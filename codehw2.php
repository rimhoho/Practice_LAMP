<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Code Homework 02</title>
        <style>
            body {padding: 20px 40px; font: bold 12px Arial, Sans-serif;}
            li {list-style-type: circle;}
            .hw1 {padding: 14px 40px; width:680px; background-color: WhiteSmoke;}
            .hw2 {margin: 20px 0 0; padding: 14px 40px; width:680px; background-color: WhiteSmoke;}
            h3 {margin:8px 6px;}
            .wheat {background-color: Wheat;}
            .white {background-color: white;}
            .gainsboro {padding: 8px 12px; background-color: Gainsboro;}
            .box {padding:8px 16px; margin:0 0 8px 0;}
            button { border: none; color: white; padding: 12px 28px; text-align: center; display: inline-block; margin: 0 6px 12px; cursor: pointer; background-color: Maroon;}
            button a {text-decoration: none; color: white; font: bold 12px Arial, Sans-serif;}
        </style>
    </head>
    <body>
        <p>Code Homework 02</p>
        <div class="hw1">
            <h1>Challenge: ISBN Validation</h1>
            <?php
                # function
                function loopup_till_X($isbn, $index) {
                    $value = str_split($isbn);
                    $sumAll = 0;
                    $counter = $index;
                    // $value =['0','7','4'...,'9']
                    for ($i = 0; $i < $index; $i++) {
                        $sumAll += ((int)$value[$i])*$counter;
                        $counter--;
                    }
                    return $sumAll;
                };

                $isbn = '0747532699';
                print "<h4>Checking <span class='box gainsboro'>".$isbn."</span> for validity...</h4>";

                if (strlen($isbn) == 10) {
                    
                    if (preg_match('/X{1}$/', $isbn)) {
                        $sumAll = loopup_till_X($isbn, 9);
                    } else {
                        $sumAll = loopup_till_X($isbn, 10);
                    }

                    if ($sumAll % 11 == 0) {
                        print "<div class='box wheat'><h3>".$isbn." is a valid ISBN.</h3> <button><a href='https://isbnsearch.org/isbn/".$isbn."' target='_blank'>More Details</a></button></div>";
                    } else {
                        print "<div class='box gainsboro'><h3>Not a valid ISBN</h3></div>";
                    }
                } else {
                    print "<div class='box gainsboro'><h3>Not a valid ISBN! It should have 10 digits.</h3></div>";
                }
            ?>
        </div>

        <div class="hw2">
            <h1>Challenge: Coin Toss</h1>
            <h4 class='gainsboro'>1. Create a series of random coin tosses for 1, 3, 5, 7, and 9 flips.</h4>
            <?php
                $count = 0;

                echo "<div>";
                do {
                    if ($count % 2 !== 0) {
                        echo "<p>Flipping a coin <b>".$count."</b> time(s)..</p>";
                        for($i=0; $i < $count; $i++){
                            $indicator = mt_rand(0, 1);
                            if ($indicator == 0) {
                                echo "<img src='head.png' alt='coin-head' width='80px' margin='4px'>";
                            } else {
                                echo "<img src='tail.png' alt='coin-tail' width='80px' margin='4px'>";
                            }
                        }
                    }
                    $count++;
                } while ($count < 10);
                echo "</div>";
                
                echo "<h4 class='gainsboro'>2. Create a loop that will toss the coin repeatedly until you have flipped exactly two heads in a row</h4>";
                $times = 0;
                $head_count = 0;
                echo "<h3>Beginning the coin flipping...</h3>";
                do {
                    $indicator = mt_rand(0, 1);
                    if ($indicator == 0) {
                        $head_count++;
                        echo "<img src='head.png' alt='coin-head' width='80px' margin='4px'>";
                    } else {
                        echo "<img src='tail.png' alt='coin-tail' width='80px' margin='4px'>";
                    }
                    $times++;
                    if ($head_count == 2) {
                        echo "<h3>Flipped two heads in a row, in <b>".$times."</b> flips!</h3>";
                    }
                } while ($head_count < 2) ;
               
            ?>
        </div>
    </body>
</html>
