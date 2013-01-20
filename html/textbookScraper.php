<?php
/*************************************************************
 * Mitchel Cole, Michael Chen, Sergui Balanovich
 * Textbook.php
 * 
 * CS 50 Final Project
 *
 * Goes through cs50 courses to find user's course
 * Searches textbook info from a given course's website
 * using the simpleTest browser
 * Displays other books required/ recommended by the course
 ************************************************************/
 
    require_once("../includes/config.php"); 

   
    require_once("../includes/simpletest/browser.php");
    
    // open file with numberkey for each course
    $rows = file("/home/jharvard/vhosts/project/includes/numbers.txt");  
    foreach ($rows as $row)
    {
        // create new web browser
        $simpleBrowser = &new SimpleBrowser();
        $row = chop($row);
        $urls = "http://isites.harvard.edu/icb/icb.do?keyword=k".$row;
        $url = $urls;
        
        // navigate to given address
        $simpleBrowser->get($url);
        // only get urls that don't require login into Harvard PIN
        // determine if there is a reserve reading list link
        if($simpleBrowser->isClickable("Reserve Reading List"))
        {    
            // click on the link
            $simpleBrowser->click("Reserve Reading List");
            $page = $simpleBrowser->getContentAsText();
            
            // beginning parsing of text for course, title, author and ISBN
            $str1 = explode("§", $page);
            
            $str2 = explode ("™",$str1[1]);
            $str3 = explode("(", $str2[0]);
            $course = $str3[0];
            
            $str4 = explode("by:", $str2[1]);
            $str5 = explode("View Full Citation Details", $str4[1]);
            
            // determine number of books for course by View Full Citation Details Delimiter
            // the last element of $str5 is the footer for the webpage
            $bookCounter = sizeof($str5);
            
            // parse each remaining text info
            for ($i = 0; $i<$bookCounter; $i++)
            {
                $str6 = explode("Lecture/Class Date:" , $str5[$i]);
                $str7 = explode("ISBN: " , $str6[0]);
                $emptyArray =array(); 
                
                // some books do not have an ISBN so $str7 may be empty array
                if ($str7 !== $emptyArray)
                {
                    $str8 = explode ("(", $str7[1]);
                    $ISBN = $str8[0];
                    
                    $str9 = explode (".", $str7[0]);
                   
                    // check sizeof $str9 to account for exra periods in author's name                  
                    if (sizeof($str9) >= 5)
                    {    
                        $author = ($str9[0] . " " . $str9[1]);
                        // $str9[2] may be part of author's name or title, assume longer is itle
                        if(strlen($str9[2]) >= strlen($str9[3]))
                            $title = $str9[2];
                        else
                        {    
                            $title = $str9[3]; 
                            $author = $author . $str9[2];
                        }   
                    }                       
                    else
                    {
                        $author = $str9[0];
                        $title = $str9[1];
                    }
                }
                // if book info has no ISBN
                else
                {
                   $str9 = explode (".", $str6[0]);

                   // check length of each string in $str9
                   $ISBN = 0;
                   if (sizeof($str9) >= 5)
                    {    
                        $author = ($str9[0] . " " . $str9[1]);
                        if(strlen($str9[2]) >= strlen($str9[3]))
                            $title = $str9[2];
                        else
                        {    
                            $title = $str9[3]; 
                            $author = $author . $str9[2];
                        }    
                    }                   
                    else
                    {
                        $author = $str9[0];
                        $title = $str9[1];
                    }
                }

                // insert entry into userbase
                $insert = query("INSERT INTO Textbooks (course, title, author, ISBN) VALUES (?, ?, ?, ?)", $course, $title, 
                $author, $ISBN);      
            } 
        }
    }
?>
