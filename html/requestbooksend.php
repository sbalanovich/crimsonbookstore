<?php   

    // configuration
    require("../includes/config.php");
    
    //get current id
    $currentid = $_SESSION["id"]; 
    
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

       //gets fields
       $to_user = $_POST['to_user'];
       $message = $_POST['message'];
       
       //checks for '
       $readymessage = str_replace("'", "''", $message);
           
       //posts messages
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
        render("requestbook_form.php", ["title" => "Send Message", "user" => $user, "book" => $book, "first" => $first, "id" => $id]);
    }
?>

