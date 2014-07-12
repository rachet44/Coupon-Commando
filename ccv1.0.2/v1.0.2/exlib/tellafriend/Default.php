<?php
 /*********************************************************************************
 *          Filename: Default.php
 *          Generated with CodeCharge  v.1.1.18
 *          PHP build 02/26/2001
 *********************************************************************************/

include ("./common.php");

session_start();

$sFileName = "Default.php";




$sTellAFriendErr = "";
$sAction = get_param("FormAction");
$sForm = get_param("FormName");

//-- handling actions
switch ($sForm)
{
  case "TellAFriend":
    TellAFriend_action($sAction);
  break;
}

?><html>
<head>
<title>TellAFriend</title>
<meta name="GENERATOR" content="YesSoftware CodeCharge v.1.1.18 using 'PHP.ccp'">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0"> 
<meta http-equiv="cache-control" content="no-cache">
</head>
<body background="images/bg.gif" text="#000000" link="#336600" vlink="#336600" alink="#336600">
<center>
<img src="images/logo.gif">

<h4>TODO: Wire Up</h4>

 <table>
  <tr>
   
   <td valign="top">
<? TellAFriend_Show() ?>
    
   </td>
  </tr>
 </table>
</center>

</body>
</html>
<? 



//********************************************************************************



function TellAFriend_action($sAction)
{
  global $db;
  global $sForm;
  global $sTellAFriendErr;
  
  $sParams = "";
  $sActionFileName = "Send_Confirmation.php";

  

  $sWhere = "";
  $bErr = false;

  if($sAction == "cancel")
    header("Location: " . $sActionFileName); 

  
  $fldto_name = get_param("to_name");
  $fldto_email = get_param("to_email");
  $fldfrom_name = get_param("from_name");
  $fldfrom_email = get_param("from_email");
  $fldcomments = get_param("comments");
  if($sAction == "insert" || $sAction == "update") 
  {
    if(!strlen($fldto_name))
      $sTellAFriendErr .= "The value in field Friend's name is required.<br>";
    
    if(!strlen($fldto_email))
      $sTellAFriendErr .= "The value in field Friend's e-mail address is required.<br>";
    
    if(!strlen($fldfrom_name))
      $sTellAFriendErr .= "The value in field Your Name is required.<br>";
    
    if(!strlen($fldfrom_email))
      $sTellAFriendErr .= "The value in field Your e-mail address is required.<br>";
    
    if(!strlen($fldcomments))
      $sTellAFriendErr .= "The value in field Comments is required.<br>";
    

    if(strlen($sTellAFriendErr)) return;
  }
  

  //-- Create SQL statement
  $sSQL = "";
  
  switch(strtolower($sAction)) 
  {
    case "insert":
      
$to_email = get_param("to_email");
$from_email = get_param("from_email");
$subject = "Web Page from " . get_param("from_name");

$body = "Hello " . get_param("to_name") . "!" . chr(13) . 
chr(13) . get_param("from_name") . 
" sent you this page from the CodeCharge Web Site." . chr(13) .
"http://www.codecharge.com" . chr(13) . chr(13) . "Comments from " . 
get_param("from_name") . ":" . chr(13) . get_param("comments");

$db->query("insert into tellafriend_log (sending_date, from_email, from_name, to_email, to_name, message_comments) values (" .
tosql(date("Y-m-d G:i:s"), "Text") . "," .
tosql(get_param("from_email"),"Text") . "," .
tosql(get_param("from_name"),"Text") . "," .
tosql(get_param("to_email"),"Text") . "," .
tosql(get_param("to_name"),"Text") . "," .
tosql(get_param("comments"),"Text") . ")");

mail($to_email, $subject, $body,"From: $from_email\nReply-To: $from_email\nX-Mailer: PHP/" . phpversion());
    break;
  }

  header("Location: " . $sActionFileName);
  
}



function TellAFriend_Show()
{
  global $sFileName;
  global $sAction;
  global $db;
  global $sForm;
  global $sTellAFriendErr;

  global $styles;

  $sWhere = "";
  
  $bPK = false; //-- primary key indication

  //-- begin block of initialization variables
  //-- end block

?>
   
   <table border="0" cellspacing="1" cellpadding="1" bgcolor="#878743">
   <form method="POST" action="<?= $sFileName ?>" name="TellAFriend">
   <tr><td align="center" bgcolor="#878743" colspan="2"><font style="font-size: 10pt; color: #FFFFFF; font-family: Arial, Tahoma, Verdana, Helvetica; font-weight: bold">.::Tell a friend::.</font></td></tr>
   <? if ($sTellAFriendErr) { ?> <tr><td bgcolor="#BCBC7A" colspan="2"><font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica"><?= $sTellAFriendErr ?></font></td></tr><? } ?>
<? 

  if($sTellAFriendErr == "")
  {
    //-- Get primary key and form parameters
  }
  else
  {
    //-- Get primary key, form parameters and form's fields
  }

  
  $fldto_name = get_param("to_name");
  $fldto_email = get_param("to_email");
  $fldfrom_name = get_param("from_name");
  $fldfrom_email = get_param("from_email");
  $fldcomments = get_param("comments");

  $sSQL = "select * from  where " . $sWhere;
  if($bPK && !($sAction == "insert" && $sForm == "TellAFriend"))
  {
    $db->query($sSQL);
    $db->next_record();
    
  }

  else
  {
    if($sTellAFriendErr == "")
    {
      $fldcomments= "New exciting product for web development. Check it out at http://www.codecharge.com";
    }
  }//-- Set default values
  $fldcomments= "New exciting product for web development. Check it out at http://www.codecharge.com";
    //-- show fields
    ?>
  <tr>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">Friend's name</font>
       </td>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">
         <input type="text" name="to_name" maxlength="50" value="<?= tohtml($fldto_name) ?>" size="30" ></font>
       </td>
     </tr>
<tr>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">Friend's e-mail address</font>
       </td>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">
         <input type="text" name="to_email" maxlength="50" value="<?= tohtml($fldto_email) ?>" size="30" ></font>
       </td>
     </tr>
<tr>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">Your Name</font>
       </td>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">
         <input type="text" name="from_name" maxlength="50" value="<?= tohtml($fldfrom_name) ?>" size="30" ></font>
       </td>
     </tr>
<tr>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">Your e-mail address</font>
       </td>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">
         <input type="text" name="from_email" maxlength="50" value="<?= tohtml($fldfrom_email) ?>" size="30" ></font>
       </td>
     </tr>
<tr>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">Comments</font>
       </td>
       <td bgcolor="#BCBC7A">
         <font style="font-size: 8pt; color: #000000; font-family: Arial, Tahoma, Verdana, Helvetica">
  <textarea name="comments" cols="40" rows="5"><?= tohtml($fldcomments) ?></textarea></font>
       </td>
     </tr>

    <tr align="right"><td colspan="2" align="right">
    

<? if (!($bPK && !($sAction=="insert" && $sForm=="TellAFriend"))) { ?>

<? if (!$bPK) { ?>
   <input type="submit" value="Send" onclick="document.TellAFriend.FormAction.value = 'insert';">
   <input type="hidden" value="insert" name="FormAction"/>
<? } ?>

<? } else { ?>
  <input type="hidden" value="" name="FormAction"/>
 
<? } ?>

 
   <input type="hidden" name="FormName" value="TellAFriend">
  

  </td></tr>
  </form>
  </table>
<?
  
}



?>
