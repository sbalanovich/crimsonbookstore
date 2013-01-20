<!DOCTYPE html>

<html>

    <head>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Harvard Book Exchange: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Harvard Book Exchange</title>
        <?php endif ?>

        <script src="js/jquery-1.8.2.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

        
        <style>
        table 
        {
	    font: 11px/24px Verdana, Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	    width: 1000px;
	    margin: auto;
	    }

        th 
        {
	    padding: 0 0.5em;
	    text-align: center;
	    }
	    
	    th+th 
        {
	    border-left: 1px solid #CCC;
	    text-align: center;
	    }

        tr.yellow td 
        {
	    border-top: 1px white;
	    border-bottom: 1px white;
	    background: #FFC;
	    }

        td 
        {
	    border-bottom: 1px white;
	    padding: 0 0.5em;
	    width:100px;
	    }
        
        td+td 
        {
	    border-left: 1px solid #CCC;
	    text-align: center;
	    }
	    
	    #cover
	    {
	    padding: 15px;
	    height: 250px;
	    width: 200px;
	    }
	    
	    #welcomeusername
	    {
	    text-align: center;
	    }
	    
	    #publisher
	    {
	    font-size:11px;
	    text-align:left;
	    }
	    
	    #carcat
	    {
	    height: 540px;
	    width: 1080px;
	    }
	    
        
        #booksearch
        {
        height:64px;
        font-size:24px;
        text-align:center;
        width:600px;
        }
        
        #searchbook
        {
        height:70px;
        font-size:28px;
        text-align:center;
        width:150px;
        }
        
        .messagebox{
         position:absolute;
         width:100px;
         margin-left:30px;
         border:1px solid #c93;
         background:#ffc;
         padding:3px;
        }
        
        .messageboxok{
         position:absolute;
         width:auto;
         margin-left:30px;
         border:1px solid #349534;
         background:#C9FFCA;
         padding:3px;
         font-weight:bold;
         color:#008000;
        }
        
        .messageboxerror{
         position:absolute;
         width:auto;
         margin-left:30px;
         border:1px solid #CC0000;
         background:#F7CBCA;
         padding:3px;
         font-weight:bold;
         color:#CC0000;
        }

	   
	    </style>

    </head>

    <body style="background:url(img/back_main.jpg); overflow:auto;"> 
    <?php

    //checks for logged in or not
    //if so
    if(!empty($_SESSION["id"]))
    {
        print("<div class=\"navbar\">");
          print("<div class=\"navbar-inner\">");
              print("<div class=\"container\">");
              print("<a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">");
                print("<span class=\"icon-bar\"></span>");
                print("<span class=\"icon-bar\"></span>");
                print("<span class=\"icon-bar\"></span>");
              print("</a>");
              print("<a class=\"brand\" href=\"catalogue.php\"><img src=\"https://twimg0-a.akamaihd.net/profile_images/1163303038/Shield_RGB_Twitter.png\" style=\"height:25px;width:25px;\">Harvard Books</a>");
              print("<div class=\"nav-collapse\">");
                print("<ul class=\"nav pull-right\">");
                print("<li class=\"divider-vertical\"></li>");
                  print("<li class=\"dropdown\">");
                    print("<a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\"> <i class=\"icon-th-list icon-white\"></i>&nbsp;Menu<strong class=\"caret\"></strong></a>");
                    print("<ul class=\"dropdown-menu\" style=\"padding: 15px; padding-bottom: 15px;\">");
                        print("<li> <a href=\"index.php\"> <i class=\"icon-user icon-white\"></i>&nbsp;Profile</a> </li>");
                        print("<li> <a href=\"inbox.php\"> <i class=\"icon-envelope icon-white\"></i>&nbsp;Messages</a> </li>");
                        print("<li> <a href=\"logout.php\"> <i class=\"icon-off icon-white\"></i>&nbsp;Logout</a> </li>");
                    print("</div>");
                  print("</li>");
                print("</ul>");
                print("<ul class=\"nav pull-right\">");
                    print("<li class=\"divider-vertical\"></li>");
                    print("<a class=\"btn btn-inverse\" href=\"sell_0.php\" id=\"navbtn\"> Sell </a>");
                print("</ul>");
                print("<ul class=\"nav pull-right\">");
                    print("<li class=\"divider-vertical\"></li>");
                    print("<a class=\"btn btn-inverse\" href=\"buy_0.php\" id=\"navbtn\"> Search </a>");
                print("</ul>");
              print("</div>");
            print("</div>");
          print("</div>");
        print("</div>");
    }
    //if not
    else
    {
         print("<div class=\"navbar\">");
              print("<div class=\"navbar-inner\">");
                  print("<div class=\"container\">");
                  print("<a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">");
                    print("<span class=\"icon-bar\"></span>");
                    print("<span class=\"icon-bar\"></span>");
                    print("<span class=\"icon-bar\"></span>");
                  print("</a>");
                  print("<a class=\"brand\" href=\"catalogue.php\"><img src=\"https://twimg0-a.akamaihd.net/profile_images/1163303038/Shield_RGB_Twitter.png\" style=\"height:25px;width:25px;\">Harvard Books</a>");
                  print("<!-- Start of the nav bar content -->");
                  print("<div class=\"nav-collapse\"><!-- Other nav bar content -->");
                    print("<!-- The drop down menu -->");
                    print("<ul class=\"nav pull-right\">");
                    print("<li class=\"divider-vertical\"></li>");
                      print("<li class=\"dropdown\">");
                        print("<a class=\"dropdown-toggle \" href=\"#\" data-toggle=\"dropdown\"> <i class=\"icon-th-list icon-white\"></i>&nbsp;Login<strong class=\"caret\"></strong></a>");
                        print("<ul class=\"dropdown-menu\" style=\"padding: 15px; padding-bottom: 15px;\">");
                           print("<form action=\"login.php\" method=\"post\" accept-charset=\"UTF-8\">");
                              print("<input placeholder = \"username\"id=\"username\" style=\"margin-bottom: 15px;\" type=\"text\" name=\"username\" size=\"30\" />");
                              print("<input placeholder=\"passworld\"id=\"password\" style=\"margin-bottom: 15px;\" type=\"password\" name=\"password\" size=\"30\" />");
                              print("<input id=\"user_remember_me\" style=\"float: left; margin-right: 10px;\" type=\"checkbox\" name=\"remember_me\" value=\"1\" />");
                              print("<label class=\"string optional\" for=\"user_remember_me\">Remember me</label>");                             
                              print("<input class=\"btn btn-primary\" style=\"clear: left; width: 100%; height: 32px; font-size: 13px;\" type=\"submit\" name=\"commit\" value=\"Sign In\" />");
                            print("</form>");
                         print("</div>");
                      print("</li>");
                    print("</ul>");
                    print("<ul class=\"nav pull-right\">");
                    print("<li class=\"divider-vertical\"></li>");
                    print("<a class=\"btn btn-inverse\" href=\"buy_0.php\" id=\"navbtn\"> Search </a>");
                    print("</ul>");
                  print("</div>");
                print("</div>");
              print("</div>");
            print("</div>");
    }
?>

        <div class="container-fluid">

            <div id="middle">

