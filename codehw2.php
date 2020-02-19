<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Code Homework 02</title>
        <style>
            body {padding: 20px 40px;}
            li {list-style-type: circle;}
            .hw1 {padding: 14px 40px; width:470px; background-color: WhiteSmoke;}
            .hw2 {margin: 20px 0 0; padding: 14px 40px; width:470px; background-color: WhiteSmoke;}
            .yellow {background-color: gold;}
            .darkgrey {background-color: grey;}
            .box {padding:8px 12px;}
        </style>
    </head>
    <body>
        <p>Code Homework 02</p>
        <div class="hw1">
            <h1>Challenge: ISBN Validation</h1>
            <?php
                # function
                function loopup_till_X($isbn, $index) {
                    // $index = ($X == true ? 10 : 9);\
                    $value = str_split($isbn);
                    $sumAll = 0;
                    $counter = $index;
                    for ($i = 0; $i < $index; $i++) {
                        $sumAll += ((int)$value[$i])*$counter;
                        $counter--;
                    }
                    return $sumAll;
                };

                $isbn = '0747532699';
                print "<h4>Checking isbn: <span class='box yellow'>".$isbn."</span> for validity...</h4>";

                if (strlen($isbn) == 10) {
                    if (preg_match('/X{1}$/', $isbn)) {
                        $sumAll = loopup_till_X($isbn, 9);
                    } else {
                        $sumAll = loopup_till_X($isbn, 10);
                    }
                    
                    if ($sumAll % 11 == 0) {
                        print "<h4>This's a <span class='box yellow'>valid ISBN</span>.</h4><div>".$sumAll.": is decided by 11 with no remainder!</div>";
                    } else {
                        print "<p>This's <span class='box darkgrey'> not a valid ISBN</span>.</p><div>".$sumAll.": isn't devide by 11 with no remainder.</div>";
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