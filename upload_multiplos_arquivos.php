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
		
    /* var_dump($_FILES); é importante para ver o array da variável global*/

        $formatoPermitidos = array("png", "jpeg","jpg","gif");
        $quantidadeDeArquivos = count($_FILES['arquivo']['name']);
        $contador = 0;

        while ($contador < $quantidadeDeArquivos) {
        	
        
		$extensao = pathinfo($_FILES['arquivo']['name'][$contador], PATHINFO_EXTENSION);

		if (in_array($extensao, $formatoPermitidos)) {
		
			$pasta = "arquivos/";
			$temporario = $_FILES['arquivo']['tmp_name'][$contador];
			$novoNome = uniqid()."$extensao";

            if (move_uploaded_file($temporario, $pasta.$novoNome)) {
            	echo "Upload Realizado com sucesso para $pasta $novoNome <br>";
            } else {
            	echo "Não foi possível fazer o Upload do arquivo: $temporario <br>";
            }
            

		}else{
			echo "$extensao não é permitida<br>";
		}

        
         $contador++;
        }

	}

?>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
		<input type="file" name="arquivo[]" multiple><br>
		<input type="submit" name="enviar-formulario">
	</form>

</body>
</html>