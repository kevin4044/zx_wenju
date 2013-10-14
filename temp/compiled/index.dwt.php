<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta name="Generator" content="Xakshop V5.0" />
    <meta charset="utf-8"/>
    
    <title><?php echo $this->_var['page_title']; ?></title>
    
    <meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>"/>
    <meta name="Description" content="<?php echo $this->_var['description']; ?>"/>
    
    
    <!--
<link href="<?php echo $this->_var['xak_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common2.js,json2.js,index.js')); ?>
-->
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="/tools/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/themes/default/common.js"></script>
    <link rel="stylesheet" href="/tools/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/tools/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/themes/default/common.css"/>
</head>
<body>
    <div class="navbar navbar-default m-topnav">
        <div class="container">
            <p class="navbar-text u-small">
               欢迎来到洲翔文具,精彩每一天!
            </p>
            <ul class="nav navbar-nav ">
                <li >
                    <a class="u-small" href="">登录</a>
                </li>
                <li >
                    <a class="u-small" href="">注册</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li>
                    <a class="u-small" href="">
                        <img class="u-weibo" src="/themes/default/images/weixin.png" alt="微信"/>微信
                    </a>
                </li>
                <li>
                    <a class="u-small" href="">
                        <img class="u-weibo" src="/themes/default/images/weibo.png" alt="微博"/>微博
                    </a>
                </li>
                <li class="navbar-text u-small">服务热线：123-123-123</li>
            </ul>
        </div>
    </div>
    
    <div class="container g-logo">
        <div class="pull-left">
            <a href="/">
                <img src="/themes/default/images/logo.png" alt="洲翔文具，精彩每一天"/>
            </a>
        </div>
        <form class="form-inline" action="/search.php">
            <div class="form-group m-searchbar">
                <input class="u-text" type="text" name="keywords" placeholder="请输入关键字"/>
                <button class="btn btn-link u-submit" type="submit" >搜索</button>
                <p class="help-block">热门搜索：1,1,2,2,3,4</p>
            </div>
        </form>
    </div>
    <div class="navbar navbar-default s-navbar" role="navigation" id="main-nav">
        <div class="container collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown s-black u-first-nav" data-toggle="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        全部商品分类
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li></li>
                    </ul>
                </li>
                <li>
                    <a href="/" title="首页">首页</a>
                </li>
                <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
                <li>
                    <a href="<?php echo $this->_var['nav']['url']; ?>" title="<?php echo $this->_var['nav']['name']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?>target="_blank" <?php endif; ?> ><?php echo $this->_var['nav']['name']; ?></a>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right" >
                <li>
                    <a href="">
                        <img src=""  alt=""/>
                        我的购物车
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <ul class="nav nav-stacked m-stack-nav" id="product-tree">
            <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['index_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['index_categories']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['index_categories']['iteration']++;
?>
            <li class="product-toggle">

                <a class="u-left-a s-dark" href="<?php echo $this->_var['cat']['url']; ?>">
                    <?php echo htmlspecialchars($this->_var['cat']['name']); ?>
                    <small><?php echo $this->_var['cat']['keywords']; ?></small>
                </a>
                <div class="m-out-nav">
                    <ul>
                        <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['index_child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['index_child']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['index_child']['iteration']++;
?>
                        <?php if (! ($this->_foreach['index_child']['iteration'] <= 1)): ?>
                        <span style="color: #aca6a5">|&nbsp;&nbsp;</span>
                        <?php endif; ?>
                        <li>
                            <a class="s-dark" href="<?php echo $this->_var['child']['url']; ?>"><small><?php echo htmlspecialchars($this->_var['child']['name']); ?></small> </a>
                        </li>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </ul>
                </div>

            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <script type="text/javascript">
            $('.product-toggle').hover(function(){
                $(this).find('.m-out-nav ').show();
            }, function() {
                $(this).find('.m-out-nav').hide();
            })
        </script>
        <div class="u-index-adv col-md-7" >
            <?php echo $this->_var['myad_index_banner']; ?>
            <p class="u-bottom">猜你喜欢</p>
            <div class="m-likelist">
                <?php $_from = $this->_var['guess_u_like']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['item']['iteration']++;
?>
                <div class="col-md-4 u-nopadding">
                    <a href="<?php echo $this->_var['item']['link']; ?>">
                        <img src="<?php echo $this->_var['item']['pic']; ?>"/>
                    </a>
                </div>

                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
        <div class="g-index-mid-right">
            <div class="u-index-bannerright">
                <ul class="nav nav-tabs">
                    <li class="active u-title"><a href="#tab_1" data-toggle="tab">最新动态</a></li>
                    <li class="u-title"><a href="#tab_2" data-toggle="tab">商城公告</a></li>
                </ul>
                <div class="tab-content u-tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <ul>
                            <?php $_from = $this->_var['new_actives']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'active');$this->_foreach['active'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['active']['total'] > 0):
    foreach ($_from AS $this->_var['active']):
        $this->_foreach['active']['iteration']++;
?>
                            <li><a href="<?php echo $this->_var['active']['url']; ?>"><?php echo $this->_var['active']['title']; ?></a></li>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                    </div>
                    <div id="tab_2" class="tab-pane">
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="u-sale-pic">
                <?php echo $this->_var['myad_index_sale']; ?>
            </div>
        </div>


    </div>


</body>
</html>