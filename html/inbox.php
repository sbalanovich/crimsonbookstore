<?php

    // configuration
    require("../includes/config.php"); 
    
    //get current id
    $currentid = $_SESSION["id"];
    
    //find the user who is currently logged in
    $userrows = query("SELECT * FROM users WHERE id = $currentid");
        
    //store their username
    foreach ($userrows as $user) 
    {
        $username = $user["username"];
    }   
    
    // query database of messages to this user
    $messagerows = query("SELECT * FROM messages WHERE to_user = ? ORDER BY from_user", $username);


    // render the inbox
    render("inbox_form.php", ["title" => "Inbox", "messagerows" => $messagerows]);
    
?>
