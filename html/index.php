<?php

    // configuration
    require("../includes/config.php");
    
    redirect("/sell.php");
    
    // render main
    render("main.php", array("title" => "Welcome to Crimson Bookstore!"));
    
?>
