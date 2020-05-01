<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Code Homework 03</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="m-3">
        <main class="flex-shrink-0">
            <div class="container">
                <p class='font-weight-bold'>Code Homework 03</p>
                <div class="p-4 bg-light mb-4">
                    <h3>Challenge: Book lists</h3>
                    <?php
                        // include_once __DIR__ . '/../vendor/autoload.php';

                        // $redirect_uri = 'https://webdevdbcourses.prattsi.org/~hhwang5/codehw3.php';

                        // $client = new Google_Client();
                        // $client->setApplicationName("Google_book_search_results");
                        // $client->setRedirectUri($redirect_uri);
                        // $client->setDeveloperKey("AIzaSyDpw7Hxkye4rATfZkSzjn81NSjPP297s0Y");

                        // $service = new Google_Service_Books($client);
                        // // $optParams = array('filter' => 'free-ebooks');
                        // $results = $service->volumes->listVolumes('PHP and MySQL Web Development'); #, $optParams);

                        // foreach ($results as $item) {
                        // echo $item['volumeInfo']['title'], "<br /> \n";
                        // }

                        $indicators = ["Title", "Author", "Page #", "Type", "Price"];
                        $collections = [
                            ["title"=>"PHP and MySQL Web Development", "author"=>"Luke Welling", "number of pages"=>144, "type"=>"Paperback", "price"=>"$31.63"],
                            ["title"=>"Web Design with HTML, CSS, JavaScript and jQuery", "author"=>"Jon Duckett", "number of pages"=>135, "type"=>"Paperback", "price"=>"$41.23"],
                            ["title"=>"PHP Cookbook: Solutions & Examples for PHP Programmers", "author"=>"David Sklar", "number of pages"=>14, "type"=>"Paperback", "price"=>"$40.88"],
                            ["title"=>"JavaScript and JQuery: Interactive Front-End Web Development", "author"=>"Jon Duckett", "number of pages"=>251, "type"=>"Paperback", "price"=>"$22.09"],
                            ["title"=>"Modern PHP: New Features and Good Practices", "author"=>"Josh Lockhart", "number of pages"=>7, "type"=>"Paperback", "price"=>"$28.49"],
                            ["title"=>"Programming PHP", "author"=>"Kevin Tatroe", "number of pages"=>26, "type"=>"Paperback", "price"=>"$28.96"]
                        ];      
                        print "<table class='table mt-3'>
                                    <thead class='thead-dark text-center'>
                                        <tr>
                                            <th scope='col'>#</th>";
                                            foreach ($indicators as $i){
                                                print "<th scope='col'>".$i."</th>";
                                            }
                                    print "</tr>
                                    </thead>";     
                        foreach ($collections as $i=>$collection) {
                            print "<tbody>
                                        <tr>
                                        <th scope='row'>".((int)$i+1)."</th>
                                            <td>".$collection['title']."</td>
                                            <td>".$collection['author']."</td>
                                            <td>".$collection['number of pages']."</td>
                                            <td>".$collection['type']."</td>
                                            <td>".$collection['price']."</td>
                                        </tr>
                                    </tbody>";
                        }
                        echo "</table>"; 
                        echo "<div class='bg-warning container text-center py-2'>
                                <h6 class='pt-2'>Your total price is: </h6>";
                                foreach($collections as $i=>$collection){
                                    $sum_all += (float)substr($collection['price'], 1);
                                }
                        echo "<h5>$".$sum_all."</h5></div>";
                    ?>
                </div>
                <div class="p-4 bg-light">
                    <h3>Challenge: Coin Toss, continued</h3>
                    <?php
                        $N = 6;
                        
                        function coinToss($N) {
                            $times = 0;
                            $head_count = 0;
                            print "<h6 pt-2>Beginning the coin flipping, looking for ".$N." times in a row...</h6>
                                <div class='my-4'>";
                            do {
                                $indicator = mt_rand(0, 1);
                                if ($indicator == 0) {
                                    $head_count++;
                                    echo "<img src='images/head.png' alt='coin-head' width='80px'>";
                                } else {
                                    $head_count=0;
                                    echo "<img src='images/tail.png' alt='coin-tail' width='80px'>";
                                }
                                $times++;
                                if ($head_count == $N) {
                                    print "</div>
                                        <h6>Flipped ".$head_count." heads in a row, in ".$times." flips!</h6>";
                                }
                            } while ($head_count < $N);

                            return; 
                        }

                        coinToss($N);
                    ?>
                </div>      
            </div>
        </main>
    </body>
</html>
