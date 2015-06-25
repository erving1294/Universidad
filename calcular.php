	

	<meta charset="utf-8" />
	<title>Algoritmo</title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">

<?php
	if (!isset( $_POST["btn_cancular"] )) {
		header("location: index.php");
	}

	
	$arrayValido = explode(",", str_replace(" ", "", $_POST["valido"]));
	$arrayInvalido = explode(",", str_replace(" ", "", $_POST["invalido"]));

	
		$arrayVariableEntradaValido=array();	
		$arrayVariableEntradaInvalido=array();	
		$arrayPesoValido = array();				
		$arrayPesoInvalido = array();			
		$arrayNuevoPesoValido = array();		
		$arrayNuevoPesoInvalido = array();		
		$arrayD1Valido = array();
		$arrayD1Invalido = array();
		$dv = 1;
		$di = 0; 
		$n = 0.1;
		$y1_valido =  0;	
		$y1_invalido =  0;	
	
	
	for ($i=0; $i < count($arrayValido)  ; $i++) {
	 	$arrayVariableEntradaValido["X".($i+1)] = $arrayValido[$i];
	 	$arrayPesoValido["W".($i+1)."1"] = 0.0;
	}


	for ($i=0; $i < count($arrayInvalido)  ; $i++) {
	 	$arrayVariableEntradaInvalido["X".($i+1)] = $arrayInvalido[$i];
	 	$arrayPesoInvalido["W".($i+1)."1"] = 0.0;
	}

	
	for ($i=0; $i < count($arrayVariableEntradaValido) ; $i++) {
		$y1_valido+= $arrayVariableEntradaValido["X".($i+1)]*$arrayPesoValido["W".($i+1)."1"];
	}

	
	for ($i=0; $i < count($arrayVariableEntradaInvalido) ; $i++) {
		$y1_invalido+= $arrayVariableEntradaInvalido["X".($i+1)]*$arrayPesoValido["W".($i+1)."1"];
	}

	for ($i=0; $i < count($arrayVariableEntradaValido) ; $i++) {
		$arrayD1Valido[$i]= $dv-$y1_invalido;
	}

	?>

	

		<!--  CUADRO 1 -->
		
		<?php

		$patrones_diferentes=1;
		$cont=1;

		while ($patrones_diferentes==1){





			if($cont>=2) {
				echo "<br>";

			}


		echo "<div class='cabecera'><h1>Iteración Nº".$cont."<h1></div>" ;
		echo CrearCuadro_1($arrayPesoValido, $arrayPesoValido); 
	?>
		<br>

		<!-- CUADRO 2 -->
		<?php $string_salidas=CrearCuadro_2($arrayPesoValido, $arrayVariableEntradaValido, $arrayVariableEntradaInvalido, $y1_valido, $y1_invalido); ?>
		<br>
		<!-- CUADRO 3 -->
		<?php
		$array_salidas=explode(",",$string_salidas);
	

		?>






		<?php $variable=CrearCuadro_3($arrayVariableEntradaValido, $arrayVariableEntradaInvalido, $arrayPesoValido, $arrayNuevoPesoValido, $arrayPesoInvalido, $dv, $array_salidas[0], $di, $array_salidas[1], $n);

		$cont++;

		$array_nuevo=explode(",",$variable);



		for ($i=0; $i < count($array_nuevo)  ; $i++) {

	 	$arrayPesoValido["W".($i+1)."1"] = $array_nuevo[$i];
		}







		$patrones_diferentes=Evaluar_Salidas($array_salidas);





		}
		echo "<br>";
		echo CrearCuadro_1($arrayPesoValido, $arrayPesoValido);
		?>

		<br>

		<!-- CUADRO 2 -->
		<?php $string_salidas=CrearCuadro_2($arrayPesoValido, $arrayVariableEntradaValido, $arrayVariableEntradaInvalido, $y1_valido, $y1_invalido); ?>
		<br>

		<br>


	<?php


	function crearTD_cabecera($array,$letra,$num=''){
		$td = "";
		for ($i=0; $i < count($array) ; $i++) {
			$td.="<td>".$letra.($i+1).$num."</td>";
		}
		echo $td;

	}

	function crearTDcuadro_variables($array,$letra,$num=''){
		$td = "";
		for ($i=0; $i < count($array) ; $i++) {
			$td.="<td>".number_format($array[$letra.($i+1).$num],2)."</td>";
		}
		echo $td;
	}


	function CrearCuadro_1($arrayPesoValido, $arrayPesoValido){
		?>
		
				<div class="panel panel-info">
					<div class="panel-heading">Inicializar pesos</div>
			
						<table class="table table-bordered">
							<tr class="warning"> <?php crearTD_cabecera($arrayPesoValido,"W",1); ?> </tr>
							<tr><?php crearTDcuadro_variables($arrayPesoValido,"W",1); ?>
							</tr>
						</table>
				</div>
			
					
		<?php
	}

	function CrearCuadro_2($arrayPesoValido, $arrayVariableEntradaValido, $arrayVariableEntradaInvalido, $y1_valido, $y1_invalido){
		?>
		<?php

		$resultado_patronV=0;



		for($i=0;$i<count($arrayVariableEntradaValido);$i++){


			$resultado_patronV+=$arrayVariableEntradaValido["X".($i+1)]*$arrayPesoValido["W".($i+1)."1"];

		}





		$resultado_patronI=0;

		for($j=0;$j<count($arrayVariableEntradaInvalido);$j++){


			$resultado_patronI+=$arrayVariableEntradaInvalido["X".($j+1)]*$arrayPesoValido["W".($j+1)."1"];


		}

		?>

		
		<div class="panel panel-success">
			<div class="panel-heading">Aplicar dinámica de red y función de transferencia</div>
			<table class="table table-bordered">
				<tr class="warning">
					<td colspan="<?php echo count($arrayPesoValido); ?>">ENTRADA</td>
					<td>ECUACIONES</td>
					<td>SALIDA ACTUAL = 'y'</td>
					<td>SALIDA DESEADA = 'd'</td>
				</tr>
				<tr align="center">
					<?php crearTDcuadro_variables($arrayVariableEntradaValido, "X"); ?>
					<td>Y1= | <?php echo number_format($resultado_patronV,2); ?> </td>
					<td><?php if (number_format($resultado_patronV,4) > 0) echo $salida_V=1; else echo $salida_V=0; ?></td>
					<td>1</td>
				</tr>
				<tr align="center">
					<?php crearTDcuadro_variables($arrayVariableEntradaInvalido, "X"); ?>
					<td>Y1= | <?php echo number_format($resultado_patronI,2); ?> </td>
					<td><?php if (number_format($resultado_patronI,4) > 0) echo $salida_I=1; else echo $salida_I=0; ?></td>
					<td>0</td>
				</tr>
			</table>

		</div>
	
		
		
		<?php

		return $salida_V.",".$salida_I;
	}

	function CrearCuadro_3($arrayVariableEntradaValido, $arrayVariableEntradaInvalido, $arrayPesoValido, $arrayNuevoPesoValido, $arrayPesoInvalido, $dv, $y1_valido, $di, $y1_invalido, $n){
		?>

			<div class="panel panel-danger">
		 		<div class="panel-heading">Aplicar algortimo de aprendizaje</div>
		 	</div>

			<table class="table table-bordered">
				<tr class="warning">
					<?php crearTD_cabecera($arrayVariableEntradaValido,"X"); ?>
					<td>W</td>
					<td>d1</td>
					<td>y1</td>
					<td>d1 - y1 = D1</td>
					<?php crearTD_cabecera($arrayVariableEntradaValido,"X"); ?>
					<td>Nuevo W</td>
				</tr>
				<?php
					for ($i=0; $i < count( $arrayVariableEntradaValido )  ; $i++) {
						?> <tr> <?php
						if ($i == 0) {
							?>

									<?php
										for ($j=0; $j < count( $arrayVariableEntradaValido )  ; $j++) {
											?>
												<td rowspan="<?php echo count( $arrayVariableEntradaValido ); ?>">
													<?php echo $arrayVariableEntradaValido["X".($j+1)]; ?>
												</td>
											<?php
										}
									?>
							<?php
						}
						?>

								<td><?php echo number_format($arrayPesoValido["W".($i+1)."1"],2); ?></td>
								<td><?php echo $dv; ?></td>
								<td><?php echo $y1_valido; ?></td>
								<td><?php echo $D1 = $dv - $y1_valido; ?></td>
								<?php
									for ($k=0; $k < count( $arrayVariableEntradaValido ) ; $k++) {
										echo "<td>";
										if ($i == ($k) ) {
											echo $arrayVariableEntradaValido["X".($i+1)];
										}else{
											echo "&nbsp;";
										}
										echo "</td>";

									}
								?>
								<td class="info"><?php
								echo $arrayPesoValido["W".($i+1)."1"] = $arrayPesoValido["W".($i+1)."1"] +
										number_format(($n * $D1 * $arrayVariableEntradaValido["X".($i+1)]),4);



								 ?></td>


							</tr>
						<?php
					}
				?>

				<?php
					for ($i=0; $i < count( $arrayVariableEntradaInvalido )  ; $i++) {
						?> <tr> <?php
						if ($i == 0) {
							?>

									<?php
										for ($j=0; $j < count( $arrayVariableEntradaInvalido )  ; $j++) {
											?>
												<td rowspan="<?php echo count( $arrayVariableEntradaInvalido ); ?>">
													<?php echo $arrayVariableEntradaInvalido["X".($j+1)]; ?>
												</td>
											<?php
										}
									?>
							<?php
						}
						?>

								<td class="info"><?php echo $arrayPesoValido["W".($i+1)."1"]; ?></td>
								<td><?php echo $di; ?></td>
								<td><?php echo $y1_invalido; ?></td>
								<td><?php echo $D1 = $di - $y1_invalido; ?></td>
								<?php
									for ($k=0; $k < count( $arrayVariableEntradaInvalido ) ; $k++) {
										echo "<td>";
										if ($i == ($k) ) {
											echo $arrayVariableEntradaInvalido["X".($i+1)];
										}else{
											echo "&nbsp;";
										}
										echo "</td>";

									}
								?>
								<td class="success"><?php echo $arrayPesoValido["W".($i+1)."1"] = $arrayPesoValido["W".($i+1)."1"] + number_format(($n * $D1 * $arrayVariableEntradaInvalido["X".($i+1)]),4);


									?></td>
							</tr>
						<?php
					}
				?>
			</table>

	
		<?php


			return implode(",",$arrayPesoValido);


	}



	function Evaluar_Salidas($array_salidas){

		if($array_salidas[0]==1 && $array_salidas[1]==0){

			return 0;
		}else{

			return 1;
		}


	}

	echo"<h1>SE DETIENE EL ALGORITMO, YA SE ENCONTRÓ LA SOLUCIÓN</h1>";


?>