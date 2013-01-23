<?php

	/****************************************************************************
	 * buy.php
	 *
	 * Crimson Bookstore
	 * Lauren Urke and Sergeui Balanovich
	 *
	 * Lets user buy books.
	 ***************************************************************************/

    // configuration
    require("../includes/config.php");
    
    // render main
    render("buy_form.php", array("title" => "Welcome to Crimson Bookstore!"));
    
?>
