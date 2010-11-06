<?php require_once('../Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

// Make an insert transaction instance
$ins_inbox = new tNG_insert($conn_ketnoi);
$tNGs->addTransaction($ins_inbox);
// Register triggers
$ins_inbox->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Custom1");
$ins_inbox->registerTrigger("END", "Trigger_Default_Redirect", 99, "index.php?mod=sendmailok");
// Add columns
$ins_inbox->setTable("inbox");
$ins_inbox->addColumn("inbox_sender", "NUMERIC_TYPE", "POST", "kt_login_id", "{POST.kt_login_id}");
$ins_inbox->addColumn("inbox_email", "STRING_TYPE", "POST", "yourfriendmail", "{POST.yourfriendmail}");
$ins_inbox->addColumn("inbox_subject", "STRING_TYPE", "POST", "title", "{POST.title}");
$ins_inbox->addColumn("inbox_content", "STRING_TYPE", "POST", "message", "{POST.message}");
$ins_inbox->addColumn("inbox_day_update", "DATE_TYPE", "POST", "", "{NOW_DT}");
$ins_inbox->addColumn("inbox_sent", "NUMERIC_TYPE", "VALUE", "1");
$ins_inbox->setPrimaryKey("id_inbox", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsinbox = $tNGs->getRecordset("inbox");
$row_rsinbox = mysql_fetch_assoc($rsinbox);
$totalRows_rsinbox = mysql_num_rows($rsinbox);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
</head>

<body>

<?php
	echo guitinnhanthanhcong;
	echo $_SESSION['kt_login_id'];
?>
<?php
	echo $tNGs->getErrorMsg();
?>
</body>
</html>
