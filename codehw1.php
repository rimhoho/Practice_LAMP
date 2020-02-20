<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Code Homework 01</title>
        <style>
            body {padding: 20px 40px; font: bold 12px Arial, Sans-serif;}
            li {list-style-type: circle;}
            .hw1 {padding: 14px 40px; width:680px; background-color: WhiteSmoke;}
            .hw2 {margin: 20px 0 0; padding: 14px 40px; width:680px; background-color: WhiteSmoke;}
        </style>
    </head>
    <body>
        <p>Code Homework 01</p>
        <div class="hw1">
            <h1>Challenge: Correct Change</h1>
            <?php
                $changes = 159;
                $types = [100, 25, 10, 5, 1];

                print "<h4>You are due ".$changes." cents back in change total.</h4>
                      <ul><b>You are due back</b>";

                for ($i = 0; $i < count($types); $i++) {
                    $remains = floor($changes / $types[$i]);      
                    $changes = $changes % $types[$i];
                    switch ($i) {
                        case 0:
                            echo "<li><b>".$remains."</b> dollor(s)</li>";
                            break;
                        case 1:
                            echo "<li><b>".$remains."</b> quarter(s)</li>";
                            break;
                        case 2:
                            echo "<li><b>".$remains."</b> dime(s)</li>";
                            break;  
                        case 3:
                            echo "<li><b>".$remains."</b> nikele(s)</li>";
                            break;
                        case 4:
                            echo "<li><b>".$remains."</b> cent(s)</li>";
                            break;
                    }
                }
                echo "</ul>";
            ?>
        </div>

        <div class="hw2">
            <?php
                $N = 9;
                $makeReduced = true;
                print "<h1>Challenge: ".$N." Bottles of Bear</h1>
                      <ul>";
                while ($makeReduced) {
                    echo "<li><b>".$N."</b> bottles of beer on the wall, <b>".$N."</b> bottles of beer.</li>";
                    --$N;
                    echo "<li>"."Take one down, Pass it around, <b>".$N."</b> bottles of beer on the wall.</li>";
                    if ($N == 0) {
                        $makeReduced = false;
                    }
                }
                echo "</ul>";
            ?>
        </div>
    </body>
</html>