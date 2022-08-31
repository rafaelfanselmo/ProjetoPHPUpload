<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UPLOAD</title>
</head>
<body>

	<?php

	if (isset($_POST['enviar-formulario'])) {
		
    // var_dump($_FILES); é importante para ver o array da variável global

		$formatoPermitidos = array("png", "jpeg","jpg","gif");
		$extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

		if (in_array($extensao, $formatoPermitidos)) {
		
			$pasta = "arquivos/";
			$temporario = $_FILES['arquivo']['tmp_name'];
			$novoNome = uniqid().".$extensao";

            if (move_uploaded_file($temporario, $pasta.$novoNome)) {
            	$mensagem = "Upload Realizado com sucesso";
            } else {
            	$mensagem = "Não foi possível fazer o Upload";
            }
            

		}else{
			$mensagem = "Formato inválido";
		}

echo $mensagem;

	}


	?>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
		<input type="file" name="arquivo"><br>
		<input type="submit" name="enviar-formulario">
		

	</form>

</body>
</html>