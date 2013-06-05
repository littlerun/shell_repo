<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_LANG['step3_title'];?></title>
<link rel="stylesheet" media="screen"  href="css/base.css"/>
</head>

<body>
	<div id="wrap">
		<!-- header -->
        <?php include_once dirname(__FILE__). '/header.php';?>
		<!-- end header -->
		<div id="main">
			<div class="content-box">
				<div class="step2 step-bg"></div>
				<form name="theForm" action="index.php?step=4" method="post" class="step">
				<div class="ct-mid">
					<div class="title-info">
					<h3><?php echo $_LANG['database_cache_tip'];?><span>(<?php echo $_LANG['database_comment'];?>)</span></h3>
					</div>
					<div class="form-row">
						<label for=""><span>*</span><?php echo $_LANG['db_host'];?>：</label>
						<input type="text" name="db_host" id="db_host" value="<?php echo DB_HOST ? DB_HOST : 'localhost';?>"/>
						<div class="check-tips-box tips-wrong" id="db_host_msg">
							<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
						</div>
						<div class="tips-correct" id="db_host_tips"><span class="icon-correct icon-bg"></span></div>
						<p><?php echo $_LANG['dbhost_comment'];?></p>
					</div>
					<div class="form-row">
						<label for=""><span>*</span><?php echo $_LANG['db_user'];?>：</label>
						<input type="text" name="db_user" id="db_user" value="<?php echo DB_USER ? htmlspecialchars(DB_USER) : '';?>"/>
						<div class="check-tips-box tips-wrong" id="db_user_msg">
							<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
						</div>
						<div class="tips-correct" id="db_user_tips"><span class="icon-correct icon-bg"></span></div>
					</div>
					<div class="form-row">
						<label for=""><span>*</span><?php echo $_LANG['db_passwd'];?>：</label>
						<input type="password" name="db_passwd" id="db_passwd" novaild="true" value=""/>
						<div class="check-tips-box tips-wrong" id="db_passwd_msg">
							<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
						</div>
						<div class="tips-correct" id="db_passwd_tips"><span class="icon-correct icon-bg"></span></div>
					</div>
					<div class="form-row">
						<label for=""><span>*</span><?php echo $_LANG['db_name'];?>：</label>
						<input type="text" name="db_name" id="db_name" value="<?php echo DB_NAME ? htmlspecialchars(DB_NAME) : '';?>"/>
						<div class="check-tips-box tips-wrong" id="db_name_msg">
							<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
						</div>
						<div class="tips-correct" id="db_name_tips"><span class="icon-correct icon-bg"></span></div>
					</div>
					<div class="form-row">
						<label for=""><span>*</span><?php echo $_LANG['db_prefix'];?>：</label>
						<input type="text" name="db_prefix" id="db_prefix" value="<?php echo DB_PREFIX ?  htmlspecialchars(DB_PREFIX) : XWEIBO_DB_PREFIX;?>"/>
						<div class="check-tips-box tips-wrong" id="db_prefix_msg">
							<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
						</div>
						<div class="tips-correct" id="db_prefix_tips"><span class="icon-correct icon-bg"></span></div>
						<p><?php echo $_LANG['tablepre_comment'];?></p>
					</div>
					<div class="form-row">
						<label for=""><span>*</span><?php echo $_LANG['wb_lang_type'];?>：</label>
						<select name="wb_lang_type" id="wb_lang_type" novaild="true">
						<option value="zh_cn" selected><?php echo $_LANG['lang_zh_cn'];?></option>
						<option value="zh_tw"><?php echo $_LANG['lang_zh_tw'];?></option>
						<!--
						<option value="en"><?php //echo $_LANG['lang_en'];?></option>
						-->
						</select>
						<div class="tips-correct" id="wb_lang_type_tips"><span class="icon-correct icon-bg"></span></div>
						<p><?php echo $_LANG['wb_lang_type_comment'];?></p>
					</div>
					<div class="attach">
						<label for=""><input type="checkbox" name="cover" value="2" /><?php echo $_LANG['is_cover_database_tip'];?></label>
						<p><?php echo $_LANG['install_attention'];?></p>
						<p><?php echo $_LANG['install_attention_note1'];?></p>
						<p><?php echo $_LANG['install_attention_note2'];?></p>
					</div>
					<fieldset>
						<legend><label for="usecache"><input type="checkbox" name="cache" onclick="choose_mc()" value="1" <?php if (isset($cache) && $cache == 1):?> checked="checked" <?php endif;?> class="cbox" /><?php echo $_LANG['user_memcache'];?></label></legend>
						<div id="mc_host_area" class="form-row-disable">
							<label for="" id="mc_host_notice"><?php echo $_LANG['mc_host'];?>：</label><input type="text" name="mc_host" disabled="disabled" id="mc_host"/>
							<div class="check-tips-box tips-wrong" id="mc_host_msg">
								<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
							</div>
							<div class="tips-correct" id="mc_host_tips"><span class="icon-correct icon-bg"></span></div>
						</div>
						<div id="mc_port_area" class="form-row-disable">
							<label for="" id="mc_port_notice"><?php echo $_LANG['mc_port'];?>：</label><input type="text" name="mc_port" disabled="disabled" id="mc_port"/>
							<div class="check-tips-box tips-wrong" id="mc_port_msg">
								<p><span class="icon-wrong icon-bg"></span><?php echo $_LANG['js_check_input_empty'];?></p>
							</div>
							<div class="tips-correct" id="mc_port_tips"><span class="icon-correct icon-bg"></span></div>
						</div>
					</fieldset>
					<div class="btn-area">
						<a href="index.php?step=1" class="btn-common all-bg mr50"><span><?php echo $_LANG['pre_button'];?></span></a>
						<a href="javascript:f_submit();" class="btn-common all-bg"><span><?php echo $_LANG['next_button'];?></span></a>
					</div>
				</div>
				</form>
				<div class="ct-bot"></div>
			</div>
		</div>
	</div>
