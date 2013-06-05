<?php

/**
 * Service class of RestfulIClient
 * 
 * Support function as follow:
 * 1.Singleton create instance of RestfulIClient;
 * 2.privode some static access method of RestfulIClient.
 *
 * @author lukezhang
 */
class RestfulIClientService {
    private static $inst = null;
    
    /**
     * Singleton create instance of RestfulIClient;
     * @return RestfulIClient 
     */
    public static function getInstance() {
        if(empty($inst)) {
            self::$inst = new RestfulICient();
        }//endif
        //return instance of RestfulICient
        return self::$inst;
    }

    public static function get($url,$parameters=array()) {
        return self::getInstance()->get($url,$parameters);
    }
    
    public static function post($url,$parameters=array()) {
        return self::getInstance()->post($url,$parameters);
    }
}//RestfulIClientService



?>
