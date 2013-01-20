<script type=text/javascript>
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

//shows the restricted sign on buttonclick
function show() {

	 $('#restrict').removeClass('hide').addClass('show');

}

</script>
<div class="centercontent" style="color:#FFFFFF;">
    <br/>
    <button class="btn btn-danger" onClick="smoothScroll('eID')">View Listings</button>
    <div class="media" style="padding:15px;">     
        <div id="coverimage" class="span3">
            <a class="pull-left" href="#">            
                <img src="<?php echo $img; ?>" class="img-polaroid centercontentsmall" width = 200>
            </a>
        </div>
        <div class="span11">
        <div class="media-body centercontentsmall">
            <div align = left>
                <legend style="color:#FFFFFF;"><h2 class="media-heading"><?php echo $title; ?></h2></legend>
                <p>
                <h4><strong>Book Description:</strong></h4>
                <h5><?php echo $description; ?></h5>
                </p>
            </div>
        </div>
        </div>
      </div>
    </div>
    </br></br>
    <div id="eID" class="centercontent" style="color:#FFFFFF;">
    <br/>
    <legend style="color:#FFFFFF;"><h2 class="media-heading">Listings</h2></legend>
      

<table class="table table-hover" data-provides="rowlink">
                <table style="color:#FFFFFF; padding:15px;" class="table table-hover" data-provides="rowlink">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="text-align:center;"><h3>Seller Name</h3></th>
                            <th style="text-align:center;"><h3>Price</h3></th>
                            <th></th>
                        </tr>
                    </thead>
                   <tbody>
    
        <?php while($results = mysql_fetch_array($raw_results)): ?>
            <?php
                //queries first and last names
                $rows = query("SELECT * FROM users WHERE (`id` = ?)", $results['userid']);    
                //just store the username and get the cash
                foreach ($rows as $row) 
                {
                    $first = $row["firstname"];
                    $last = $row["lastname"];
                } 
            ?>
                            <tr data-toggle="modal" onclick="togglemodal('#<?= $results['id'] ?>');">
                            <?php
                            $picture=$results["user_img"];
                            print("<td style=\"text-align:center;vertical-align: middle;\"><img id=\"coverpreview\"src=" . $picture . "></td>");
                            ?>
                            <td style="text-align:center; vertical-align: middle;"><h4><?= $first." ".$last ?></h4></td>
                            <?$price=number_format($results["price"], 2);?>
                            <td style="text-align:center;vertical-align: middle;"><h4>$<?= $price ?></h4></a></td>
                            <td style="vertical-align: middle;"><center><button class="btn btn-danger btn-large" data-toggle="modal" href="#<?php print($results['id']); ?>">View</button></center></td>
                            </tr>

                <div class="modal hide fade" id="<? echo($results['id']); ?>" style ="display:none; color:#000000;">
                    <div class ="row">
                        <div class ="span3">
                            <img src="<? echo($results['user_img']); ?>" id ="cover">
                        </div>
                            <div class="modal-header" style="text-align:left;">
                                <a class=" close" data-dismiss="modal">×</a>
                                <h4><? echo($title); ?></h4>
                                <h6><? echo($author); ?></h6>
                                <h5>Sold By: <? echo($first); ?><? echo("&nbsp;"); ?><? echo($last); ?></h5>
                                <p>Seller's Price: $<? echo($results['price']); ?></p>
                                <p></p>
                                <?php
                                    $id = $results['id'];
                                    //controls for if the user is logged in or not
                                    if(!empty($_SESSION['id']))
                                    {
                                        $link = "requestbook.php?listing_id=" . $id;
                                        print("<a class=\"btn btn-success\"href=\" $link\">I'm Interested!</a>");
                                    }
                                    else
                                    {
                                        print("<a class=\"btn btn-success\"href=\"#\" onclick=\"show()\">I'm Interested!</a>");
                                        print("<br/><br/><span style=\"margin-left:280px; \"id=\"restrict\" class=\"messageboxerror hide\">Feature requires login!</span>");
                                    }
                                 ?>
                            </div>
                    </div>
                    <div class="modal-body">
                        <h4>Seller's Description</h4>
                        <p><? echo($results["user_desc"]);?></p>
                    </div>
                    <div class=modal-footer">
                    </div>
            </div>
        <? endwhile ?>
        
                    </tbody>

                </table>

</div>
