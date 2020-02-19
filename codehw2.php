<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Code Homework 02</title>
        <style>
            body {padding: 20px 40px;}
            li {list-style-type: circle;}
            .hw1 {padding: 14px 40px; width:470px; background-color: WhiteSmoke;}
            .hw2 {margin: 20px 0 0; padding: 14px 40px; width:470px; background-color: WhiteSmoke;}
        </style>
    </head>
    <body>
        <p>Code Homework 02</p>
        <div class="hw1">
            <h1>Challenge: ISBN Validation</h1>
            <?php
                # function
                function loopup_till_X($index) {
                    // $index = ($X == true ? 10 : 9);
                    echo 'index: '.$index.'<br/>';
                    $m = array();
                    $sumAll = 0;
                    for ($i = 0; $i < $index; $i++) {
                        for ($j = $index; $j = 0; $j--) {
                            array_push($m,$isbn[$i]*$j);
                            echo 'm: '.$m.'<br/>';
                        }
                        $sumAll += $m[$i];
                        echo 'sumAll: '.$sumAll.'<br/>';
                    }
                    return $sumAll;
                };

                $isbn = '156881111X';
                print "<h4>Checking isbn: ".$isbn." for validity...</h4>";

                if (strlen($isbn) == 10) {
                    if (preg_match('/X{1}$/', $isbn)) {
                        $sumAll = loopup_till_X(9);
                    } else {
                        $sumAll = loopup_till_X(10);
                    }
                    if ($sumAll % 11 == 0) {
                        print "<h4>This's a valid ISBN!</h4>".$sumAll.": is decide by 11 with no remainder!";
                    } else {
                        print "<h4>This's not a valid ISBN! It should devide by 11 with no remainder.</h4>";
                    }
                } else {
                    print "<h4>This's not a valid ISBN! It should have 10 digits.</h4>";
                }
            ?>
        </div>

        <div class="hw2">
            <?php
                $N = 9;
                $makeReduced = true;
                print "<h1>Challenge: Coin Toss</h1>";
               
            ?>
        </div>
    </body>
</html>