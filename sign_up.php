<?php   
	error_reporting(E_ALL ^ E_NOTICE);
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

	if ($is_emty){
		MakeResponse('error',"Заполните все поля!<br>");
	}
	elseif ($user['pass'] !== $user['confirm_pass']){
		MakeResponse('error',"Введённые пароли не совпадают!<br>");
	}
	else{
		AddUser($user);
		MakeResponse('success',"Hello $user[name]<br>");
	}

	function MakeResponse($status,$msg)
	{
		$Response = [
	  	'status' => $status,
	    'msg'    => $msg
  	];
  	echo json_encode($Response);
	}

	function AddUser($data)
	{
		$xml=simplexml_load_file('data.xml');
		$new_user = $xml->addChild('user');
		foreach ($data as $key => $value) {
			$new_user->addChild($key, $value);
		}
		$xml->asXML('data.xml');
	}