<?php
/*********************************************************************************
 *          Filename: common.php
 *          Generated with CodeCharge  v.1.1.18
 *          PHP build 02/26/2001
 *********************************************************************************/

error_reporting (E_ALL ^ E_NOTICE);

//-- handling database connection
include("./db_odbc.inc");

define("DATABASE_NAME","tellafriend");
define("DATABASE_USER","");
define("DATABASE_PASSWORD","");
define("DATABASE_HOST","");

//-- Database class
$db = new DB_Sql();
$db->Database = DATABASE_NAME;
$db->User     = DATABASE_USER;
$db->Password = DATABASE_PASSWORD;
$db->Host     = DATABASE_HOST;

$db2 = new DB_Sql();
$db2->Database = DATABASE_NAME;
$db2->User     = DATABASE_USER;
$db2->Password = DATABASE_PASSWORD;
$db2->Host     = DATABASE_HOST;



function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}

function tourl($strValue)
{
  return urlencode($strValue);
}

function get_param($ParamName)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;

  $ParamValue = "";
  if(isset($HTTP_POST_VARS[$ParamName]))
    $ParamValue = $HTTP_POST_VARS[$ParamName];
  else if(isset($HTTP_GET_VARS[$ParamName]))
    $ParamValue = $HTTP_GET_VARS[$ParamName];

  return $ParamValue;
}

function get_session($ParamName)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;
  global ${$ParamName};

  $ParamValue = "";
  if(!isset($HTTP_POST_VARS[$ParamName]) && !isset($HTTP_GET_VARS[$ParamName]) && session_is_registered($ParamName)) 
    $ParamValue = ${$ParamName};

  return $ParamValue;
}

function set_session($ParamName, $ParamValue)
{
  global ${$ParamName};
  if(session_is_registered($ParamName)) 
    session_unregister($ParamName);
  ${$ParamName} = $ParamValue;
  session_register($ParamName);
}

function is_number($string_value)
{
  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else 
    return false;
}

function is_param($param_value)
{
  if($param_value)
    return 1;
  else
    return 0;
}

function tosql($value, $type="Text")
{
  if($value == "")
  {
    return "NULL";
  }
  else
  {
    if($type == "Number")
      return doubleval($value);
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }
      return "'" . $value . "'";
     }
   }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}



function dlookup($Table, $fName, $sWhere)
{
  global $db2;
  $db2 = new DB_Sql();
  $db2->Database = DATABASE_NAME;
  $db2->User     = DATABASE_USER;
  $db2->Password = DATABASE_PASSWORD;
  $db2->Host     = DATABASE_HOST;

  $db2->query("SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere);
  if($db2->next_record())
    return $db2->f(0);
  else 
    return "";
}


function get_checkbox_value($sVal, $CheckedValue, $UnCheckedValue)
{
  if(!strlen($sVal))
    return tosql($UnCheckedValue);
  else
    return tosql($CheckedValue);
}

//- function returns options for HMTL control "<select>" as one string
function get_options($sql,$is_search,$is_required,$selected_value)
{
  global $db2;  //-- connection special for list box

  $options_str="";
  if ($is_search)
    $options_str.="<option value=\"\">All</option>";
  else
  {
    if (!$is_required)
    {
      $options_str.="<option value=\"\"></option>";
    }
  }
  
  $db2->query($sql);
  while ($db2->next_record($sql))
  {
    $id=$db2->f(0);
    $value=$db2->f(1);
    $selected="";
    if ($id == $selected_value)
    {
      $selected = "SELECTED";
    }
    $options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
  }
  return $options_str;
}
//--------------------------
function get_lov_options($lov_str,$is_search,$is_required,$selected_value)
{
  $options_str="";
  if (!$is_required && !$is_search)
    $options_str.="<option value=\"\"></option>";

  $LOV = split(";", $lov_str);

  if(sizeof($LOV)%2 != 0) 
    $array_length = sizeof($LOV) - 1;
  else
    $array_length = sizeof($LOV);
  reset($LOV);

  for($i = 0; $i < $array_length; $i = $i + 2)
  {
    $id =  $LOV[$i];
    $value = $LOV[$i + 1];
    $selected="";
    if ($id == $selected_value)
      $selected = "SELECTED";

    $options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
  }
  return $options_str;
}
//--------------------------
//-- function take $lov_str as parameter, parse it and return the result as array
function get_lov_values($lov_str)
{
  $options_str="";
  $LOV = split(";", $lov_str);

  if(sizeof($LOV)%2 != 0) 
    $array_length = sizeof($LOV) - 1;
  else
    $array_length = sizeof($LOV);
  reset($LOV);

  $values = array();
  for($i = 0; $i < $array_length; $i = $i + 2)
  {
    $id =  $LOV[$i];
    $value = $LOV[$i + 1];
    $values[$id] = $value;
  }
  return $values;
}



function check_security()
{
 if(!session_is_registered("UserID"))
    header ("Location: .php?querystring=" . tourl(getenv("QUERY_STRING")) . "&amp;ret_page=" . tourl(getenv("REQUEST_URI")));
}


?>