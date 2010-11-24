<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "") {
?>
<a href="index.php?lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['id_project'] != "" && @$_GET['mod'] == "" && @$_GET['pageNum_rs_projectgallery']==0) {
?>
<a href="project.php?id_project=<?php echo $_GET['id_project']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="project.php?id_project=<?php echo $_GET['id_project']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region1
?>


 <?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "gioithieu" || @$_GET['mod'] == "gioithieu" ||  @$_GET['mod'] == "register" || @$_GET['mod'] == "forgotpassword" || @$_GET['mod'] == "tinraovat_detail" || @$_GET['mod'] == "sua_tinrao"||@$_GET['mod'] == "sua_tinraoOK"||@$_GET['mod'] == "profile_edit"||@$_GET['mod'] == "profile"||  @$_GET['mod'] == "tuyendung_detail" || @$_GET['mod'] == "customer" || @$_GET['mod'] == "registersusscess" || @$_GET['mod'] == "order" || @$_GET['mod'] == "wishlist" || @$_GET['mod'] == "viewwishlist"|| @$_GET['mod'] == "add_folder" ||@$_GET['mod']=="list_folder"||@$_GET['mod']=="add_note"||@$_GET['mod']=="list_note"||@$_GET['mod']=="default_note"|| @$_GET['mod'] == "faq" || @$_GET['mod'] == "forgotpassok" || @$_GET['mod'] == "services" || @$_GET['mod'] == "intro" || @$_GET['mod'] == "productcat" || @$_GET['mod'] == "contact" || @$_GET['mod'] == "registersuccess" ||  @$_GET['mod'] == "contactsuccess" || @$_GET['mod'] == "event") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>

<?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "customers" && @$_GET['pageNum_rs_khachhang']==0) {
?>

<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>

<?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "customers" && @$_GET['pageNum_rs_khachhang']>0) {
?>

<a href="index.php?mod=<?php echo $_GET['mod']; ?>&pageNum_rs_khachhang=<?php echo $_GET['pageNum_rs_khachhang']; ?>&totalRows_rs_khachhang=<?php echo $_GET['totalRows_rs_khachhang']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&pageNum_rs_khachhang=<?php echo $_GET['pageNum_rs_khachhang']; ?>&totalRows_rs_khachhang=<?php echo $_GET['totalRows_rs_khachhang']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>

<?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "raovat" && @$_GET['pageNum_rs_tinraovatthuong']==0) {
?>

<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>

<?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "raovat" && @$_GET['pageNum_rs_tinraovatthuong']>0) {
?>

<a href="index.php?mod=<?php echo $_GET['mod']; ?>&pageNum_rs_tinraovatthuong=<?php echo $_GET['pageNum_rs_tinraovatthuong']; ?>&totalRows_rs_tinraovatthuong=<?php echo $_GET['totalRows_rs_tinraovatthuong']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&pageNum_rs_tinraovatthuong=<?php echo $_GET['pageNum_rs_tinraovatthuong']; ?>&totalRows_rs_tinraovatthuong=<?php echo $_GET['totalRows_rs_tinraovatthuong']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>



<?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "tinraovat_theloai") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloaitinrao=<?php echo $_GET['ID_theloaitinrao']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloaitinrao=<?php echo $_GET['ID_theloaitinrao']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>





<?php 
// Show IF Conditional region2 
	if (@$_GET['mod'] == "tuyendung" && @$_GET['pageNum_rs_tinraovatthuong']==0) {
?>

<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>

<?php 
// Show IF Conditional region2 
if (@$_GET['mod'] == "raovat" && @$_GET['pageNum_rs_tinraovatthuong']>0) {
?>

<a href="index.php?mod=<?php echo $_GET['mod']; ?>&pageNum_rs_tinraovatthuong=<?php echo $_GET['pageNum_rs_tinraovatthuong']; ?>&totalRows_rs_tinraovatthuong=<?php echo $_GET['totalRows_rs_tinraovatthuong']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&pageNum_rs_tinraovatthuong=<?php echo $_GET['pageNum_rs_tinraovatthuong']; ?>&totalRows_rs_tinraovatthuong=<?php echo $_GET['totalRows_rs_tinraovatthuong']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" /></a>
 <?php } 
// endif Conditional region2
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "newscategory") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" />
</a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "newssubcategory") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&ID_theloaitin=<?php echo $_GET['ID_theloaitin']?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" />
</a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&ID_theloaitin=<?php echo $_GET['ID_theloaitin']?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "newssubsubcategory") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&ID_theloaitin=<?php echo $_GET['ID_theloaitin']?>&ID_theloaitincon=<?php echo $_GET['ID_theloaitincon']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" />
</a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&ID_theloaitin=<?php echo $_GET['ID_theloaitin']?>&ID_theloaitincon=<?php echo $_GET['ID_theloaitincon']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a><?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "newsdetail") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&ID_theloaitin=<?php echo $_GET['ID_theloaitin'];?>&ID_theloaitincon=<?php echo $_GET['ID_theloaitincon'];?>&ID_tintuc=<?php echo $_GET['ID_tintuc']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" />
</a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ID_theloai=<?php echo $_GET['ID_theloai']; ?>&ID_theloaitin=<?php echo $_GET['ID_theloaitin'];?>&ID_theloaitincon=<?php echo $_GET['ID_theloaitincon'];?>&ID_tintuc=<?php echo $_GET['ID_tintuc']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
<?php } 
// endif Conditional region1
?>


