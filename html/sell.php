<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if (isset($_POST['sellformsubmit']))
    {

        //check if book is in database, insert if not
        $insertbook=query("INSERT INTO books (title, author, publisher, isbn13) VALUES (?, ?, ?, ?)", $_POST["title"], $_POST["authors"], $_POST["publisher"], $_POST["isbn13"]);
        if ($insertbook === false) {
            apologize("Unable to insert book into books");
        }

		/*//insert listing into database
		$listing = array();
        $_POST["price"];
		$_POST["condition"];
		$_POST["description"];


        // define message to show users */
        

        // render sell
        render("sell_form.php",array("title" => "Welcome to Crimson Bookstore!")); 

    }
    else 
    {
        // render sell
    	render("sell_form.php", array("title" => "Welcome to Crimson Bookstore!"));
    }
    
?>
