<?php

require("../includes/config.php"); 

    //save username into variable
    $username = $_POST['uname'];

    //ensure proper username length
    if(strlen($username) <= 2)
    {
        echo 1;
    }
    
    //if length is correct
    else
    {
        //query the database and store informaton about the user in the variable
        $userrows = query("SELECT * FROM users WHERE username = '$username'");

        //calculate the number of users with the given username
        $sum = 0;
        foreach($userrows as $userrow)
        {
            $sum++;
        }

        //send a response based upon the result
        if($sum > 0)
        {  
            //and we send 0 to the ajax request  
            echo 0;  
        }
        else
        {  
            //else if it's not bigger then 0, then it's available '  
            //and we send 1 to the ajax request  
            echo 2;  
        }  
    }

?>

