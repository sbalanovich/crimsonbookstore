var ajaxRequest = null;


$(document).ready(function() {
    $('input.preset').hide();
    $('.actualform').hide();
    $('.sellformentrance').show();
    $('.buyentrance').show();
    //when one result is clicked for common results
        $('#big').on('click', '.sellformentrance', function() {
            //hide any open forms and current button
            $('.actualform').hide();
            $('.sellformentrance').show();
            $(this).hide();

            //show form
            $('#'+this.id+'.actualform').show();
            //hide presets in sellform
            $('input.preset').hide();

        });
                        
    //query google books api on button clicked
    var books = {};
    var ajaxHandler = function() {
        //remove any existing search results
        $('.sellresult').remove(); 
        $('#common').remove();
        //remove any existing message that tells user they sold a book   
        $('#message').remove();
        
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
                //put search one result and one form into #big inside a div with class sellresult
                $("<div id='" + i + "' class='sellresult well'><div class='sellbook'><img src='" + books[i]["pic"] + "' alt='book image'><ol id = 'book_" + i + "'><li id='stitle'>" + books[i]["title"] + "</li><li id='sauthors'>" + books[i]["authors"] + "</li><li id='spublisher'>" + books[i]["publisher"] + " | " + books[i]["isbn13"] + " </li><li id='sdescription'>" + books[i]["description"] + " </li></ol></div><div class='sellform'><button id='" + i + "' type='submit' name='sellformentrance' class='sellformentrance btn'>Sell</button><button id='buy_" + i + "' type='submit' name='sellformentrance' class='sellformentrance btn'>BUY</button><form class='actualform' name='sellform' method='post' action='sell.php'><input id='scourse' name='course' placeholder='Course' type='text'/><input id='smandatory' type='checkbox' name='smandatory' value='1'><label for='smandatory'>Required Text?</label><br><input id='sprice' name='price' placeholder='List your price' type='text'/><div class=selectstyle><select id='sbookcondition' vertical-align='top' name='book_condition' size='1'><option value='' class='uneditable-input' selected='selected'>Condition</option><option value='new'>Outstanding</option><option value='exceeds'>Exceeds Expectations</option><option value='acceptable'>Acceptable</option><option value='poor'>Poor</option><option value='dreadful'>Dreadful</option><option value='troll'>Troll</option></select></div><textarea id='scomments' name='comments' placeholder='Comments' maxlength='800' rows='3'></textarea><button id='sbutton' type='submit' name='sellformsubmit' class='btn'>Submit</button><input class='preset' name='title' value='" + books[i]["title"] + "' readonly><input class='preset' name='authors' value='" + books[i]["authors"] + "' readonly><input class='preset' name='publisher' value='" + books[i]["publisher"] + "' readonly><input class='preset' name='description' value='" + books[i]["description"] + "' readonly><input class='preset' name='pic' value='" + books[i]["pic"] + "' readonly><input class='preset' name='isbn10' value='" + books[i]["isbn10"] + "' readonly><input class='preset' name='isbn13' value='" + books[i]["isbn13"] + "' readonly></form></div></div>").appendTo('#big'); 
                $('.actualform').hide();
            }
            //when one result is clicked
            $('#big').on('click', '.sellformentrance', function() {
                //hide any open forms and current button
                $('.actualform').hide();
                $('.sellformentrance').show();
                $(this).hide();

                //show form
                var ident=this.id;
                $('#'+ident+' .actualform').show();
                //hide presets in sellform
                $('input.preset').hide();

            });
            //-------------------------------------------LOLOLOLOLOLOLOL--------------------------------------------------------------------
        $(".buyentrance").on('click', function() {
                
                    var tableid = $(this).attr("id");
                    var bookid = tableid.slice(5, tableid.length);
                    console.log(bookid);                  
                    $('#listbook_' + bookid).toggleClass('invisible');               
                   
                    if (counts[bookid]) {
                           return;
                    }                  

                    $.post('ajax/listtbl.php', {bookid: bookid}, function(data) {                         

                            $('#book_' + bookid).after(data);
                            counts[bookid] = true;
                            
//                            $("[rel=tooltip]").tooltip({'placement':'top'});                 

                            $("#listings tbody tr td").on('click', function() {
                            
                                var listid = $(this).attr("id");
                                var id = listid.slice(5, listid.length);
                                $("#"+listid + " i").toggleClass("icon-white");                                
                                
                                    if (listid === 'star_'+id)
                                    {
                                        if ($("#"+listid + " i").hasClass("icon-white"))
                                        {
                                            $.post('ajax/star.php', {listid: id, is_starred: 1}, function(data) {
                                            });
                                            $("td#star_" + id + " h5").replaceWith("<h5><i class=\"icon-star icon-white\"></i> Un-Star?</h5>");
                                        }

                                        else
                                        {
                                             $.post('ajax/star.php', {listid: id, is_starred: 0}, function(data) {
                                            });
                                            $("td#star_" + id + " h5").replaceWith("<h5><i class=\"icon-star\"></i> Star It!</h5></td>");
                                        }
                                    }
                                    else if (listid === 'cart_'+id)
                                    { 
                                        if ($("#"+listid + " i").hasClass("icon-white"))
                                        {
                                            $.post('ajax/cart.php', {listid: id, is_carted: 1}, function(data) {
                                                $("td#user_" + id + " h5").replaceWith("<h5><a style = 'text decoration: none' rel='tooltip' data-original-title='" + data + " users have already asked to buy this book'><i class=\"icon-user icon-white\"></i></a>     " + data + "</h5>");
                                            });
                                            $("td#cart_" + id + " h5").replaceWith("<h5><i class=\"icon-shopping-cart icon-white\"></i> Remove from Cart?</h5>");
                                            
                                            $("#boom_"+id +".green").addClass("yellow");
                                            $("#star_"+id +".green").addClass("yellow");
                                            $("#cart_"+id +".green").addClass("yellow");
                                            $("#user_"+id +".green").addClass("yellow");
                                            $("#boom_"+id +".pending_red").addClass("red");
                                            $("#star_"+id +".pending_red").addClass("red");
                                            $("#cart_"+id +".pending_red").addClass("red");
                                            $("#user_"+id +".pending_red").addClass("red");
                                            
                                            $("#boom_"+id +".green").removeClass("green");
                                            $("#star_"+id +".green").removeClass("green");
                                            $("#cart_"+id +".green").removeClass("green");
                                            $("#user_"+id +".green").removeClass("green");
                                            $("#boom_"+id +".pending_red").removeClass("pending_red");
                                            $("#star_"+id +".pending_red").removeClass("pending_red");
                                            $("#cart_"+id +".pending_red").removeClass("pending_red");
                                            $("#user_"+id +".pending_red").removeClass("pending_red");                                                                                   
                                        }

                                        else
                                        {
                                             $.post('ajax/cart.php', {listid: id, is_carted: 0}, function(data) {
                                                $("td#user_" + id + " h5").replaceWith("<h5><a style = 'text decoration: none' rel='tooltip' data-original-title='" + data + " users have already asked to buy this book'><i class=\"icon-user icon-white\"></i></a>     " + data + "</h5>");                                             
                                             });
                                             $("td#cart_" + id + " h5").replaceWith("<h5><i class=\"icon-shopping-cart\"></i> Add to Cart</h5>");
                                            $("#boom_"+id +".yellow").toggleClass("green");
                                            $("#star_"+id +".yellow").toggleClass("green");
                                            $("#cart_"+id +".yellow").toggleClass("green");
                                            $("#user_"+id +".yellow").toggleClass("green");
                                            $("#boom_"+id +".red").toggleClass("pending_red");
                                            $("#star_"+id +".red").toggleClass("pending_red");
                                            $("#cart_"+id +".red").toggleClass("pending_red");
                                            $("#user_"+id +".red").toggleClass("pending_red");
                                            
                                            $("#boom_"+id +".yellow").toggleClass("yellow");
                                            $("#star_"+id +".yellow").toggleClass("yellow");
                                            $("#cart_"+id +".yellow").toggleClass("yellow");
                                            $("#user_"+id +".yellow").toggleClass("yellow");
                                            $("#boom_"+id +".red").toggleClass("red");
                                            $("#star_"+id +".red").toggleClass("red");
                                            $("#cart_"+id +".red").toggleClass("red");
                                            $("#user_"+id +".red").toggleClass("red");
                                        }
                                    }
                            });
                    });                                                   
                });
                
//-------------------------------------------END LOLOLOLOLOLOLOL--------------------------------------------------------------------
        };
    var query= $('#booksearchinput').val();    
    if (ajaxRequest != null)
    {
        ajaxRequest.abort();
    }
    ajaxRequest = $.ajax({
        url: "https://www.googleapis.com/books/v1/volumes?q=" + query + "&maxResults=20", 
        method: "GET", 
        success: responseCallback, 
        error: function(a, why) {
            if (why != "abort") {
                // handle error here
            }
        }
    });

    };
    var enterHandler = function(e) {
         if ((e.keycode && e.keycode == 13) || (e.which && e.which == 13))
             ajaxHandler(); 
    };
    $('#sellsearchsubmit').click(ajaxHandler);
    $('#booksearchinput').on('keyup', enterHandler);
    
  
}); 


