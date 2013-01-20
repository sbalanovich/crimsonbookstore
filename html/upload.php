<?php

    // configuration
    require("../includes/config.php");
    
    //if user logged in
    if (!empty($_SESSION['id']))
    {
        //if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //if a file was selected for upload as an image
            if(!empty($_POST['picture']))
            {        
                //assign allowed file endings and explode the file name
                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $temp = explode(".", $_FILES["picture"]["name"]);
                $extension = end($temp);
                
                //if all conditions satisfied (the file ending is correct and the size is under 100 kB)
                if ((($_FILES["picture"]["type"] == "image/gif")
                || ($_FILES["picture"]["type"] == "image/jpeg")
                || ($_FILES["picture"]["type"] == "image/png")
                || ($_FILES["picture"]["type"] == "image/pjpeg"))
                && ($_FILES["picture"]["size"] < 100000)
                && in_array($extension, $allowedExts))
                {
                    //check for any errors
                    if ($_FILES["picture"]["error"] > 0)
                    {
                        apologize("Error: " . $_FILES["picture"]["error"]);
                    }
                    
                    else
                    {
                        //apologize if file already exists
                        if (file_exists("upload/" . $_FILES["picture"]["name"]))
                        {
                            apologize($_FILES["picture"]["name"] . " already exists. ");
                        }
                        
                        else
                        {
                            //save the file with its full name and apologize if this is unsuccessful
                            if(!move_uploaded_file($_FILES["picture"]["tmp_name"],
                            "img/" . $_FILES["picture"]["name"]))
                            {
                                apologize("Error uploading your image!");
                            }
                        }
                    }
                }
                else
                {
                    //otherwise apologize and let the user know what was wrong with the file
                    apologize("Invalid image file. Please make sure it's only in jpg, gif, or png format and that it is under 100 kB in size");
                }
            }    
            //validate the price
            if(empty($_POST['price']))
	        { 
                apologize("Please enter a price."); 
	        }
            else if(preg_match("/^([0-9.]+)$/", $_POST["price"]) == 0)
	        { 
                apologize("Please enter a valid decimal number"); 
	        }
	        
	        //ensure the GET variables are set
	        if(isset($_GET['book']) && !empty($_GET['book']))
	        { 
                //connect  to the database 
	            $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
	            
	            //select  the database to use 
	            $mydb=mysql_select_db("project") or die (mysql_error());
	            
                //extract the book id from the url
                $bookID=mysql_real_escape_string($_GET["book"]);
                
                //initialize file name
                $filename = [];
                if (!empty($_FILES["picture"]["name"]))
                {
                    $filename = $_FILES["picture"]["name"];
                }
                
                //if no file uploaded, store it as a default filename
                else
                {
                    $filename = "default.gif";
                }
                
                //insert all the values into the database
                if(query("INSERT INTO sellerbooks (userid, bookid, price, user_desc, cond, user_img) VALUES (?,?,?,?,?,?)",
                    mysql_real_escape_string($_SESSION["id"]),
                    mysql_real_escape_string($bookID),
                    mysql_real_escape_string($_POST["price"]),
                    mysql_real_escape_string($_POST['description']),
                    mysql_real_escape_string($_POST['condition']),
                    mysql_real_escape_string("img/" . $filename)))
                {
                    //apologize if mysql query unsuccessful
                    apologize("There was an error processing your request.");
                }
                else
                {
                    //otherwise render the upload success page
                    render("upload_success.php", ["title" => "Upload Success!", "bookID" => $bookID]);
                }
            }
            else
            {
                //apologize if url is invalid
                apologize("Error. Invalid book selected");
            }    
        }        
        else
        {
            if(isset($_GET['book']) && !empty($_GET['book']))
	        { 
                //connect  to the database 
	            $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
	            
	            //-select  the database to use 
	            $mydb=mysql_select_db("project") or die (mysql_error());
	            
                //extract the book id
                $bookID=mysql_real_escape_string($_GET["book"]);
                
                //query for the book data
                $bookrows = query("SELECT * FROM books WHERE (`id` = ?)", $bookID);
                  
                //just store the username and get the cash
                foreach ($bookrows as $book) 
                {
                    $title = $book["title"];
                    $author = $book["author"];
                    $ISBN = $book["ISBN"];
                    $img = $book["picture"];
                    $description = $book["description"];
                }
                
                //render the upload form with the data about the book queried above
                render("upload_form.php", ["title" => "Sell Your Book", "title" => $title, "author" => $author, "ISBN" => $ISBN, 
                "img" => $img, "description" => $description, "id" => $bookID]);
            }
            else
            {
                //apologize if no book selected
                apologize("No book selected!");
            }
        }
    }
    else
    {
        //let user know if they are logged out
        apologize("You must be logged in to use this feature");
    }
?> 
