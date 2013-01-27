<?php
    if(isset($_POST['bookid']) && !empty($_POST['bookid'])) {

        require '../db/connect.php';
        $query = mysql_query("SELECT * FROM listings WHERE (`book_id` = " . $_POST['bookid'] . ")");            

        echo('<tr><td colspan = 4 id = listbook_' . $_POST['bookid'] . '><table id = "listings" style="color:#000000; padding:15px;">');

        if (mysql_num_rows($query) !== 0)
        {               
                while($results = mysql_fetch_array($query))
                {
                    $userquery = mysql_query("SELECT * FROM users WHERE (`id` = " . $results['user_id'] . ")");
                    $userresults = mysql_fetch_array($userquery);

                    
                    $starquery = mysql_query("SELECT * FROM user_starred WHERE (`listing_id` = " . $results['id'] . ")");                    
                    $starred =false;
                    while($starresults = mysql_fetch_array($starquery))
                    {
                        if (1 == $starresults['user_id'])
                        {
                            $starred = true;
                        }
                    }
                    
                    $cartquery = mysql_query("SELECT * FROM user_cart WHERE (`listing_id` = " . $_POST['bookid'] . ")");
                    $carted =false;
                    $users = 0;
                    while($cartresults = mysql_fetch_array($starquery))
                    {
                        $users++;
                        if (1 == $cartresults['user_id'])
                        {
                            $carted = true;
                        }
                    }
                    
                    $id = $results['id'];
                    $price = $results['price'];
                    $cond = $results['book_condition'];
                    $firstname = $userresults['firstname'];
                    $lastname = $userresults['lastname'];

                    echo("<tr id =list_" . $id . " class='hoverstate'>");
                    if($users == 0)
                    {
                        echo("<td class = 'listhilite green' id = boom_". $id . " style=\"text-align:center;\">LOL</td>");                    
                        echo("<td class = 'listhilite green' id = boom_". $id . " style=\"text-align:center;\"><h5>$" . $price . "</h5></td>");
                        echo("<td class = 'listhilite green' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $cond . "</h5></a></td>");
                        echo("<td class = 'listhilite green' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $firstname . " " . $lastname . "</h5></a></td>");

                        if ($starred == false)
                            echo("<td class = 'listhilite green' id = star_" . $id . "><h5><i class=\"icon-star\"></i> Star It!</h5></td>");
                        if ($starred == true)
                            echo("<td class = 'listhilite green' id = star_" . $id . "><h5><i class=\"icon-star icon-white\"></i> Un-Star?</h5></td>");
                        if ($carted == false)    
                            echo("<td class = 'listhilite green' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart\"></i> Add to Cart</h5></td>");
                        if ($carted == true)    
                            echo("<td class = 'listhilite green' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart icon-white\"></i> Remove from Cart</h5></td>");
                        echo("<td class = 'listhilite green' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $users . "  <i class=\"icon-user icon-white\"></i></h5></a></td>");
                    }
                    if($users > 0 && $users < 5)
                    {
                        echo("<td class = 'listhilite yellow' id = boom_". $id . " style=\"text-align:center;\">LOL</td>");                    
                        echo("<td class = 'listhilite yellow' id = boom_". $id . " style=\"text-align:center;\"><h5>$" . $price . "</h5></td>");
                        echo("<td class = 'listhilite yellow' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $cond . "</h5></a></td>");
                        echo("<td class = 'listhilite yellow' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $firstname . " " . $lastname . "</h5></a></td>");

                        if ($starred == false)
                            echo("<td class = 'listhilite yellow' id = star_" . $id . "><h5><i class=\"icon-star\"></i> Star It!</h5></td>");
                        if ($starred == true)
                            echo("<td class = 'listhilite yellow' id = star_" . $id . "><h5><i class=\"icon-star icon-white\"></i> Un-Star?</h5></td>");
                        if ($carted == false)    
                            echo("<td class = 'listhilite yellow' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart\"></i> Add to Cart</h5></td>");
                        if ($carted == true)    
                            echo("<td class = 'listhilite yellow' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart icon-white\"></i> Remove from Cart</h5></td>");
                        echo("<td class = 'listhilite yellow' id = boom_". $id . " style=\"text-align:center;\"><h5>10  <i class=\"icon-user icon-white\"></i></h5></a></td>");
                    }
                    if($users == 5)
                    {
                        echo("<td class = 'listhilite pending_red' id = boom_". $id . " style=\"text-align:center;\">LOL</td>");                    
                        echo("<td class = 'listhilite pending_red' id = boom_". $id . " style=\"text-align:center;\"><h5>$" . $price . "</h5></td>");
                        echo("<td class = 'listhilite pending_red' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $cond . "</h5></a></td>");
                        echo("<td class = 'listhilite pending_red' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $firstname . " " . $lastname . "</h5></a></td>");

                        if ($starred == false)
                            echo("<td class = 'listhilite pending_red' id = star_" . $id . "><h5><i class=\"icon-star\"></i> Star It!</h5></td>");
                        if ($starred == true)
                            echo("<td class = 'listhilite pending_red' id = star_" . $id . "><h5><i class=\"icon-star icon-white\"></i> Un-Star?</h5></td>");
                        if ($carted == false)    
                            echo("<td class = 'listhilite pending_red' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart\"></i> Add to Cart</h5></td>");
                        if ($carted == true)    
                            echo("<td class = 'listhilite pending_red' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart icon-white\"></i> Remove from Cart</h5></td>");
                        echo("<td class = 'listhilite pending_red' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $users . "  <i class=\"icon-user icon-white\"></i></h5></a></td>");
                    }
                    if($users > 6)
                    {
                        echo("<td class = 'listhilite red' id = boom_". $id . " style=\"text-align:center;\">LOL</td>");                    
                        echo("<td class = 'listhilite red' id = boom_". $id . " style=\"text-align:center;\"><h5>$" . $price . "</h5></td>");
                        echo("<td class = 'listhilite red' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $cond . "</h5></a></td>");
                        echo("<td class = 'listhilite red' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $firstname . " " . $lastname . "</h5></a></td>");

                        if ($starred == false)
                            echo("<td class = 'listhilite red' id = star_" . $id . "><h5><i class=\"icon-star\"></i> Star It!</h5></td>");
                        if ($starred == true)
                            echo("<td class = 'listhilite red' id = star_" . $id . "><h5><i class=\"icon-star icon-white\"></i> Un-Star?</h5></td>");
                        if ($carted == false)    
                            echo("<td class = 'listhilite red' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart\"></i> Add to Cart</h5></td>");
                        if ($carted == true)    
                            echo("<td class = 'listhilite red' id = cart_" . $id . "><h5><i class=\"icon-shopping-cart icon-white\"></i> Remove from Cart</h5></td>");
                        echo("<td class = 'listhilite red' id = boom_". $id . " style=\"text-align:center;\"><h5>" . $users . "  <i class=\"icon-user icon-white\"></i></h5></a></td>");
                    }
                    echo("</tr>");
                }
        }
        
        else
        {        
            echo ('<h3>No Listings found</h3>');
        }
        echo('</td></table></tr>');
    }
