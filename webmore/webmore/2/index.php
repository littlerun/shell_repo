<?php
//Includeing restful interface client
include_once 'class/class.RestfulIClientService.php';
//
//$url = "https://w3-sso.toronto.ca.ibm.com/pkmslogin.form";
//
//$reqdata = array(    
//"username"=>"zhsongdl@cn.ibm.com",
//"password"=>"8fxes0hyPU",
//"login-form-type"=>"pwd",
//"submitButton"=>"Submit",
//"cancelButton"=>"",
//"resumeSession"=>"true",
//"returnurl"=>"%2Fmyportal"    
//);
//
//$response = RestfulIClientService::post($url,$reqdata);


$response = RestfulIClientService::get("https://w3-sso.toronto.ca.ibm.com/tools/cm/ecm/filegen/publish/ICE_NEXTGEN_PAGE_JOB/services/us/en/it-services/ibm-Implementation-services-for-system-z-it-process-automation.html");

echo $response;


/**
if (!(SaeMC::$handler = @(memcache_init()))) {
    header("Content-Type:text/html; charset=utf-8");
    exit('您的Memcache还没有初始化，请登录SAE平台进行初始化~');
}
register_shutdown_function(array('SaeMC', 'error'));


SaeMC::set('test.php', '<?php echo "hello world"?>'); //设置缓存内容
SaeMC::include_file('test.php'); //执行缓存文件
 * 
 */
//var_dump(SaeMC::filemtime('test.php'));//获得缓存文件生成时间
//var_dump(SaeMC::file_exists('test.php'));//判断文件是否存在
?>
