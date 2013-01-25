/***********************************************************************
 * scripts.js
 *
 * Computer Science 50
 * Problem Set 7
 *
 * Global JavaScript, if any.
 **********************************************************************/

// Fire jQuery only when document ready
$(document).ready( function () {


    //if there is a change in the search bar
    $("input#booksearch").on('change', function() {
        var input = $('input#booksearch').val();
        var count = 0;
        var div = '<div>'
        var table = '<table id = "results" style="color:#000000; padding:15px;" class="table table-hover" data-provides="rowlink"><thead><tr>'
        var pic = '<th></th>'
        var author = '<th style="text-align:center;"><h3>Author</h3></th>'
        var title = '<th style="text-align:center;"><h3>Title</h3></th>'
        var isbn = '<th style="text-align:center;"><h3>ISBN</h3></th></tr></thead>'
        var tableHead = div+table+pic+author+title+isbn;
        if ($('#resultstable').html().trim() === '') 
        {
            $('#resultstable').empty().append(tableHead);
        }
        
        if ($.trim(input) != '') {
            $.post('ajax/booktbl.php', {booksearch: input}, function(data) {
            
                var counts = [];
            
                $("tbody").empty();
                $("thead").after(data);
                
                $("#results tbody tr").on('click', function() { 
                

                    var tableid = $(this).attr("id");
                    var bookid = tableid.slice(5, tableid.length);                   
                    $('#listbook_' + bookid).toggleClass('invisible');
                    
                    
                    if (counts[bookid]) {
                           return;
                    }


                    
                    $.post('ajax/listtbl.php', {bookid: bookid}, function(data) {  
                            
                            
                            $('#book_' + bookid).after(data);
                            counts[bookid] = true;

                            



                            $("#listings tbody tr td").on('click', function() {
                                var listid = $(this).attr("id");
                                var id = listid.slice(5, listid.length);
                                $("#"+listid).toggleClass("icon-white");
                                    if (listid === 'star_'+id)
                                    {
                                        if ($('#'+listid).hasClass("icon-white"))
                                        {
                                            $.post('ajax/star.php', {listid: id, is_starred: 1}, function(data) {
                                                alert("you starred listing " + id);
                                            });
                                        }
                                        else
                                        {
                                             $.post('ajax/star.php', {listid: id, is_starred: 0}, function(data) {
                                                alert("you UNstarred listing " + id);
                                            });
                                        }
                                    }
                                    else if (listid === 'cart_'+id)
                                    {
                                        if ($('#'+listid).hasClass("icon-white"))
                                        {
                                            $.post('ajax/cart.php', {listid: id, is_starred: 1}, function(data) {
                                                alert("you carted listing " + id);
                                            });
                                        }
                                        else
                                        {
                                             $.post('ajax/cart.php', {listid: id, is_starred: 0}, function(data) {
                                                alert("you UNcarted listing " + id);
                                            });
                                        }
                                    }
                            });
                    });
                                                          
                });  
            });
        }

    });
   

});
