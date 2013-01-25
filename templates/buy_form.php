<div class="container">  
    <div class="row">  
        <div class="span12">  
            <ul class="nav nav-tabs">  
                <li class="span5 active"><a href="/buy.php">Buy</a></li>   
                <li class = "span5"><a href="/sell.php">Sell</a></li>  
            </ul>  
        </div>  
    </div>  
</div>

<style>

.invisible {
    display:none;
    }
    
}

</style>

<div id="centercontent">
    <legend id="welcomeuser" style="color:#000000">
        <?php

        print("Welcome, [INSERT USERNAME HERE].");
        printf("\n");
        
        ?>
    </legend>
    <h2 style="color:#000000;">Buy Books!</h2>
    </br><br>
        <fieldset>
            <div class="row span6 control-group">
                <input id="booksearch" placeholder="Enter Class Name or Find your Book by Author, Title, or ISBN" type="text"/>
            </div>
        </fieldset>
        
        <div id="resultstable">

        </div>
</div>

