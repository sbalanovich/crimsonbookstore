<?php

    /***********************************************************************
     * config.php
     *
     * Crimson Bookstore
     * Lauren Urke and Sergeui Balanovich
     *
     * Configures pages.
     **********************************************************************/

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();

#    // require authentication for most pages
#    if (!preg_match("{(?:index|login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
#    {
#        if (empty($_SESSION["id"]))
#        {
#            redirect("/");
#        }
#    }

?>
