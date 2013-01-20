<?php

    // configuration
    require("../includes/config.php"); 

    //connect  to the database 
    $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
    
	//select  the database to use 
	$mydb=mysql_select_db("project") or die (mysql_error());
	
	//extract the book's id from the url
    $bookID=mysql_real_escape_string($_GET["book"]);
    
    //gather the information about the book from the database
    $bookrows = query("SELECT * FROM books WHERE (`id` = ?)", $bookID);
        
    //store the book's information
    foreach ($bookrows as $book) 
    {
        $title = $book["title"];
        $author = $book["author"];
        $ISBN = $book["ISBN"];
        $img = $book["picture"];
        $description = $book["description"];
    }
    
    //display the book's sell profile
    render("sell_profile_form.php", ["title" => "Sell your Book", "title" => $title, "author" => $author, "ISBN" => $ISBN, 
    "img" => $img, "description" => $description]);

?>
