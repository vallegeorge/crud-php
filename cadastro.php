<html>
	<head>
		<title>Cadastro de Eventos</title>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php require_once 'process.php'; ?>
		
		<?php
			if (isset($_SESSION['message'])): ?>
			
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
		
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?>
		
		<div class="container">
		<?php
			$mysqli = new mysqli('localhost', 'user','pass','dbname') or die(mysqli_error($mysqli));
			$result = $mysqli->query("SELECT * FROM eventos ORDER BY data") or die($mysqli->error);
			//pre_r($result);
			//pre_r($result->fetch_assoc());
			//pre_r($result->fetch_assoc());
		?>
		
		<div class="row justify-content-center">
			<table class="table table-striped table-dark">
				<thead class="thead-dark">
					<tr>
						<th>Data</th>
						<th>Dia</th>
						<th>Evento</th>
						<th>Cidade</th>
						<th colspan="2">Ação</th>
					</tr>
				</thead>
				
		<?php	
			while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row['data']; ?></td>
					<td><?php echo $row['data_descricao']; ?></td>
					<td><?php echo $row['descricao']; ?></td>
					<td><?php echo $row['local']; ?></td>
					<td>
						<a href="cadastro.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>
						<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Apagar</a>
					</td>
				</tr>
			<?php endwhile; ?>	
			</table>
		</div>

		<?php		
			function pre_r( $array ) {
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
		?>
		
		<div class="row justify-content-center">
			<form action="process.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<label>Data</label>
					<input type="date" name="data" class="form-control" value="<?php echo $data; ?>" placeholder="Informe a data">
				</div>
				<div class="form-group">
					<label>Descrição Data (Dia)</label>
					<input type="text" name="data_descricao" class="form-control" value="<?php echo $data_descricao; ?>" placeholder="Informe a descrição da data">
				</div>
				<div class="form-group">
					<label>Evento</label>
					<input type="text" name="descricao" class="form-control" value="<?php echo $descricao; ?>" placeholder="Informe a descrição do evento">
				</div>
				<div class="form-group">
					<label>Cidade</label>
					<input type="text" name="local" class="form-control" value="<?php echo $local; ?>" placeholder="Informe o local">
				</div>
				<div class="form-group">
				<?php
					if ($update == true):
				?>
					<button type="submit" class="btn btn-info" name="update">Atualizar</button>
				<?php else: ?>	
					<button type="submit" class="btn btn-primary" name="save">Salvar</button>
				<?php endif; ?>
				</div>
			</form>
		</div>
		</div>
	</body>
</html>