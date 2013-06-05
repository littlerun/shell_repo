<?php
    /**
     * 获取request_uri
     * @return string
     */
    function get_request_url(){
    	if(isset($_SERVER['REQUEST_URI'])){
    		return $_SERVER['REQUEST_URI'];
    	}
        if(isset($_SERVER['PHP_SELF'])){
	        if(isset($_SERVER['argv'][0])){
                return $_SERVER['PHP_SELF']. '?'. $_SERVER['argv'][0];
	        }elseif(isset($_SERVER['QUERY_STRING'])){
		        return $_SERVER['PHP_SELF']. '?'. $_SERVER['QUERY_STRING'];
	        }else{
		        return $_SERVER['PHP_SELF'];
	        }
        }else{
	        return '_UNKNOWN_URI_';
        }
    }