<div class="secondnav">  
    <div class="row">  
        <div class="span12">  
            <ul class="nav nav-tabs">  
                <li class="span5 active"><a href="/buy.php">Buy</a></li>   
                <li class = "span5"><a href="/sell.php">Sell</a></li>  
            </ul>  
        </div>  
    </div>  
</div>

<div id="centercontent">
    <legend id="welcomeuser" style="color:#000000">
        <?php

        print("Welcome, [INSERT USERNAME HERE].");
        printf("\n");
        
        ?>
    </legend>
    <h2 style="color:#000000;">Buy Books!</h2>
    </br><br>
    <form action="buy_0.php" method="GET">
        <fieldset>
            <div class="row">
            <div class="span6">
            <div class="control-group ">
                <input id="booksearch" autofocus name="booksearch" placeholder="Enter Class Name or Find your Book by Author, Title, or ISBN" type="text"/>
            </div>
            </div>
            </div>
        </fieldset>
    </form>
    </div>

</div>
