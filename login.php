<?php   
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

	if ($is_emty){
		MakeResponse('error',"Заполните все поля!<br>");
	}
	else{
		if (!LogIn($user)){
			MakeResponse('error',"Введены неккоректные данные<br>");
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
				$name = $users->user[$i]->name;
				MakeResponse('success',"Hello $name<br>");
				return true;
			}
		}
		return false;
	}