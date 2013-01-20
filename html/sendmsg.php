<?php   

    require("../includes/config.php");

    //extract the variables from the url
    $u = $_GET["u"];
    $msg = $_GET["msg"];

    //query database for information about currently logged in user
    $userrows = query("SELECT * FROM users WHERE username = ?", $_SESSION["id"]);
    
    //gets your username
    $from_user = $userrows['0']['username'];

    //inserts message into the database
    $rows = query("INSERT INTO messages (from_user, message, to_user) VALUES (?, ?, ?)", $from_user, $msg, $u);

?>

