<?php

    // configuration
    require("../includes/config.php");
    
    //get current id
    $currentid = $_SESSION["id"];
    
    // query database for user's books
    $rows = query("SELECT * FROM profile WHERE id = $currentid");
        
    //iterate through rows obtained by query
    foreach ($rows as $row) 
    {
        $bookid = $row["bookid"];
    }
    
    //extract information about the user's books
    $bookrows = query("SELECT * FROM books WHERE id = $bookid");
    
    //store the publisher and author id
    foreach ($bookrows as $book) 
    {
        $authorid = $book["authorid"];
        $pubid = $book["pubid"];
    } 

    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "bookrows" => $bookrows, "username" => $username]);

?>
