<?php

    // configuration
    require("../includes/config.php"); 

    //connect  to the database 
    $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
	//-select  the database to use 
	$mydb=mysql_select_db("project") or die (mysql_error());
    
    if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']))
	{ 
        // Verify data  
        $email = mysql_real_escape_string($_GET['email']); // Set email variable  
        $hash = mysql_real_escape_string($_GET['hash']); // Set hash variable
                   
        //query the database for a user with the provided e-mail and hash code
        $rows = mysql_query("SELECT * FROM users WHERE (`email` = '" . $email . "') AND (hash = '" . $hash . "') AND active=0") or die(mysql_error());
        
        //count how many results the query got
        $match  = mysql_num_rows($rows);
        if($match > 0)
        {  
            // We have a match, activate the account  
            query("UPDATE users SET active=1 WHERE email=? AND hash = ? AND active = 0", $email, $hash);
            
            // query database for user
            $rows = query("SELECT * FROM users WHERE email = ?", $_GET["email"]);
            
            //access the first and only row
            $row = $rows[0]; 
                     
            //log the user in
            $_SESSION["id"] = $row["id"];

            //save the user information
                $first = $row["firstname"];
                $last = $row["lastname"];
                $user = $row["username"];

            // render the activation success page, passing in all the important user information
            render("activate_form.php", ["title" => "Registration Complete!", "first" => $first, "last" => $last, "user" => $user]);
        }   
         else
         {  
            // No match -> invalid url or account has already been activated.  
            apologize("The url is either invalid or you have already activated your account");
         }
     }
     else
     {
        //one or more of the GET variables is invalid so notify the user
        apologize("Invalid Activation Link. Please try again.");
     }
?>
