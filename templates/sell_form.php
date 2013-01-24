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
            //turn off form
            $('#sellform').toggle();

            //query google books api on button clicked
            var books = {};
            $('#sellsearchsubmit').click(function() {
                $('div.sellresult').remove();    
                var query= $('#booksearchinput').val();
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "https://www.googleapis.com/books/v1/volumes?q=" + query +"&maxResults=20", false);
                xhr.send();
                var json = JSON.parse(xhr.responseText);
                for(var i=0; i < json.items.length; i++) {
                    books[i]={};
                    books[i]["authors"]=json.items[i].volumeInfo.authors.join(", ");
                    books[i]["title"]=json.items[i].volumeInfo.title;
                    if (json.items[i].volumeInfo.subtitle != undefined)
                        books[i]["title"]=books[i]["title"] + ": " + json.items[i].volumeInfo.subtitle;
                    books[i]["publisher"]=json.items[i].volumeInfo.publisher;
                    books[i]["isbn13"]=json.items[i].volumeInfo.industryIdentifiers[1].identifier;
                    books[i]["pic"]=json.items[i].volumeInfo.imageLinks.thumbnail;

                    //put search results into element
                    $('<div class="sellresult" id=' + i + '>' + books[i]["title"] + '</div>').appendTo('#sellsearchresults');
                    }
                });
            
            //toggle off search results, toggle on form, put defined info into form
            $('#sellsearchresults').on('click', '.sellresult', function() {
                var id= this.id;
                $('#sellsearchresults').toggle();
                $('#sellform').toggle();
                $("<input class='preset' value='" + books[id]["title"] + ": " + books[id]["subtitle"] + "' readonly>").prependTo('#sellform'); 
                $("<input class='preset' value='" + books[id]["authors"] + "' readonly>").prependTo('#sellform'); 
                $("<input class='preset' value='" + books[id]["publisher"] + "' readonly>").prependTo('#sellform'); 
                $("<input class='preset' value='" + books[id]["isbn13"] + "' readonly>").prependTo('#sellform'); 
                $('input.preset').toggle();

                $("<li>" + books[id]["isbn13"] + " </li>").prependTo('#presetform');
                $("<li>" + books[id]["publisher"] + " </li>").prependTo('#presetform');
                $("<li>" + books[id]["authors"] + " </li>").prependTo('#presetform');
                $("<li>" + books[id]["title"] + " </li>").prependTo('#presetform');
                $("<img src='" + books[id]["pic"] + "' alt='book image'>").prependTo('#presetform');

            });
        });
        </script>
    </div>
    <div id="sellsearchresults">
    </div>
    <div id="sellformdiv">
        <ol id="presetform">
        </ol>
        <form id="sellform" name="sellform" method="post" action="sell.php">
            <input name="price" placeholder="List your price" type="float"/>
            <select name="condition" class="input-large" size="1">
                <option value="" class="uneditable-input" selected="selected">Condition</option>
                <option value="new">New</option>
                <option value="excellent">Excellent</option>
                <option value="good">Good</option>
                <option value="fair">Fair</option>
                <option value="poor">Poor</option>
                <option value="damaged">Damaged</option>
            </select>
            <textarea name="description" class="input-xxlarge" placeholder="Description" maxlength="200" rows="3"></textarea>
            <button type="submit" name="sellformsubmit" name="sellformsubmit" class="btn">Submit</button>
        </form>
    </div>
</div>
