<?php
	include_once 'functions.php';
	if(isset($_COOKIE['hash']) || isset($_SESSION['hash'])){
		$users=simplexml_load_file('data.xml');
		$hash = isset($_COOKIE['hash']) ? $_COOKIE['hash'] : $_SESSION['hash'];
		for ($i=0; $i < count($users); $i++) { 
			if ($users->user[$i]->hash == $hash){
				$name = $users->user[$i]->name;
				$users->user[$i]->hash = $hash;
				MakeResponse('success',"Hello $name<br>", true);
				break;
			}
		}		
	}
	else{
		MakeResponse('error',"Добро пожаловать! Пожалуйста, авторизуйтесь<br>", false);
	}