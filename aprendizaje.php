
<html>
<head>
	<meta charset="utf-8" />
	<title>SBC</title>
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	
	<header>
         <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                    <h3 class="texto tamtex1">SISTEMA BASADO EN CONOCIMIENTOS</h3>
                </div>
            </div>
        </div>
     </header>
	<br>
	<div class="container">
		<div class="panel panel-primary">

			<div class="panel-heading">ALGORITMO DE APRENDIZAJE</div>
			<br>
			<form class="form-horizontal" role ="form" action="algoritmo.php" method="POST" name="form" id="form" >
				<div class="form-group">
					<label for="inputValido" class="col-sm-4 control-label">Ingrese Patrón válido:</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="valido" name="valido" placeholder="ingrese números">
					</div>
				</div>

				<div class="form-group">
					<label for="inputValido" class="col-sm-4 control-label">Ingrese Patrón inválido:</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" id="invalido" name="invalido" placeholder="ingrese números">
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<input class="btn btn-warning" type="submit" id="btn_cancular" name="btn_cancular" value="Calcular Algoritmo">
					
					</div>	
				</div>	

			</form>
		</div>
	</div>
		
	
</body>
</html>