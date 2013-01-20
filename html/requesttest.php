<?php

require("../includes/config.php");

//gets the get variable
$q = $_GET["q"];

//queries messages and names
$rows = query("SELECT * FROM messages WHERE from_user = ?", $q);
$userrows = query("SELECT * FROM users WHERE username = ?", $rows[0]['from_user']);

//set the name to first last
$name=$userrows[0]["firstname"]." ".$userrows[0]["lastname"];

//prints out the messaging display that we see
echo "<div class=\"container \"";
    echo "<div class=\"row-fluid\"";
        echo "<div class=\"message\" style=\"color:#FFFFFF;\">";
            echo "<div class=\"span3\">";
            echo "<h3 style=\"padding:15px;\"class=\"pull-left\">" . $name . ":</h3>";
            echo "</div>";

            echo "<div class=\"span6\">";
            foreach($rows as $row)
            {
              $time = date("g:i a", strtotime($row['time']));
              echo "<div class=\"span12\"style=\"max-height:400px; overflow:hidden; margin: 4px; word-wrap: break-word;\">";
              echo "<p class=\"span6\" >" . $row['message'] . "</p>";
              echo "<p class=\"span2\"style=\"text-align:right;\">" . $time . "</p>";
              echo "</div>";

            }
            echo "</div>";
        echo "</div>";
    echo "</div>";
echo "</div>";

?>
