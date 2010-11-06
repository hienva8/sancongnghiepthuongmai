<div class="bor_1">
        	<img src="../../Interface/home-1.jpg" width="16" height="16" />&nbsp;<span class="st_1"><a href="../../index.php">Home</a>&nbsp;<b> ></b>&nbsp;<a href="#"> <?php echo chaomua;?></a></span></div>
<div class="cates">
<?php if($totalRows_rs_procat>0){?>
        	<fieldset>            

            	<legend>Ngành nghề</legend>            	 
                <table border="0">
                	<tr>
     <?php $i=0;?>      
    <?php do { 
			$i++;
	      ?>
						<td><img src="../../Interface/icon_2.jpg" width="5" height="9" /><a></a><span class="number">
    <?php if($totalRows_rs_procat>0){?>
    <?php $nested_query_rs_products = str_replace("123456789",$row_rs_procat['id_procat'],$query_rs_products);
			$nested_rs_products = mysql_query($nested_query_rs_products,$ketnoi) or die(mysql_error());
			$nested_row_rs_products = mysql_fetch_assoc($nested_rs_products);
			$nested_totalRows_rs_products = mysql_num_rows($nested_rs_products);
			$nested_sw = false;
	?>
    		<?php if(isset($nested_row_rs_products) && is_array($nested_row_rs_products)) {?>
                        (<?php echo $nested_totalRows_rs_products;?>)
        	<?php }else {echo"(0)";}?>
    <?php } ?>            
                       </span></td>   
      <?php if($i%4==0) echo "</tr><tr class='tr'>";  ?>    
      <?php } while ($row_rs_procat = mysql_fetch_assoc($rs_procat)); ?>  
                   </tr>          
                </table>
            </fieldset> 
<?php }else{echo $chuacothongtin;}?>   
</div>