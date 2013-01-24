<?php
    if(isset($_POST['bookid']) && !empty($_POST['bookid'])) {

        require '../db/connect.php';
        $query = mysql_query("SELECT * FROM listings WHERE (`book_id` = " . $_POST['bookid'] . ")");            
        
        echo('<tr><td colspan = 4><table id = ' . $_POST['bookid'] . ' style="color:#000000; padding:15px;" class="table table-hover">');
        if (mysql_num_rows($query) !== 0)
        {               
                while($results = mysql_fetch_array($query))
                {
#                    $userquery = mysql_query("SELECT * FROM users WHERE (`id` = " . $_POST['user_id'] . ")");
                    
                    $id = $results['id'];
                    $price = $results['price'];
                    $cond = $results['book_condition'];
#                    $firstname = mysql_fetch_array($userquery)['firstname'];
#                    $lastname = mysql_fetch_array($userquery)['lastname'];
                    echo("<tr id = " . $id . ">");
                    echo("<td style=\"text-align:center;\">LOL</td>");                    
                    echo("<td style=\"text-align:center;\"><h5>" . $price . "</h5></td>");
                    echo("<td style=\"text-align:center;\"><h5>" . $cond . "</h5></a></td>");
                    echo("<td style=\"text-align:center;\"><h5>LOL</h5></a></td>");
                    echo("<td style=\"text-align:center;\"><h5>LOL</h5></a></td>");
                    echo("</tr>");
                }
        }
        
        else
        {        
            echo ('<h3>No Listings found</h3>');
        }
        echo('</td></table></tr>');
    }
