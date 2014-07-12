<?php
 /*********************************************************************************
 *          Filename: Send_Confirmation.php
 *          Generated with CodeCharge  v.1.1.18
 *          PHP build 02/26/2001
 *********************************************************************************/

include ("./common.php");

session_start();

$sFileName = "Send_Confirmation.php";





?><html>
<head>
<title>TellAFriend</title>
<meta name="GENERATOR" content="YesSoftware CodeCharge v.1.1.18 using 'PHP.ccp'">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0"> 
<meta http-equiv="cache-control" content="no-cache">
</head>
<body background="images/bg.gif" text="#000000" link="#336600" vlink="#336600" alink="#336600">
Your message was sent.
 <table>
  <tr>
   
   <td valign="top">
<? Confirmation_Show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<? 



//********************************************************************************


function Confirmation_Show()
{
global $styles;




?>
  <table border="0" cellspacing="1" cellpadding="1" bgcolor="#878743">
  
  <tr>
  
  </tr>
  </table>
<?

}

?>