<?php 
	session_start();
	error_reporting(0);
	$is_emty = false;
	foreach ($_POST as $key => $value) {
		if (!empty($value)){
			$user[$key] = htmlentities(trim($value));
		}
		else{
			$is_emty = true;
			break;
		}
	}
	function MakeResponse($status,$msg,$logged)
	{
		$Response = [
	  	'status' => $status,
	    'msg'    => $msg,
	    'logged' => $logged
  	];
  	echo json_encode($Response);
	}
	function GenerateSalt(){
		$salt = '';
		$length = rand(5,10);//Длина соли
		for ($i=0; $i <$length ; $i++) { 
			$salt .= chr(rand(33,126));
		}
		return $salt;
	}