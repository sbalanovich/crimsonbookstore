<?php

    // configuration
    require("../includes/config.php"); 

    //connect  to the database 
    $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
    
	//select  the database to use 
	$mydb=mysql_select_db("project") or die (mysql_error());
	
	//extract deoartment ID from the url
    $deptID=mysql_real_escape_string($_GET["id"]);
    
    //query database for data about the department
    $deptrows = query("SELECT * FROM Department WHERE (deptid = ?)", $deptID);
        
    //store the name, image, description, and popularity of a given department
    foreach ($deptrows as $dept) 
    {
        $name = $dept["dept_name"];
        $image = $dept["dept_img"];
        $description = $ept["dept_description"];
        $popular = $dept["popularity"];
    }
    
    //query the books database to find the dbooks associated with the department
    $raw_results = mysql_query("SELECT * FROM books
                    WHERE (department = '" . $deptID . "')") or die(mysql_error());
                    
    //generate the department page with the queried variables
    render("department_form.php", ["title" => "Sell your Book", "name" => $name, "image" => $image, "description" => $description, 
    "popular" => $popular, "raw_results" => $raw_results]);

?>
