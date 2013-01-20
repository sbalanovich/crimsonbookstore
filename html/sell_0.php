<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if(isset($_GET['booksearch']) && !empty($_GET['booksearch']))
    {
        //get value of the book search from URL
        $book = strval($_GET["booksearch"]); 
     
        // if no query
        if(strlen($book) <= 0)
        {
            apologize("You must provide a search query!");
        }
        
        // if all is well
        else
        {        
            //ensure proper characters n the search
            if(preg_match("/[A-Za-z0-9]+/", $_GET["booksearch"]))
            {
	            //connect  to the database 
	            $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
	            
	            //select  the database to use 
	            $mydb=mysql_select_db("project") or die (mysql_error());

	            // changes characters used in html to their equivalents, for example: < to &gt;
	            $book = htmlspecialchars($book);

                // makes sure nobody uses SQL injection
                $book = mysql_real_escape_string($book);
         
                //perform the search query
                $raw_results = mysql_query("SELECT * FROM books
                    WHERE (`author` LIKE '%".$book."%') OR (`title` LIKE '%".$book."%') OR (`ISBN` LIKE '%".$book."%')") or die(mysql_error());
        
                // if one or more rows are returned, render the book profile 
                if(mysql_num_rows($raw_results) > 0)
                {
                    render("sell_0_display.php", ["title" => "Find Your Book", "raw_results" => $raw_results]);
                }
                
                // if there are no matching results to the search, apologize
                else
                {
                    apologize("No results");            	        
                }
            }
            
            // warn against the use of special chars
            else
            {
                apologize("Invalid input. Please, do not use special characters in your search");            	        
            }
         }  
    }    
    else
    {
        // else render form
        render("sell_0_form.php", ["title" => "Find your book"]);
    }
?>
