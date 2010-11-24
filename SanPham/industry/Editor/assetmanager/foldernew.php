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

$sMsg = "";

if(isset($_POST["inpNewFolderName"]))
  {
  $sFolder = $_POST["inpCurrFolder"]."/".$_POST["inpNewFolderName"];

  if(is_dir($sFolder)==1)
    {//folder already exist
    $sMsg = "<script>document.write(getTxt('Folder already exists.'))</script>";
    }
  else
    {
    //if(mkdir($sFolder))
    if(mkdir($sFolder,0755))
      $sMsg = "<script>document.write(getTxt('Folder created.'))</script>";
    else
      $sMsg = "<script>document.write(getTxt('Invalid input.'))</script>";
    }
  }
?>
<base target="_self">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<script>
  var sLang=parent.oUtil.langDir;;
  document.write("<scr"+"ipt src='language/"+sLang+"/foldernew.js'></scr"+"ipt>");
</script>
<script>writeTitle()</script>
<script>
function doPreSubmit()
  {
  var Form1 = document.forms.Form1;
    Form1.elements.inpCurrFolder.value=(opener?opener:openerWin).document.getElementById("selCurrFolder").value;

  if(Form1.elements.inpNewFolderName.value=="")
    {
    alert(fgetTxt("Invalid input."));
    return false;
    }
  return true;
  }
function doSubmit()
  {
  if(doPreSubmit())document.forms.Form1.submit()
  }
</script>
</head>
<body onLoad="loadTxt()" style="overflow:hidden;margin:0;">

<table width=100% height=100% align=center style="" cellpadding=0 cellspacing=0>
<tr>
<td valign=top style="padding-top:5px;padding-left:15px;padding-right:15px;padding-bottom:12px;height:100%">

<form method=post action="foldernew.php" onSubmit="doPreSubmit()" name="Form1" id="Form1">
  <br>
  <input type="hidden" id="inpCurrFolder" name="inpCurrFolder">
  <span id="txtLang">New Folder Name</span>: <br>
  <input type="text" id="inpNewFolderName" name="inpNewFolderName" class="inpTxt" size=38>
  <div><b><?php echo $sMsg ?>&nbsp;</b></div>
</form>

</td>
</tr>
<tr>
<td class="dialogFooter" align="right">
  <table cellpadding="1" cellspacing="0">
    <tr>
    <td>
      <input style="width:135" type="button" name="btnCloseAndRefresh" id="btnCloseAndRefresh" value="close & refresh" onClick="(opener?opener:openerWin).changeFolder();self.close();" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">&nbsp;<input name="btnCreate" id="btnCreate" type="button" onClick="doSubmit()" value="create" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">
    </td>
    </tr>
  </table>
</td>
</tr>
</table>

</body>
</html>