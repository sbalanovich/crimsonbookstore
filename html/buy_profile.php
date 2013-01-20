<?php

    // configuration
    require("../includes/config.php"); 

    //connect  to the database 
    $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
    
	//select  the database to use 
	$mydb=mysql_select_db("project") or die (mysql_error());
	
	//store the GET variable from the URL
    $bookID=mysql_real_escape_string($_GET["book"]);
    
    //use the stored variable to query the database for the book associated with it
    $bookrows = query("SELECT * FROM books WHERE (`id` = ?)", $bookID);
     
    //look through the query to store details about the book
    foreach ($bookrows as $book) 
    {
        $title = $book["title"];
        $author = $book["author"];
        $ISBN = $book["ISBN"];
        $img = $book["picture"];
        $description = $book["description"];
    }
    
    //store a mysql_query resource from the database sellerbooks to be used later
    $raw_results = mysql_query("SELECT * FROM sellerbooks
                    WHERE (bookid = '" . $bookID . "')") or die(mysql_error());
                    
    //display the profile of the book requested
    render("buy_profile_form.php", ["title" => "Sell your Book", "title" => $title, "author" => $author, "ISBN" => $ISBN, 
    "img" => $img, "description" => $description, "raw_results" => $raw_results]);

?>
