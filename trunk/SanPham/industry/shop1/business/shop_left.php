<?php
// Require the MXI classes
require_once ('../../includes/mxi/MXI.php');
?><div class="right">
    <div class="logo">
    	<center><img src="../../interface/VIP_logo.gif" />
    	</center>
    </div>
    
     <div class="business">
     <h1><?php echo danhmuc;?></h1>
       <div id="info_help">      <?php
  mxi_includes_start("../shop_left_menu_doc.php");
  require(basename("../shop_left_menu_doc.php"));
  mxi_includes_end();
?></div>
<center><img src="../../interface/khung_2_1.jpg" />
</center>
</div>
        
      <?php
  mxi_includes_start("../shop_left_supportonline.php");
  require(basename("../shop_left_supportonline.php"));
  mxi_includes_end();
?><div class="business">
       	  <h1><?php echo luoctruycap;?></h1>
            <div id="info_help">            
            <p style="padding:7px 0px 5px 45px;"><?php echo luoctruycap;?>: 999</p>         
            </div>
          <center>
              <img src="../../interface/khung_2_1.jpg" height="15" align="left" width="220"/>
    </center>
   	</div>
      
  </div>