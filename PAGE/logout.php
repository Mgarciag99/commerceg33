<?php
    session_start();

    $_SESSION[ 'codeUser' ] = '';
    $_SESSION[ 'user' ] = '';
    $_SESSION[ 'nameUser' ] = '';
    $_SESSION[ 'surnameUser' ] = '';


	unset($_SESSION['codeUser']);
	unset($_SESSION['user']);
	unset($_SESSION['nameUser']);
	unset($_SESSION['surnameUser']);
	
    session_destroy();


    header('Location: PAGES/index.php');
?>
