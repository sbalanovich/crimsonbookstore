<?php

	/****************************************************************************
	 * index.php
	 *
	 * Crimson Bookstore
	 * Lauren Urke and Sergeui Balanovich
	 *
	 * Receives from CS50 ID and redirects to sell.php.
	 ***************************************************************************/

    // configuration
    require("../includes/config.php");
    
    redirect("/sell.php");
    
    // render main
    render("main.php", array("title" => "Welcome to Crimson Bookstore!"));
    
?>
