<div class="container">  
    <div class="row">  
        <div class="span12">  
            <ul class="nav nav-tabs">  
                <li class="span5"><a href="/buy.php">Buy</a></li>   
                <li class = "span5 active"><a href="/sell.php">Sell</a></li>  
            </ul>  
        </div>  
    </div>  
</div>

<div id="centercontent">
    <div>
        <input id="booksearchinput" name="booksearch" placeholder="Search by Title, Author, or ISBN" type="text"/>
        <button id="sellsearchsubmit" class="btn">Search</button>
        <script> $(document).ready(function() {
            $('#sellform').toggle();
            var books = {};
            $('#sellsearchsubmit').click(function() { //onClick("functionname")
                $('div.sellresult').remove();    
                var query= $('#booksearchinput').val();
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "https://www.googleapis.com/books/v1/volumes?q=" + query, false);
                xhr.send();
                var json = JSON.parse(xhr.responseText);
                for(var i=0; i < json.items.length; i++) {
                    books[i]={};
                    books[i]["author"]=json.items[i].volumeInfo.authors[0];
                    books[i]["title"]=json.items[i].volumeInfo.title;

                    $('<div class="sellresult" id=' + i + '>' + books[i]["author"] + '</div>').appendTo('#sellsearchresults');
                }
            });
            
            $('#sellsearchresults').on('click', '.sellresult', function() {
                var id= this.id;
                $('#sellsearchresults').toggle();
                $('#sellform').toggle();
                $('<div class="sellresult" id=' + id + '>' + books[id]["author"] + '</div>').prependTo('#sellform');
            });
        });
        </script>
    </div>
    <div id="sellsearchresults">
    </div>
    <div id="sellform">
        <input id="price" placeholder="List your price" type="float"/>
        <select id="condition" class="input-large" size="1">
            <option value="" class="uneditable-input" selected="selected">Condition</option>
            <option value="new">New</option>
            <option value="excellent">Excellent</option>
            <option value="good">Good</option>
            <option value="fair">Fair</option>
            <option value="poor">Poor</option>
            <option value="damaged">Damaged</option>
        </select>
        <textarea class="input-xxlarge" placeholder="Description" maxlength="200" rows="3"></textarea>
    </div>
</div>
