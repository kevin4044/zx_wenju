<?php

/**
 * 广告管理程序
 * ----------------------------------------------------------------------------
 * $Id: my_ad.php
*/

define('XAK_INC', true);

require(dirname(__FILE__) . '/includes/init.php');
include_once(ROOT_PATH . 'includes/cls_image.php');
$image = new cls_image($_CFG['bgcolor']);
$exc   = new exchange($xak->table("myad"), $db, 'ad_id', 'ad_name');

/* act操作项的初始化 */
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}

/*------------------------------------------------------ */
//-- 广告列表页面
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    $pid = !empty($_REQUEST['pid']) ? intval($_REQUEST['pid']) : 0;

    $smarty->assign('ur_here',     $_LANG['myad_list']);
    $smarty->assign('action_link', array('text' => '添加广告', 'href' => 'my_ad.php?act=add'));
    $smarty->assign('pid',         $pid);
     $smarty->assign('full_page',  1);

    $ads_list = get_adslist();

    $smarty->assign('ads_list',     $ads_list['ads']);
    $smarty->assign('filter',       $ads_list['filter']);
    $smarty->assign('record_count', $ads_list['record_count']);
    $smarty->assign('page_count',   $ads_list['page_count']);

    $sort_flag  = sort_flag($ads_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('myad_list.htm');
}
/*------------------------------------------------------ */
//-- 翻页、排序
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'query')
{
    $ads_list = get_adslist();

    $smarty->assign('ads_list',     $ads_list['ads']);
    $smarty->assign('filter',       $ads_list['filter']);
    $smarty->assign('record_count', $ads_list['record_count']);
    $smarty->assign('page_count',   $ads_list['page_count']);

    $sort_flag  = sort_flag($ads_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('myad_list.htm'), '',
        array('filter' => $ads_list['filter'], 'page_count' => $ads_list['page_count']));
}
/*------------------------------------------------------ */
//-- 添加新广告页面
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
    admin_priv('ad_manage');

    $ad_link = empty($_GET['ad_link']) ? '' : trim($_GET['ad_link']);
    $ad_name = empty($_GET['ad_name']) ? '' : trim($_GET['ad_name']);

    $start_time = local_date('Y-m-d');
    $end_time   = local_date('Y-m-d', gmtime() + 3600 * 24 * 30);  // 默认结束时间为1个月以后

    $smarty->assign('ads',
        array('ad_link' => $ad_link, 'ad_name' => $adname, 'starttime' => $start_time,
            'endtime' => $end_time, 'enabled' => 1));

    $smarty->assign('ur_here',       '添加广告');
	$smarty->assign('action_link', array('text' => '广告列表', 'href' => 'my_ad.php?act=list'));
    $smarty->assign('position_list', get_position_list());
	//幻灯片循环
	$smarty->assign('slide_list', get_slide_list());
	//商品分类
	$smarty->assign('cat_list', cat_list());

    $smarty->assign('form_act', 'insert');
    $smarty->assign('action',   'add');
    $smarty->assign('cfg_lang', $_CFG['lang']);

    assign_query_info();
    $smarty->display('myad_info.htm');
}

