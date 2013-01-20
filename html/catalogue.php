<?php

    // configuration
    require("../includes/config.php"); 
   
    //if logged in
    if(!empty($_SESSION["id"]))
    {
        //get current id
        $currentid = $_SESSION["id"];

        //query the database for info on the user
        $userrows = query("SELECT * FROM users WHERE id = $currentid");

        //just store the username and get the cash
        foreach ($userrows as $user) 
        {
            $username = $user["username"];
        }
        
         // query database for books, departments, and featured departments
        $books = query("SELECT * FROM books ORDER BY title");
        $deptrows = query("SELECT * FROM Department ORDER BY popularity DESC LIMIT 0,5 ");
        $deptrowsfeatured = query("SELECT * FROM Department ORDER BY dept_name");

        // render catalogue
        render("catalogue_form.php", ["title" => "Catalogue", "books" => $books, "deptrowsfeatured" => $deptrowsfeatured,"deptrows" => $deptrows, "username" => $username]);   
    }
    
    //if not logged in
    else
    {
        // query database for books, departments, and featured departments
        $books = query("SELECT * FROM books ORDER BY title");
        $deptrows = query("SELECT * FROM Department ORDER BY popularity DESC LIMIT 0,5 ");
        $deptrowsfeatured = query("SELECT * FROM Department ORDER BY dept_name");


        // render catalogue for those not logged in
        render("catalogue_form.php", ["title" => "Catalogue", "books" => $books, "deptrowsfeatured" => $deptrowsfeatured,"deptrows" => $deptrows]); 
    }

   
    
?>
