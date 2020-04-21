<?php
	/**
	* Главный файл (переключатель)
	* Site: http://bezramok-tlt.ru
	* Регистрация пользователя письмом
	*/

	//Запускаем сессию
	session_start();

	//Устанавливаем кодировку и вывод всех ошибок
	header('Content-Type: text/html; charset=UTF8');
	error_reporting(E_ALL);

	//Включаем буферизацию содержимого
	ob_start();

	//Определяем переменную для переключателя
	$mode = isset($_GET['mode'])  ? $_GET['mode'] : false;
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
	$err = array();

	//Устанавливаем ключ защиты
	define('BEZ_KEY', true);
	 
	//Подключаем конфигурационный файл
	include './config.php';
	 
	//Подключаем скрипт с функциями
	include './funct.php';

	//подключаем MySQL
	include './bd/bd.php';

	switch($mode)
	{
		//Подключаем обработчик с формой регистрации
		case 'reg':
			include './reg.php';
			include './reg_form.html';
		break;
		
		//Подключаем обработчик с формой авторизации
		case 'auth':
			include './auth.php';
			include './auth_form.html';
			include './show.php';
		break;
    
	}
    
	//Получаем данные с буфера
	$content = ob_get_contents();
	ob_end_clean();

	//Подключаем наш шаблон
	include './index.html';
?>			
