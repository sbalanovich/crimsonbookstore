/***********************************************************************
 * scripts.js
 *
 * Computer Science 50
 * Problem Set 7
 *
 * Global JavaScript, if any.
 **********************************************************************/

$(document).ready( function () {
    $("input#booksearch").change( function() {
        var input = $('input#booksearch').val();
        
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
                $("tbody").empty();
                $("thead").after(data);
                
                $("#results tbody tr").click( function() {
                    var bookid = $(this).attr("id");
                    $.post('ajax/listtbl.php', {bookid: bookid}, function(data) {
                        
                        $('tr#' + bookid).after(data);

                     });
                }); 
            });
        }

    });
   

});
