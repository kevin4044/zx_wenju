<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start add new category form -->
<div class="list-div">
    <form action="category.php" method="post" name="theForm">
    <table cellpadding="3" cellspacing="1">
      <tr>
        <td><strong>上级分类:</strong></td>
        <td colspan="4">
            <select name="parent_id">
                <option value="0"><?php echo $this->_var['lang']['cat_top']; ?></option>
                <?php echo $this->_var['cat_select']; ?>
            </select>
         </td>
      </tr>		
      <tr>
        <th width="10%">排序</th>
        <th width="15%">分类名称</th>
        <th width="10%">数量单位</th>
        <th width="15%">是否显示</th>
        <th width="50%">&nbsp;</th>
      </tr>
      <?php $_from = $this->_var['catgory_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'category');if (count($_from)):
    foreach ($_from AS $this->_var['category']):
?>
      <tr>
        <td><input type="text" class="inputText" name="catgory_id<?php echo $this->_var['category']['id']; ?>" value="<?php echo $this->_var['category']['id']; ?>" size="5" /></td>
        <td><input type="text" class="inputText" name="catgory_name<?php echo $this->_var['category']['id']; ?>" value="" size="20" /></td>
        <td><input type="text" class="inputText" name="catgory_units<?php echo $this->_var['category']['id']; ?>" value="<?php echo $this->_var['category']['units']; ?>" size="5" /></td>
        <td><input type="radio" name="catgory_show<?php echo $this->_var['category']['id']; ?>" value="1" checked="checked" />是 <input type="radio" name="catgory_show<?php echo $this->_var['category']['id']; ?>" value="0" />否</td>
        <td>&nbsp;</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
    <div class="button-div">
        <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="buttonBlue" />
        <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="buttonBlue" />
    </div>
        <input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
    </form>
</div>


<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--
onload = function()
{
  // 开始检查订单
  startCheckOrder();
}
-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>