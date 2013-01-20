<?php

    require("../includes/config.php"); 

    //store first and last name of the user
    $first = $_POST['first'];
    $last = $_POST['last'];

    //ensure proper length of first name
    if(strlen($first) <= 2)
    {
        echo 0;
    }
    
    //check length of last name
    else if(strlen($last) <= 2)
    {
        echo 1;
    }

    //echo the result that all is well
    else
    {  
        echo 2;  
    } 

?>

