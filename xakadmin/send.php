<?php
/** 快钱联合注册接口
 * ----------------------------------------------------------------------------
 * $File: send.php 2008-10-23 09:31:42Z liuhui $
*/

define('XAK_INC', true);

require(dirname(__FILE__) . '/includes/init.php');
$backUrl=$xak->url() . ADMIN_PATH . '/receive.php';
header("location:http://cloud.xakshop.com/payment_apply.php?mod=kuaiqian&par=$backUrl");
exit;
?>
