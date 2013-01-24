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
        <script src="js/sell_formjs.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    </head>

    <body style="background-color:	#7D0000; overflow:auto;"> 
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="sell.php"><img src="https://twimg0-a.akamaihd.net/profile_images/1163303038/Shield_RGB_Twitter.png" style="height:25px;width:25px;">Crimson Bookstore</a>
                    <div class="nav-collapse"></div>
                    <ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-user icon-white"></i>&nbsp;[User's Name Here]<strong class="caret"></strong></a>
                            <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                                <li> Insert Links Here </li>
                                <li> Report Bug </Li>
                                <li> Feedback </Li>
                                <li> Feature Request </li>
                                <li> Log Out </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-shopping-cart icon-white"></i>&nbsp;Cart<strong class="caret"></strong></a>
                            <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;"></ul>
                        </li>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-star icon-white"></i>&nbsp;Starred<strong class="caret"></strong></a>
                            <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;"></ul>
                        </li>
                    </ul>
                    <ul class="nav pull-right" >
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-list icon-white"></i>&nbsp;Listings<strong class="caret"></strong></a>
                            <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;"></ul>
                        </li>  
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div id="middle">

