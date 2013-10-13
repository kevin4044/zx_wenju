<?php

/**
 * 广告调用函数
 * ============================================================================
 * $Author: hebian $
 * $Id: lib_myad.php 2011-08-25 12:52 heibian $
*/

if (!defined('XAK_INC'))
{
    die('Hacking attempt');
}

/**
 * 获得广告内容
 *
 * @access  public
 * @param   string   $tagname   广告标识
 * @param   int      $cat_id    商品分类id
 * @param   int      $onlycode  是否只输出广告代码
 * @return  string
 */
function get_myad($tagname='',$cat_id = 0,$onlycode = 0)
{
	$tagname = trim($tagname);
	$tagname=str_replace("myad_",'',$tagname);
	
	if(!isset($cat_id))
	{
		$cat_id =0;
	}
	
	if(!isset($onlycode))
	{
		$onlycode =0;
	}
	
	if($cat_id == '0')
	{
		$typesql = " AND typeid ='0'";
	}
	else
	{
		$cat_arr = get_all_top($cat_id);
		$typesql = " AND typeid in(0,".$cat_arr.")";
	}
	
	/* 获取广告数据 */
    $sql = "SELECT * FROM " .$GLOBALS['xak']->table('myad'). " WHERE tagname='".$tagname."'".$typesql ." ORDER BY typeid DESC";	
    $arr = $GLOBALS['db']->getRow($sql);
	
	/*取得广告时间*/
	$starttime = local_date('Y-m-d',$arr['starttime']);
	$endtime = local_date('Y-m-d',$arr['endtime']);
	/*当前时间*/
	$nowtime = local_date('Y-m-d'); 
	/*是否限时*/
	$timeset = $arr['timeset'];
	/*广告类型*/
	$adtype = $arr['adtype'];
	
	/*开启限时并不在设定时间内显示过期内容*/
	if($timeset =='1' && ($nowtime > $endtime || $nowtime < $starttime))
	{
		$adinfo = $arr['expbody'];
	}
	/*显示正常广告内容*/
	else
	{
		/*是否只输出广告代码*/
		if($onlycode == 1)
		{
			$adinfo = $arr['normparams'];
		}
		else
		{
			/*代码广告*/	
			if($adtype=='0')
			{
				$adinfo = $arr['normparams'];
			}
			/*幻灯广告*/	
			elseif($adtype=='1')
			{
				$slidearr = unserialize($arr['normparams']);
				
				/*没有宽度和高度默认一个*/
				if(empty($slidearr['width']))
				{
					$slidearr['width'] = "400";
				}
				if(empty($slidearr['height']))
				{
					$slidearr['height'] = "250";
				}
				
				$adinfo ="<script language='javascript'>
					linkarr = new Array();
					picarr = new Array();
					textarr = new Array();
					var swf_width=".$slidearr['width']."; var swf_height=".$slidearr['height']."; var configtg='0xffffff|2|0xFF6600|5|0xffffff|0xFF6600|0x000033|3|3|1|_blank';
					var files = '';
					var links = '';
					var texts = '';";
				$autonum = 1;	
				foreach($slidearr['pic'] as $k=>$v)
				{
					if(!empty($v))
					{
						$slide_list.= 'linkarr['.$autonum.'] = "'.$slidearr['link'][$autonum].'";picarr['.$autonum.'] = "'.$slidearr['pic'][$autonum].'";textarr['.$autonum.'] = "'.$slidearr['text'][$autonum].'";';
						$autonum++;
					}
				}
				$adinfo .= $slide_list;	
				$adinfo .= "for(i=1;i<picarr.length;i++){
				  if(files==\"\") files = picarr[i];
				  else files += \"|\"+picarr[i];
				}
				for(i=1;i<linkarr.length;i++){
				  if(links==\"\") links = linkarr[i];
				  else links += \"|\"+linkarr[i];
				}
				for(i=1;i<textarr.length;i++){
				  if(texts==\"\") texts = textarr[i];
				  else texts += \"|\"+textarr[i];
				}
				document.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\">');
				document.write('<param name=\"movie\" value=\"/data/flashdata/bcastr3.swf\"><param name=\"quality\" value=\"high\">');
				document.write('<param name=\"menu\" value=\"false\"><param name=wmode value=\"opaque\">');
				document.write('<param name=\"FlashVars\" value=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'&bcastr_config='+configtg+'\">');
				document.write('<embed src=\"/data/flashdata/bcastr3.swf\" wmode=\"opaque\" FlashVars=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'&bcastr_config='+configtg+'&menu=\"false\" quality=\"high\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />'); document.write('</object>'); 
			</script>";
			}
			/*图片广告*/	
			elseif($adtype=='2')
			{
				$imagearr = unserialize($arr['normparams']);
				if(empty($imagearr['width']))
				{
					$width = "";
				}
				else
				{
					$width = " width=\"{$imagearr['width']}\"";
				}
				if (empty($imagearr['height']))
				{
					$height = "";
				}
				else
				{
					$height = " height=\"{$imagearr['height']}\"";
				}
				if (empty($imagearr['text']))
				{
					$alt = "";
					$title="";
				}
				else
				{
					$alt = " alt=\"{$imagearr['text']}\"";
					$title = " title=\"{$imagearr['text']}\"";
				}
				
				if(empty($imagearr['link']) || $imagearr['link']=='#')
				{
					$adinfo = "<img src=\"{$imagearr['url']}\"$width $height $alt $title border=\"0\" />";
				}
				else
				{
					$adinfo = "<a href=\"{$imagearr['link']}\" $title target=\"_blank\"><img src=\"{$imagearr['url']}\"$width $height $alt border=\"0\" /></a>";
				}				
			}
			/*文字广告*/	
			elseif($adtype=='3')
			{
				$textarr = unserialize($arr['normparams']);
				if(!empty($textarr['size']))
				{
					$font = 'font-size:'.$textarr['size'].'px;';
				}
				else
				{
					$font='';	
				}
							
				if(!empty($textarr['color']))
				{
					$color = 'color:'.$textarr['color'].';';
				}
				else
				{
					$color='';
				}
				$adinfo = "<a href=\"{$textarr['link']}\" style=\"$font $color\" target=\"_blank\">{$textarr['title']}</a>";
			}
			/*Flash广告*/	
			elseif($adtype=='4')
			{
				$flasharr = unserialize($arr['normparams']);
				if(empty($flasharr['width']))
				{
					$width = " width=\"400\"";
				}
				else
				{
					$width = " width=\"{$flasharr['width']}\"";
				}
				if (empty($flasharr['height']))
				{
					$height = " height=\"250\"";
				}
				else
				{
					$height = " height=\"{$flasharr['height']}\"";
				}
				$adinfo = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0\" $width $height >
	  <param name=\"movie\" value=\"{$flasharr['link']}\" />
	  <param name=\"quality\" value=\"high\" />
	  <param name=\"wmode\" value=\"transparent\" />
	  <embed src=\"{$flasharr['link']}\" quality=\"high\" pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" $width $height></embed>
	</object>";
			}
			else
			{
				$adinfo ="";
			}
		}
	}
	
	return $adinfo;
}

function get_all_top($id)
{
	$autoindex =0;
	$arr = get_all_top_id($id,$autoindex);
    return $arr;
}
//循环当前栏目的所有上级栏目
function get_all_top_id($id,$autoindex)
{
	$sql = "SELECT * FROM " .$GLOBALS['xak']->table('category'). " WHERE cat_id = '$id'";
	$row = $GLOBALS['db']->getRow($sql);
	if($row['parent_id']==0){
		if($autoindex ==0)
		{
			$list.=$row['cat_id'];
		}
		else
		{
			$list.=','.$row['cat_id'];
		}	 
	}
	else
	{
		if($autoindex ==0)
		{
			$list.=$row['cat_id'];
		}
		else
		{
			$list.=','.$row['cat_id'];
		}
		$autoindex++;		
		$list.= get_all_top_id($row['parent_id'],$autoindex);		
	}
	
	return $list;
}
 
?>