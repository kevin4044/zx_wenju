<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<form method="post" action="" name="listForm">
<!-- start ads list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th>编号</th>
    <th>广告名称</th>
    <th>投放范围</th>
    <th>广告类型</th>
    <th>是否限时</th>
    <th>开始时间</th>
    <th>结束时间</th>
    <th>调用代码</th>
    <th>操作</th>
  </tr>
  <?php $_from = $this->_var['ads_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
  <tr>
    <td align="center"><?php echo $this->_var['list']['aid']; ?></td>
    <td align="center"><span><?php echo htmlspecialchars($this->_var['list']['adname']); ?></span></td>
    <td align="center"><span><?php echo htmlspecialchars($this->_var['list']['typename']); ?></span></td>
    <td align="center"><span><?php if ($this->_var['list']['adtype'] == 0): ?>代码<?php elseif ($this->_var['list']['adtype'] == 1): ?>幻灯<?php elseif ($this->_var['list']['adtype'] == 2): ?>图片<?php elseif ($this->_var['list']['adtype'] == 3): ?>文字<?php elseif ($this->_var['list']['adtype'] == 4): ?>Flash<?php endif; ?></span></td>
    <td align="center"><span><?php if ($this->_var['list']['timeset'] == 0): ?>不限时间<?php else: ?>是<?php endif; ?></span></td>
    <td align="center"><span><?php echo $this->_var['list']['starttime']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['list']['endtime']; ?></span></td>
    <td align="left" width="50%"><span>$smarty->assign('myad_<?php echo $this->_var['list']['tagname']; ?>',  get_myad('myad_<?php echo $this->_var['list']['tagname']; ?>',$cat_id)); <font color="#FF0000">|</font> {$myad_<?php echo $this->_var['list']['tagname']; ?>}</span></td>
    <td align="center"><span>      
      <a href="my_ad.php?act=edit&id=<?php echo $this->_var['list']['aid']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16" /></a>
      <a href="javascript:if(confirm('删除广告可能会导致前台无法正常显示，您确定要删除吗?')) location='my_ad.php?act=remove&id=<?php echo $this->_var['list']['aid']; ?>&adname=<?php echo htmlspecialchars($this->_var['list']['adname']); ?>';" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16" /></a>
     </span>
    </td>
  </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="9"><?php echo $this->_var['lang']['no_ads']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td align="right" nowrap="true" colspan="9"><?php echo $this->fetch('page.htm'); ?></td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end ad_position list -->
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>