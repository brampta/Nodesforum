<?php



$no_more_quote_tags=0;
$count_tags=0;
$reading_head=0;
while($no_more_quote_tags==0)
{
    $find_first_quote_tag=stripos(' '.$string,'[quote',$reading_head);
    if($find_first_quote_tag)
    {
        //we got the start of a quote opening tag
        $count_tags++;
        $reading_head=$find_first_quote_tag+2;
        $find_first_quote_tag=$find_first_quote_tag-1;

        $secondary_reading_head=$reading_head;
        $closingtag_good=0;
        $nomore_closing_brackets=0;
        $counturns=0;
        $maxturns=100;
        while($closingtag_good==0 && $nomore_closing_brackets==0 && $counturns<$maxturns)
        {
            $counturns++;
            $find_closing_of_opening_tag=stripos($string,']',$secondary_reading_head);
            if($find_closing_of_opening_tag)
            {
                $secondary_reading_head=$find_closing_of_opening_tag+2;
                $char_before_that=substr($string,$find_closing_of_opening_tag-1,1);
                if($char_before_that!=$_nodesforum_bbcode_escape_char)
                {$closingtag_good=1;}
            }
            else
            {$nomore_closing_brackets=1;}
        }




        if($closingtag_good==1)
        {
            //we found the next unslashed closing bracket after that we got the whole quote opening tag
            $length_of_opening_tag=$find_closing_of_opening_tag-$find_first_quote_tag;
            $string_of_opening_tag=substr($string,$find_first_quote_tag,$length_of_opening_tag+1);



            //read strict attribute inside quote opening tag
            $lookfor_strict_attribute=stripos($string_of_opening_tag,' strict="');
            if($lookfor_strict_attribute)
            {
                $secondary_reading_head=$lookfor_strict_attribute+9;
                $stricttag_good=0;
                $nomore_strattr=0;
                $counturns=0;
                $maxturns=100;
                while($stricttag_good<4 && $nomore_strattr==0 && $counturns<$maxturns)
                {
                    $counturns++;
                    $lookforclose_of_strict_attribute=stripos($string_of_opening_tag,'"',$secondary_reading_head);
                    if($lookforclose_of_strict_attribute)
                    {
                        $secondary_reading_head=$lookforclose_of_strict_attribute+1;
                        $char_before_that=substr($string_of_opening_tag,$lookforclose_of_strict_attribute-1,1);
                        if($char_before_that!=$_nodesforum_bbcode_escape_char)
                        {
                            $stricttag_good++;
                            $closing_quotes[$stricttag_good]=$lookforclose_of_strict_attribute;
                        }
                    }
                    else
                    {$nomore_strattr=1;}
                }


                if($stricttag_good==4)
                {
                    //the quote opening tag contains a strict attr of valid format
                    $quote_postID[$count_tags]=substr($string_of_opening_tag,$lookfor_strict_attribute+9,$closing_quotes[1]-($lookfor_strict_attribute+9));
                    $quote_userID[$count_tags]=_nodesforum_different_unescape_certain_chars(substr($string_of_opening_tag,$closing_quotes[1]+1,$closing_quotes[2]-($closing_quotes[1]+1)));
                    $quote_publicname[$count_tags]=_nodesforum_different_unescape_certain_chars(substr($string_of_opening_tag,$closing_quotes[2]+1,$closing_quotes[3]-($closing_quotes[2]+1)));
                    $quote_time[$count_tags]=substr($string_of_opening_tag,$closing_quotes[3]+1,$closing_quotes[4]-($closing_quotes[3]+1));





                    $find_first_closing_tag_after_that=stripos($string,'[/quote]',$find_closing_of_opening_tag);


                    if($find_first_closing_tag_after_that)
                    {
                        //and we had the closing quote tag after, completing the strict quote structure




                        $reading_head=$find_first_closing_tag_after_that+2;



                        $string_inside_of_tags=substr($string,$find_first_quote_tag+$length_of_opening_tag+1,$find_first_closing_tag_after_that-($find_first_quote_tag+$length_of_opening_tag+1));
                        $quote_texts[$count_tags]=_nodesforum_different_unescape_certain_chars($string_inside_of_tags);




                        //now we know that we have a well formed strict quote and we have all its data on vars, lets verify its validity













                        $quotechecksout=0;






                        if($_nodesforum_verifstrquotes_editmode==1)
                        {
                            $nomoreofthatopeningtag=0;
                            $countchecks=0;
                            $maxchecks=100;
                            $readingheadzzz=0;
                            while($nomoreofthatopeningtag==0 && $countchecks<$maxchecks && $quotechecksout==0)
                            {
                                $lookforthisopeningtaginold=stripos(' '.$_nodesforum_oldpost_to_compare,$string_of_opening_tag,$readingheadzzz);
                                if($lookforthisopeningtaginold)
                                {
                                    $readingheadzzz=$lookforthisopeningtaginold+2;
                                    $lookforthisopeningtaginold=$lookforthisopeningtaginold-1;
                                    $lookforclosingquotetag=stripos($_nodesforum_oldpost_to_compare,'[/quote]',$lookforthisopeningtaginold+strlen($string_of_opening_tag)-1);
                                    if($lookforclosingquotetag)
                                    {
                                        $old_quote_text=substr($_nodesforum_oldpost_to_compare,$lookforthisopeningtaginold+strlen($string_of_opening_tag),$lookforclosingquotetag-($lookforthisopeningtaginold+strlen($string_of_opening_tag)));
                                        $check_for_new_quote_text_in_old_quote_text=stripos(' '.$old_quote_text,$string_inside_of_tags);
                                        if($check_for_new_quote_text_in_old_quote_text)
                                        {$quotechecksout=1;}
                                    }
                                }
                                else
                                {$nomoreofthatopeningtag=1;}
                            }
                        }






                        if($quotechecksout==0)
                        {


                            $addslashed_postID_for_verification=mysql_real_escape_string($quote_postID[$count_tags]);
                            $addslashed_userID_for_verification=mysql_real_escape_string($quote_userID[$count_tags]);
                            $addslashed_publicname_for_verification=mysql_real_escape_string($quote_publicname[$count_tags]);

                            $quote_texts[$count_tags]=str_replace('\\','\\\\',$quote_texts[$count_tags]);
                            $addslashed_text_for_verification=mysql_real_escape_string($quote_texts[$count_tags]);




                            $myquery="SELECT fapID FROM ".$_nodesforum_db_table_name_modifier."_nodesforum_folders_and_posts WHERE fapID = '$addslashed_postID_for_verification' && creator_uniqueID = '$addslashed_userID_for_verification' && post LIKE '%$addslashed_text_for_verification%'";
                            $result = mysql_query($myquery);
                            while($row = mysql_fetch_array($result))
                            {
                                if($addslashed_userID_for_verification=='0' || $addslashed_userID_for_verification==$_nodesforum_uniqueID_of_deleted_user)
                                {$quotechecksout=1;}
                                else
                                {
                                    $myquery="SELECT $_nodesforum_external_user_system_user_uniqueID_rowname FROM $_nodesforum_external_user_system_table_name WHERE $_nodesforum_external_user_system_user_uniqueID_rowname = '$addslashed_userID_for_verification' && $_nodesforum_external_user_system_publicname_rowname = '$addslashed_publicname_for_verification'";
                                    //echo $myquery.'<br />';
                                    $result2 = mysql_query($myquery);
                                    while($row2 = mysql_fetch_array($result2))
                                    {$quotechecksout=1;}
                                }








                                //set time

                                $string_before_time=substr($string,0,$find_first_quote_tag+$closing_quotes[3]+1);
                                $string_after_time=substr($string,$find_first_quote_tag+$closing_quotes[4]);
                                $string=$string_before_time.$nowtime.$string_after_time;



                                if($reading_head>$string_after_time)
                                {
                                    $lendiffbetween_real_and_dummy_time=strlen($nowtime)-strlen($quote_time[$count_tags]);
                                    $reading_head=$reading_head+$lendiffbetween_real_and_dummy_time;
                                }

                            }
                        }












                        //throw error and add info to $_nodesforum_contains_invalid_strict_quotes if doesnt checkout
                        if($quotechecksout==0)
                        {
                            $error=1;
                            $thequoteforshow=htmlspecialchars(substr($string,$find_first_quote_tag,($find_first_closing_tag_after_that+8)-$find_first_quote_tag));
                            $xplain_error='
									this quote:<hr />'.$thequoteforshow.'<hr />does not appear to be true according the the verification made on the database.';
                            $_nodesforum_contains_invalid_strict_quotes=$_nodesforum_contains_invalid_strict_quotes.$xplain_error;
                        }


                    }
                }

            }

        }




    }
    else
    {$no_more_quote_tags=1;}
}



?>
