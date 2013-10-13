<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Xakshop管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />

<style type="text/css">
body{
	background:url(images/admin_header_bg.png) repeat-x;}
ul,li{
	list-style:none;
	margin:0;
	padding:0;}
img{
	border:none;}	

.header_box{
	width:100%;
	height:78px;
	overflow:hidden;
	position:relative;
	z-index:5;
	background:url(images/admin_header.png) no-repeat left top;
	}	
#header-div {
	height:51px;
	margin:0px 8px;
	overflow:hidden;
}

#logo-div {
  width:190px;	
  height: 51px;
  float: left;
  overflow:hidden;
}
#logo-div a{
	width:190px;
	height:51px;
	display:block;
	overflow:hidden;
	text-indent:-9999px;}
.send_info{
	height:20px;
	line-height:20px;
	float:left;
	overflow:hidden;
	display:inline;
	margin:15px 0px 0px 5px;}	
.top_menu_box{
	height:32px;
	float:right;
	overflow:hidden;
	display:inline;
	margin:19px 16px 0px 0px;
	position:relative;
	z-index:100;
	}
.top_menu_left{
	width:32px;
	height:32px;
	position:absolute;
	left:0px;
	top:0px;
	overflow:hidden;
	z-index:101;}
.top_menu_right{
	width:32px;
	height:32px;
	position:absolute;
	right:0px;
	top:0px;
	overflow:hidden;
	z-index:101;}	
.top_menu{
	height:32px;
	float:left;
	overflow:hidden;
	display:inline;
	margin:0px 32px;
	background:url(images/admin_menu_bg.png) repeat-x;
	padding:0px 5px;}
.top_menu ul{
	float:left;
	overflow:hidden;
	margin:0;
	padding:0;}
.top_menu ul li{
	height:32px;
	line-height:34px;
	float:left;
	overflow:hidden;
	padding:0px 12px 0px 32px;
	}
.top_menu ul li a{
	color:#FFF;}
.top_menu ul li a:hover{
	color:#F60;
	text-decoration:none;}	
.top_menu ul li.line{
	width:2px;
	padding:0;
	background:url(images/admin_menu_line.png) no-repeat;}	
.top_menu ul li.ico_1{
	background:url(images/ico_1.png) no-repeat 10px 8px;
	}
.top_menu ul li.ico_2{
	background:url(images/ico_2.png) no-repeat 10px 8px;
	}
.top_menu ul li.ico_3{
	background:url(images/ico_3.png) no-repeat 10px 8px;
	}
.top_menu ul li.ico_4{
	background:url(images/ico_4.png) no-repeat 10px 8px;
	}	

#menu-div {
	height:27px;
	margin:0px 8px;
	overflow:hidden;
}
#menu-div ul{
	height:27px;
	float:left;
	overflow:hidden;}
#menu-div ul li{
	height:16px;
	line-height:16px;
	float:left;
	overflow:hidden;
	display:inline;
	margin:6px 5px 0px 5px;}
#menu-div ul li.admin_home{
	margin:6px 5px 0px 15px;}
#menu-div ul li.line{
	width:2px;
	background:url(images/admin_nav_line.png) no-repeat;}	

#load-div {
  width:50%;
  height:25px;
  line-height:25px;
  position:absolute;
  left:25%;
  top:18px;
  text-align:center;
  z-index:99999;
  color:#C00;
  display:none;
}
#load-div img{
	vertical-align:middle;}
.admin_exit{
	width:15px;
	height:16px;
	position:absolute;
	right:10px;
	top:27px;
	z-index:99999;
	overflow:hidden;
	background:url(images/ico_5.png) no-repeat;
	}
.admin_exit a{
	width:15px;
	height:16px;
	line-height:16px;
	display:block;
	overflow:hidden;
	text-indent:-9999px;}	
	
.admin_header_right{
	width:11px;
	height:27px;
	position:absolute;
	right:0px;
	top:51px;
	overflow:hidden;
	z-index:1000;
	background:url(images/admin_header_right.png) no-repeat;
	}
</style>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/transport.js')); ?>
<!--[if IE 6]>
<script language="javascript" src="js/png_ie6.js"></script>
<script> 
  DD_belatedPNG.fix('.ie6_png');
</script>
<![endif]-->
<script type="text/javascript">
/** 帮助系统*/
function web_address()
{
  var ne_add = parent.document.getElementById('main-frame');
  var ne_list = ne_add.contentWindow.document.getElementById('search_id').innerHTML;
  ne_list.replace('-', '');
  var arr = ne_list.split('-');
  window.open('help.php?al='+arr[arr.length - 1],'_blank');
}

function ShowToDoList()
{
  try
  {
    var mainFrame = window.top.frames['main-frame'];
    mainFrame.window.showTodoList(adminId);
  }
  catch (ex)
  {
  }
}