</script>
</body>
</html>
<script>
(function(){
		var
			isIE = function(){
				if (navigator.appName == 'Microsoft Internet Explorer') {
					return true;
				 }
				return false;
			}

			trim = function(text){
				return (text || "").replace( /^\s+|\s+$/g, "").replace(/^　+|　+$/g, "");
			}

			choose_mc = function(cache){
				if (document.theForm.cache.checked == false) {
					document.getElementById('mc_host').disabled = 'disabled';
					document.getElementById('mc_port').disabled = 'disabled';
					if (isIE()) {
						document.getElementById('mc_host').novaild = 'true';
						document.getElementById('mc_port').novaild = 'true';
					} else {
						document.getElementById('mc_host').setAttribute('novaild', 'true');
						document.getElementById('mc_port').setAttribute('novaild', 'true');
					}
					document.getElementById('mc_host_area').className = 'form-row-disable';
					document.getElementById('mc_port_area').className = 'form-row-disable';
					document.getElementById('mc_host_notice').innerHTML = '<?php echo $_LANG['mc_host'];?>:';
					document.getElementById('mc_port_notice').innerHTML = '<?php echo $_LANG['mc_port'];?>:';
					document.getElementById('mc_host_msg').style.display = 'none';
					document.getElementById('mc_port_msg').style.display = 'none';
				} else {
					document.getElementById('mc_host').disabled = '';
					document.getElementById('mc_port').disabled = '';
					if (isIE()) {
						document.getElementById('mc_host').novaild = '';
						document.getElementById('mc_port').novaild = '';
					} else {
						document.getElementById('mc_host').setAttribute('novaild', '');
						document.getElementById('mc_port').setAttribute('novaild', '');
					}
					document.getElementById('mc_host_area').className = 'form-row';
					document.getElementById('mc_port_area').className = 'form-row';
					document.getElementById('mc_host_notice').innerHTML = '<span>*</span><?php echo $_LANG['mc_host'];?>:';
					document.getElementById('mc_port_notice').innerHTML = '<span>*</span><?php echo $_LANG['mc_port'];?>:';

					if(window.addEventListener){  //FF
						document.getElementById('mc_host').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_host_msg').style.display = 'none';document.getElementById('mc_host_tips').style.display = 'block';}}, false);
						document.getElementById('mc_host').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_host_msg').style.display = 'inline-block';document.getElementById('mc_host_tips').style.display = '';}}, false);
						document.getElementById('mc_port').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_port_msg').style.display = 'none';document.getElementById('mc_port_tips').style.display = 'block';}}, false);
						document.getElementById('mc_port').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_port_msg').style.display = 'inline-block';document.getElementById('mc_port_tips').style.display = '';}}, false);
					}else{  //IE chrome
						document.getElementById('mc_host').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_host_msg').style.display = 'none';document.getElementById('mc_host_tips').style.display = 'block';}});
						document.getElementById('mc_host').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_host_msg').style.display = 'inline-block';document.getElementById('mc_host_tips').style.display = '';}});
						document.getElementById('mc_port').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_port_msg').style.display = 'none';document.getElementById('mc_port_tips').style.display = 'block';}});
						document.getElementById('mc_port').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_port_msg').style.display = 'inline-block';document.getElementById('mc_port_tips').style.display = '';}});
					}
				}

				if (cache == '1') {
					document.getElementById('mc_host').disabled = '';
					document.getElementById('mc_port').disabled = '';
					if (isIE()) {
						document.getElementById('mc_host').novaild = '';
						document.getElementById('mc_port').novaild = '';
					} else {
						document.getElementById('mc_host').setAttribute('novaild', '');
						document.getElementById('mc_port').setAttribute('novaild', '');
					}
					document.getElementById('mc_host_notice').innerHTML = '<span>*</span><?php echo $_LANG['mc_host'];?>:';
					document.getElementById('mc_port_notice').innerHTML = '<span>*</span><?php echo $_LANG['mc_port'];?>:';
					document.getElementById('mc_host').value = '<?php echo isset($mc_host) ? htmlspecialchars($mc_host) : '';?>';
					document.getElementById('mc_port').value = '<?php echo isset($mc_port) ? htmlspecialchars($mc_port) : '';?>';

					if(window.addEventListener){  //FF
						document.getElementById('mc_host').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_host_msg').style.display = 'none';document.getElementById('mc_host_tips').style.display = 'block';}}, false);
						document.getElementById('mc_host').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_host_msg').style.display = 'inline-block';document.getElementById('mc_host_tips').style.display = '';}}, false);
						document.getElementById('mc_port').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_port_msg').style.display = 'none';document.getElementById('mc_port_tips').style.display = 'block';}}, false);
						document.getElementById('mc_port').addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_port_msg').style.display = 'inline-block';document.getElementById('mc_port_tips').style.display = '';}}, false);
					}else{  //IE chrome
						document.getElementById('mc_host').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_host_msg').style.display = 'none';document.getElementById('mc_host_tips').style.display = 'block';}});
						document.getElementById('mc_host').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_host_msg').style.display = 'inline-block';document.getElementById('mc_host_tips').style.display = '';}});
						document.getElementById('mc_port').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById('mc_port_msg').style.display = 'none';document.getElementById('mc_port_tips').style.display = 'block';}});
						document.getElementById('mc_port').attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById('mc_port_msg').style.display = 'inline-block';document.getElementById('mc_port_tips').style.display = '';}});
					}
				}
			}

			f_submit = function(){
				var i, sign = true;
				for(i = 0; i < document.theForm.elements.length; i++) {
					if (typeof document.theForm.elements[i].name == 'undefined') {
						continue;
					}
					if (isIE()) {
						if (document.theForm.elements[i].novaild) {
							continue;
						}
					} else {
						if (document.theForm.elements[i].getAttribute('novaild')) {
							continue;
						}
					}

					if (document.theForm.elements[i].type == 'text' || document.theForm.elements[i].type == 'textarea') {
						if (trim(document.theForm.elements[i].value) == '') {
							document.getElementById(document.theForm.elements[i].name+'_msg').style.display = 'inline-block';
							sign = false;
						} else {
							document.getElementById(document.theForm.elements[i].name+'_msg').style.display = 'none';
						}
					}
				}

				if (sign == true) {
					document.theForm.submit();
				}
				return;
			}

		//初始化mc输入框
		choose_mc('<?php echo isset($cache) ? $cache : 0;?>');

		//初始化表单输入框检测
		for(i = 0; i < document.theForm.elements.length; i++) {
			if (document.theForm.elements[i].name == '') {
				continue;
			}
			if (typeof document.theForm.elements[i].name == 'undefined') {
				continue;
			}
			if (document.theForm.elements[i].name == 'cache' || document.theForm.elements[i].name == 'cover') {
				continue;
			}
			if (isIE()) {
				if (document.theForm.elements[i].novaild) {
					continue;
				}
			} else {
				if (document.theForm.elements[i].getAttribute('novaild')) {
					continue;
				}
			}

			if (trim(document.theForm.elements[i].value) != '') {
				document.getElementById(document.theForm.elements[i].name+'_msg').style.display = 'none';
				document.getElementById(document.theForm.elements[i].name+'_tips').style.display = 'block';
			}

			if(window.addEventListener){  //FF
				document.getElementById(document.theForm.elements[i].name).addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById(target.name+'_msg').style.display = 'none';document.getElementById(target.name+'_tips').style.display = 'block';}}, false);
				document.getElementById(document.theForm.elements[i].name).addEventListener("blur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById(target.name+'_msg').style.display = 'inline-block';document.getElementById(target.name+'_tips').style.display = '';}}, false);
			}else{  //IE chrome
				document.getElementById(document.theForm.elements[i].name).attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) != ''){document.getElementById(target.name+'_msg').style.display = 'none';document.getElementById(target.name+'_tips').style.display = 'block';}});
				document.getElementById(document.theForm.elements[i].name).attachEvent("onblur", function(evt){var evt = window.event?window.event:evt,target=evt.srcElement||evt.target;if (trim(target.value) == ''){document.getElementById(target.name+'_msg').style.display = 'inline-block';document.getElementById(target.name+'_tips').style.display = '';}});
			}
		}
})();
</script>
