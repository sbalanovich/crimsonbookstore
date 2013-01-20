<?php

    require("../includes/config.php"); 

    //store the email
    $email = $_POST['email'];

    //ensure validity of the e-mail as a valid harvard account
    if (checkEmail($email) === false)
    {
        echo 1;
    }

    else
    {
        //extract all username data at given e-mail
        $emailrows = query("SELECT * FROM users WHERE email = '$email'");

        //initialize sum as 0 and add to it if users with given e-mail are found
        $sum = 0;
        foreach($emailrows as $row)
        {
            $sum++;
        }
        
        //if more than 0 users are found, e-mail is taken and there is an error
        if($sum > 0)
        {    
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

