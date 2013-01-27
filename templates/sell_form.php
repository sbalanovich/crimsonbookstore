<div id="pill-bar">
    <ul><li id="buy" class="inactive"><a href="/buy.php">Buy</a></li><li id="sell" class="active"><a href="/sell.php">Sell</a></li></ul>
</div>
<div id="pill-content">
    <div id="centercontent">
        <div id="sellsearchbar">
            <input id="booksearchinput" name="booksearch" placeholder="Search by Title, Author, or ISBN" type="text"/>
            <button id="sellsearchsubmit" class="btn">Search</button>
        </div>
            <?php if(isset($message))  {
                        echo "<div id='message' >" . $message . "</div>";
                     } ?>

    <!-- todo insert links into message
    todo check if user refreshes the page what happens, 
     make back button once click on form, 
    make the page still searchable once form is clicked 
    validate form-->
        <div id="big">    
            <!-- insert one search result here in div-->
            <!--insert form here -->
        </div>
    </div>
</div>