<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/Calendar.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/SmartDate.js"></script>
<script type="text/javascript" src="../includes/wdg/calendar/calendar_stripped.js"></script>
<script type="text/javascript" src="../includes/wdg/calendar/calendar-setup_stripped.js"></script>
<script src="../includes/resources/calendar.js"></script>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<!--<center><form action="sday.php?sday=" method="POST" enctype="multipart/form-data" name="formday" id="formday">
Ngày
    <select name = "d" id="d">
<script >
for(i=1;i<=31;i++)
{
document.write("<option value ="+i+">"+i+"</option>");
}
</script>
</select>
Tháng<select name = "m" id="m">
<script >
for(i=1;i<=12;i++)
{
document.write("<option value ="+i+">"+i+"</option>");
}
</script>
</select>
Năm<select name ="y" id="y">
<script >
for(i=2000;i<=2050;i++)
{
document.write("<option value ="+i+">"+i+"</option>");
}
</script>
</select>
<input type="submit" name="button" id="button" value="click" />
</form>
</center>-->
<?php $KT_screen_date_format="12/11/1988" ;
?>
<form id="fday2" name="fday2" method="GET" action="sday.php&date=<?php echo $KT_screen_date_format;?>">
  <input name="sday" id="sday" value="" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:mondayfirst="true" wdg:type="widget" wdg:singleclick="true" wdg:restricttomask="no" wdg:readonly="true" />
  <input type="submit" name="ok" id="ok" value="OK" />
</form>
</body>
</html>
