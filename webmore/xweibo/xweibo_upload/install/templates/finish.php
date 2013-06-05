<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_LANG['done_title'];?></title>
<link rel="stylesheet" media="screen"  href="css/base.css"/>
</head>

<body>
	<div id="wrap">
		<!-- header -->
        <?php include_once dirname(__FILE__). '/header.php';?>
		<!-- end header -->
		<div id="main">
			<div class="content-box">
				<div class="step4 step-bg"></div>
				<div class="ct-mid">
					<div class="title-info">
					<h3 class="lh44"><span class="icon-finish all-bg"></span><?php if ($type == 'upgrade'):?><?php echo $_LANG['xweibo_finish_upgrade_install'];?><?php else:?><?php echo $_LANG['xweibo_finish_install'];?><?php endif;?></h3>
					</div>
					<ul class="">
						<?php if (($type=='repeat' || $type=='upgrade') && WB_USER_OAUTH_TOKEN && WB_USER_OAUTH_TOKEN_SECRET):?>
						<li>1、<?php echo $_LANG['xweibo_security_tip'];?></li>
						<li>2、<?php echo $_LANG['xweibo_clear_cache'];?></li>
						<li>3、<?php echo $_LANG['xweibo_api_warn'];?></li>
						<?php else:?>
						<li>1、<?php echo $_LANG['xweibo_admin_comment'];?></li>
						<li>2、<?php echo $_LANG['xweibo_security_tip'];?></li>
						<li>3、<?php echo $_LANG['xweibo_clear_cache'];?></li>
						<li>4、<?php echo $_LANG['xweibo_api_warn'];?></li>
						<?php endif;?>
					</ul>
					<?php if (($type=='repeat' || $type=='upgrade') && WB_USER_OAUTH_TOKEN && WB_USER_OAUTH_TOKEN_SECRET):?>
						<p class="btn-area">
						<a href="<?php echo $index_url;?>">去网站首页&gt;&gt;</a><a href="<?php echo $admin_url;?>">去管理后台&gt;&gt;</a>
						</p>
					<?php else:?>
						<div class="btn-area">
						<a href="<?php echo $admin_url;?>" class="btn-active-admin all-bg"></a>
						</div>
					<?php endif;?>
				</div>
				<div class="ct-bot"></div>
			</div>
		</div>
	</div>
<img src="http://beacon.x.weibo.com/a.gif?xt=in&akey=<?php echo WB_AKEY;?>&name=<?php echo urlencode(WB_USER_SITENAME);?>&content=<?php echo urlencode(WB_USER_SITEINFO);?>&ip=<?php echo get_real_ip();?>&pjt=<?php echo XWEIBO_PROJECT;?>&ver=<?php echo XWEIBO_VERSION;?>&domain=<?php echo urlencode($_SERVER['HTTP_HOST']);?>&random=<?php echo mt_rand();?>" style="display:none"/>
</body>
</html>
