<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_LANG['xweibo_uninstall_title'];?></title>
<link rel="stylesheet" media="screen"  href="css/style.css"/>
</head>

<body>
   <div id="wrap">
     <div id="main" >
     
        <?php include_once dirname(__FILE__). '/header.php';?>
        
        <div id="content">
          <div class="content-inner">
            <div class="top"></div>
            <div class="middle">
              <div class="pad">
                <h3><?php echo $_LANG['xweibo_uninstall_h3_title'];?></h3>
                <div class="step-area">
                  <div class="top light-blue-t"></div>
                  <div class="middle light-blue-m clear">
                    <div class="block">
                      <span class="icon" id="show_icon"><img src="img/icon2.gif" /></span>
                      <div id="show_tip">
                        
                        <p>1.<?php echo $_LANG['xweibo_uninstall_comment1'];?></p>
                        <p>2.<?php echo $_LANG['xweibo_uninstall_comment2'];?></p>
                        <p>3.<?php echo $_LANG['xweibo_uninstall_comment3'];?></p>
                        <p>4.<?php echo $_LANG['xweibo_uninstall_comment4'];?></p>
						<p><input type="checkbox" value="1" id="backup" name="backup" checked="checked" /> 是否保留数据</p>
                      </div>
                    </div>
                  </div>
                  <div class="bottom light-blue-b"></div>
                </div>
                
              </div>
              <p class="tips" id="tip_notice"><?php echo $_LANG['xweibo_uninstall_notice'];?></p>
              <p class="tips" id="show_btn"><a href="javascript:void(0)" onclick="uninstall()"><img src="img/btn2.gif" /></a></p>
            </div>
            
            <div class="bottom"></div>
            
          </div>
          
          
          
        </div>
     </div>
   </div>
<script>
var request;
function createRequest() {
  try {
    request = new XMLHttpRequest();
  } catch (trymicrosoft) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (othermicrosoft) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = false;
      }
    }
  }
  if (!request)
    alert("Error initializing XMLHttpRequest!");
}

function uninstall()
{
	var backup = '';
	if (document.getElementById('backup').checked == true) {
		backup = document.getElementById('backup').value;
	}
	document.getElementById('show_icon').innerHTML = '<img src="img/icon2.gif" />';
	document.getElementById('show_icon').style.width = '6%';
	document.getElementById('show_icon').style.paddingLeft = '20px';
	document.getElementById('show_tip').innerHTML = '<p><?php echo $_LANG['xweibo_uninstalling'];?></p>';
	createRequest();
	url = 'uninstall.php?method=uninstall&backup='+backup;
	request.open("POST", url, true);
	request.onreadystatechange = view_tip;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send('');
}

function view_tip()
{
	if (request.readyState == 4) {
		if (request.status == 200) {
			 var result = request.responseText;
			 if (result == '1') {
				document.getElementById('show_icon').innerHTML = '<img src="img/icon1.gif" />';
				document.getElementById('show_icon').style.width = '';
				document.getElementById('show_icon').style.paddingLeft = '';
				document.getElementById('show_tip').innerHTML = '<p><strong><?php echo $_LANG['xweibo_uninstall_done'];?></strong></p><p><?php echo $_LANG['xweibo_uninstalled_notice'];?></p>';
				document.getElementById('show_btn').style.display = 'none';
			 } else {
				document.getElementById('show_icon').innerHTML = '<img src="img/icon4.gif" />';
				document.getElementById('show_icon').style.width = '';
				document.getElementById('show_icon').style.paddingLeft = '';
				document.getElementById('show_tip').innerHTML = '<p><strong><?php echo $_LANG['xweibo_uninstall_error'];?></strong></p>';
				document.getElementById('tip_notice').innerHTML = result;
//				document.getElementById('show_btn').style.display = 'none';
			 }
		} else {
			alert("status is " + request.status);
		}
	}
}
</script>
</body>
</html>
