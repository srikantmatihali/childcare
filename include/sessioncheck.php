<?php
session_start();
if(!isset($_SESSION['id'])) {
		       header('Location:http://lee.in/cityismine/index.php');
				}
?>