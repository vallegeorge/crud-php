<?php
ob_start();
session_start();
$mysqli = new mysqli('localhost', 'user','password','dbname') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$data = '';
$data_descricao = '';
$descricao = '';
$local = '';

if (isset($_POST['save'])){
	$data = $_POST['data'];
	$data_descricao = $_POST['data_descricao'];
	$descricao = $_POST['descricao'];
	$local = $_POST['local'];
	
	$mysqli->query("INSERT INTO eventos (data, data_descricao, descricao, local) VALUES('$data', '$data_descricao', '$descricao', '$local')") or die($mysqli->error);
	
	$_SESSION['message'] = "Registro salvo com sucesso!";
	$_SESSION['msg_type'] = "success";
	
	header("location: cadastro.php");
}

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM eventos WHERE id =$id") or die($mysqli->error());
	
	$_SESSION['message'] = "Registro excluído com sucesso!";
	$_SESSION['msg_type'] = "danger";
	
	header("location: cadastro.php");
}

if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM eventos WHERE id =$id") or die($mysqli->error());
	if (count($result)==1){
		$row = $result->fetch_array();
		$data = $row['data'];	
		$data_descricao = $row['data_descricao'];	
		$descricao = $row['descricao'];
		$local = $row['local'];
	}
}

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$data = $_POST['data'];
	$data_descricao = $_POST['data_descricao'];
	$descricao = $_POST['descricao'];
	$local = $_POST['local'];
	
	$mysqli->query("UPDATE eventos SET data='$data', data_descricao='$data_descricao', descricao='$descricao', local='$local' WHERE id =$id") or die($mysqli->error);
	
	$_SESSION['message'] = "Registro atualizado com sucesso!";
	$_SESSION['msg_type'] = "warning";
	
	header("location: cadastro.php");
}


?>