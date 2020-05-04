<?php
    session_start(); 
    require_once '../vendor/autoload.php';
    // Apply Custom css file
    // define('CSSPATH', dirname(__DIR__).'/css/'); //define css path
    // $cssItem = 'style.css'; //css item to display

    //  Make the connection to mysql using the credentials
    require_once 'db_connection.php';

    if (isset($_POST['submitted'])) { //check if the form has been submitted
        if (empty($_POST['usrName']) || empty($_POST['password'])) {
            echo "<p>Please fill out all the fields!</p>";
        } else {
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            $usrName = $_POST['usrName'];
            $password = $_POST['password'];
            $salt1 = "qm&h*";  
            $salt2 = "pg!@"; 
            $password = hash('ripemd128', $salt1.$password.$salt2);
            $check_query  = "SELECT FirstName, LastName FROM Users WHERE UsrName='$usrName' AND Passwords='$password'"; 
            $check_result = $conn->query($check_query);    
            if (!$check_result) die($conn->error); 
            $rows = $check_result->num_rows;
            if ($rows==1) {
                $row = $check_result->fetch_assoc();
                $_SESSION['FirstName'] = $row['FirstName'];
                $_SESSION['LastName'] = $row['LastName'];
                header("Location: index.php");			
            } else {
                echo "<p>Can you try again? The username/password doesn't match!</p>";
            }
        };
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Where Free Movies @?</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body class="container d-flex align-items-center justify-content-center" data-gr-c-s-loaded="true" cz-shortcut-listen="true">
        <div class="p-5 m-5">
            <form class="form-signin" action="" method="post">
                <h4 class="h3 mb-3 font-weight-normal">Please sign in</h4>
                <label for="inputUserName" class="sr-only">User Name</label>
                <input type="Username" id="inputUserName" class="form-control mb-2" placeholder="User Name" name="usrName">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" name="password">
                <!-- <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div> -->
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <input type="hidden" name="submitted" value="yes">
            </form>
            <div class="pt-5">
                <small class="d-block mb-3 text-muted">© 2020</small>
            </div>
        </div>
    </body>
</html>