/*------------------------------------------------------ */
//-- 新广告的处理
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'insert')
{
    admin_priv('ad_manage');

    /* 初始化变量 */  
	$tagname = !empty($_POST['tagname']) ? trim($_POST['tagname']) : '';
	$typeid = !empty($_POST['typeid']) ? trim($_POST['typeid']) : '0';
	
	if(empty($tagname)){
		$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
        sys_msg('广告标识不能为空!', 0, $link);
	}
 

    /* 获得广告的开始时期与结束日期 */
    $starttime = local_strtotime($_POST['starttime']);
    $endtime   = local_strtotime($_POST['endtime']);

    /* 查看广告名称是否有重复 */
	$sql = "SELECT COUNT(*) FROM " .$xak->table('myad'). " WHERE tagname = '$tagname' and typeid = '$typeid'";
	if ($db->getOne($sql) > 0)
	{
		$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
		sys_msg('广告标识已存在!', 0, $link);
	}
	
	
	 /* 代码广告 */
    if ($_POST['adtype'] == '0')
    {
        if (!empty($_POST['htmlcode']))
        {
            $normparams = $_POST['htmlcode'];
        }        
    }
	
	/* 幻灯广告 */
    elseif ($_POST['adtype'] == '1')
    {
		if(!empty($_POST['slide']))
		{
			for($i=1;$i<7;$i++)
			{
				$val = "slide_f_".$i;
				if ($_FILES[$val]['error'] == 0  && $_FILES[$val]['tmp_name'] != 'none')
				{
					$_POST['slide']['pic'][$i] = "/data/afficheimg/". basename($image->upload_image($_FILES[$val], 'afficheimg'));
				}
			}
			$normparams = serialize($_POST['slide']);
		}		
    }
    /* 图片广告 */
    elseif ($_POST['adtype'] == '2')
    {
       if(!empty($_POST['image']))
		{
			
			if ($_FILES['image_f']['error'] == 0  && $_FILES['image_f']['tmp_name'] != 'none')
			{
				$_POST['image']['url'] = "/data/afficheimg/". basename($image->upload_image($_FILES['image_f'], 'afficheimg'));
			}   
			$normparams = serialize($_POST['image']);
		}
		
    }
	
	/* 文字广告 */
    elseif ($_POST['adtype'] == '3')
    {
        if(!empty($_POST['text']))
		{
			$normparams = serialize($_POST['text']);
		}
		
    }

    /* Flash广告 */
    elseif ($_POST['adtype'] == '4')
    {
        if(!empty($_POST['flash']))
		{
			if ($_FILES['flash_f']['error'] == 0 && $_FILES['flash_f']['tmp_name'] != 'none')
			{
				/* 检查文件类型 */
				if ($_FILES['flash_f']['type'] != "application/x-shockwave-flash")
				{
					$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
					sys_msg('上传文件类型不正确!', 0, $link);
				}
			
				/* 生成文件名 */
				$urlstr = date('Ymd');
				for ($i = 0; $i < 6; $i++)
				{
				$urlstr .= chr(mt_rand(97, 122));
				}
			
				$source_file = $_FILES['flash_f']['tmp_name'];
				$target      = ROOT_PATH . DATA_DIR . '/afficheimg/';
				$file_name   = $urlstr .'.swf';
			
				if (!move_upload_file($source_file, $target.$file_name))
				{
					$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
					sys_msg('上传文件出错,请重试!', 0, $link);
				}
				else
				{
					$_POST['flash']['link'] = "/data/afficheimg/".$file_name;
				}
			}
			$normparams = serialize($_POST['flash']);
		}
		
    }  

    /* 插入数据 */
    $sql = "INSERT INTO ".$xak->table('myad'). " (tagname,adname,typeid,timeset,starttime,endtime,adtype,normparams,expbody)
    VALUES (
            '$tagname',
            '$_POST[adname]',
			'$typeid',
            '$_POST[timeset]',
            '$starttime',
            '$endtime',
            '$_POST[adtype]',
            '$normparams',
            '$_POST[expbody]')";

    $db->query($sql);
    /* 记录管理员操作 */
    admin_log($_POST['adname'], 'add', 'ads');

    clear_cache_files(); // 清除缓存文件

    /* 提示信息 */

    $link[0]['text'] = $_LANG['back_ads_list'];
    $link[0]['href'] = 'my_ad.php?act=list';

    $link[1]['text'] = $_LANG['continue_add_ad'];
    $link[1]['href'] = 'my_ad.php?act=add';
    sys_msg($_LANG['add'] . "&nbsp;" .$_POST['adname'] . "&nbsp;" . $_LANG['attradd_succed'],0, $link);

}

/*------------------------------------------------------ */
//-- 广告编辑页面
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    admin_priv('ad_manage');

    /* 获取广告数据 */
    $sql = "SELECT * FROM " .$xak->table('myad'). " WHERE aid='".intval($_REQUEST['id'])."'";
    $ads_arr = $db->getRow($sql);

    $ads_arr['adname'] = htmlspecialchars($ads_arr['adname']);
    /* 格式化广告的有效日期 */
    $ads_arr['starttime']  = local_date('Y-m-d', $ads_arr['starttime']);
    $ads_arr['endtime']    = local_date('Y-m-d', $ads_arr['endtime']);
	
	if ($ads_arr['adtype'] == '0')
	{
		$ads_arr['htmlcode'] = $ads_arr['normparams'];
	}
	if ($ads_arr['adtype'] == '1')
	{
		$ads_arr['slide'] = unserialize($ads_arr['normparams']);		
		for($i=1;$i<7;$i++)
		{
			$row['num']=$i;
			$row['pic']=$ads_arr['slide']['pic'][$i];
			$row['link']=$ads_arr['slide']['link'][$i];
			$row['text']=$ads_arr['slide']['text'][$i];
			$slide_list[]=$row;
		}
	}
	if ($ads_arr['adtype'] == '2')
	{
		$ads_arr['image'] = unserialize($ads_arr['normparams']);
	}
	if ($ads_arr['adtype'] == '3')
	{
		$ads_arr['text'] = unserialize($ads_arr['normparams']);
	}
	if ($ads_arr['adtype'] == '4')
	{
		$ads_arr['flash'] = unserialize($ads_arr['normparams']);
	}
	if(!is_array($slide_list))
	{
		$slide_list=get_slide_list();
	}
    $smarty->assign('ur_here',       '编辑广告');
    $smarty->assign('action_link',   array('href' => 'my_ad.php?act=list', 'text' => $_LANG['ad_list']));
    $smarty->assign('form_act',      'update');
    $smarty->assign('action',        'edit');
    $smarty->assign('position_list', get_position_list());
	$smarty->assign('slide_list', $slide_list);
    $smarty->assign('ads',           $ads_arr);
	
	//商品分类
	$smarty->assign('cat_list', cat_list(0,$ads_arr['typeid']));

    assign_query_info();
    $smarty->display('myad_info.htm');
}

