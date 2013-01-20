<script type=text/javascript>
//redirect on rowclick
function DoNav(theUrl)
{
document.location.href = theUrl;
}

//taken from http://css-tricks.com/snippets/jquery/smooth-scrolling/
function currentYPosition() {
    // Firefox, Chrome, Opera, Safari
    if (self.pageYOffset) return self.pageYOffset;
    // Internet Explorer 6 - standards mode
    if (document.documentElement && document.documentElement.scrollTop)
        return document.documentElement.scrollTop;
    // Internet Explorer 6, 7 and 8
    if (document.body.scrollTop) return document.body.scrollTop;
    return 0;
}

function elmYPosition(eID) {
    var elm = document.getElementById(eID);
    var y = elm.offsetTop;
    var node = elm;
    while (node.offsetParent && node.offsetParent != document.body) {
        node = node.offsetParent;
        y += node.offsetTop;
    } return y;
}

function smoothScroll(eID) {
    var startY = currentYPosition();
    var stopY = elmYPosition(eID);
    var distance = stopY > startY ? stopY - startY : startY - stopY;
    if (distance < 100) {
        scrollTo(0, stopY); return;
    }
    var speed = Math.round(distance / 100);
    if (speed >= 20) speed = 20;
    var step = Math.round(distance / 30);
    var leapY = stopY > startY ? startY + step : startY - step;
    var timer = 0;
    if (stopY > startY) {
        for ( var i=startY; i<stopY; i+=step ) {
            setTimeout("window.scrollTo(0, "+leapY+")", timer * speed);
            leapY += step; if (leapY > stopY) leapY = stopY; timer++;
        } return;
    }
    for ( var i=startY; i>stopY; i-=step ) {
        setTimeout("window.scrollTo(0, "+leapY+")", timer * speed);
        leapY -= step; if (leapY < stopY) leapY = stopY; timer++;
    }
}

</script>
<div>
    <div class="container" id="centercontent">
    <br/>
        <button style="float:right;" class="btn btn-danger" onClick="smoothScroll('eID')">View Recently Added</button>
        <legend id="welcomeuser" style="color:#FFFFFF">
            <?php
            if(!empty($_SESSION["id"]))
            {
                print("Welcome, $username.");
                printf("\n");
            }
            ?>
        </legend>
        <div class = "row-fluid">
            <div class = "span2 centercontentsmall">
                <legend><h4 style="color:#FFFFFF">Browse by Department:</h4></legend>
                <ul class="nav nav-pills nav-stacked" id="departnav">  
                <?php
                foreach($deptrowsfeatured as $deptrowfeatured)
                {
                    $deptname = $deptrowfeatured["dept_name"];
                    $deptid = $deptrowfeatured["deptid"];
                    print("<li id=\"departnavbtn\"><a href=\"department.php?id=" . $deptid ."\">" . $deptname . "</a></li>"); 
                }
                ?> 
                </ul>
            </div>
            <div class = "span10">
                <div id="myCarousel" class="carousel slide centercontentsmall" style="padding:0px;">
                    <script type="text/javascript">
                        //automates the carousel
                        $(document).ready(function(){
                        $('#myCarousel').carousel({ interval: 5000 })
                        }
                    </script>
                    
                    <div class="carousel-inner">
                    
                    <?php
                        $count = 1;
                        foreach ($deptrows as $deptrow) 
                        {
                            $deptid = $deptrow["deptid"];
                            $deptname = $deptrow["dept_name"];
                            $deptdescrip = $deptrow["dept_description"];
                            $deptimage = $deptrow["dept_img"];
                        
                            //<!-- Carousel items -->
                            //prints active
                            if($count == 1)
                            {
                                print("<div onclick=\"DoNav('department.php?id=$deptid')\" class=\"item active\">");
                                    print("<img src=\"$deptimage\"id=" . "carcat" . ">");
                                    print("<div class=" . "carousel-caption" . " style=" . "text-align:left;" . ">");
                                        print("<h4>" . $deptname . "</h4>");
                                        print("<p>" . $deptdescrip . "</p>");
                                    print("</div>");
                                print("</div>");
                                $count = $count + 1;
                            }
                            //prints following items
                            else if($count > 1)
                            {
                                print("<div onclick=\"DoNav('department.php?id=$deptid')\" class=" . "item" . ">");
                                    print("<img src=\"$deptimage\" id=" . "carcat" . ">");
                                    print("<div class=" . "carousel-caption" . " style=" . "text-align:left;" . ">");
                                        print("<h4>" . $deptname . "</h4>");
                                        print("<p>" . $deptdescrip . "</p>");
                                    print("</div>");    
                                print("</div>");
                            }
                        }

                     ?>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
            </div>
        </div>
    </div>
    
    <br/><br/>
    
    <div id="eID">
    <div id="centercontent">
    <legend style="color:#FFFFFF;"><h2>Recently Added Books</h2></legend>
 

    
    
    <?php
        
        print("<ul class=" . "thumbnails" . ">");
        print("<div class" . "row" . ">");
        
       
        //prints out the modals for the books
        foreach ($books as $book) 
        {
            $title = $book["title"];
            $image = $book["picture"];
            $author = $book["author"];
            $description = $book["description"];
            $id = $book["id"];
            print("<li class=" . "span3" . ">");
            
            print("<a data-toggle=" . "modal" . " href=" . "#$title" . " >");
                    print("<img id=\"coverfloat\"class=\"shadow\"src=" . $image . " id =" . "cover" . ">");
            print("</a>");

            print("<div class=\"modal hide fade\"id=" . "$title" . " style =" . "display:none;" . ">");
                print("<div class =" . "row" . ">");
                    print("<div class =" . "span3" . ">");
                        print("<img src=" . $image . " id =" . "cover" . ">");
                    print("</div>");
                    //print("<div class =" . "span3" . ">");
                        print("<div class=" . "modal-header" . " style =" . "text-align:left;" . ">");
                            print("<a class=" . "close" . " data-dismiss=" . "modal" . ">×</a>");
                            print("<h4>" . $title . "</h3>");
                            print("<h5>" . $author . "</h5>");
                            print("<p></p>");
                            print("<a class=\"btn btn-success\"href=\"http://project/buy_profile.php?book=" . $id . ".php\">More Information</a>");
                        print("</div>");
                    //print("</div>");
                print("</div>");
                print("<div class=" . "modal-body" . ">");
                    print("<p>" . $description . "</p>");
                print("</div>");
                print("<div class=" . "modal-footer" . ">");
                print("</div>");
            print("</div>");
            
            print("</li>");
        } 
        
        print("</div>");
        print("</ul>");
    ?>
</div>
</div>
</div>

