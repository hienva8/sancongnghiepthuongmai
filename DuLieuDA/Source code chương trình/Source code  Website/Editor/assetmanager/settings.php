<?php require_once('../../Connections/ketnoi.php'); ?><?php
// Load the tNG classes
require_once('../../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_ketnoi, "../../");
//Grand Levels: Level
$restrict->addLevel("1");
$restrict->Execute();
//End Restrict Access To Page

$bReturnAbsolute=false;

$sBaseVirtual0="/Editor/assets";  //Assuming that the path is http://yourserver/Editor/assets/ ("Relative to Root" Path is required)

$sBase0="c:/inetpub/wwwroot/Editor/assets"; //The real path
//$sBase0="/home/yourserver/web/Editor/assets"; //example for Unix server

$sName0="Assets";

$sBaseVirtual1="";
$sBase1="";
$sName1="";

$sBaseVirtual2="";
$sBase2="";
$sName2="";

$sBaseVirtual3="";
$sBase3="";
$sName3="";
?>