
<?php

	if(!function_exists('root')){
		function root($path=''){
			$path=trim($path,'/');
			$docPath=dirname(dirname(__FILE__)).'/'.$path;
			return $docPath;
			
		}
	}

	if(!function_exists('base_url')){

	function base_url($path=''){
			$path=trim($path,'/');
			$http=$_SERVER['REQUEST_SCHEME'];
			$serverName=$_SERVER['HTTP_HOST'];
			return $http.'://'.$serverName.'/digital-assignment/admin-pannel/'.$path;
		}

	}

	if(!function_exists('exit_url')){

	function exit_url($path=''){
			$path=trim($path,'/');
			$http=$_SERVER['REQUEST_SCHEME'];
			$serverName=$_SERVER['HTTP_HOST'];
			return $http.'://'.$serverName.'/digital-assignment/'.$path;
		}

	}

?>