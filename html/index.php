<?php

    // configuration
    require("../includes/config.php"); 
    
    //get current id
    $currentid = $_SESSION["id"];

    // render portfolio
    render("portfolio.php", array("title" => "Seller Profile", "books" => $books, "username" => $username, "sellerbooks" => $sellerbooks));
    
?>
