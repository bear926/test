<?php
defined('IND') or die('No direct script access.');


class URL {
	public $adr = array();

	/**
	 * Dfghjkl.
	 *
	 * @param strig $cl
	 *   Dsdfrsdf.
	 *
	 * @return $
	 *   Dsdzfdxgfd.
	 */
	function explod(){
		$adr = explode('/', $_SERVER['REQUEST_URI']);
		return $adr[count($adr)-1];
	}
	
	
	
	function lang($lang='en'){
			$adr = explode('/', $_SERVER['REQUEST_URI']);
			foreach($adr as $k){
				if(($k == "ua") or ($k == "ru") or ($k == "en")){
					$v = $k;
					break;
				}
			}		
			if($v == ''){
				return $lang;
			}
			else {
				return $v;
			}
		}
		/**
	 * function adm();
	 * Checks string the address bar
	 *
	 * @param string $str
	 *   string who search
	 *
	 * @return string $str
	 *   string who search
	 */	
	function adm($str){
			$adr = explode('/', $_SERVER['REQUEST_URI']);
			foreach($adr as $k){
				$c = strpos($k, $str);
				if($c !== false){
					return $str;
				}
			}
		}

}




?>