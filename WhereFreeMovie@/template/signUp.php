<?php
    require_once '../vendor/autoload.php';
    // Apply Custom css file
    // define('CSSPATH', dirname(__DIR__).'/css/'); //define css path
    // $cssItem = 'style.css'; //css item to display

    //  Make the connection to mysql using the credentials
    require_once 'db_connection.php';

    if (isset($_POST['submitted'])) { //check if the form has been submitted
        if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['userName']) || empty($_POST['password'])) {
            echo "<p>Please fill out all the fields!</p>";
        } else {
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            $salt1 = "qm&h*";  
            $salt2 = "pg!@";  
            $fname = $_POST['firstName'];
            $lname = $_POST['lastName'];
            $username = $_POST['userName'];
            $password = $_POST['password'];
            $token = hash('ripemd128', "$salt1$password$salt2");
            // echo $username."<p>".$password."</p>";
            $user_query  = "INSERT INTO Users VALUES(NULL, '$fname', '$lname', '$username', '$token')";    
            $user_result = $conn->query($user_query);    

            if (!$user_result) {
                die ("Database access failed: " . $conn->error);
            } else {
                header("Location: signIn.php");
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
                <h4 class="h3 mb-3 font-weight-normal">Create your account</h4>
                <label for="inputFirstName" class="sr-only">First Name</label>
                <input type="firstName" id="inputFirstName" class="form-control mb-2" placeholder="First Name" name="firstName">
                <label for="inputLastName" class="sr-only">Last Name</label>
                <input type="lastName" id="inputLastName" class="form-control mb-2" placeholder="Last Name" name="lastName">
                <label for="inputUserName" class="sr-only">User Name</label>
                <input type="Username" id="inputUserName" class="form-control mb-2" placeholder="User Name" name="userName">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" name="password">
                <div class="checkbox mb-3">
                    Do you have an account? <a href="signIn.php" class="text-primary">Sing in ></a>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create account</button>
                <input type="hidden" name="submitted" value="yes">
            </form>
            <div class="pt-5">
                <small class="d-block mb-3 text-muted">© 2020</small>
            </div>
        </div>
    </body>
</html>