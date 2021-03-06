<?php require_once('Connections/ketnoi.php'); ?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');
?>
<?php
// Load the tNG classes
require_once('includes/tng/tNG.inc.php');
?>
<?php
// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");
?>
<?php
// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);
?>
<?php
//start Trigger_ActivationCheck trigger
//remove this line if you want to edit the code by hand
function Trigger_ActivationCheck(&$tNG) {
  return Trigger_Activation_Check($tNG);
}
//end Trigger_ActivationCheck trigger
?>
<?php
// Make an update transaction instance
$activate_transaction = new tNG_update($conn_ketnoi);
$tNGs->addTransaction($activate_transaction);
// Register triggers
$activate_transaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "GET", "kt_login_id");
$activate_transaction->registerTrigger("BEFORE", "Trigger_ActivationCheck", 1);
$activate_transaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
// Add columns
$activate_transaction->setTable("member");
$activate_transaction->addColumn("member_active", "NUMERIC_TYPE", "VALUE", "1");
$activate_transaction->setPrimaryKey("id_member", "NUMERIC_TYPE", "GET", "kt_login_id");
?>
<?php
// Execute all the registered transactions
$tNGs->executeTransactions();
?>
<?php
// Get the transaction recordset
$rsmember = $tNGs->getRecordset("member");
$row_rsmember = mysql_fetch_assoc($rsmember);
$totalRows_rsmember = mysql_num_rows($rsmember);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Activation Page</title>
<link href="includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script src="includes/skins/style.js" type="text/javascript"></script>

</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
</body>
</html>
