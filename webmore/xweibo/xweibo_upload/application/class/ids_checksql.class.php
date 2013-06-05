<?php
/**
 * 软式IDS之MYSQL SQL语句相关
 * 本文件修改自80sec出品的mysqlids，在此特别鸣谢
 * 相关资料请参见以下链接
 * @link http://www.80sec.com/dedecms-with-mysqlids8.html
 * @link http://safe.it168.com/a2009/0224/266/000000266608.shtml
 * @author 80sec {@link http://www.80sec.com/}
 * @version $Id: ids_checksql.class.php 18257 2011-12-01 10:09:53Z yaoying $
 */
class ids_checksql{
	
	/**
	 * 最后一次SQL检查错误信息
	 * @var string
	 */
	var $_error = '';
	
	/**
	 * 默认的检查参数
	 * @var array
	 */
	var $_setting_def = array(
		'sub_select_allow' => false,    //是否允许子查询？默认不允许
		'union_select_allow' => false,  //是否允许union select？默认不允许
		/*
		是否执行对双引号内容的替换再进行注释符检查？
		此选项将降低安全性，但将最大程度兼容SQL语句
		由于本选项存在，本流程已经更改了80sec原始版本，请谨慎评估，建议设置为false
		*/
		'double_quot_preg_replace' => true,
	);
	
	/**
	 * 当前的检查参数
	 * 警告！当设置相关参数时，请务必预知带来的后果，并且已经做好充足的防止注入准备。
	 * 另外，每次调用checksql时，将会被设置回默认值
	 * @var array
	 */
	var $_setting_cur = array();
	
	/**
	 * 设置检查参数，可以用数组设置
	 * @param array|string $k
	 * @param mixed $v
	 */
	function setting($k, $v = null){
		if(is_array($k)){
			$this->_setting_cur = array_merge($this->_setting_cur, $k);
		}else{
			$this->_setting_cur[$k] = $v;
		}
	}
	
	/**
	 * 对SQL进行检查
	 * @param string $db_string
	 * @return bool 检查结果。false时，请调用error获知false原因
	 */
	function check($db_string){
		if(!empty($this->_setting_cur)){
			$setting = array_merge($this->_setting_def, $this->_setting_cur);
		}else{
			$setting = $this->_setting_def;
		}
		$this->reset();
		
		$clean = '';
		$error=$fail='';
		$old_pos = 0;
		$pos = -1;
		
		//完整的SQL检查
		while (true)
		{
			$pos = strpos($db_string, '\'', $pos + 1);
			if ($pos === false)
			{
				break;
			}
			$clean .= substr($db_string, $old_pos, $pos - $old_pos);
			while (true)
			{
				$pos1 = strpos($db_string, '\'', $pos + 1);
				$pos2 = strpos($db_string, '\\', $pos + 1);
				if ($pos1 === false)
				{
					break;
				}
				elseif ($pos2 == false || $pos2 > $pos1)
				{
					$pos = $pos1;
					break;
				}
				$pos = $pos2 + 1;
			}
			$clean .= '$s$';
			$old_pos = $pos + 1;
		}
		$clean .= substr($db_string, $old_pos);
		$clean = trim(strtolower(preg_replace(array('~\s+~s' ), array(' '), $clean)));
		

		
		/*
		 * 初步检查，如发现，在后续的某些preg_match必须继续进行检查
	 	 * 请注意在此处修改后，继续对下面preg_match的对应部分进行修改！
		 */
		$_first_check_ok = true;
		foreach(array('sleep', 'benchmark', 'load_file', 'like0x', 'outfile', 'dumpfile') as $_action){
			if(strpos($clean, $_action) !== false){
				$_first_check_ok = false;
				break;
			}
		}
		
		//老版本的Mysql并不支持union，常用的程序里也不使用union，但是一些黑客使用它，所以检查它
		if (!$setting['union_select_allow'] && strpos($clean, 'union') !== false && preg_match('~(^|[^a-z])union($|[^[a-z])~s', $clean) != 0)
		{
			$fail = true;
			$error="union detect";
		}
		
		//这些函数不会被使用，但是黑客会用它来操作文件，down掉数据库
		/*
		 * 2011-11-10改进：
		 * 原逻辑中，strpos并非最终条件，故调离出前面进行整合初步检查以节省资源
		 * 后续preg_match判断中相同的逻辑合并，方便扩展
		 */
		elseif (!$_first_check_ok && preg_match('~(^|[^a-z])(?:sleep|benchmark|load_file|like0x)($|[^[a-z])~s', $clean) != 0)
		{
			$fail = true;
			$error="action 'sleep/benchmark/load_file/like0x' detect";
		}
		elseif (!$_first_check_ok && preg_match('~(^|[^a-z])into\s+(?:outfile|dumpfile)($|[^[a-z])~s', $clean) != 0)
		{
			$fail = true;
			$error="action 'into outfile/dumpfile' detect";
		}
		
		//老版本的MYSQL不支持子查询，我们的程序里可能也用得少，但是黑客可以使用它来查询数据库敏感信息
		elseif (!$setting['sub_select_allow'] && preg_match('~\([^)]*?select~s', $clean) != 0)
		{
			$fail = true;
			$error="sub select detect";
		}
		
		if (empty($fail)){
			//对双引号的额外处理
			if($setting['double_quot_preg_replace'] && strpos($clean, '"') !== false){
				$clean = preg_replace("#\"(?:\\\\.|.)+?\"#sim", '"$s$"', $clean);
			}			
			
			//发布版本的程序可能比较少包括--,#这样的注释，但是黑客经常使用它们
			if (strpos($clean, '/*') > 2 || strpos($clean, '--') !== false || strpos($clean, '#') !== false)
			{
				$fail = true;
				$error="comment detect";
			}
		}
		
		if (!empty($fail))
		{
			$this->_error = $error;
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	/**
	 * 重置所有当前设置和上一次检查结果
	 */
	function reset(){
		$this->_error = '';
		$this->_setting_cur = array();
	}
	
	/**
	 * 获取上一次的检查错误原因
	 * @return string
	 */
	function error(){
		return $this->_error;
	}
	
}