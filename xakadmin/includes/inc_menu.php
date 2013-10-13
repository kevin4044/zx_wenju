<?php

/** 管理中心菜单数组
 * ----------------------------------------------------------------------------
 * $File: inc_menu.php
*/

if (!defined('XAK_INC'))
{
    die('Hacking attempt');
}

//商品
$modules['01_cat_and_goods']['01_goods_list']       = 'goods.php?act=list';         // 商品列表
$modules['01_cat_and_goods']['02_goods_add']        = 'goods.php?act=add';          // 添加商品
$modules['01_cat_and_goods']['03_category_list']    = 'category.php?act=list';
$modules['01_cat_and_goods']['05_comment_manage']   = 'comment_manage.php?act=list';
$modules['01_cat_and_goods']['06_goods_brand_list'] = 'brand.php?act=list';
$modules['01_cat_and_goods']['08_goods_type']       = 'goods_type.php?act=manage';
$modules['01_cat_and_goods']['11_goods_trash']      = 'goods.php?act=trash';        // 商品回收站
$modules['01_cat_and_goods']['12_batch_pic']        = 'picture_batch.php';
$modules['01_cat_and_goods']['13_batch_add']        = 'goods_batch.php?act=add';    // 商品批量上传
$modules['01_cat_and_goods']['14_goods_export']     = 'goods_export.php?act=goods_export';
$modules['01_cat_and_goods']['15_batch_edit']       = 'goods_batch.php?act=select'; // 商品批量修改
$modules['01_cat_and_goods']['16_goods_script']     = 'gen_goods_script.php?act=setup';
//$modules['01_cat_and_goods']['17_tag_manage']       = 'tag_manage.php?act=list'; //标签管理
//$modules['01_cat_and_goods']['50_virtual_card_list']   = 'goods.php?act=list&extension_code=virtual_card'; //虚拟商品
//$modules['01_cat_and_goods']['51_virtual_card_add']    = 'goods.php?act=add&extension_code=virtual_card'; //添加虚拟商品
//$modules['01_cat_and_goods']['52_virtual_card_change'] = 'virtual_card.php?act=change'; //更改加密串
$modules['01_cat_and_goods']['goods_auto']             = 'goods_auto.php?act=list';

//促销
//$modules['02_promotion']['02_snatch_list']          = 'snatch.php?act=list'; //夺宝奇兵
$modules['02_promotion']['04_bonustype_list']       = 'bonus.php?act=list';
$modules['02_promotion']['06_pack_list']            = 'pack.php?act=list';
$modules['02_promotion']['07_card_list']            = 'card.php?act=list';
$modules['02_promotion']['08_group_buy']            = 'group_buy.php?act=list';
//$modules['02_promotion']['09_topic']                = 'topic.php?act=list'; //专题管理
//$modules['02_promotion']['10_auction']              = 'auction.php?act=list'; //拍卖活动
$modules['02_promotion']['12_favourable']           = 'favourable.php?act=list';
//$modules['02_promotion']['13_wholesale']            = 'wholesale.php?act=list'; //批发管理
//$modules['02_promotion']['14_package_list']         = 'package.php?act=list'; //超值礼包
$modules['02_promotion']['15_exchange_goods']       = 'exchange_goods.php?act=list';

//订单
$modules['03_order']['02_order_list']               = 'order.php?act=list';
$modules['03_order']['03_order_query']              = 'order.php?act=order_query';
$modules['03_order']['04_merge_order']              = 'order.php?act=merge';
$modules['03_order']['05_edit_order_print']         = 'order.php?act=templates';
$modules['03_order']['06_undispose_booking']        = 'goods_booking.php?act=list_all';
$modules['03_order']['08_add_order']                = 'order.php?act=add';
$modules['03_order']['09_delivery_order']           = 'order.php?act=delivery_list';
$modules['03_order']['10_back_order']               = 'order.php?act=back_list';

//报表
$modules['04_stats']['flow_stats']                  = 'flow_stats.php?act=view';
$modules['04_stats']['searchengine_stats']          = 'searchengine_stats.php?act=view';
//$modules['04_stats']['z_clicks_stats']              = 'adsense.php?act=list';  //站外投放js
$modules['04_stats']['report_guest']                = 'guest_stats.php?act=list';
$modules['04_stats']['report_order']                = 'order_stats.php?act=list';
$modules['04_stats']['report_sell']                 = 'sale_general.php?act=list';
$modules['04_stats']['sale_list']                   = 'sale_list.php?act=list';
$modules['04_stats']['sell_stats']                  = 'sale_order.php?act=goods_num';
$modules['04_stats']['report_users']                = 'users_order.php?act=order_num';
$modules['04_stats']['visit_buy_per']               = 'visit_sold.php?act=list';

