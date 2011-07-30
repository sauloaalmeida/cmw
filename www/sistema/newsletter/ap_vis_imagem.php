<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';

//testa se o nome do arquivo veio
    if( !isset($_REQUEST["l_str_arquivo"]) )
        msg(K_MSGERRO, K_FECHAR, "Falta de parametros", "O parâmetro l_str_arquivo não foi postado para a pagina<br><br>Clique em fechar e tente novament se o problema persistir contate o administrador!");						

?>
<html>
<head>
<script type="text/javascript" src="../nucleo/js/default.js"></script>
<link href="../nucleo/css/default.css" rel="stylesheet" type="text/css">
<title>Visualização da imagem</title>
</head>
<body onload="window.focus();">
<br>

<table width="90%" height="80%" border="0" align="center">
	<tr>
		<td align="center"><img src="<?php echo K_UPLOADDIR_EXIB_IMG_MAIL . $_REQUEST["l_str_arquivo"]; ?>"></td>
	</tr>
	<tr>
		<td align="center">
			<?php echo substr($_REQUEST["l_str_arquivo"],strrpos($_REQUEST["l_str_arquivo"],"_")+1); ?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input class="botao01" type="button" onClick="window.close();" value="Fechar">
		</td>
	</tr>
</table>

</body>
</html>


</body>
</html>
