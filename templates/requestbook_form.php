<script type="text/javascript">
//on document ready
$(document).ready(function()
{
//taken from http://www.phpgenious.com/2009/02/username-availability-chacker-in-ajax-and-php-using-jquery/
//checks that the user being sent to is a real user
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

</script>

<form action="requestbooksend.php" method="post">

        <div id="centercontent" class="hero-unit" style="color:#FFFFFF">
            <legend><h1 style="text-align:left; color:#FFFFFF;">Send PM:</h1></legend>
                <input type="hidden" name="from_user" maxlength="32" value = "">
            <h4>To User:</h4> 
                    <?php
                    print("<input class=\"input\" id=\"to_user\" type=\"text\" name=\"to_user\" maxlength=\"32\" value = " . $user['username'] . ">");
                    ?>
                    <p><span id="msgbox" style="display:none"></span></p>
            <br/>
            <h4>Message:</h4>
            <?php 
                   print("<TEXTAREA NAME=\"message\" COLS=100 ROWS=10 WRAP=SOFT>Hey&nbsp;" . $user['firstname'] . ",
                   
I am interested in your listing of&nbsp;" . $book['author'] . "'s&nbsp;" . $book['title'] . ".&nbsp;Please get back to me.

Thanks! 
" . $first . "</TEXTAREA>");
            ?>
            <p>
               <input type="submit" name="submit" value="Send Message">
            </p>
            </div>

</table>
</form>
</div>