/*------------------------------------------------------ */
//-- 广告编辑的处理
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'update')
{
    admin_priv('ad_manage');

    /* 初始化变量 */
	$tagname = !empty($_POST['tagname']) ? trim($_POST['tagname']) : '';
    $id   = !empty($_POST['id'])   ? intval($_POST['id'])   : 0;
    $type = !empty($_POST['adtype']) ? intval($_POST['adtype']) : 0;
	$typeid = !empty($_POST['typeid']) ? intval($_POST['typeid']) : 0;
	
    /* 获得广告的开始时期与结束日期 */
    $starttime = local_strtotime($_POST['starttime']);
    $endtime   = local_strtotime($_POST['endtime']);
	
	/* 检查广告是否有重复 */
	$sql = "SELECT COUNT(*) FROM " .$xak->table('myad'). " WHERE tagname = '$tagname' and typeid = '$typeid' and aid != $id";
	if ($db->getOne($sql) > 0)
	{
		$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
		sys_msg('存在重复的广告标识!', 0, $link);
	}
	
	 /* 代码广告 */
    if ($type == '0')
    {
        $normparams = $_POST['htmlcode'];
    }
	
	/* 幻灯广告 */
    elseif ($type == '1')
    {
		if(!empty($_POST['slide']))
		{
			for($i=1;$i<7;$i++)
			{
				$val = "slide_f_".$i;
				$del =$_POST['del_s_'.$i];				
				if ($_FILES[$val]['error'] == 0  && $_FILES[$val]['tmp_name'] != 'none')
				{
					//删除旧文件
					if(file_exists(ROOT_PATH.$_POST['slide']['pic'][$i]) && $del =='1')
					{
						unlink(ROOT_PATH.$_POST['slide']['pic'][$i]);
					}
					
					$_POST['slide']['pic'][$i] = "/data/afficheimg/". basename($image->upload_image($_FILES[$val], 'afficheimg'));
				}
			}
			$normparams = serialize($_POST['slide']);
		}		
    }
    /* 图片广告 */
    elseif ($type == '2')
    {
       if(!empty($_POST['image']))
		{
			
			if ($_FILES['image_f']['error'] == 0  && $_FILES['image_f']['tmp_name'] != 'none')
			{
				//删除旧文件
				if(file_exists(ROOT_PATH.$_POST['image']['url'])&& $_POST['del_i'] =='1')
				{
					unlink(ROOT_PATH.$_POST['image']['url']);
				}
				$_POST['image']['url'] = "/data/afficheimg/". basename($image->upload_image($_FILES['image_f'], 'afficheimg'));
			}   
			$normparams = serialize($_POST['image']);
		}
		
    }
	
	/* 文字广告 */
    elseif ($type == '3')
    {
        if(!empty($_POST['text']))
		{
			$normparams = serialize($_POST['text']);
		}
		
    }

    /* Flash广告 */
    elseif ($type == '4')
    {
        if(!empty($_POST['flash']))
		{
			if ($_FILES['flash_f']['error'] == 0 && $_FILES['flash_f']['tmp_name'] != 'none')
			{
				/* 检查文件类型 */
				if ($_FILES['flash_f']['type'] != "application/x-shockwave-flash")
				{
					$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
					sys_msg('上传文件类型不正确!', 0, $link);
				}
			
				/* 生成文件名 */
				$urlstr = date('Ymd');
				for ($i = 0; $i < 6; $i++)
				{
				$urlstr .= chr(mt_rand(97, 122));
				}
			
				$source_file = $_FILES['flash_f']['tmp_name'];
				$target      = ROOT_PATH . DATA_DIR . '/afficheimg/';
				$file_name   = $urlstr .'.swf';
			
				if (!move_upload_file($source_file, $target.$file_name))
				{
					$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
					sys_msg('上传文件出错,请重试!', 0, $link);
				}
				else
				{
					//删除旧文件
					if(file_exists(ROOT_PATH.$_POST['flash']['link'])&& $_POST['del_f'] =='1')
					{
						unlink(ROOT_PATH.$_POST['flash']['link']);
					}
					$_POST['flash']['link'] = "/data/afficheimg/".$file_name;
				}
			}
			$normparams = serialize($_POST['flash']);
		}
		
    } 
	
    /* 更新信息 */
    $sql = "UPDATE " .$xak->table('myad'). " SET ".
            "adname     = '$_POST[adname]', ".
			"typeid     = '$_POST[typeid]', ".
            "timeset     = '$_POST[timeset]', ".
            "starttime  = '$starttime', ".
            "endtime    = '$endtime', ".
            "adtype    = '$type', ".
            "normparams  = '$normparams', ".
            "expbody  = '$_POST[expbody]' ".           
            "WHERE aid = '$id'";
    $db->query($sql);

   /* 记录管理员操作 */
   admin_log($_POST['adname'], 'edit', 'ads');

   clear_cache_files(); // 清除模版缓存

   /* 提示信息 */
   $href[] = array('text' => $_LANG['back_ads_list'], 'href' => 'my_ad.php?act=list');
   sys_msg($_LANG['edit'] .' '.$_POST['adname'].' '. $_LANG['attradd_succed'], 0, $href);

}


