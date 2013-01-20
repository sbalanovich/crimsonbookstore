<?php
    
    // configuration
    require("../includes/config.php");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //ensure existence and validity of first name
        if(empty($_POST['first']))
	    { 
            apologize("Please enter a first name."); 
	    } 
	    else if(!checkuname($_POST['first']))
	    { 
	        apologize("Please enter a valid name"); 
	    }
	    
        //ensure existence and validity of last name
	    else if(empty($_POST['last']))
	    { 
            apologize("Please enter a last name."); 
	    } 
	    else if(!checkuname($_POST['last']))
	    { 
	        apologize("Please enter a valid last name"); 
	    }
	    
	    //ensure proper lengths of first and last names
        else if(strlen($_POST['first']) <= 2)
        {
            apologize("First name is too short");
        }
        else if(strlen($_POST['last']) <= 2)
        {
            apologize("Last name is too short");
        }
        
        //ensure existence, length, and validity of username
	    else if(empty($_POST['uname']))
	    { 
            apologize("Please enter a user name."); 
	    } 
	    else if(!checkuname($_POST['uname']))
	    { 
	        apologize("Please enter a valid uname"); 
	    }
	    else if(strlen($_POST['uname']) <= 2)
        {
            apologize("Username is too short");
        }
        
	    //now we check the email address 
	    //check if the email address is empty 
	    if(empty($_POST['email']))
	    { 
	        apologize("Please enter an email address."); 
	    }
	    
	    //Next we check if the email address has a valid format 
	    else if(!checkEmail($_POST['email']))
	    { 
	        apologize("Please enter a valid \"@college.harvard.edu\" email address."); 
	    }
	    
	    //if username and email were input
	    else if (!empty($_POST['email']) && !empty($_POST['uname']))
        {
            //find users by given e-mail and username
            $emailrows = query("SELECT * FROM users WHERE email = '?'", $_POST['email']);        
            $userrows = query("SELECT * FROM users WHERE username = '?'", $_POST['uname']);

            //if users with same email were found, apologize
            if (count($emailrows) > 0)
            {
                apologize("Email taken");
            }
                        
            //if users with same username were found, apologize
            else if (count($userrows) >0)
            {
                apologize("Username taken"); 
            }
        }
        
	    //now we check the password 
	    //first we check that both password fields are filled in 
	    else if(empty($_POST['password']))
	    { 
	        apologize("Please enter a password."); 
	    } 
	    else if(empty($_POST['confirmation']))
	    { 
	        apologize("Please enter a valid confirmation password."); 
	    }
	    
	    //now we check to see if the passwords match 
	    else if($_POST['password'] !== $_POST['confirmation'])
	    { 
	        apologize("Your password does not match the confirmation. Please check and try again."); 
	    }
	    
	    //finally the secret message "captcha" is checked
	    else if(empty($_POST['secret']))
	    { 
	        apologize("Please answer the challenge question."); 
	    } 
	    else if(!($_POST['secret'] == 5))
	    { 
	        apologize("Challenge question answered incorrectly. Try again"); 
	    } 
	     
	    /* SECTION 2: Data verification and insertion*/ 
	    else
	    { 
	        //connect  to the database 
	        $db=mysql_connect  (SERVER, USERNAME,  PASSWORD) or die('Could not connect: ' . mysql_error());
	        //-select  the database to use 
	        $mydb=mysql_select_db("project") or die (mysql_error());
	        
	        //all data tests have passed so store data in variables
	        $first=mysql_real_escape_string($_POST['first']);
            $last=mysql_real_escape_string($_POST['last']);
	        $user=mysql_real_escape_string($_POST['uname']);
            $pass=crypt($_POST["password"]);
	        $email=mysql_real_escape_string($_POST['email']);
            $hash = md5(rand(0,1000)); // Generate random 32 character hash and assign it to a local variable.     
	         
	        //create subject and e-mail message
	        $subject = 'Harvard Book Exchange Signup | Complete your registration';
	        $message = 'Thanks for signing up, '.$first.'! 
            Your account has been created, you can login with the following uname after you have activated your account. 
            ------------------------ 
            uname: '.$user.'
            ------------------------ 
            Please click this link to activate your account: 
            http://project/activate.php?email='.$email.'&hash='.$hash.' 
            '; 
	        
            //now send the email 
            require("PHPMailer/class.phpmailer.php");

            // instantiate mailer
            $mail = new PHPMailer();

            // use SMTP
            $mail->IsSMTP();
            $mail->Host = "smtp.fas.harvard.edu";

            // set From:
            $mail->SetFrom("noreply@harvardbookexchange.com");

            // set To:
            $mail->AddAddress("" . $email);

            // set Subject:
            $mail->Subject = "" . $subject;

            // set body
            $mail->Body = "" . $message;

            // send mail
            if ($mail->Send() == false)
            {
              die($mail->ErrInfo);
            }
            else
            {                     
                //if e-mail successful, inout new user into database
                if(query("INSERT INTO users (firstname, lastname, username, password, email, hash) VALUES (?,?,?,?,?,?)",
                    mysql_real_escape_string($first),
                    mysql_real_escape_string($last), 
                    mysql_real_escape_string($user), 
                    mysql_real_escape_string($pass), 
                    mysql_real_escape_string($email), 
                    mysql_real_escape_string($hash)))
                {
                    apologize("There was an error processing your request. The uname might already be taken");
                }
                //render success upon succesful registration
                render("register_success.php", ["title" => "Check your e-mail!", "first" => $first, "last" => $last, "email" => $email]);
            }
	    }         
    }
    
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
?>
