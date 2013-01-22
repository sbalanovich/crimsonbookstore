<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    //if (isset($_POST['sellformsubmit'])))
    {
        /*// validate submission do this with jquery
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }*/

        //insert book and listing into database
      //  listing=array();
       // $_POST["price"]


        // render sell
       // render("sell_form.php",array("title" => "Welcome to Crimson Bookstore!"));

    }
   // else
    {
        // render sell
    	render("sell_form.php", array("title" => "Welcome to Crimson Bookstore!"));
    }
    
?>