/*------------------------------------------------------ */
//-- 删除广告
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('ad_manage');

    $id = intval($_GET['id']);
	$adname = !empty($_GET['adname']) ? trim($_GET['adname']) : '';
	$sql = "DELETE FROM" .$xak->table('myad').          
            "WHERE aid = '$id'";
    $db->query($sql);
    	
	 /* 记录管理员操作 */
    admin_log($adname, 'remove', 'ads');

    /* 提示信息 */
    $href[] = array('text' => $_LANG['back_ads_list'], 'href' => 'my_ad.php?act=list');
    sys_msg('成功删除广告 : '.$adname, 0, $href);
}

/* 获取广告数据列表 */
function get_adslist()
{
   
    $filter = array();
    $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'aid' : trim($_REQUEST['sort_by']);
    $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

    $where = '';
  

    /* 获得总记录数据 */
    $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['xak']->table('myad');
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);

    $filter = page_and_size($filter);

    /* 获得广告数据 */
    $arr = array();
    $sql = 'SELECT * '.
            'FROM ' .$GLOBALS['xak']->table('myad'). ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'];

    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

    while ($rows = $GLOBALS['db']->fetchRow($res))
    {
         /* 广告类型的名称 */
         $rows['type']  = ($rows['adtype'] == 0) ? '代码'   : '';
         $rows['type'] .= ($rows['adtype'] == 1) ? '幻灯' : '';
         $rows['type'] .= ($rows['adtype'] == 2) ? '文字'  : '';
         $rows['type'] .= ($rows['adtype'] == 3) ? '图片'  : '';
		 $rows['type'] .= ($rows['adtype'] == 4) ? 'Flash'  : '';

         /* 格式化日期 */
         $rows['starttime']    = local_date($GLOBALS['_CFG']['date_format'], $rows['starttime']);
         $rows['endtime']      = local_date($GLOBALS['_CFG']['date_format'], $rows['endtime']);
		 $rows['typename']     = get_typename($rows['typeid']);

         $arr[] = $rows;
    }

    return array('ads' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

/* 循环幻灯列表 */
function get_slide_list()
{
	for($i=1;$i<7;$i++)
	{
		$rows['num'] = $i;
		$arr[] =$rows;
	}
	return $arr;
}
/* 取得商品分类名称 */
function get_typename($id)
{
	$sql = "SELECT cat_name FROM " .$GLOBALS['xak']->table('category'). " WHERE cat_id = '$id'";
	$typename = $GLOBALS['db']->getOne($sql);
	if(empty($typename))
	{
		$typename ='所有分类';
	}	
	return $typename;
}
?>