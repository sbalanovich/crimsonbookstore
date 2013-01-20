<?php

    // configuration
    require("../includes/config.php");
    
    redirect("/buy.php");
    
    // render main
    render("main.php", array("title" => "Welcome to Crimson Bookstore!"));
    
?>
