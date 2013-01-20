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

//redirect on row click
function DoNav(theUrl)
{
document.location.href = theUrl;
}
</script>
<div class="container">
    <div class="centercontent" style="color:#FFFFFF;">
        <br/>
        <button style="float:right;"class="btn btn-danger" onClick="smoothScroll('eID')">Department Books</button>
            <div class="row-fluid">
               <div>
                    <div align ="center">
                        <legend style="color:#FFFFFF;"><h2 class="media-heading"><?php echo $name; ?></h2></legend>
                    </div>
                </div>
            </div>
        <div class="row-fluid">
        <div class="media" align="center" style="padding:15px;">     
            <div id="coverimage" class="span8 offset2">
                <a href="#">            
                    <img style="height:66%; width:66%;" src="<?php echo $image; ?>" class="centercontentsmall">
                </a>
            </div>
          </div>
          <br/>
          </div>
            <h5 style="word-wrap:break-word; text-align:left;">
            <?php echo $description; ?>
            </h5>
        </div>
        </div>
        </br></br>
        <div id="eID" class="centercontent" style="color:#FFFFFF;">
        <br/>
        <legend style="color:#FFFFFF;"><h2 class="media-heading">Listings</h2></legend>
        </br></br>
      

  <table style="color:#FFFFFF; padding:15px;" class="table table-hover" data-provides="rowlink">
    <thead>
        <tr>
            <th></th>
            <th style="text-align:center;"><h3>Author</h3></th>
            <th style="text-align:center;"><h3>Title</h3></th>
            <th style="text-align:center;"><h3>ISBN</h3></th>
        </tr>
    </thead>
    <tbody>
        <?php while($results = mysql_fetch_array($raw_results)): ?>

            <tr onclick="DoNav('buy_profile.php?book=<?= $results['id'] ?>');">
            <?php
            $picture=$results["picture"];
            print("<td style=\"text-align:center;\"><img id=\"coverpreview\"src=" . $picture . "></td>");
            ?>
            <td style="text-align:center;"><h5><?= $results["author"] ?></h5></td>
            <td style="text-align:center;"><h5><?= $results["title"] ?></h5></a></td>
            <td style="text-align:center;"><h5><?= $results["ISBN"] ?></h5></a></td>
            </tr>

        <? endwhile ?>

    </tbody>

</table>

