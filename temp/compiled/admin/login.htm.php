<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_var['lang']['cp_home']; ?><?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?><?php endif; ?></title>
<link href="styles/login.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>
<script language="JavaScript">
<!--
// 这里把JS用到的所有语言都赋值到这里
<?php $_from = $this->_var['lang']['js_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

if (window.parent != window)
{
  window.top.location.href = location.href;
}

//-->
</script>
</head>
<body>
<div class="login_bg">
	<div class="login_main">
    	<div class="header">
            <div class="logo">
                <a href="http://www.xak.cn" target="_blank" title="深圳市卓睿创想科技有限公司"><img src="images/login_logo.jpg" alt="深圳市卓睿创想科技有限公司" /></a>
            </div>
            <div class="top_link">
                <a href="/">网站首页</a>
                                 | <a href="http://help.xak.cn" target="_blank">帮助中心</a>
                 
            </div>
        </div>
        <form method="post" action="privilege.php" name='theForm' onsubmit="return validate()">
        <input type="hidden" name="act" value="signin" />
        <div class="main_box">
        	<ul>
            	<li class="login_user"><input type="text" class="inputText" name="username" value="" /></li>
                <li class="login_pass"><input type="password" name="password" value="" /></li>
                <?php if ($this->_var['gd_version'] > 0): ?>
                <li class="login_code">
                    <input type="text" class="inputText" name="captcha" value="" /> 
                    <img src="index.php?act=captcha&<?php echo $this->_var['random']; ?>" alt="CAPTCHA" border="1" onclick= this.src="index.php?act=captcha&"+Math.random() style="cursor: pointer;" title="<?php echo $this->_var['lang']['click_for_another']; ?>" />
                </li>
                <?php endif; ?>
                <li class="login_submit"><input type="submit" value="" /></li>
            </ul>
        </div>
        </form>
        <div class="footer">
        	Copyright &copy; 2009-2012 <a href="http://www.xak.cn" target="_blank">深圳市卓睿创想科技有限公司</a> 版权所有
        </div>
    </div>
</div>
<script language="JavaScript">
<!--
  document.forms['theForm'].elements['username'].focus();
  
  /** 检查表单输入的内容
   */
  function validate()
  {
    var validator = new Validator('theForm');
    validator.required('username', user_name_empty);
    //validator.required('password', password_empty);
    if (document.forms['theForm'].elements['captcha'])
    {
      validator.required('captcha', captcha_empty);
    }
    return validator.passed();
  }
  
//-->
</script>
</body>
</html>