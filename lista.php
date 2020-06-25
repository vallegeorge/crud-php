<html>
	<head>
		<title>Lista de Eventos</title>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<?php
				$mysqli = new mysqli('localhost', 'user','password','dbname') or die(mysqli_error($mysqli));
				$result = $mysqli->query("SELECT EXTRACT(YEAR_MONTH FROM data) as anomes, CONCAT(CASE WHEN EXTRACT(MONTH FROM data) = 1 THEN 'JANEIRO' WHEN EXTRACT(MONTH FROM data) = 2 THEN 'FEVEREIRO' WHEN EXTRACT(MONTH FROM data) = 3 THEN 'MARÇO' WHEN EXTRACT(MONTH FROM data) = 4 THEN 'ABRIL' WHEN EXTRACT(MONTH FROM data) = 5 THEN 'MAIO' WHEN EXTRACT(MONTH FROM data) = 6 THEN 'JUNHO' WHEN EXTRACT(MONTH FROM data) = 7 THEN 'JULHO' WHEN EXTRACT(MONTH FROM data) = 8 THEN 'AGOSTO' WHEN EXTRACT(MONTH FROM data) = 9 THEN 'SETEMBRO' WHEN EXTRACT(MONTH FROM data) = 10 THEN 'OUTUBRO' WHEN EXTRACT(MONTH FROM data) = 11 THEN 'NOVEMBRO' ELSE 'DEZEMBRO' END, ' ', EXTRACT(YEAR FROM data)) as mes FROM `eventos` WHERE data >= CURDATE() group by 1 order by 1") or die($mysqli->error);
			?>
			
			<div class="row justify-content-center">
				<table class="table">
					<caption class="table-dark" style="caption-side: top;line-height: 14px;text-align: center;font-size: 28px;font-weight: bold;">CALENDÁRIO DE EVENTOS DE MCs E MGs DO MS</caption>
					<thead class="thead-dark">
						<tr style="line-height: 5px;">
							<th style="text-align: center;">Dia</th>
							<th>Evento</th>
							<th>Cidade</th>
						</tr>
					</thead>
					<?php	
					while ($row = $result->fetch_assoc()): 
					$anomes = $row['anomes'];
					$result2 = $mysqli->query("SELECT * FROM `eventos` where EXTRACT(YEAR_MONTH FROM data) = '$anomes' AND data >= CURDATE() ORDER BY data") or die($mysqli->error);?>
				
					<tr style="line-height: 5px;">
						<td colspan="3" class="table-dark" style="text-align: center;font-size: 20px;"><?php echo $row['mes']; ?></td>
					</tr>
					
					<?php	
					while ($row2 = $result2->fetch_assoc()): ?>
					<tr style="line-height: 5px;">
						<td style="text-align: center;"><?php echo $row2['data_descricao']; ?></td>
						<td><?php echo $row2['descricao']; ?></td>
						<td><?php echo $row2['local']; ?></td>
					</tr>
					<?php endwhile; ?>	
					
					
					<?php endwhile; ?>	
					<tr style="line-height: 5px;">
						<td colspan="3" class="table-dark" style="text-align: center;">Elaborado por: Kaveiras Nômades MTC</td>
					</tr>
					<tr style="line-height: 5px;">
						<td colspan="3" class="table-dark" style="text-align: center;">Alteração ou inclusão? Contato: kaveirasnomadesmtc@gmail.com</td>
					</tr>
					<tr>
						<td colspan="3" class="table-dark" style="text-align: center;"><img src="http://totbox.com.br/kav/logo.jpg" class="img-fluid" style="height: 150px;"></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>