<?php

######################## randnum ########################
function randnum()
{
    $first = date('ym');
    $last = '';
    for($i = 1; $i <= 4; $i++)
    {
        $last .= rand(0,9);
    }
    $num = $first . $last;
    
    return $num;
}
######################## randnum ########################

######################## gPureText ########################
function gPureText( $Text , $Style = "Text" , $Switches=NULL  ) 
{
    $Style = strtolower($Style) ; 
    $Text = str_replace( "||"  , "AAA" , $Text ) ; 
    
    
    if(!strstr($Switches,"E")) {
        $Text=str_replace("1","غ±",$Text);
        $Text=str_replace("2","غ²",$Text);
        $Text=str_replace("3","غ³",$Text);
        $Text=str_replace("4","غ´",$Text);
        $Text=str_replace("5","غµ",$Text);
        $Text=str_replace("6","غ¶",$Text);
        $Text=str_replace("7","غ·",$Text);
        $Text=str_replace("8","غ¸",$Text);
        $Text=str_replace("9","غ¹",$Text);
        $Text=str_replace("0","غ°",$Text);    
    }
    
    
    switch( $Style ) {
        case "number" :
            $Text=str_replace("غ±","1",$Text);
            $Text=str_replace("غ²","2",$Text);
            $Text=str_replace("غ³","3",$Text);
            $Text=str_replace("غ´","4",$Text);
            $Text=str_replace("غµ","5",$Text);
            $Text=str_replace("غ¶","6",$Text);
            $Text=str_replace("غ·","7",$Text);
            $Text=str_replace("غ¸","8",$Text);
            $Text=str_replace("غ¹","9",$Text);
            $Text=str_replace("غ°","0",$Text);    
            $Text+=0 ; 
            break ; 
                        
        case "convert" : 
            $Text = str_replace( "'" , NULL , $Text) ; 
            //$Text = ereg_replace( "'" , NULL , $Text) ; 
            $Text = str_replace( "==" , NULL , $Text) ; 
            //$Text = ereg_replace( "==" , NULL , $Text) ; 
            $Text = str_replace(" 
" , ".." , $Text ) ; //Contains somthing. it is not empty

        case "users" :
            $Text = strip_tags($Text) ;  
            $Text = trim($Text) ; 
                        
        case "special" :
            $Text = str_replace( "[\x5c\]" , NULL , $Text) ; 
            //$Text = ereg_replace( "[\x5c\]" , NULL , $Text) ; 
            $Text = str_replace( "|"  , "â€Œâ€Œ"       , $Text ) ; // contains something. it is not empty
            $Text = str_replace( "ظٹ" , "غŒ" , $Text ) ; 
            $Text = str_replace( "ظƒ"  , "ع©" , $Text ) ;
            $Text = str_replace( "آ¬"  , "â€ڈ" , $Text ) ;
            break ;
            
        case "comment" :
        case "comments":
            $Text = str_replace( "==" , " " , $Text ) ; 
            $Text = str_replace( "|"  , "â€Œâ€Œ"       , $Text ) ; // contains something. it is not empty
            break ;
                
        case "rss"      :
            $Text = str_replace( "|"  , "â€Œâ€ڈ"       , $Text ) ; // contains something. it is not empty
            $Text = str_replace( "{{" , "<p>"    , $Text ) ; 
            $Text = str_replace( "}}" , "</p>"   , $Text ) ; 
            $Text = str_replace( "{!" , "<p>",$Text) ; 
            $Text = str_replace( "!}" , "</p>" , $Text ) ; 
            $Text = str_replace( "{#" , "<p>"    , $Text ) ; 
            $Text = str_replace( "#}" , "</p>"   , $Text ) ; 
            $Text = str_replace( "{L" , "<div align='left' dir='ltr'>"    , $Text ) ; 
            $Text = str_replace( "L}" , "</div>"   , $Text ) ; 
            $Text = str_replace( "{_" , "<i>"    , $Text ) ; 
            $Text = str_replace( "_}" , "</i>"   , $Text ) ; 
            $Text = str_replace( "{+" , "<b>"    , $Text ) ; 
            $Text = str_replace( "+}" , "</b>"   , $Text ) ; 
            $Text = str_replace( "{" , "<div><b>"    , $Text ) ; 
            $Text = str_replace( "}" , "</b></div>"   , $Text ) ; 
            $Text = str_replace( "\n" , "<br />"   , $Text ) ;  
            $Text = str_replace(" 
" , "<br />" , $Text ) ; //Contains somthing. it is not empty
            break ; 
        
        case "body"      :
            $Text = str_replace( "*"  , "ظ­"   , $Text ) ; 
            $Text = str_replace( "-"  , "ظ€"   , $Text ) ; 
            $Text = str_replace( "|"  , "â€ڈâ€Œ"       , $Text ) ; // contains something. it is not empty
            $Text = str_replace( "{{" , "<br><font color='red' style='font-size:11px;line-height:1.6'><b>"    , $Text ) ; 
            $Text = str_replace( "}}" , "</b></font>"   , $Text ) ; 
            $Text = str_replace( "{!" , "<table width='90%' border='0' cellpadding='0' cellspacing='0' ><tr><td style='text-align:justify;font-size:12px;line-height:1.7'>",$Text) ; 
            $Text = str_replace( "!}" , "</td></tr></table>" , $Text ) ; 
            $Text = str_replace( "{#" , "<div align='center'>"    , $Text ) ; 
            $Text = str_replace( "#}" , "</div>"   , $Text ) ; 
            $Text = str_replace( "{L" , "<div align='left' dir='ltr'>"    , $Text ) ; 
            $Text = str_replace( "L}" , "</div>"   , $Text ) ; 
            $Text = str_replace( "{_" , "<i>"    , $Text ) ; 
            $Text = str_replace( "_}" , "</i>"   , $Text ) ; 
            $Text = str_replace( "{+" , "<b><font style='font-size:11px'>"    , $Text ) ; 
            $Text = str_replace( "+}" , "</font></b>"   , $Text ) ; 
            $Text = str_replace( "{" , "<font color='CC3300' style='font-size:11px'><b>"    , $Text ) ; 
            $Text = str_replace( "}" , "</b></font>"   , $Text ) ; 
            $Text = str_replace( "\n\n" , "<p>"   , $Text ) ; 
            $Text = str_replace( "\n" , "<div style='line-height:0.8'>&nbsp;</div>"   , $Text ) ;  
            $Text = str_replace(" 
" , "<p>" , $Text ) ; //Contains somthing. it is not empty
            break ; 
                
                
        case "text"      :
            $Text = str_replace( "*"  , "ظ­"   , $Text ) ; 
            $Text = str_replace( "-"  , "ظ€"   , $Text ) ; 
            $Text = str_replace( "|"  , "â€Œâ€ڈ"       , $Text ) ; // contains something. it is not empty
            $Text = str_replace( "{L" , "<div align='left' dir='ltr'>"    , $Text ) ; 
            $Text = str_replace( "L}" , "</div>"   , $Text ) ; 
            $Text = str_replace( "{_" , "<i>"    , $Text ) ; 
            $Text = str_replace( "_}" , "</i>"   , $Text ) ; 
            $Text = str_replace( "{+" , "<b><font style='font-size:11px'>"    , $Text ) ; 
            $Text = str_replace( "+}" , "</font></b>"   , $Text ) ; 
            $Text = str_replace( "\n\n" , "<p>"   , $Text ) ; 
            $Text = str_replace( "\n" , "<br />"   , $Text ) ;  
            $Text = str_replace(" 
" , "<p>" , $Text ) ; //Contains somthing. it is not empty
            break ; 
        
        case "notice"    : 
            $Text = str_replace( "|" , "â€ڈâ€Œ" , $Text ) ; 
            $Text = str_replace( "*" , "<br><font color='#990066'>ظ­</font> " , $Text ) ; 
//                    , "<p></p><img src='Images/Check.gif' border='0' />" , $Text ) ;
            break ;
    }

    $Text = str_replace( "AAA"  , "|"       , $Text ) ; 
    return trim($Text) ; 
}

######################## gPureText ########################

######################## gCharLimit ########################
function gCharLimit($String , $Length)
{
    if(strlen($String) > $Length ) {
        $String = substr(trim($String),0,$Length); 
        $String = substr($String,0,strlen($String)-strpos(strrev($String)," "));
        $String = $String.'...';
    }
    return $String ; 
}
######################## gCharLimit ########################

######################## Html Coding ########################
function htmlCoding($input, $type = 1)
{
    if($type == '1')
    {
        $input = str_replace( "ي" , "ی" , $input ) ; 
        $input = str_replace( "ك"  , "ک" , $input ) ;
        $input = str_replace( "¬"  , "‏" , $input );
        $input = trim($input);
        return htmlspecialchars($input ,ENT_QUOTES);
    }
    else
    {
        return htmlspecialchars_decode($input, ENT_QUOTES);
    }
}
######################## Html Coding ########################

######################## Update One Field From Table ########################
function updateOneFieldFromTable($table, $field, $value, $id)
{
    $result = DatabaseHandler::Execute("UPDATE `$table` SET `$field` = '" . $value . "' WHERE `id` = $id ;");
    if($result)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}
######################## Update One Field From Table ########################

######################## Validation Email ########################
function EmailValidation($email)
{ 
    $email = htmlspecialchars(stripslashes(strip_tags($email)));
    if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
    {
        /*$domain = explode('@', $email);
        $domain = $domain[1];
        if(!checkdnsrr($domain,'MX'))
        {
            //return false;
            return true;
        }*/
        return true;
    }
    else
    {
        return false;
    }
}
######################## Validation Email ########################

######################## Get Real User IP ########################
function getRealUserIp() {
     $ipaddress = '';
     if (isset($_SERVER['HTTP_CLIENT_IP']))
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_X_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if(isset($_SERVER['REMOTE_ADDR']))
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}
######################## Get Real User IP ########################

######################## My show Array ########################
function myShowArray($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
######################## My show Array ########################



?>