<?php

    // configuration
    require("../includes/config.php"); 
    
    //get current id
    $currentid = $_SESSION["id"];
    
    // query database for users and book listings by said user
    $sellerbooks = query("SELECT * FROM sellerbooks WHERE userid = $currentid ORDER BY bookid");
    $userrows = query("SELECT * FROM users WHERE id = $currentid");
    
    $bookids = array();
    $books = array();
    
    foreach($sellerbooks as $sellerbook)
    {
        if(!in_array($sellerbook["bookid"], $bookids))   
        {     
            array_push($bookids, $sellerbook["bookid"]);
        }
    }
    
    foreach($bookids as $bookid)
    {
        $bookrows = query("SELECT * FROM books WHERE id = $bookid ORDER BY title");
        
        foreach($bookrows as $bookrow)
        {
            array_push($books, $bookrow);
        }
    }
    
    
    //just store the username and get the cash
    foreach ($userrows as $user) 
    {
        $username = $user["username"];
    }   

    // render portfolio
    render("portfolio.php", ["title" => "Seller Profile", "books" => $books, "username" => $username, "sellerbooks" => $sellerbooks]);
    
?>