var adminId = "<?php echo $this->_var['admin_id']; ?>"; 
</script>
</head>
<body>
<div class="header_box">
    <div id="header-div">
      <div id="logo-div"><a href="http://www.xak.cn" target="_blank" title="Xakshop">Xakshop</a></div>
      <div class="send_info">
      <?php if ($this->_var['send_mail_on'] == 'on'): ?>
        <span id="send_msg"><img src="images/top_loader.gif" width="20" height="20" alt="<?php echo $this->_var['lang']['loading']; ?>" style="vertical-align: middle" /> <?php echo $this->_var['lang']['email_sending']; ?></span>
        <a href="javascript:;" onClick="Javascript:switcher()" id="lnkSwitch" style="margin-right:10px;color: #FF9900;text-decoration: underline"><?php echo $this->_var['lang']['pause']; ?></a>
      <?php endif; ?>
      </div>
      <div class="top_menu_box">
      	<div class="top_menu_left"><img src="images/admin_menu_left.png" class="ie6_png" /></div>
        <div class="top_menu_right"><img src="images/admin_menu_right.png" class="ie6_png" /></div>	
        <div class="top_menu">
        	<ul>
                <li class="ico_1"><a href="index.php?act=first" target="main-frame"><?php echo $this->_var['lang']['shop_guide']; ?></a></li>
                <li class="line"></li>
                <li class="ico_2"><a href="privilege.php?act=modif" target="main-frame"><?php echo $this->_var['lang']['profile']; ?></a></li>
                <li class="line"></li>
                <li class="ico_3"><a href="message.php?act=list" target="main-frame"><?php echo $this->_var['lang']['view_message']; ?></a></li>
                <li class="line"></li>
                <li class="ico_4"><a href="../" target="_blank"><?php echo $this->_var['lang']['preview']; ?></a></li>
                <li class="line"></li>
                <li class="ico_1"><a href="index.php?act=clear_cache" target="main-frame"><?php echo $this->_var['lang']['clear_cache']; ?></a></li>
            </ul>
        </div>        
      </div>
    </div>
    <div id="menu-div">
    	<ul>
        	<li class="admin_home"><a href="index.php?act=main" target="main-frame"><img src="images/ico_6.png" /></a></li>
            <li><a href="javascript:history.go(-1);" target="main-frame"><img src="images/ico_7.png" /></a></li>
            <li><a href="javascript:history.forward();" target="main-frame"><img src="images/ico_8.png" /></a></li>
            <li class="line"></li>
            <li><a href="privilege.php?act=modif" target="main-frame"><?php echo $this->_var['lang']['set_navigator']; ?></a></li>
            <?php $_from = $this->_var['nav_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
            <li class="line"></li>
            <li><a href="<?php echo $this->_var['key']; ?>" target="main-frame"><?php echo $this->_var['item']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <div class="admin_header_right"></div>
    <div id="load-div"><img src="images/top_loader.gif" width="20" height="20" alt="<?php echo $this->_var['lang']['loading']; ?>" style="vertical-align: middle" /> <?php echo $this->_var['lang']['loading']; ?></div>
    <div class="admin_exit"><a href="privilege.php?act=logout" target="_top" title="<?php echo $this->_var['lang']['signout']; ?>"><?php echo $this->_var['lang']['signout']; ?></a></div>
</div>    
<?php if ($this->_var['send_mail_on'] == 'on'): ?>
<script type="text/javascript" charset="gb2312">
	var sm = window.setInterval("start_sendmail()", 5000);
	var finished = 0;
	var error = 0;
	var conti = "<?php echo $this->_var['lang']['conti']; ?>";
	var pause = "<?php echo $this->_var['lang']['pause']; ?>";
	var counter = 0;
	var str = "<?php echo $this->_var['lang']['str']; ?>";
	
	function start_sendmail()
	{
	  Ajax.call('index.php?is_ajax=1&act=send_mail','', start_sendmail_Response, 'GET', 'JSON');
	}
	function start_sendmail_Response(result)
	{
		if (typeof(result.count) == 'undefined')
		{
			result.count = 0;
			result.message = '';
		}
		if (typeof(result.count) != 'undefined' && result.count == 0)
		{
			counter --;
			document.getElementById('lnkSwitch').style.display = "none";
			window.clearInterval(sm);
		}
	
		if( typeof(result.goon) != 'undefined' )
		{
			start_sendmail();
		}
	
		counter ++ ;
	
		document.getElementById('send_msg').innerHTML = result.message;
	}
	function switcher()
	{
		if(document.getElementById('lnkSwitch').innerHTML == conti)
		{
			//do pause
			document.getElementById('lnkSwitch').innerHTML = pause;
			sm = window.setInterval("start_sendmail()", 5000);
		}
		else
		{
			//do continue
			document.getElementById('lnkSwitch').innerHTML = conti;
			document.getElementById('send_msg').innerHTML = sprintf(str, counter);
			window.clearInterval(sm);
		}
	}
	
	sprintfWrapper = {   
	  
	  init : function () {   
	  
		if (typeof arguments == "undefined") {return null;}   
		if (arguments.length < 1) {return null;}   
		if (typeof arguments[0] != "string") {return null;}   
		if (typeof RegExp == "undefined") {return null;}   
	  
		var string = arguments[0];   
		var exp = new RegExp(/(%([%]|(\-)?(\+|\x20)?(0)?(\d+)?(\.(\d)?)?([bcdfosxX])))/g);   
		var matches = new Array();   
		var strings = new Array();   
		var convCount = 0;   
		var stringPosStart = 0;   
		var stringPosEnd = 0;   
		var matchPosEnd = 0;   
		var newString = '';   
		var match = null;   
	  
		while (match = exp.exec(string)) {   
		  if (match[9]) {convCount += 1;}   
	  
		  stringPosStart = matchPosEnd;   
		  stringPosEnd = exp.lastIndex - match[0].length;   
		  strings[strings.length] = string.substring(stringPosStart, stringPosEnd);   
	  
		  matchPosEnd = exp.lastIndex;   
		  matches[matches.length] = {   
			match: match[0],   
			left: match[3] ? true : false,   
			sign: match[4] || '',   
			pad: match[5] || ' ',   
			min: match[6] || 0,   
			precision: match[8],   
			code: match[9] || '%',   
			negative: parseInt(arguments[convCount]) < 0 ? true : false,   
			argument: String(arguments[convCount])   
		  };   
		}   
		strings[strings.length] = string.substring(matchPosEnd);   
	  
		if (matches.length == 0) {return string;}   
		if ((arguments.length - 1) < convCount) {return null;}   
	  
		var code = null;   
		var match = null;   
		var i = null;   
	  
		for (i=0; i<matches.length; i++) {   
	  
		  if (matches[i].code == '%') {substitution = '%'}   
		  else if (matches[i].code == 'b') {   
			matches[i].argument = String(Math.abs(parseInt(matches[i].argument)).toString(2));   
			substitution = sprintfWrapper.convert(matches[i], true);   
		  }   
		  else if (matches[i].code == 'c') {   
			matches[i].argument = String(String.fromCharCode(parseInt(Math.abs(parseInt(matches[i].argument)))));   
			substitution = sprintfWrapper.convert(matches[i], true);   
		  }   
		  else if (matches[i].code == 'd') {   
			matches[i].argument = String(Math.abs(parseInt(matches[i].argument)));   
			substitution = sprintfWrapper.convert(matches[i]);   
		  }   
		  else if (matches[i].code == 'f') {   
			matches[i].argument = String(Math.abs(parseFloat(matches[i].argument)).toFixed(matches[i].precision ? matches[i].precision : 6));   
			substitution = sprintfWrapper.convert(matches[i]);   
		  }   
		  else if (matches[i].code == 'o') {   
			matches[i].argument = String(Math.abs(parseInt(matches[i].argument)).toString(8));   
			substitution = sprintfWrapper.convert(matches[i]);   
		  }   
		  else if (matches[i].code == 's') {   
			matches[i].argument = matches[i].argument.substring(0, matches[i].precision ? matches[i].precision : matches[i].argument.length)   
			substitution = sprintfWrapper.convert(matches[i], true);   
		  }   
		  else if (matches[i].code == 'x') {   
			matches[i].argument = String(Math.abs(parseInt(matches[i].argument)).toString(16));   
			substitution = sprintfWrapper.convert(matches[i]);   
		  }   
		  else if (matches[i].code == 'X') {   
			matches[i].argument = String(Math.abs(parseInt(matches[i].argument)).toString(16));   
			substitution = sprintfWrapper.convert(matches[i]).toUpperCase();   
		  }   
		  else {   
			substitution = matches[i].match;   
		  }   
	  
		  newString += strings[i];   
		  newString += substitution;   
	  
		}   
		newString += strings[i];   
	  
		return newString;   
	  
	  },   
	  
	  convert : function(match, nosign){   
		if (nosign) {   
		  match.sign = '';   
		} else {   
		  match.sign = match.negative ? '-' : match.sign;   
		}   
		var l = match.min - match.argument.length + 1 - match.sign.length;   
		var pad = new Array(l < 0 ? 0 : l).join(match.pad);   
		if (!match.left) {   
		  if (match.pad == "0" || nosign) {   
			return match.sign + pad + match.argument;   
		  } else {   
			return pad + match.sign + match.argument;   
		  }   
		} else {   
		  if (match.pad == "0" || nosign) {   
			return match.sign + match.argument + pad.replace(/0/g, ' ');   
		  } else {   
			return match.sign + match.argument + pad;   
		  }   
		}   
	  }   
	}   
	sprintf = sprintfWrapper.init;  
	
</script>
<?php endif; ?>
</body>
</html>