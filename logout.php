<?php
	include_once 'functions.php';
	setcookie('username','', -1);
	setcookie('hash', '', -1);
	unset($_SESSION['hash']);
	MakeResponse('error',"Добро пожаловать! Пожалуйста, авторизуйтесь<br>",false);