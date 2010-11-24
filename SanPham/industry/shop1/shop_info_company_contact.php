<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');
?>
<?php
  mxi_includes_start("shop_info_company.php");
  require(basename("shop_info_company.php"));
  mxi_includes_end();
?>
<?php
  mxi_includes_start("shop_info_contact.php");
  require(basename("shop_info_contact.php"));
  mxi_includes_end();
?>