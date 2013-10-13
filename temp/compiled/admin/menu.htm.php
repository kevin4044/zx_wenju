<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Xakshop管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />

<style type="text/css">
div,ul,li,dl,dd,dt,p,span,a,body{
	padding:0px;
	margin:0px;
}
body {
  background: #FFFFFF;
}
ul,li{
	list-style:none;}
img{
	border:none;}

.menu_box{
	width:100%;
	float:left;
	overflow:hidden;
	border-bottom:1px solid #dddddd;
	padding-bottom:10px;}	
.menu_box dl{
	width:46px;
	float:left;
	overflow:hidden;
	display:inline;
	margin:10px 1px 0px 1px;}
.menu_box dl dt{
	width:42px;
	height:37px;
	float:left;
	overflow:hidden;
	display:inline;
	margin:0px 2px;
	}	
.menu_box dl dt img{
	width:40px;
	height:35px;
	border:1px solid #ddd;}	
.menu_box dl.cur dt img{
	border-color:#666;}	
.menu_box dl dd{
	width:46px;
	line-height:20px;
	height:20px;
	float:left;
	overflow:hidden;
	text-align:center;
	margin-top:5px;
	font-family:Arial, Helvetica, sans-serif;
	}
.menu_box dl dd a{
	color:#444;
	}
.menu_box dl dd a:hover{
	text-decoration:none;} 	
.menu_box dl.cur dd a{
	color:#000;} 
.menu_box dl.cur dd a:hover{
	color:#000;} 
.son_menu_box{
	width:145px;
	float:left;
	overflow:hidden;
	padding:10px 0px;
	}
.son_menu{
	width:145px;
	float:left;
	overflow:hidden;
	display:none;}
.son_menu li{
	width:105px;
	line-height:20px;
	float:left;
	overflow:hidden;
	margin-top:5px;
	padding-left:40px;
	background:url(images/arrow.gif) no-repeat 18px 5px;
	}		
	
</style>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/jquery.min.js')); ?>

</head>
<body>
<div class="menu_box">
	<?php $_from = $this->_var['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'menu');$this->_foreach['menu_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['k'] => $this->_var['menu']):
        $this->_foreach['menu_foreach']['iteration']++;
?>
    <?php if (($this->_foreach['menu_foreach']['iteration'] <= 1)): ?>
	<dl class="cur">
    <?php else: ?>
    <dl>
    <?php endif; ?>
    	<dt><a href="javascript:void(0);" rel="<?php echo $this->_var['k']; ?>"><img src="images/<?php echo $this->_var['menu']['ico']; ?>.png" alt="<?php echo $this->_var['menu']['label']; ?>" /></a></dt>
        <dd><a href="javascript:void(0);" rel="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['menu']['label']; ?></a></dd>
    </dl>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
</div>
<div class="son_menu_box">
	<?php $_from = $this->_var['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'menu');$this->_foreach['menu_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['k'] => $this->_var['menu']):
        $this->_foreach['menu_foreach']['iteration']++;
?>
    <?php if (($this->_foreach['menu_foreach']['iteration'] <= 1)): ?>
	<div class="son_menu" id="<?php echo $this->_var['k']; ?>" style="display:block;">
    <?php else: ?>
    <div class="son_menu" id="<?php echo $this->_var['k']; ?>">
    <?php endif; ?>
    	<ul>
        	<?php $_from = $this->_var['menu']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
        	<li class="<?php echo $this->_var['child']['ico']; ?>"><a href="<?php echo $this->_var['child']['action']; ?>" target="main-frame"><?php echo $this->_var['child']['label']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>

<script type="text/javascript">

$(function(){ 
	$(".menu_box a").click(function(){
		var N_show = $(this).parent().parent();
		var N_show_item = $(this).attr("rel");
		if(!$(N_show).hasClass("cur"))
		{
			$(".menu_box dl").removeClass("cur");
			$(N_show).addClass("cur");
			$(".son_menu").hide();
			$("#"+N_show_item).show();
		}		
	});
});

</script>
</body>
</html>