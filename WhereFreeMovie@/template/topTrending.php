<?php
    require_once '../vendor/autoload.php';
    include_once 'header.php';
    $cssItem = 'style.css'; //css item to display

    //  Make the connection to mysql using the credentials
    require_once 'db_connection.php';
   
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    // $config = parse_ini_file( '../DB/apikey.ini');

    if (isset($_POST['submitted'])) { //check if the form has been submitted
        $MovieId = $_POST['submitted'];
        $FirstName = $_SESSION['FirstName'];
        $LastName = $_SESSION['LastName'];

        $check_query= "SELECT UserId FROM Users WHERE FirstName = '$FirstName' && LastName = '$LastName'";
        $check_result = $conn->query($check_query);
        $rows = $check_result->num_rows;
        while ($row = $check_result->fetch_assoc()) {
            $UserId = $row['UserId'];
            $add_query = "INSERT INTO Watchlist VALUES(NULL, $UserId, '$MovieId')";
            $post_result = $conn->query($add_query);
        }
       

        // if (!$post_result) {
        //     die ("Database access failed: " . $conn->error);
        // }
    };
?>

<?php
    $get_query = "SELECT `MovieId`, `MovieTitle`, `ReleaseYear`, `Type`, `PosterUrl`, `Rating`, `TopRank`, `RatingCount` FROM `Movie` WHERE `Rating` > 8.8 ORDER BY `Rating` DESC";
    $get_result = $conn->query($get_query);

    if (!$get_result) {
        die ("Database access failed: " . $conn->error);
    } else {
        $rows = $get_result->num_rows;
        if ($rows) {
            print '<div class="py-3 mt-4 bg-secondary">
                <div class="container">
                    <div class="m-2">
                        <h5 class="mt-2 text-light">This week\'s Top Rating TV/Movies</h5>
                        <div class="row pt-2 mb-2">';
            while ($row = $get_result->fetch_assoc()) {
                print '<div class="col-md-4">
                        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="d-inline-block mb-2 text-muted">'.Strtoupper($row["Type"]).' Top'.$row["TopRank"].'</strong>
                                    <div>
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 24 24" fill="currentColor" role="presentation"><path d="M12 20.1l5.82 3.682c1.066.675 2.37-.322 2.09-1.584l-1.543-6.926 5.146-4.667c.94-.85.435-2.465-.799-2.567l-6.773-.602L13.29.89a1.38 1.38 0 0 0-2.581 0l-2.65 6.53-6.774.602C.052 8.126-.453 9.74.486 10.59l5.147 4.666-1.542 6.926c-.28 1.262 1.023 2.26 2.09 1.585L12 20.099z"></path></svg>
                                        <small class="card-text">'.$row["Rating"].'</small>
                                    </div>
                                </div>
                                <h5 class="mb-0">'.$row["MovieTitle"].'</h5>
                                <small class="mb-1 text-muted">'.$row["ReleaseYear"].'</small>
                                <div class="d-none d-lg-block my-3">
                                    <img src="'.$row["PosterUrl"].'" alt="'.$row["MovieTitle"].'" width="100%" height="30%">
                                </div>
                                <form class="form-inline mt-md-0" action="index.php" method="post">
                                    <button class="btn btn-sm btn-outline-primary my-2 my-sm-0 mr-3" type="submit">+ Watchlist</button>
                                    <small><a href="https://www.imdb.com/title/'.$row["MovieId"].'" class="text-primary" target="_blank">More Details ></a></small>
                                    <input type="hidden" name="submitted" value='.$row["MovieId"].'>
                                </form>
                            </div>
                        </div>
                    </div>';
                }
                print "</div>
                    </div>
                </div>
            </div>";
        } else {
            echo "<p>No results!</p>";
        }
    }
?>