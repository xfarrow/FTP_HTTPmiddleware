<?php
	session_start();
	require './includes/server_configs.php';

	$new_folder_path = $_GET['path']."/".$_POST['folder_name'];
	
	$username = $_SESSION['username'];
	$password = $_SESSION['pass'];
	
	$ftp_connection = ftp_connect(FTP_SERVER,FTP_PORT,FTP_TIMEOUT) or die("Could not connect to" . FTP_SERVER);
	
	if(@ftp_login($ftp_connection,$username,$password)){
		if(@ftp_mkdir($ftp_connection,$new_folder_path)){
			header("Location: home.php?path=".$_GET['path']);
		}else{
			echo "Unable to create folder :-( check permissions";
		}
		ftp_close($ftp_connection);
	}
?>