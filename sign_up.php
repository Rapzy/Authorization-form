<?php   
	include_once 'functions.php';
	if ($is_emty){
		MakeResponse('error',"Заполните все поля!<br>",false);
	}
	elseif ($user['pass'] !== $user['confirm_pass']){
		MakeResponse('error',"Введённые пароли не совпадают!<br>",false);
	}
	else{
		unset($user['confirm_pass']);
		if(AddUser($user)){
			MakeResponse('success',"Вы успешно зарегистрировались!<br>",false);
		}
	}

	function AddUser($data)
	{
		$data['salt'] = GenerateSalt();
		$data['pass'] = md5($data['salt'] . $data['pass']);
		$data['hash'] = '';
		$users=simplexml_load_file('data.xml');
		for ($i=0; $i < count($users); $i++) { 
			if ($users->user[$i]->login == $data['login']){
				MakeResponse('error',"Логин уже используется!<br>",false);
				return false;
			}
			elseif($users->user[$i]->email == $data['email']){
				MakeResponse('error',"E-mail уже используется!<br>",false);
				return false;
			}
		}
		$new_user = $users->addChild('user');
		foreach ($data as $key => $value) {
			$new_user->addChild($key, $value);
		}
		$users->asXML('data.xml');
		return true;
	}