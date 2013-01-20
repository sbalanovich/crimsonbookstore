<div id="centercontent">
    <legend id="welcomeuser" style="color:#FFFFFF">
        <?php
        //checks for user to have a session id
        if(!empty($_SESSION["id"]))
        {
            print("Welcome, $username.");
            printf("\n");
        }
        ?>
        </legend>
    
    <h3 style="color:#FFFFFF;">Your Book List:</h3>
    
    <table>
    <?php
        
        print("<ul class=" . "thumbnails" . ">");
        print("<div class" . "row" . ">");
        
       
        //double for-loop that constructs the book lists with info from both books and sellerbooks
        foreach ($books as $book)
        {
            foreach ($sellerbooks as $sellerbook) 
            {
                //only allow matches
                if($book['id'] == $sellerbook['bookid'])
                {
                    $title = $book["title"];
                    $image = $book["picture"];
                    $author = $book["author"];
                    $description = $book["description"];
                    $price = number_format($sellerbook["price"] , 2);
                    print("<li class=" . "span3" . ">");
                    
                    print("<a data-toggle=" . "modal" . " href=" . "#$title" . " >");
                            print("<img id=\"coverfloat\" src=" . $image . " id =" . "cover" . ">");
                    print("</a>");

                    print("<div class=\"modal hide fade\" id=" . "$title" . " style =" . "display:none;" . ">");
                        print("<div class =" . "row" . ">");
                            print("<div class =" . "span3" . ">");
                                print("<img src=" . $image . " id =" . "cover" . ">");
                            print("</div>");
                            //print("<div class =" . "span3" . ">");
                                print("<div class=" . "modal-header" . " style=" . "text-align:left;" . ">");
                                    print("<a class=" . "close" . " data-dismiss=" . "modal" . ">×</a>");
                                    print("<h4>" . $title . "</h3>");
                                    print("<h5>" . $author . "</h5>");
                                    print("<h5> Your Price: $" . $price . "</h5>");
                                print("</div>");
                            //print("</div>");
                        print("</div>");
                        print("<div class=" . "modal-body" . ">");
                            print("<p>" . $description . "</p>");
                        print("</div>");
                        print("<div class=" . "modal-footer" . ">");
                        print("</div>");
                    print("</div>");
                    
                    print("</li>");
                }
            }
        } 
        
        print("</div>");
        print("</ul>");
    ?>
</table>
</div>

