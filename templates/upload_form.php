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
</script>
    <div class="centercontent" style="color:#FFFFFF;">
        <legend style="color:#FFFFFF;"><h1>List your book!</h1></legend>
        <button class="btn btn-danger" onClick="smoothScroll('eID')" >List Now!</button>
        <div class="row">
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
    </div>
    <br/><br/>
    <div id= "eID" class="centercontent" style="color:#FFFFFF;">
    <br/>
        <legend style="color:#FFFFFF;"><h2 class="media-heading">Finalize Your Listing:</h2></legend>
        <form enctype="multipart/form-data" action="upload.php?book=<?= $id ?>" method="POST">
            <fieldset>
                <div class="control-group">
                    <h3>Your Price<font color = red>*</font>: $ <input autofocus name="price" placeholder="Your Price (EX: 10.00)" type="text"/></h3>
                </div>
                <h3>Optionally, provide a brief description of your copy: </h3>
                <div class="control-group">
                    <textarea name="description" rows=3 cols=30 placeholder="Type up a brief description of your book..."></textarea>
                </div>
                <h3>Your Book's Condition<font color = red>*</font>: </h3>
                <div class="control-group">
                    <select name="condition">
                    <option value = "new"> NEW </option>
                    <option value = "excellent"> EXCELLENT </option>
                    <option value = "good"> GOOD </option>
                    <option value = "fair"> FAIR </option>
                    <option value = "poor"> POOR </option>
                    <option value = "damaged"> DAMAGED </option>
                    <option value = "half-blood prince"> HALF-BLOOD PRINCE </option>
                    </select>
                </div>
                <h3>Show users what your book looks like. Upload a picture: </h3>
                <div class="control-group">
                    <input name="picture" type = "file" placeholder="File must be under 100 kB"/>
                </div>
                <div class="control-group">
                    <button type="submit" class="btn">List it!</button>
                </div>
            </fieldset>
</form>
</div>
