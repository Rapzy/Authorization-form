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
	else{
		if (!$name = LogIn($user)){
			MakeResponse('error',"Введены неккоректные данные<br>");
		}
		else{
			MakeResponse('success',"Hello $name<br>");
		}
	}

	function MakeResponse($status,$msg)
	{
		$Response = [
	  	'status' => $status,
	    'msg'    => $msg
  	];
  	echo json_encode($Response);
	}

	function LogIn($data)
	{
		$users=simplexml_load_file('data.xml');
		for ($i=0; $i < count($users); $i++) { 
			if ($users->user[$i]->login == $data['login'] && $users->user[$i]->pass == md5($users->user[$i]->salt . $data['pass'])){
				return $users->user[$i]->name;
			}
		}
		return false;
	}