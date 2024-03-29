<?php

/** 前台公用文件
 * ----------------------------------------------------------------------------
 * $File: init.php
*/

error_reporting(7);

if (!defined('XAK_INC'))
{
    die('Hacking attempt');
}

/* 取得当前client所在的根目录 */
define('CLIENT_PATH', substr(__FILE__, 0, -17));

/* 设置maifou.net所在的根目录 */
define('ROOT_PATH', substr(__FILE__, 0, -28));

$php_self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
if ('/' == substr($php_self, -1))
{
    $php_self .= 'index.php';
}
define('PHP_SELF', $php_self);

// 通用包含文件
require(ROOT_PATH . 'data/config.php');
require(ROOT_PATH . 'includes/lib_common.php');
require(ROOT_PATH . 'includes/cls_mysql.php');


/* 兼容旧版本载入库文件 */
if (!function_exists('addslashes_deep'))
{
    require(ROOT_PATH . 'includes/lib_base.php');
}
require(CLIENT_PATH . 'includes/lib_api.php');    // API库文件
require(CLIENT_PATH . 'includes/lib_struct.php'); // 结构库文件

// json类文件
require(ROOT_PATH . 'includes/cls_json.php');

/* 对用户传入的变量进行转义操作。*/
if (!get_magic_quotes_gpc())
{
    $_COOKIE   = addslashes_deep($_COOKIE);
}

/* 兼容旧版本 */
if (!defined('XAK_CHARSET'))
{
    define('XAK_CHARSET', 'utf-8');
}

/* 初始化JSON对象 */
$json = new JSON;

/* 分析JSON数据 */
parse_json($json, $_POST['Json']);

/* 初始化包含文件 */
require(ROOT_PATH . 'includes/inc_constant.php');
require(ROOT_PATH . 'includes/cls_xak.php');
require(ROOT_PATH . 'includes/lib_time.php');
require(ROOT_PATH . 'includes/lib_main.php');
require(ROOT_PATH . 'includes/lib_insert.php');
require(ROOT_PATH . 'includes/lib_goods.php');

/* 创建 XKASHOP 对象 */
$xak = new XAK($db_name, $prefix);

/* 初始化数据库类 */
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
$db->set_disable_cache_tables(array($xak->table('sessions'), $xak->table('sessions_data'), $xak->table('cart')));
$db_host = $db_user = $db_pass = $db_name = NULL;

/* 载入系统参数 */
$_CFG = load_config();

/* 载入语言包 */
require(ROOT_PATH.'languages/' .$_CFG['lang']. '/admin/common.php');
require(ROOT_PATH.'languages/' .$_CFG['lang']. '/admin/log_action.php');

/* 初始化session */
include(ROOT_PATH . 'includes/cls_session.php');

$sess = new cls_session($db, $xak->table('sessions'), $xak->table('sessions_data'), 'CL_XAKCP_ID');

define('SESS_ID', $sess->get_session_id());

/* 判断是否登录了 */
if ((!isset($_SESSION['admin_id']) || intval($_SESSION['admin_id']) <= 0) && ($_POST['Action'] != 'UserLogin'))
{
    client_show_message(110);
}

if ($_CFG['shop_closed'] == 1)
{
    /* 商店关闭了，输出关闭的消息 */
    client_show_message(105);
}

?>