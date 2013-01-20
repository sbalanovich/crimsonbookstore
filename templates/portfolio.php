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
</div>

