<?php
    if(isset($_POST['bookid']) && !empty($_POST['bookid'])) {

        require '../db/connect.php';
        $query = mysql_query("SELECT * FROM listings WHERE (`book_id` = " . $_POST['bookid'] . ")");            
        
        echo('<tr><td colspan = 4 class = "invisible" id = book_' . $_POST['bookid'] . '><table id = "listings" style="color:#000000; padding:15px;">');
        if (mysql_num_rows($query) !== 0)
        {               
                while($results = mysql_fetch_array($query))
                {
                    $userquery = mysql_query("SELECT * FROM users WHERE (`id` = " . $results['user_id'] . ")");
                    $userresults = mysql_fetch_array($userquery);
                    
                    $id = $results['id'];
                    $price = $results['price'];
                    $cond = $results['book_condition'];
                    $firstname = $userresults['firstname'];
                    $lastname = $userresults['lastname'];
                    echo("<tr id = " . $id . ">");
                    echo("<td style=\"text-align:center;\">LOL</td>");                    
                    echo("<td style=\"text-align:center;\"><h5>" . $price . "</h5></td>");
                    echo("<td style=\"text-align:center;\"><h5>" . $cond . "</h5></a></td>");
                    echo("<td style=\"text-align:center;\"><h5>" . $firstname . "</h5></a></td>");
                    echo("<td style=\"text-align:center;\"><h5>" . $lastname . "</h5></a></td>");
                    echo("<td id = star_" . $id . "><i class=\"icon-star icon-black\"></td>");
                    echo("<td id = cart_" . $id . "><i class=\"icon-shopping-cart icon-black\"></td>");
                    echo("</tr>");
                }
        }
        
        else
        {        
            echo ('<h3>No Listings found</h3>');
        }
        echo('</td></table></tr>');
    }
