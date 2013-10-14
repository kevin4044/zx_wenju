<?php echo $this->fetch('pageheader.htm'); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<div class="main-div">
<form action="my_ad.php" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
  <table width="100%" id="general-table">
  	<tr>
      <td  class="label">
       广告标识</td>
      <td>
          <?php if ($this->_var['ads']['tagname']): ?>
          <?php echo $this->_var['ads']['tagname']; ?>
          <input type="hidden" name="tagname" value="<?php echo $this->_var['ads']['tagname']; ?>" /> 
          <?php else: ?>
          <input type="text" class="inputText" name="tagname" value="" size="35" /> 
          <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td  class="label">
       广告名称</td>
      <td>
        <input type="text" class="inputText" name="adname" value="<?php echo $this->_var['ads']['adname']; ?>" size="35" />        
      </td>
    </tr>
    <tr>
      <td  class="label">
       投放范围</td>
      <td>
      	<select name="typeid">
        <option value='0'>投放在没有同名标识的所有分类</option>
      	<?php echo $this->_var['cat_list']; ?>
        </select>  
        <font color="#FF0000">(仅对商品分类有效)</font>           
      </td>
    </tr>
    
      <tr>
        <td class="label">广告类型</td>
        <td>
         <select name="adtype" onchange="showMedia(this.value)">
         <option value='0'<?php if ($this->_var['ads']['adtype'] == 0): ?> selected='selected'<?php endif; ?>>代码</option>
         <option value='1'<?php if ($this->_var['ads']['adtype'] == 1): ?> selected='selected'<?php endif; ?>>幻灯</option>
         <option value='2'<?php if ($this->_var['ads']['adtype'] == 2): ?> selected='selected'<?php endif; ?>>图片</option>
         <option value='3'<?php if ($this->_var['ads']['adtype'] == 3): ?> selected='selected'<?php endif; ?>>文字</option>
         <option value='4'<?php if ($this->_var['ads']['adtype'] == 4): ?> selected='selected'<?php endif; ?>>Flash</option>
         </select>
        </td>
      </tr>
	
    <tr>
      <td  class="label">时间限制</td>
      <td>
        <select name="timeset">
        <option value='0'<?php if ($this->_var['ads']['timeset'] == 0): ?> selected='selected'<?php endif; ?>>不限时间</option>
        <option value='1'<?php if ($this->_var['ads']['timeset'] == 1): ?> selected='selected'<?php endif; ?>>在设定的时间内有效</option>
        </select>
      </td>
    </tr>
    <tr>
      <td  class="label">开始时间</td>
      <td>
        <input name="starttime" type="text" class="inputText" id="start_time" size="22" value='<?php echo $this->_var['ads']['starttime']; ?>' readonly="readonly" /> 
        <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time', '%Y-%m-%d', false, false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="buttonBlue"/>
      </td>
    </tr>
    <tr>
      <td class="label">结束时间</td>
      <td>
        <input name="endtime" type="text" class="inputText" id="end_time" size="22" value='<?php echo $this->_var['ads']['endtime']; ?>' readonly="readonly" /> 
        <input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('end_time', '%Y-%m-%d', false, false, 'selbtn2');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="buttonBlue"/>
      </td>
    </tr>
 
    <tbody id="0" style="<?php if ($this->_var['ads']['adtype'] != 0): ?>display:none;<?php endif; ?>">
    <tr>
        <td  class="label">代码内容:<br/><font color="#FF0000">(支持Html)</font></td>
        <td><textarea class="inputText" name="htmlcode" cols="50" rows="7"><?php echo $this->_var['ads']['htmlcode']; ?></textarea></td>
    </tr>
   
    </tbody>
  
    <tbody id="1" style="<?php if ($this->_var['ads']['adtype'] != 1): ?>display:none;<?php endif; ?>">
    <tr>
      <td  class="label">幻灯片高度</td>
      <td>
        <input type="text" class="inputText" name="slide[width]" value="<?php echo $this->_var['ads']['slide']['width']; ?>" size="35" />
      </td>
    </tr>
    <tr>
      <td  class="label">幻灯片宽度</td>
      <td>
        <input type="text" class="inputText" name="slide[height]" value="<?php echo $this->_var['ads']['slide']['height']; ?>" size="35" />
      </td>
    </tr>
    
    <?php $_from = $this->_var['slide_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'side');if (count($_from)):
    foreach ($_from AS $this->_var['side']):
?>
    <tr>
      <td  class="label">链接<?php echo $this->_var['side']['num']; ?></td>
      <td>
        <input type="text" class="inputText" name="slide[link][<?php echo $this->_var['side']['num']; ?>]" size="35" value="<?php echo $this->_var['side']['link']; ?>"/>       
      </td>
    </tr>
    <tr>
      <td  class="label">标题<?php echo $this->_var['side']['num']; ?></td>
      <td>
        <input type="text" class="inputText" name="slide[text][<?php echo $this->_var['side']['num']; ?>]" size="35" value="<?php echo $this->_var['side']['text']; ?>" />   
      </td>
    </tr>
    <tr>
      <td class="label">图片地址<?php echo $this->_var['side']['num']; ?></td>
      <td>
        <input type="text" class="inputText" name="slide[pic][<?php echo $this->_var['side']['num']; ?>]" size="35" value="<?php echo $this->_var['side']['pic']; ?>" />
      </td>
     
    </tr>
    <tr>
      <td  class="label">上传新图片<?php echo $this->_var['side']['num']; ?></td>
      <td>
        <input type="file" class="inputText" name="slide_f_<?php echo $this->_var['side']['num']; ?>" size="35"/>       
      </td>
    </tr>
    <?php if ($this->_var['action'] == edit): ?>
    <tr>
      <td  class="label">删除旧文件</td>
      <td>
        <input type="checkbox" name="del_s_<?php echo $this->_var['side']['num']; ?>" value="1" /> 
      </td>
    </tr>
    <?php endif; ?>

  	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    </tbody>
  
    <tbody id="2" style="<?php if ($this->_var['ads']['adtype'] != 2): ?>display:none;<?php endif; ?>">
    <tr>
      <td  class="label">图片地址</td>
      <td>
        <input type='text' class="inputText" name='image[url]' size='35' value="<?php echo $this->_var['ads']['image']['url']; ?>" />       
      </td>
    </tr>
    <tr>
      <td  class="label">上传新图片</td>
      <td>
        <input type="file" class="inputText" name="image_f" size="35"/>       
      </td>
    </tr>
    <?php if ($this->_var['action'] == edit): ?>
    <tr>
      <td  class="label">删除旧文件</td>
      <td>
        <input type="checkbox" name="del_i" value="1" /> 
      </td>
    </tr>
    <?php endif; ?>
    <tr>
      <td  class="label">图片链接</td>
      <td>
        <input type="text" class="inputText" name="image[link]" value="<?php echo $this->_var['ads']['image']['link']; ?>" size="35" />
      </td>
    </tr>
    <tr>
      <td  class="label">图片宽度</td>
      <td><input type="text" class="inputText" name="image[width]" value="<?php echo $this->_var['ads']['image']['width']; ?>" size="35" /></td>
    </tr>
    <tr>
      <td  class="label">图片高度</td>
      <td><input type="text" class="inputText" name="image[height]" value="<?php echo $this->_var['ads']['image']['height']; ?>" size="35" /></td>
    </tr>
    <tr>
      <td  class="label">图片描述</td>
      <td><input type="text" class="inputText" name="image[text]" value="<?php echo $this->_var['ads']['image']['text']; ?>" size="35" /></td>
    </tr>
    </tbody>
  
    <tbody id="3" style="<?php if ($this->_var['ads']['adtype'] != 3): ?>display:none;<?php endif; ?>">
       <tr>
      <td  class="label">文字内容</td>
      <td>
        <input type="text" class="inputText" name="text[title]" value="<?php echo $this->_var['ads']['text']['title']; ?>" size="35" />
      </td>
    </tr>    
    <tr>
      <td  class="label">文字链接</td>
      <td><input type="text" class="inputText" name="text[link]" value="<?php echo $this->_var['ads']['text']['link']; ?>" size="35" /></td>
    </tr>
    <tr>
      <td  class="label">文字颜色<br/><font color="#FF0000">(如 red, #000000)</font></td>
      <td><input type="text" class="inputText" name="text[color]" value="<?php echo $this->_var['ads']['text']['color']; ?>" size="35" /></td>
    </tr>
    <tr>
      <td  class="label">文字大小<br/><font color="#FF0000">(填写像素,如 12)</font></td>
      <td><input type="text" class="inputText" name="text[size]" value="<?php echo $this->_var['ads']['text']['size']; ?>" size="35" /></td>
    </tr>
    </tbody>
  
    <tbody id="4" style="<?php if ($this->_var['ads']['adtype'] != 4): ?>display:none;<?php endif; ?>">
     <tr>
      <td  class="label">Flash地址</td>
      <td>
        <input type="text" class="inputText" name="flash[link]" value="<?php echo $this->_var['ads']['flash']['link']; ?>" size="35" />
      </td>
    </tr>
    <tr>
      <td  class="label">上传flash</td>
      <td>
        <input type="file" class="inputText" name="flash_f" size="35"/>       
      </td>
    </tr>
    <?php if ($this->_var['action'] == edit): ?>
    <tr>
      <td  class="label">删除旧文件</td>
      <td>
        <input type="checkbox" name="del_f" value="1" /> 
      </td>
    </tr>
    <?php endif; ?>
    <tr>
      <td  class="label">Flash宽度</td>
      <td>
        <input type="text" class="inputText" name="flash[width]" value="<?php echo $this->_var['ads']['flash']['width']; ?>" size="35" />
      </td>
    </tr>
    <tr>
      <td  class="label">Flash高度</td>
      <td>
        <input type="text" class="inputText" name="flash[height]" value="<?php echo $this->_var['ads']['flash']['height']; ?>" size="35" />
      </td>
    </tr>
   
    </tbody>
  
  
	<tbody>
    <tr>
        <td  class="label">过期显示内容:<br/><font color="#FF0000">(支持Html)</font></td>
        <td><textarea class="inputText" name="expbody" cols="50" rows="7"><?php echo $this->_var['ads']['expbody']; ?></textarea></td>
    </tr>
    </tbody>
    
    <tr>
       <td class="label">&nbsp;</td>
       <td>
        <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="buttonBlue" />
        <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="buttonBlue" />
        <input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
        <input type="hidden" name="id" value="<?php echo $this->_var['ads']['aid']; ?>" />
      </td>
    </tr>
 </table>

</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>
<script language="JavaScript">
 
  <!--
  var MediaList = new Array('0', '1', '2', '3','4');
  
  function showMedia(AdMediaType)
  {
    for (I = 0; I < MediaList.length; I ++)
    {
      if (MediaList[I] == AdMediaType)
        document.getElementById(AdMediaType).style.display = "";
      else
        document.getElementById(MediaList[I]).style.display = "none";
    }
  }

  /**
   * 检查表单输入的数据
   */
  function validate()
  {
    validator = new Validator("theForm");
    validator.required("ad_name",     ad_name_empty);
    return validator.passed();
  }

  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
    document.forms['theForm'].reset();
  }

  //-->
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>