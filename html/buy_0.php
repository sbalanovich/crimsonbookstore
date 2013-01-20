<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if (isset($_GET['booksearch']) && !empty($_GET['booksearch']))
    {
        //store the numerical value of the GET variable
        $book = strval($_GET["booksearch"]); 
     
        //ensure that a search query was provided
        if(strlen($book) <= 0) // if no query
        {
            apologize("You must provide a search query!");
        }
        
        // if all is well
        else
        {        
            //ensure the use of valid characters
            if(preg_match("/[A-Za-z0-9]+/", $_GET["booksearch"]))
            {
	            //connect  to the database 
	            $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
	            
	            //-select  the database to use 
	            $mydb=mysql_select_db("project") or die (mysql_error());

                // change characters used in html to their equivalents;
	            $book = htmlspecialchars($book);
         
                // make sure nobody uses SQL injection
                $book = mysql_real_escape_string($book);
         
                //query the database searching for likenesses in author title and ISBN to the input string
                $raw_results = mysql_query("SELECT * FROM books
                    WHERE (`author` LIKE '%".$book."%') OR (`title` LIKE '%".$book."%') OR (`ISBN` LIKE '%".$book."%')") or die(mysql_error());
        
                // if one or more rows are returned, display them in a table
                if(mysql_num_rows($raw_results) > 0)
                {
                    render("buy_0_display.php", ["title" => "Search Results", "raw_results" => $raw_results]);
                }
                else // if there are no matching rows, apologize
                {
                    apologize("No results");            	        
                }
            }
            
            else // if the search is performed with invalid characters
            {
                apologize("Invalid input. Please, do not use special characters in your search");            	        
            }
         }  
    }    
    else
    {
        // else render form
        render("buy_0_form.php", ["title" => "Find your book"]);
    }
?>
