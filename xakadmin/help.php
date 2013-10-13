<?php
/** 帮助信息接口
 * ----------------------------------------------------------------------------
 * $File: respond.php 16220 2009-06-12 02:08:59
 */

define('XAK_INC', true);
require(dirname(__FILE__) . '/includes/init.php');

$get_keyword = trim($_GET['al']); // 获取关键字
header("location:http://help.xakshop.com/do.php?k=".$get_keyword."&v=".$_CFG['xak_version']."&l=".$_CFG['lang']."&c=".XAK_CHARSET);
?>