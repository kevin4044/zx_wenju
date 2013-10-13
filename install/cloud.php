<?php

define('XAK_INC', true);
require(dirname(__FILE__) . '/includes/init.php');
session_start();
require(ROOT_PATH . 'includes/cls_xak.php');
require(ROOT_PATH . 'includes/cls_transport.php');
$t = new transport('-1',5);

$data['api_ver'] = '1.0';
$data['version'] = VERSION;
$data['charset'] = strtoupper(XAK_CHARSET);
$xak_charset = $data['charset'];
$data['patch'] = file_get_contents(ROOT_PATH."xakadmin/patch_num");
$data['xak_lang'] = !empty($_SESSION['xak_lang']) ? $_SESSION['xak_lang'] : 'zh_cn';
$data['release'] = RELEASE;
$step = isset($_REQUEST['step']) ? trim($_REQUEST['step']) : '';

$step_arr = array('welcome','check','setting_ui','done','active');

if (!in_array($step,$step_arr))
{
    @header('Location: index.php');
}

$apiget = "step= $step &xak_lang= $data[xak_lang] &release= $data[release] &version= $data[version] &patch= $data[patch] &charset= $data[charset] &api_ver= $data[api_ver]";

foreach ($_SESSION[$step] as $k => $v)
{
    $smarty->assign($k, $v);
    $GLOBALS[$k] = $v;
}

$installer_lang_package_path = ROOT_PATH . 'install/languages/' . $data['xak_lang'] . '.php';
if (file_exists($installer_lang_package_path))
{
    include_once($installer_lang_package_path);
    $lang = $_LANG;
    $smarty->assign('lang', $_LANG);
}

if ($step == 'welcome')
{
    $content = api_request($apiget);
    if ($content)
    {
        //$content=str_replace('<'.'?php','<'.'?',$content);
        $content='?'.'>'.trim($content);
        eval($content);
    }
    else
    {
        $smarty->display('welcome_content.php');
    }
}
elseif ($step == 'check')
{
    $content = api_request($apiget);
    if ($content)
    {
        //$content=str_replace('<'.'?php','<'.'?',$content);
        $content='?'.'>'.trim($content);
        eval($content);
    }
    else
    {
        $smarty->display('checking_content.php');
    }
}
elseif ($step == 'setting_ui')
{
    $content = api_request($apiget);
    if ($content)
    {
        //$content=str_replace('<'.'?php','<'.'?',$content);
        $content='?'.'>'.trim($content);
        eval($content);
    }
    else
    {
        $smarty->display('setting_content.php');
    }
}
elseif ($step == 'done')
{
    $content = api_request($apiget);
    if ($content)
    {
        //$content=str_replace('<'.'?php','<'.'?',$content);
        $content='?'.'>'.trim($content);
        eval($content);
    }
    else
    {
        $smarty->display('done_content.php');
    }
}
elseif ($step == 'active')
{
    $content = api_request($apiget);
    if ($content)
    {
        //$content=str_replace('<'.'?php','<'.'?',$content);
        $content='?'.'>'.trim($content);
        eval($content);
    }
    else
    {
        $smarty->display('active_content.php');
    }
}

function api_request($apiget)
{
    return false;
}

?>