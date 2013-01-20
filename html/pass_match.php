<?php

    require("../includes/config.php"); 

    //now we check to see if the passwords match 
    if($_POST['password'] !== $_POST['confirmation'])
    { 
        echo 0; 
    }

    //echo a 1 if passwords do match
    else
    {  
        echo 1;  
    }  

?>

