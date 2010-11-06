<div class="right-center">
 <?php
  if(!($_GET["mod"]=="detail")){?>   <?php
  mxi_includes_start("shop_contain_short_intro_company.php");
  require(basename("shop_contain_short_intro_company.php"));
  mxi_includes_end();
?>
<?php }?>

<?php
  $incFileName = $mxiObj->getCurrentInclude();
  if ($incFileName !== null)  {
    mxi_includes_start($incFileName);
    require(basename($incFileName)); // require the page content
    mxi_includes_end();
}
?>
</div>
