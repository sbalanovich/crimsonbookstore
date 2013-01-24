$(document).ready(function() {
    //turn off form when page loads
    $('#sellformdiv').hide();
    //query google books api on button clicked
    var books = {};
    var ajaxHandler = function() {
        //remove any existing search results
        $('div.sellresult').remove(); 
        //remove any existing message that tells user they sold a book   
        $('#message').remove();
        //hide form when new search is completed
        $('#sellformdiv').hide();
        // AJAX using jQuery
        var responseCallback = function(json, successString) {
            //var json = JSON.parse(responseText);
            //parse response
            for(var i=0; i < json.items.length; i++) {
                books[i]={};
                //author
                if (json.items[i].volumeInfo.authors)
                    books[i]["authors"]=json.items[i].volumeInfo.authors.join(", ");
                else
                    books[i]["authors"]="No Author Available";
                //title
                if (json.items[i].volumeInfo.subtitle)
                    books[i]["title"] = json.items[i].volumeInfo.title + ": " + json.items[i].volumeInfo.subtitle;
                else
                    books[i]["title"]=json.items[i].volumeInfo.title;
                //publisher
                if (json.items[i].volumeInfo.publisher)
                    books[i]["publisher"]=json.items[i].volumeInfo.publisher;
                else
                    books[i]["publisher"]="No Publisher Available";
                //description
                if (json.items[i].volumeInfo.description)
                    books[i]["description"]=json.items[i].volumeInfo.description;
                else
                    books[i]["description"]="No Description Available";
                //isbn10
                if (json.items[i].volumeInfo.industryIdentifiers) {
                    if (json.items[i].volumeInfo.industryIdentifiers[0]) {
                        if (json.items[i].volumeInfo.industryIdentifiers[0].type === "ISBN_10") 
                           books[i]["isbn10"]=json.items[i].volumeInfo.industryIdentifiers[0].identifier;
                        else
                            books[i]["isbn10"]="No ISBN Available";
                    }
                    else
                        books[i]["isbn10"]="No ISBN Available";
                }
                else
                    books[i]["isbn10"]="No ISBN Available";
                //isbn13
                if (json.items[i].volumeInfo.industryIdentifiers) {
                    if (json.items[i].volumeInfo.industryIdentifiers[1]) {
                        if (json.items[i].volumeInfo.industryIdentifiers[1].type === "ISBN_13")
                           books[i]["isbn13"]=json.items[i].volumeInfo.industryIdentifiers[1].identifier;
                        else
                            books[i]["isbn13"]="No ISBN Available";
                    }
                    else 
                            books[i]["isbn13"]="No ISBN Available";
                }
                else 
                    books[i]["isbn13"]="No ISBN Available";  
                //pic
                if (json.items[i].volumeInfo.imageLinks) 
                    books[i]["pic"]=json.items[i].volumeInfo.imageLinks.thumbnail;
                else
                    books[i]["pic"]="http://www.myworldhut.com/product_images/u/book_image_not_available__14165.jpg";
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
        };
        var query= $('#booksearchinput').val();    
        $.get("https://www.googleapis.com/books/v1/volumes?q=" + query + "&maxResults=20", responseCallback);
    };
    /*var enterHandler = function(e) {
         if ((e.keycode && e.keycode == 13) || (e.which && e.which == 13))
             ajaxHandler(); 
    }; */
    $('#sellsearchsubmit').click(ajaxHandler);
    $('#booksearchinput').on('keyup', ajaxHandler);
}); 