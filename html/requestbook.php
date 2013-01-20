<?php   

    // configuration
    require("../includes/config.php");
    
    //get current id
    $currentid = $_SESSION["id"];
    
    //request sellerrows
    $sellerrows = query("SELECT * FROM sellerbooks WHERE id = ?", $_GET['listing_id']);
    
    //gets all ids
    foreach($sellerrows as $sellerrow)
    {
    $seller['bookid'] = $sellerrow['bookid'];
    $seller['userid'] = $sellerrow['userid'];
    }
    
    //queries
    $bookrows = query("SELECT * FROM books WHERE id = ?", $seller['bookid']);
    $book = $bookrows[0];
    $userrows = query("SELECT * FROM users WHERE id = ?", $seller['userid']);
    $user = $userrows[0]; 
    
    $userrows = query("SELECT * FROM users WHERE id = $currentid");

    //just store the username
    foreach ($userrows as $userrow) 
    {
        $first = $userrow["firstname"];
        $username = $userrow["username"];
    }
 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["to_user"]))
        {
            apologize("You must provide receiver's username.");
        }
        else if (empty($_POST["message"]))
        {
            apologize("You must provide a message.");
        }

       //gets all the fields
       $to_user = $_POST['to_user'];
       $message = $_POST['message'];
       
       //checks for '
       $readymessage = str_replace("'", "''", $message);
           
       //queries to post message
       $s = query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$readymessage', '$username')");
       
       if($s !== false)
       {
            redirect("/");
       }
       
       apologize("Message failed.");

    }
    else
    {
        // else render form
        render("requestbook_form.php", ["title" => "Send Message", "user" => $user, "book" => $book, "first" => $first]);
    }
?>

