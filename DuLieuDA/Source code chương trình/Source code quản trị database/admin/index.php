<?php require_once('../Connections/ketnoi.php'); ?>
<?php require_once('../Connections/ketnoi.php'); 
require_once('../inc_language.php'); ?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_ketnoi = new KT_connection($ketnoi, $database_ketnoi);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_ketnoi, "../");
//Grand Levels: Level
$restrict->addLevel("1");
$restrict->Execute();
//End Restrict Access To Page

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_ketnoi, "../");
//Grand Levels: Level
$restrict->addLevel("1");
//$restrict->Execute();
//End Restrict Access To Page

// Include Multiple Static Pages
$mxiObj = new MXI_Includes("mod");
$mxiObj->IncludeStatic("", "homepage.php", "Administrator", "", "");
$mxiObj->IncludeStatic("list_member", "list_member.php", "Member pages", "", "");
$mxiObj->IncludeStatic("form_member", "form_member.php", "Member pages", "", "");
$mxiObj->IncludeStatic("list_auction", "list_auction.php", "Auction pages", "", "");
$mxiObj->IncludeStatic("form_auction", "form_auction.php", "Auction pages", "", "");
$mxiObj->IncludeStatic("list_menu", "list_menu.php", "Menu pages", "", "");
$mxiObj->IncludeStatic("form_menu", "form_menu.php", "Menu pages", "", "");
$mxiObj->IncludeStatic("list_submenu", "list_submenu.php", "Submenu pages", "", "");
$mxiObj->IncludeStatic("form_submenu", "form_submenu.php", "Submenu pages", "", "");
$mxiObj->IncludeStatic("list_company", "list_company1.php", "Company pages", "", "");
$mxiObj->IncludeStatic("form_company", "form_company.php", "Company pages", "", "");
$mxiObj->IncludeStatic("list_country", "list_country.php", "Country pages", "", "");
$mxiObj->IncludeStatic("form_country", "form_country.php", "Country pages", "", "");
$mxiObj->IncludeStatic("list_industry", "list_industry.php", "Industry pages", "", "");
$mxiObj->IncludeStatic("form_industry", "form_industry.php", "Industry pages", "", "");
$mxiObj->IncludeStatic("list_procat", "list_procat.php", "Procat pages", "", "");
$mxiObj->IncludeStatic("form_procat", "form_procat.php", "Procat pages", "", "");
$mxiObj->IncludeStatic("list_prosubcat1", "list_prosubcat1.php", "Prosubcat1 pages", "", "");
$mxiObj->IncludeStatic("form_prosubcat1", "form_prosubcat1.php", "Prosubcat1 pages", "", "");
$mxiObj->IncludeStatic("list_prosubcat2", "list_prosubcat2.php", "Prosubcat2 pages", "", "");
$mxiObj->IncludeStatic("form_prosubcat2", "form_prosubcat2.php", "Prosubcat2 pages", "", "");
$mxiObj->IncludeStatic("list_prosubcat3", "list_prosubcat3.php", "Prosubcat3 pages", "", "");
$mxiObj->IncludeStatic("form_prosubcat3", "form_prosubcat3.php", "Prosubcat3 pages", "", "");
$mxiObj->IncludeStatic("list_prosubcat4", "list_prosubcat4.php", "Prosubcat4 pages", "", "");
$mxiObj->IncludeStatic("form_prosubcat4", "form_prosubcat4.php", "Prosubcat4 pages", "", "");
$mxiObj->IncludeStatic("list_products", "list_products.php", "Products pages", "", "");
$mxiObj->IncludeStatic("form_products", "form_products.php", "Products pages", "", "");
$mxiObj->IncludeStatic("list_payment_methods", "list_payment_methods.php", "Payment_methods pages", "", "");
$mxiObj->IncludeStatic("form_payment_methods", "form_payment_methods.php", "Payment_methods pages", "", "");
$mxiObj->IncludeStatic("list_advertise", "list_advertise.php", "Advertise pages", "", "");
$mxiObj->IncludeStatic("form_advertise", "form_advertise.php", "Advertise pages", "", "");
$mxiObj->IncludeStatic("list_footer", "list_footer.php", "Footer pages", "", "");
$mxiObj->IncludeStatic("form_footer", "form_footer.php", "Footer pages", "", "");
$mxiObj->IncludeStatic("list_services", "list_services.php", "Services pages", "", "");
$mxiObj->IncludeStatic("form_services", "form_services.php", "Services pages", "", "");
$mxiObj->IncludeStatic("list_help", "list_help.php", "Help pages", "", "");
$mxiObj->IncludeStatic("form_help", "form_help.php", "Help pages", "", "");
$mxiObj->IncludeStatic("list_question_answer", "list_question_answer.php", "Question - Answer pages", "", "");
$mxiObj->IncludeStatic("form_question_answer", "form_question_answer.php", "Question - Answer pages", "", "");
$mxiObj->IncludeStatic("list_supportonline", "list_supportonline.php", "Supportonline pages", "", "");
$mxiObj->IncludeStatic("form_supportonline", "form_supportonline.php", "Supportonline pages", "", "");
$mxiObj->IncludeStatic("list_video", "list_video.php", "Video pages", "", "");
$mxiObj->IncludeStatic("form_video", "form_video.php", "Video pages", "", "");
$mxiObj->IncludeStatic("list_intro", "list_intro.php", "Introduction pages", "", "");
$mxiObj->IncludeStatic("form_intro", "form_intro.php", "Introduction pages", "", "");
$mxiObj->IncludeStatic("list_customer_contact", "list_customer_contact.php", "Customer_contact pages", "", "");
$mxiObj->IncludeStatic("form_customer_contact", "form_customer_contact.php", "Customer_contact pages", "", "");
$mxiObj->IncludeStatic("list_contact_department", "list_contact_department.php", "Contact_department pages", "", "");
$mxiObj->IncludeStatic("form_contact_department", "form_contact_department.php", "Contact_department pages", "", "");
$mxiObj->IncludeStatic("list_member_hits", "list_member_hits.php", " pages", "", "");
$mxiObj->IncludeStatic("list_hitcount", "list_hitcount.php", " pages", "", "");
$mxiObj->IncludeStatic("form_business_history", "form_business_history.php", "Business history pages", "", "");
$mxiObj->IncludeStatic("list_business_history", "list_business_history.php", "Business history pages", "", "");
$mxiObj->IncludeStatic("form_contact_department", "form_contact_department.php", "Contact department pages", "", "");
$mxiObj->IncludeStatic("list_contact_department", "list_contact_department.php", "Contact department pages", "", "");
$mxiObj->IncludeStatic("form_business_form", "form_business_form.php", "Business form pages", "", "");
$mxiObj->IncludeStatic("list_business_form", "list_business_form.php", "Business form pages", "", "");
$mxiObj->IncludeStatic("form_capital_revenue", "form_capital_revenue.php", "Capital revenue pages", "", "");
$mxiObj->IncludeStatic("list_capital_revenue", "list_capital_revenue.php", "Capital revenue pages", "", "");
$mxiObj->IncludeStatic("form_import_export", "form_import_export.php", "Import - Export pages", "", "");
$mxiObj->IncludeStatic("list_import_export", "list_import_export.php", "Import - Export pages", "", "");
$mxiObj->IncludeStatic("form_main_markets", "form_main_markets.php", "Main markets pages", "", "");
$mxiObj->IncludeStatic("list_main_markets", "list_main_markets.php", "Main markets pages", "", "");
$mxiObj->IncludeStatic("form_images_library", "form_images_library.php", "Images library pages", "", "");
$mxiObj->IncludeStatic("list_images_library", "list_images_library.php", "Images library pages", "", "");
$mxiObj->IncludeStatic("form_rates", "form_rates.php", "Rates pages", "", "");
$mxiObj->IncludeStatic("list_rates", "list_rates.php", "Rates pages", "", "");
$mxiObj->IncludeStatic("form_services_categories", "form_services_categories.php", "Services categories pages", "", "");
$mxiObj->IncludeStatic("list_services_categories", "list_services_categories.php", "Services categories pages", "", "");
$mxiObj->IncludeStatic("form_position", "form_position.php", "Position pages", "", "");
$mxiObj->IncludeStatic("list_position", "list_position.php", "Position pages", "", "");
$mxiObj->IncludeStatic("form_contact_information", "form_contact_information.php", " pages", "", "");
$mxiObj->IncludeStatic("list_contact_information", "list_contact_information.php", "Contact information pages", "", "");
$mxiObj->IncludeStatic("form_inbox", "form_inbox.php", "Inbox pages", "", "");
$mxiObj->IncludeStatic("list_inbox", "list_inbox.php", "Inbox pages", "", "");
$mxiObj->IncludeStatic("form_question", "form_question.php", "Question pages", "", "");
$mxiObj->IncludeStatic("list_question", "list_question.php", "Question pages", "", "");
$mxiObj->IncludeStatic("form_answer", "form_answer.php", "Answer pages", "", "");
$mxiObj->IncludeStatic("list_answer", "list_answer.php", "Answer pages", "", "");
$mxiObj->IncludeStatic("form_member_profile", "form_member_profile.php", "Member profile pages", "", "");
$mxiObj->IncludeStatic("list_member_profile", "list_member_profile.php", "Member profile pages", "", "");
$mxiObj->IncludeStatic("form_", "form_.php", " pages", "", "");
$mxiObj->IncludeStatic("list_", "list_.php", " pages", "", "");
// End Include Multiple Static Pages
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $mxiObj->getTitle(); ?></title>
<link href="../library/css/admin_style.css" rel="stylesheet" type="text/css" />
<meta name="keywords" content="<?php echo $mxiObj->getKeywords(); ?>" />
<meta name="description" content="<?php echo $mxiObj->getDescription(); ?>" />
<base href="<?php echo mxi_getBaseURL(); ?>" />
</head>

<body>
<div id="admin">
<div id="admin_banner">
<div>Welcome to Administrator</div>
<div>
  <?php
  mxi_includes_start("../logout.php");
  require(basename("../logout.php"));
  mxi_includes_end();
?></div>
</div>
<div id="admin_menu"><?php include("admin_menu.php"); ?></div>
<div id="admin_content">
  <?php
  $incFileName = $mxiObj->getCurrentInclude();
  if ($incFileName !== null)  {
    mxi_includes_start($incFileName);
    require(basename($incFileName)); // require the page content
    mxi_includes_end();
}
?></div>
<div id="admin_footer"><?php include("admin_footer.php");?></div>
</div>
</body>
</html>
