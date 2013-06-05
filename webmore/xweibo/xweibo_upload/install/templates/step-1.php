<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_LANG['step1_title'];?></title>
<link rel="stylesheet" media="screen"  href="css/base.css"/>
</head>

<body>
	<div id="wrap">
		<!-- header -->
        <?php include_once dirname(__FILE__). '/header.php';?>
		<!-- end header -->
		<div id="main">
			<div class="content-box">
				<div class="step1 step-bg"></div>
				<div class="ct-mid">
					<h3><?php echo $_LANG['env_check'];?></h3>
					<table>
						<colgroup>
							<col style="width:15%;" />
							<col style="width:20%;" />
							<col style="width:25%;" />
							<col style="width:32%;" />
							<col style="width:8%;" />
						</colgroup>
						<tr>
							<th class="l-b"><?php echo $_LANG['project'];?></th>
							<th><?php echo $_LANG['xweibo_required'];?></th>
							<th><?php echo $_LANG['xweibo_best'];?></th>
							<th><?php echo $_LANG['curr_server'];?></th>
							<th class="r-b"><?php echo $_LANG['check_result'];?></th>	
						</tr>
						<?php if ($env_vars):?>
						<?php foreach ($env_vars as $key => $item):?>
							<tr>
								<td><?php echo $_LANG[$key];?></td>
								<td><?php echo $item['required'];?></td>
								<td><?php echo $item['best'];?></td>
								<td class="<?php echo $item['state'] ? $item['state'] : 'false';?>"><?php echo $item['curr'];?> </td>
								<td><span class="icon-<?php if ($item['state'] == true):?>true<?php else:?>false<?php endif;?>"></span></td>
							</tr>
<?php 
if ($item['state'] == false) {
	$env_error[$key] = $key;
}
?>
						<?php endforeach;?>
						<?php endif;?> 
					</table>
					<?php if (isset($env_error)):?>
					<div class="warn">
						<?php foreach ($env_error as $var):?>
						<p><?php echo $_LANG['error_'.$var];?></p>
						<?php endforeach;?>
					</div>
					<?php endif;?>
					<h3><?php echo $_LANG['priv_check'];?></h3>
					<table>
						<colgroup>
							<col style="width:60%;" />
							<col style="width:32%;" />
							<col style="width:8%;" />
						</colgroup>
						<tr>
							<th class="l-b"><?php echo $_LANG['dir_file'];?></th>
							<th><?php echo $_LANG['status'];?></th>
							<th class="r-b"><?php echo $_LANG['check_result'];?></th>
						</tr>
						<?php if ($dir_file_vars):?>
						<?php foreach ($dir_file_vars as $key => $item):?>
							<tr>
								<td><?php echo $key;?>  </td>
								<td class="<?php echo $item['state'] ? $item['state'] : 'false';?>"><?php echo $_LANG[$item['w']];?></td>
								<td><span class="icon-<?php if ($item['state'] == true):?>true<?php else:?>false<?php endif;?>"></span></td>
							</td>
						</tr>
<?php 
if ($item['state'] == false) {
	$dir_error[$key] = $key;
}
?>
						<?php endforeach;?>
						<?php endif;?>
					</table>
					<?php if (isset($dir_error)):?>
					<div class="warn">
						<?php foreach ($dir_error as $var):?>
						<p><?php echo $_LANG['error_'.$var];?></p>
						<?php endforeach;?>
					</div>
					<?php endif;?>
					<h3><?php echo $_LANG['func_depend'];?></h3>
					<table>
						<colgroup>
							<col style="width:60%;" />
							<col style="width:32%;" />
							<col style="width:8%;" />
						</colgroup>
						<tr>
							<th class="l-b"><?php echo $_LANG['func_name'];?></th>
							<th><?php echo $_LANG['status'];?></th>
							<th class="r-b"><?php echo $_LANG['check_result'];?></th>
						</tr>
						<?php if ($func_vars):?>
						<?php foreach ($func_vars as $key => $item):?>
						<tr>
							<td><?php echo $key;?>  </td>
							<td class="<?php echo $item['state'] ? $item['state'] : 'false';?>"><?php echo $_LANG[$item['s']];?></td>
							<td><span class="icon-<?php if ($item['state'] == true):?>true<?php else:?>false<?php endif;?>"></span></td>
						</tr>
<?php 
if ($item['state'] == false) {
	$fun_error[$key] = $key;
}
?>
						<?php endforeach;?>
						<?php endif;?>
					</table>
					<?php if (isset($fun_error)):?>
					<div class="warn">
						<?php foreach ($fun_error as $var):?>
						<p><?php echo $_LANG['error_'.$var];?></p>
						<?php endforeach;?>
					</div>
					<?php endif;?>
					<div class="btn-area">
						<a href="index.php?step=1" class="btn-common all-bg mr50"><span><?php echo $_LANG['check_again_button'];?></span></a>
						<?php if ($disabled == true):?>
						<a href="index.php?step=2" class="btn-common all-bg"><span><?php echo $_LANG['next_button'];?></span></a>
						<?php else:?>
						<span class="btn-common-disabled all-bg"><?php echo $_LANG['next_button'];?></span>
						<?php endif;?>
					</div>
				</div>
				<div class="ct-bot"></div>
			</div>
		</div>
	</div>
</body>
</html>

