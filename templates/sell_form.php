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
        <button id="sellsearchsubmit" class="btn">Search</button> </br>
        <?php if(isset($message))  {
                    echo "<div id='message' >" . $message . "</div>";
                 } ?>
<?php //insert links into message?>

        <script> $(document).ready(function() {
            //turn off form when page loads
            $('#sellformdiv').hide();
            //query google books api on button clicked
            var books = {};
            $('#sellsearchsubmit').click(function() {
                //remove any existing search results
                $('div.sellresult').remove(); 
                //remove any existing message that tells user they sold a book   
                $('#message').remove();
                //hide form when new search is completed
                $('#sellformdiv').hide();
                //send request
                var query= $('#booksearchinput').val();     <?php//todo validate ?>
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "https://www.googleapis.com/books/v1/volumes?q=" + query + "&maxResults=20", false);
                xhr.send();
                var json = JSON.parse(xhr.responseText);
                //parse response
                for(var i=0; i < json.items.length; i++) {
                    books[i]={};
                    //author
                    if (json.items[i].volumeInfo.authors) {
                        books[i]["authors"]=json.items[i].volumeInfo.authors.join(", ");
                    }
                    else {
                        books[i]["authors"]="No Author Available";
                    }
                    //title
                    if (json.items[i].volumeInfo.subtitle) {
                        books[i]["title"] = json.items[i].volumeInfo.title + ": " + json.items[i].volumeInfo.subtitle;
                    }
                    else {
                        books[i]["title"]=json.items[i].volumeInfo.title;
                    }
                    //publisher
                    if (json.items[i].volumeInfo.publisher) {
                        books[i]["publisher"]=json.items[i].volumeInfo.publisher;
                    }
                    else {
                        books[i]["publisher"]="No Publisher Available";
                    }
                    //description
                    if (json.items[i].volumeInfo.description) {
                        books[i]["description"]=json.items[i].volumeInfo.description;
                    }
                    else {
                        books[i]["description"]="No Description Available";
                    }
                    //isbn10
                    if (json.items[i].volumeInfo.industryIdentifiers) {
                        if (json.items[i].volumeInfo.industryIdentifiers[0]) {
                            if (json.items[i].volumeInfo.industryIdentifiers[0].type === "ISBN_10") {
                               books[i]["isbn10"]=json.items[i].volumeInfo.industryIdentifiers[0].identifier;
                            }
                            else {
                                books[i]["isbn10"]="No ISBN Available";
                            }
                        }
                        else {
                            books[i]["isbn10"]="No ISBN Available";
                        }
                    }
                    else {
                        books[i]["isbn10"]="No ISBN Available";
                    }  
                    //isbn13
                    if (json.items[i].volumeInfo.industryIdentifiers) {
                        if (json.items[i].volumeInfo.industryIdentifiers[1]) {
                            if (json.items[i].volumeInfo.industryIdentifiers[1].type === "ISBN_13") {
                               books[i]["isbn13"]=json.items[i].volumeInfo.industryIdentifiers[1].identifier;
                            }
                            else {
                                books[i]["isbn13"]="No ISBN Available";
                            }
                        }
                        else {
                                books[i]["isbn13"]="No ISBN Available";
                        }
                    }
                    else {
                        books[i]["isbn13"]="No ISBN Available";
                    }  
                    //pic
                    if (json.items[i].volumeInfo.imageLinks) {
                        books[i]["pic"]=json.items[i].volumeInfo.imageLinks.thumbnail;
                    }
                    else {
                        books[i]["pic"]="http://www.myworldhut.com/product_images/u/book_image_not_available__14165.jpg";
                    }
                    //put search results into #sellsearchresults, creating divs for each with class .sellresult
                    $("<div class='sellresult' align='left' id='" + i + "'> <img src='" + books[i]["pic"] + "' alt='book image'> <ol> <li>" + books[i]["title"] + " </li> <li>" + books[i]["authors"] + " </li> <li>" + books[i]["publisher"] + " </li> <li>" + books[i]["description"] + " </li> <li>" + books[i]["isbn10"] + " </li> <li>" + books[i]["isbn13"] + " </li> </ol> </div>").appendTo('#sellsearchresults');
                    
                }
                //when one result is clicked
                $('#sellsearchresults').on('click', '.sellresult', function() {
                    var id= this.id;
                    //empty current preset area in sellformpreset
                    $('#sellformpreset').empty();
                    //remove presets from sellform
                    $('#sellform.preset').remove();
                    //put presets into sellform
                    $("<input class='preset' name='title' value='" + books[id]["title"] + ": " + books[id]["subtitle"] + "' readonly> <input class='preset' name='authors' value='" + books[id]["authors"] + "' readonly> <input class='preset' name='publisher' value='" + books[id]["publisher"] + "' readonly> <input class='preset' name='description' value='" + books[id]["description"] + "' readonly> <input class='preset' name='pic' value='" + books[id]["pic"] + "' readonly> <input class='preset' name='isbn10' value='" + books[id]["isbn10"] + "' readonly> <input class='preset' name='isbn13' value='" + books[id]["isbn13"] + "' readonly>").prependTo('#sellform'); 
                    //hide presets in sellform
                    $('input.preset').hide();
                    //put preset area into sellformpreset
                    $("<img src='" + books[id]["pic"] + "' alt='book image'> <ol> <li>" + books[id]["title"] + " </li> <li>" + books[id]["authors"] + " </li> <li>" + books[id]["publisher"] + " </li> <li>" + books[id]["description"] + " </li> <li>" + books[id]["isbn10"] + " </li> <li>" + books[id]["isbn13"] + " </li> </ol> ").prependTo('#sellformpreset');
                    //show entire form, including sellformpreset and sellform
                    $('#sellformdiv').show();
                });
            });
        });
        </script>
<?php //todo check if user refreshes the page what happens, 
 //make back button once click on form, 
//make the page still searchable once form is clicked?>

    </div> 
    <div id="sellsearchresults" class="span6">      
    </div>
    <div id="sellformdiv" class="span6">
        <div id="sellformpreset">
        </div>
        <form id="sellform" name="sellform" method="post" action="sell.php">   <?php //todo validate ?>
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
