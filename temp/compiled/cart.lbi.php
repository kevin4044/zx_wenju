<?php echo $this->smarty_insert_scripts(array('files'=>'transport2.js')); ?>
<div class="cart" id="XAK_CARTINFO">
 <?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
</div>
<div class="blank5"></div>