//文章
$modules['05_content']['03_article_list']           = 'article.php?act=list';
$modules['05_content']['02_articlecat_list']        = 'articlecat.php?act=list';
//$modules['05_content']['vote_list']                 = 'vote.php?act=list';  //在线调查
$modules['05_content']['article_auto']              = 'article_auto.php?act=list';

//会员
$modules['06_members']['03_users_list']             = 'users.php?act=list';
$modules['06_members']['04_users_add']              = 'users.php?act=add';
$modules['06_members']['05_user_rank_list']         = 'user_rank.php?act=list';
$modules['06_members']['06_list_integrate']         = 'integrate.php?act=list';
$modules['06_members']['08_unreply_msg']            = 'user_msg.php?act=list_all';
$modules['06_members']['09_user_account']           = 'user_account.php?act=list';
$modules['06_members']['10_user_account_manage']    = 'user_account_manage.php?act=list';

//权限
$modules['07_priv_admin']['admin_list']             = 'privilege.php?act=list';
$modules['07_priv_admin']['admin_role']             = 'role.php?act=list';
$modules['07_priv_admin']['admin_logs']             = 'admin_logs.php?act=list';
$modules['07_priv_admin']['agency_list']            = 'agency.php?act=list';
$modules['07_priv_admin']['suppliers_list']         = 'suppliers.php?act=list'; // 供货商

//模块
$modules['08_module']['myad_list']                  = 'my_ad.php?act=list';
//$modules['08_module']['ad_position']                = 'ad_position.php?act=list'; //广告位置
//$modules['08_module']['ad_list']                    = 'ads.php?act=list'; //广告列表
$modules['08_module']['08_friendlink_list']         = 'friend_link.php?act=list';
//$modules['08_module']['02_template_select']       = 'template.php?act=list'; //模板选择
//$modules['08_module']['03_template_setup']        = 'template.php?act=setup'; //模板设置
//$modules['08_module']['04_template_library']      = 'template.php?act=library'; //库项目管理
$modules['08_module']['05_edit_languages']        = 'edit_languages.php?act=list';
//$modules['08_module']['06_template_backup']       = 'template.php?act=backup_setting'; //模板设置备份
$modules['08_module']['mail_template_manage']     = 'mail_template.php?act=list';
$modules['08_module']['email_list']           = 'email_list.php?act=list';
$modules['08_module']['magazine_list']        = 'magazine_list.php?act=list';
//$modules['08_module']['attention_list']       = 'attention_list.php?act=list'; //关注管理
$modules['08_module']['view_sendlist']        = 'view_sendlist.php?act=list';

//系统
$modules['09_system']['01_shop_config']             = 'shop_config.php?act=list_edit';
$modules['09_system']['02_payment_list']            = 'payment.php?act=list';
$modules['09_system']['03_shipping_list']           = 'shipping.php?act=list';
$modules['09_system']['05_area_list']               = 'area_manage.php?act=list';
$modules['09_system']['captcha_manage']             = 'captcha_manage.php?act=main';
$modules['09_system']['ucenter_setup']              = 'integrate.php?act=setup&code=ucenter';
$modules['09_system']['navigator']                  = 'navigator.php?act=list';
$modules['09_system']['021_reg_fields']             = 'reg_fields.php?act=list';
$modules['09_system']['04_mail_settings']           = 'shop_config.php?act=mail_settings'; //邮件服务器设置
$modules['09_system']['affiliate']                     = 'affiliate.php?act=list';
$modules['09_system']['affiliate_ck']                  = 'affiliate_ck.php?act=list';
$modules['09_system']['02_db_manage']               = 'database.php?act=backup';
$modules['09_system']['03_db_optimize']             = 'database.php?act=optimize';
$modules['09_system']['04_sql_query']               = 'sql.php?act=main';
//$modules['09_system']['03_sms_send']                   = 'sms.php?act=display_send_ui'; //发送短信
$modules['09_system']['07_cron_schcron']            = 'cron.php?act=list'; //计划任务
//$modules['09_system']['sitemap']                    = 'sitemap.php'; //站点地图
//$modules['09_system']['file_check']                 = 'filecheck.php'; //文件检验
$modules['09_system']['check_file_priv']            = 'check_file_priv.php?act=check'; //文件权限检测

?>