<?php
    session_start();
    if (!isset($_SESSION['FirstName']) || !isset($_SESSION['LastName']) ) {
        header("Location: signUp.php");
    } 
    require_once '../vendor/autoload.php';
    // Apply Custom css file
    // define('CSSPATH', dirname(__DIR__).'/css/'); //define css path
    // $cssItem = 'style.css'; //css item to display
    include_once 'header.php';

    //  Make the connection to mysql using the credentials
    require_once 'db_connection.php';
    // $config = parse_ini_file( '../DB/apikey.ini');
?>

<body data-gr-c-s-loaded="true" cz-shortcut-listen="true">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="index.php" class="text-muted">Where My Favorite Movies @?</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#"></a>
            <a class="p-2 text-dark" href="#"></a>
            <a class="p-2 text-dark" href="#"></a>
        </nav>
        <?php
        echo '<small class="mr-3">Welcome, '.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'</small>';
        echo '<small><a class="btn btn-sm btn-outline-danger" href="signOut.php">Sign Out</a></small>';
        ?>
    </div>
    <?php
    if (isset($_POST['searched']) && isset($_POST['movie'])) { //check if the form has been submitted
        if (empty($_POST['movie'])) {
            echo "<p>Please search Again!</p>";
        } else {
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);
            $name = sanitizeString($_POST['movie']);
            $name = str_replace(' ','%20',$name);
            // Using cURl to connect IMDB-alternative API : https://rapidapi.com/rapidapi/api/movie-database-imdb-alternative
            $Movie_basic = connect_cURL_with_query($name);
            $MovieTitle = $Movie_basic["Search"][0]["Title"];
            $ReleaseYear = $Movie_basic["Search"][0]["Year"];
            $Type = $Movie_basic["Search"][0]["Type"];
            $PosterUrl = $Movie_basic["Search"][0]["Poster"];
            $MovieId = $Movie_basic["Search"][0]["imdbID"];

            $check_query= "SELECT MovieId FROM Movie WHERE MovieId = '$MovieId'";
            $check_result = $conn->query($check_query);
            $rows = $check_result->num_rows;

            if ($rows != 1) {
                // Using cURl to connect IMDB8 API : https://rapidapi.com/apidojo/api/imdb8
                $Movie_adv = get_more_infos_with_moviId($MovieId);
                $Rating = $Movie_adv[$MovieId]['ratings']['rating'];
                if(array_key_exists('topRank', $Movie_adv[$MovieId]['ratings'])){
                    $TopRank = $Movie_adv[$MovieId]['ratings']['topRank'];
                } elseif (array_key_exists('otherRanks', $Movie_adv[$MovieId]['ratings'])) {
                    $TopRank = preg_replace('/[^0-9.]/','', $Movie_adv[$MovieId]['ratings']['otherRanks'][0]['label']);
                } else {
                    $TopRank = 0000;
                }
                $RatingCount = $Movie_adv[$MovieId]['ratings']['ratingCount'];
                $add_query = "INSERT INTO Movie VALUES('$MovieId', '$MovieTitle', '$ReleaseYear', '$Type', '$PosterUrl', $Rating, $TopRank, $RatingCount)";
                $post_result = $conn->query($add_query);

                if (array_key_exists('optionGroups', $Movie_adv[$MovieId]['waysToWatch'])){
                    $ServiceName = $Movie_adv[$MovieId]['waysToWatch']['optionGroups'][0]['watchOptions'][0]['primaryText'];
                    $RetailPrice = floatval(preg_replace('/[^0-9.]/','', $Movie_adv[$MovieId]['waysToWatch']['optionGroups'][0]['watchOptions'][0]['secondaryText']));
                    $RetailLink = $Movie_adv[$MovieId]['waysToWatch']['optionGroups'][0]['watchOptions'][0]['link']['uri'];
                    $RetailType = $Movie_adv[$MovieId]['waysToWatch']['optionGroups'][0]['displayName'];
                    $add_query2 = "INSERT INTO Service VALUES (NULL, '$ServiceName')";
                    $post_result2 = $conn->query($add_query2);
                    $ServiceId = "SELECT ServiceId FROM Service WHERE ServiceName = '$ServiceName'";
                    $add_query3 = "INSERT INTO MovieService VALUES(NULL, $RetailPrice, '$RetailLink', '$RetailType', '$MovieId', $ServiceId)";
                    $post_result3 = $conn->query($add_query3);
                }
            
                if (!$post_result || !$post_result2 || !$post_result3) {
                    die ("Database access failed: " . $conn->error);
                }
            }
        };
    }
    if (isset($_POST['submitted'])) {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
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
    }
    ?>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h3 class="">Search Movies</h3>
        <p class="text-muted">Find out most recent movies that xx resources are provided!</p>
        <div class="d-flex justify-content-center">
            <form class="form-inline mt-2 mt-md-0" action="" method="post">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="movie" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                <input type="hidden" name="searched" value="yes">
            </form>
        </div>
    </div>
    <?php
        if (isset($_POST['searched']) && isset($_POST['movie'])) { //check if the form has been submitted
            if (empty($_POST['movie'])) {
                echo "<p>Please search Again!</p>";
            } else {
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error) die($conn->connect_error);
                $name = sanitizeString($_POST['movie']);
                $get_query = "SELECT * FROM Movie WHERE MovieTitle LIKE '%$name%'";
                
                $get_result = $conn->query($get_query);
                if (!$get_result) {
                    die ("Database access failed: " . $conn->error);
                } else {
                    $rows = $get_result->num_rows;
                    if ($rows) {
                        print '<div class="py-3 bg-light">
                            <div class="container">
                                <div class="m-2">
                                    <h5 class="m-2 text-secondary">Result</h5>
                                    <div class="row pt-3 mb-2 bg-light">';
                        while ($row = $get_result->fetch_assoc()) {
                            print '<div class="col-md-4">
                                        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
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
                                                </div>';
                                                // $MovieId = $row["MovieId"];
                                                // echo '<p> UUUUU'.$MovieId;
                                                // $get_query2 = "SELECT * FROM MovieService WHERE MovieId='$MovieId'";
                                                // $get_result2 = $conn->query($get_query2);

                                                // while ($row = $get_result2->fetch_assoc()) {
                                                //     echo $row['RetailPrice'];
                                                //     echo $row['RetailLink'];
                                                //     echo $row['RetailType'];
                                                // }
                                                print '<form class="form-inline mt-md-0" action="" method="post">
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
                            </div>'
                        </div>";
                    } else {
                        echo "<p>No results!</p>";
                    }
                }
            }
        } else {
            $conn = new mysqli($hn, $un, $pw, $db);
            $FirstName = $_SESSION['FirstName'];
            $LastName = $_SESSION['LastName'];

            $check_query= "SELECT UserId FROM Users WHERE FirstName = '$FirstName' && LastName = '$LastName'";
            $check_result = $conn->query($check_query);
            $rows = $check_result->num_rows;
            
            while ($row = $check_result->fetch_assoc()) {
                $UserId = $row['UserId'];
                $watchList_query = "SELECT M.MovieId, MovieTitle, ReleaseYear, Type, PosterUrl, Rating, TopRank, RatingCount
                            FROM Watchlist W INNER JOIN Movie M 
                            ON M.MovieId=W.MovieId 
                            WHERE W.UserId = $UserId";
                $watchList_result = $conn->query($watchList_query);
                if (!$watchList_result) {
                    die ("Database access failed: " . $conn->error);
                } else {
                    $rows = $watchList_result->num_rows;
                    if ($rows) {
                        
                        print '<div class="pt-1 mt-4 lighter"></div>
                        <div class="py-3 bg-light ">
                        <div class="container">
                            <div class="m-2">
                                <h5 class="my-2 text-dark">My WatchList</h5>
                                    <div class="row pt-1 mb-2">';
                        while ($row = $watchList_result->fetch_assoc()) {
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
                                            <div class="d-none d-lg-block my-3">';
                                            print '<img src="'.$row["PosterUrl"].'" alt="'.$row["MovieTitle"].'" width="100%" height="30%">';
                                            // if ($row["PosterUrl"]) {
                                            //     print "<img src="".row["PosterUrl"]."" alt="".$row["MovieTitle"]."" > ";
                                            // } else {
                                            //     print "<svg class="bd-placeholder-img" width="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>";
                                            // }
                                            print '
                                            </div>
                                            <form class="form-inline mt-md-0">
                                                <button class="btn btn-sm btn-dark my-2 my-sm-0 mr-2" type="submit"><a href="https://www.imdb.com/title/'.$row["MovieId"].'" class="text-light" target="_blank">More Details ></a></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                        }
                        print "</div>
                            </div>
                        </div>";
                    }
                }
            } 
            include_once('topTrending.php');

            if (isset($_GET['submit'])) { //check if the form has been submitted
        
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error) die($conn->connect_error);
                // Using cURl to connect IMDB-alternative API : https://rapidapi.com/rapidapi/api/movie-database-imdb-alternative
                // $get_query = "SELECT * FROM Movie WHERE MovieTitle LIKE '%$name%'";
                // $get_result = $conn->query($get_query);
        
                // if (!$Movie_basic) {
                //     die ('Does it collect to search ".$name."? Please search again, The <a href="https://www.imdb.com/">IMDB</a> didn\'t have it');
                // } elseif (!$post_result) {
                //     die ("Database access failed: " . $conn->error);
                // }
            };
        }
    ?>
    <?php

        function sanitizeString($var){
            $var = stripslashes($var);
            $var = strip_tags($var);
            $var = htmlentities($var);
            return $var;
        };

        function sanitizeMySQL($connection, $var){
            $var = sanitizeString($var);
            $var = $connection->real_escape_string($var);
            return $var;
        };

        function connect_cURL_with_query($query){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://movie-database-imdb-alternative.p.rapidapi.com/?page=1&r=json&s=".$query,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: movie-database-imdb-alternative.p.rapidapi.com",
                    "x-rapidapi-key: 8e73a39958msh5b6463aa3427577p179ea0jsn9b350378e684"
                ),
            ));
            
            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                $response = json_decode($response_json, true);
                return $response;
            }
        };

        function get_more_infos_with_moviId($MovieId){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-meta-data?region=US&ids=".$MovieId,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: imdb8.p.rapidapi.com",
                    "x-rapidapi-key: 8e73a39958msh5b6463aa3427577p179ea0jsn9b350378e684"
                ),
            ));

            $response_json = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                $response = json_decode($response_json, true);
                return $response;
            }
        };

        include_once('footer.php');
?>