<?php

    // configuration
    require("../includes/config.php");
    
    $_SESSION["id"]=1;

    // if form was submitted
    if (isset($_POST['sellformsubmit']))
    {
        //check if book is in database, insert if not
        $isbookneeded=query("SELECT * FROM books WHERE isbn13=?", $_POST["isbn13"]);
        if($isbookneeded === false) {
        	apologize("Unable to look for this book in books");
        }
        $class_id=1; //need to query
        if(empty($isbookneeded)) {
			$insertbook=query("INSERT INTO books (title, author, publisher, class_id, mandatory, picture, description, isbn10, isbn13) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $_POST["title"], $_POST["authors"], $_POST["publisher"], $class_id, $_POST["mandatory"], $_POST["pic"], $_POST["description"], $_POST["isbn10"], $_POST["isbn13"]);
	        if ($insertbook === false) {
	            apologize("Unable to insert book into books");
	        }
	        $row=query("SELECT LAST_INSERT_ID() AS id");
	        $book_id=$row[0]["id"];
	    }
	    else {
	    	$book_id=$isbookneeded[0]["id"];
	    }
	    
		//insert listing into database
		$listing = query("INSERT INTO listings (book_id, user_id, price, book_condition, comments) VALUES (?, ?, ?, ?, ?)", $book_id, $_SESSION["id"], $_POST["price"], $_POST["condition"], $_POST["comments"]);

        // define message to show users
        $message="You have successfully listed " . $_POST["title"] . " for sale. To edit this listing... You will be notified when users add this to their shopping cart.";
        // render sell
        render("sell_form.php",array("title" => "Welcome to Crimson Bookstore!", "message"=> $message)); 

    }
    else 
    {
        // render sell
    	render("sell_form.php", array("title" => "Welcome to Crimson Bookstore!"));
    }
    
?>
