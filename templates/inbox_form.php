<div>
<script>
//on document ready
$(document).ready(function(){
     //displays the "No messages" if there are no messages
     if (!$('#from').html().trim()) {
        $('#msg').removeClass('nothere').addClass('here');
    }
    
    //on user click away
    $("#to_user").blur(function()
	{
		
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn(1000);
		//check the uname exists or not from ajax
		$.post("user_available.php",{ uname:$(this).val() } ,function(data)
        {
		  if(data == 0) //if uname not avaiable
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Good to go!').addClass('messageboxok').fadeTo(900,1);
			});		
          }
		  else
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('User doesn\'t exist').addClass('messageboxerror').fadeTo(900,1);	
			});
		  }
				
        });
 
	});
});

//displays messages real time on username click
function showUser(str)
{
    //checks for empty
    if (str=="")
      {
          document.getElementById("txtHint").innerHTML="";
          return;
      } 
    //sends a new XML HTTP Request
    if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
      }
    //calibration for other browsers
    else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    //detecs input  
    xmlhttp.onreadystatechange=function()
    {
        //displays the messages
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }
//sends a get request to the message querying functions
xmlhttp.open("GET","requesttest.php?q=" + str, true);
//sends
xmlhttp.send();
}


</script>
<div class="container" id="centercontent">
<br/>
<legend style="color:#FFFFFF;"><h1>Book Talk</h1>
</legend>
<a class="btn btn-primary btn-large" href="#compose" data-toggle="modal"><i class="icon-pencil icon-white"></i>&nbsp;Compose</a>
    <div class="row-fluid">
        <div class="span4">
            <legend style="color:#FFFFFF;"><h2>From User</h2></legend>
            <h5 id="msg" class="nothere" style="color:#FFFFFF;">No messages!</h5>
            <div id="from">
                <?php
                //constructs the left navigation bar
                $users = array();
                foreach($messagerows as $messagerow)
                {
                    $from_user = $messagerow["from_user"];
                    if(!in_array($from_user, $users))
                    {
                        array_push($users, $from_user);
                        print("<button class=\"btn btn-danger\" id=\"departnavbtn\" onclick=\"showUser(this.value)\" value=" . "$from_user" . ">" . $from_user . "</button>");
                        print("<br/>");
                    } 
                }
                ?>
            </div> 
        </div>
        <div class="span8">
            <legend style="color:#FFFFFF;"><h2>Messages</h2></legend>
            <div id="txtHint" style="color:#FFFFFF;"><b>Messages will load here...</b></div>
        </div>
    </div>
</div>

<?php
//prints the modals for composing messages
 print("<div class=\"modal hide fade\"id=" . "compose" . " style =" . "display:none;" . ">");
    print("<form action=\"sendpm.php\" method=\"post\">");
        print("<div id=\"centercontent\" style=\"color:#FFFFFF\">");
            print("<div class=" . "modal-header" . " style =" . "text-align:left;" . ">");
                print("<a class=" . "close" . " data-dismiss=" . "modal" . ">×</a>");
                print("<legend><h1 style=\"text-align:left; color:#FFFFFF;\">Send PM:</h1></legend>");
                print("<input type=\"hidden\" name=\"from_user\" maxlength=\"32\" value = \"\">");
            print("</div>");
                print("<h4>To User:</h4>"); 
                        print("<input class=\"input\" id=\"to_user\" type=\"text\" name=\"to_user\" maxlength=\"32\" value = \"\">");
                        print("<p><span id=\"msgbox\" style=\"display:none\"></span></p>");
                print("<br/>");
                print("<h4>Message:</h4>"); 
                       print("<TEXTAREA NAME=\"message\" COLS=\"100\" ROWS=10 WRAP=SOFT></TEXTAREA>");
                print("<p>");
                   print("<input type=\"submit\" name=\"submit\" value=\"Send Message\">");
                print("</p>");
            print("</div>");
    print("</form>");
print("</div>");
?>