<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "printdetail") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&id=<?php echo $_GET['id']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" />
</a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&id=<?php echo $_GET['id']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "categories") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&catid=<?php echo $_GET['catid']; ?>&id=<?php echo $_GET['id']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" />
</a>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&catid=<?php echo $_GET['catid']; ?>&id=<?php echo $_GET['id']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "details") {
?>
<table>
  <tr>
     <td>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ItemCatID=<?php echo $_GET['ItemCatID']; ?>&ItemsSubCatID=<?php echo $_GET['ItemsSubCatID']; ?>&ItemID=<?php echo $_GET['ItemID']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0"/></a>
     </td>
     <td>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ItemCatID=<?php echo $_GET['ItemCatID']; ?>&ItemsSubCatID=<?php echo $_GET['ItemsSubCatID']; ?>&ItemID=<?php echo $_GET['ItemID']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0"/></a>
</td>
</tr>
</table>
<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "category") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ItemCatID=<?php echo $_GET['ItemCatID']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>&nbsp;<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ItemCatID=<?php echo $_GET['ItemCatID']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>

 <?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "subcategory") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ItemCatID=<?php echo $_GET['ItemCatID']; ?>&ItemsSubCatID=<?php echo $_GET['ItemsSubCatID']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>&nbsp;<a href="index.php?mod=<?php echo $_GET['mod']; ?>&ItemCatID=<?php echo $_GET['ItemCatID']; ?>&ItemsSubCatID=<?php echo $_GET['ItemsSubCatID']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>

<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "orderfinish") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&OrderVisitorID=<?php echo $_GET['OrderVisitorID']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>&nbsp;<a href="index.php?mod=<?php echo $_GET['mod']; ?>&OrderVisitorID=<?php echo $_GET['OrderVisitorID']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
 <?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "deletewishlist") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&id_sv=<?php echo $_GET['id_sv']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>&nbsp;<a href="index.php?mod=<?php echo $_GET['mod']; ?>&id_sv=<?php echo $_GET['id_sv']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
<?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "search") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&key1=<?php echo $_GET['key1']; ?>&key2=<?php echo $_GET['key2']; ?>&key18=<?php echo $_GET['key18']; ?>&key3=<?php echo $_GET['key3']; ?>&key4=<?php echo $_GET['key4']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>&nbsp;<a href="index.php?mod=<?php echo $_GET['mod']; ?>&key1=<?php echo $_GET['key1']; ?>&key2=<?php echo $_GET['key2']; ?>&key18=<?php echo $_GET['key18']; ?>&key3=<?php echo $_GET['key3']; ?>&key4=<?php echo $_GET['key4']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
 <?php } 
// endif Conditional region1
?>

<?php 
// Show IF Conditional region1 
if (@$_GET['mod'] == "orderhistorydetail") {
?>
<a href="index.php?mod=<?php echo $_GET['mod']; ?>&OrderID=<?php echo $_GET['OrderID']; ?>&lang=vietnam"><img src="flags/vn.gif" width="25" height="18" border="0" /></a>&nbsp;<a href="index.php?mod=<?php echo $_GET['mod']; ?>&OrderID=<?php echo $_GET['OrderID']; ?>&lang=english"><img src="flags/en.gif" width="25" height="18" border="0" />
</a>
 <?php } 
// endif Conditional region1
?>