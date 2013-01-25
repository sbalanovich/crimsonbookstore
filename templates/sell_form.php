<div class="secondnav">  
  
            <ul class="nav nav-tabs">  
                <li><a href="/buy.php">Buy</a></li>   
                <li class="active"><a href="/sell.php">Sell</a></li>  
            </ul>  

</div>

<div id="centercontent">
    <div id="sellsearchbar">
        <input id="booksearchinput" name="booksearch" placeholder="Search by Title, Author, or ISBN" type="text"/>
        <button id="sellsearchsubmit" class="btn">Search</button> </br>
    </div>
        <?php if(isset($message))  {
                    echo "<div id='message' >" . $message . "</div>";
                 } ?>

<!-- todo insert links into message
todo check if user refreshes the page what happens, 
 make back button once click on form, 
make the page still searchable once form is clicked -->

    <div id="sellsearchresults" class="span6">      
    </div>
    <div id="sellformdiv" class="span6">
        <div id="sellformpreset">
        </div>
        <form id="sellform" name="sellform" method="post" action="sell.php">   <?php //todo validate ?>
            <input name="course" placeholder="Course" type="text"/>
            <input type="checkbox" name="mandatory" value="1">Required Text?<br>
            <input name="price" placeholder="List your price" type="float"/>
            <select name="condition" class="input-large" size="1">
                <option value="" class="uneditable-input" selected="selected">Condition</option>
                <option value="new">Outstanding</option>
                <option value="exceeds">Exceeds Expectations</option>
                <option value="acceptable">Acceptable</option>
                <option value="fair">Fair</option>
                <option value="poor">Poor</option>
                <option value="dreadful">Dreadful</option>
                <option value="troll">Troll</option>
            </select>
            <textarea name="comments" class="input-xxlarge" placeholder="Comments" maxlength="200" rows="3"></textarea>
            <button type="submit" name="sellformsubmit" name="sellformsubmit" class="btn">Submit</button>
        </form>
    </div>
</div>
