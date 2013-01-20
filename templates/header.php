<!DOCTYPE html>

<html>

    <head>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Harvard Bookstore: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Harvard Bookstore</title>
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

    <body style="background-color:	#FFFFFF; overflow:auto;"> 

         <div class="navbar">
              <div class="navbar-inner">
                  <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="catalogue.php"><img src="https://twimg0-a.akamaihd.net/profile_images/1163303038/Shield_RGB_Twitter.png" style="height:25px;width:25px;">Harvard Books</a>
                  <!-- Start of the nav bar content -->
                  <div class="nav-collapse"><!-- Other nav bar content -->
                    <!-- The drop down menu -->
                    <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                      <li class="dropdown">
                        <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-th-list icon-white"></i>&nbsp;Login<strong class="caret"></strong></a>
                        <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                           <form action="login.php" method="post" accept-charset="UTF-8">
                              <input placeholder = "username"id="username" style="margin-bottom: 15px;" type="text" name="username" size="30" />
                              <input placeholder="password"id="password" style="margin-bottom: 15px;" type="password" name="password" size="30" />
                              <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="remember_me" value="1" />
                              <label class="string optional" for="user_remember_me">Remember me</label>                             
                              <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
                            </form>
                         </div>
                      </li>
                    </ul>
                    <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <a class="btn btn-inverse" href="buy_0.php" id="navbtn"> Search </a>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

        <div class="container-fluid">

            <div id="middle">

