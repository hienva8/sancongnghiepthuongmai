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
?><base target="_self">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<script>
  var sLang=parent.oUtil.langDir;
  document.write("<scr"+"ipt src='language/"+sLang+"/folderdel.js'></scr"+"ipt>");
</script>
<script>writeTitle()</script>
<script>
function del()
  {
  var Form1 = document.forms.Form1;
  Form1.elements.inpCurrFolder.value=(opener?opener:openerWin).document.getElementById("selCurrFolder").value;
  Form1.submit();
  }
</script>
</head>
<body onLoad="loadTxt()" style="overflow:hidden;margin:0px;">

<table width=100% height=100% align=center style="" cellpadding=0 cellspacing=0>
<tr>
<td valign=top style="padding-top:5px;padding-left:15px;padding-right:15px;padding-bottom:12px;height:100%">

<form method=post action="folderdel_.php"  name="Form1" id="Form1">
  <br>
  <input type="hidden" ID="inpCurrFolder" NAME="inpCurrFolder">
  <div><b><span id=txtLang>Are you sure you want to delete this folder?</span></b></div>
</form>

</td>
</tr>
<tr>
<td class="dialogFooter" align=right valign=middle>
  <table cellpadding="1" cellspacing="0">
    <tr>
    <td>
      <input type="button" name="btnClose" id="btnClose" value="close" onClick="self.close();" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">&nbsp;<input type="button" name="btnDelete" id="btnDelete" value="delete" onClick="del()" class="inpBtn" onMouseOver="this.className='inpBtnOver';" onMouseOut="this.className='inpBtnOut'">
    </td>
    </tr>
  </table>
</td>
</tr>
</table>

</body>
</html>