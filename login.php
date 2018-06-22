<?php   
	include_once 'functions.php';
	if ($is_emty){
		MakeResponse('error',"Заполните все поля!<br>",false);
	}
	else{
		if (!LogIn($user)){
			MakeResponse('error',"Введены неккоректные данные<br>",false);
		}
	}

	function LogIn($data)
	{
		$users=simplexml_load_file('data.xml');
		for ($i=0; $i < count($users); $i++) { 
			if ($users->user[$i]->login == $data['login'] && $users->user[$i]->pass == md5($users->user[$i]->salt . $data['pass'])){
				$name = $users->user[$i]->name;
				$hash = md5(GenerateSalt());
				$users->user[$i]->hash = $hash;
				setcookie('username', $name, time() + 3600 * 24 * 7);
				setcookie('hash', $hash, time() + 3600 * 24 * 7);
				$_SESSION['hash'] = $hash;
				$users->asXML('data.xml');
				MakeResponse('success',"Hello $name<br>", true);
				return true;
			}
		}
		return false;
	}