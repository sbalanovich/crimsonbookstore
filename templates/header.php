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
        <script src="js/buy_formjs.js"></script>
        <script src="js/sell_formjs.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    </head>

    <body> 
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="sell.php"><img src="https://twimg0-a.akamaihd.net/profile_images/1163303038/Shield_RGB_Twitter.png" style="height:25px;width:25px;">Crimson Bookstore</a>
                <div class="nav-collapse"></div>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                    <?php 
                        require '../html/db/connect.php';
                        $query = mysql_query("SELECT * FROM users WHERE (`id` = 1)");
                        $results = mysql_fetch_array($query);
                        echo('<a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-user icon-white"></i>' . $results['firstname'] . " " . $results['lastname'] . '<strong class="caret"></strong></a>')
                    ?>
                        <ul class="dropdown-menu">
                        <?php
                            echo('<li> Report Bug </li>');
                            echo('<li> Feedback </li>');
                            echo('<li> Feature Request </li>');
                            echo('<li> Log Out </li>');
                        ?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-shopping-cart icon-white"></i>&nbsp;Cart<strong class="caret"></strong></a>
                        <ul class="dropdown-menu">
                        <?php
                            require '../html/db/connect.php';
                            $query = mysql_query("SELECT * FROM user_cart WHERE (`user_id` = 1)");
                            if (mysql_num_rows($query) !== 0)
                            {                                
                                while($results = mysql_fetch_array($query))
                                {
                                    $query2 = mysql_query("SELECT * FROM books WHERE (`id` =" . $results['listing_id'] . "1)");
                                    $results2 = mysql_fetch_array($query2);
                                    echo('<li>' . $results2['title'] . '</li>');
                                }
                            }
                            else
                                echo("<h5>Nothing added to cart!</h5>")
                        ?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-star icon-white"></i>&nbsp;Starred<strong class="caret"></strong></a>
                        <ul class="dropdown-menu" >
                        <?php
                            require '../html/db/connect.php';
                            $query = mysql_query("SELECT * FROM user_starred WHERE (`user_id` = 1)");
                            if (mysql_num_rows($query) !== 0)
                            {                     
                                while($results = mysql_fetch_array($query))
                                {
                                    echo('<li>' . $results['listing_id'] . '</li>');
                                }
                            }
                            else
                                echo("<h5>Nothing Starred!</h5>")
                        ?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right" >
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle " href="#" data-toggle="dropdown"> <i class="icon-list icon-white"></i>&nbsp;My Listings<strong class="caret"></strong></a>
                        <ul class="dropdown-menu" >
                        <?php
                            require '../html/db/connect.php';
                            $query = mysql_query("SELECT * FROM listings WHERE (`user_id` = 1)");
                            if (mysql_num_rows($query) !== 0)
                            {                     
                                while($results = mysql_fetch_array($query))
                                {
                                    echo('<li>' . $results['book_id'] . '</li>');
                                }
                            }
                            else
                                echo("<h4>No Listings!</h4>")

                        ?>
                        </ul>
                    </li>  
                </ul>
            </div>
        </div>

        <div id="mainpage">
                <div id="centercontent">             
