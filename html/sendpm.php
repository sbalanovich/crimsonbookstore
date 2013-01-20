<?php   

    // configuration
    require("../includes/config.php");
    
    //get current id
    $currentid = $_SESSION["id"]; 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // ensure that recipient is specified
        if (empty($_POST["to_user"]))
        {
            apologize("You must provide receiver's username.");
        }
        
        //ensure that a message is written
        else if (empty($_POST["message"]))
        {
            apologize("You must provide a message.");
        }
        
        //query the mysql database for data on current user
        $userrows = query("SELECT * FROM users WHERE id = $currentid");
    
        //just store the username
        foreach ($userrows as $user) 
        {
            $username = $user["username"];
        }
        
        //save the POST data of the recepient and message
       $to_user = $_POST['to_user'];
       $message = $_POST['message'];
       
       //replace each ' with a '' in the message
       $readymessage = str_replace("'", "''", $message);
           
       //insert message into database
       $s = query("INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$readymessage', '$username')");
       
       //if the query is succesful redirect to the home page
       if($s !== false)
       {
            redirect("/");
       }
       
       //otherwise let the user know
       apologize("Message failed.");
    }
    
    else
    {
        // else render form
        render("sendpm_form.php", ["title" => "Send Message"]);
    }
?>

