<?php include 'nucleo/incs/inc_constantes.php'; ?>
<html>
<head>
<title><?php echo K_TITULO_SISTEMA; ?> - ERRO</title>
<link href="nucleo/css/default.css" rel="stylesheet" type="text/css">
</head>

<?php 
//inicializa as variaveis
$l_fl_tipo = "";
$l_fl_janela = K_VOLTAR;
$l_str_titulo = "Janela sem mensagem!";
$l_str_msg = "Janela sem mensagem";

//pega os valores para pagina de msg
if (isset($_REQUEST["g_fl_tipo"]))
   $l_fl_tipo = $_REQUEST["g_fl_tipo"];

if (isset($_REQUEST["g_fl_janela"]))
$l_fl_janela = $_REQUEST["g_fl_janela"];

if (isset($_REQUEST["g_str_titulo"]))
$l_str_titulo = $_REQUEST["g_str_titulo"];

if (isset($_REQUEST["g_str_msg"]))
$l_str_msg = $_REQUEST["g_str_msg"];

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="tx_titulo_01"><?php echo $l_str_titulo ?></td>
  </tr>
  <tr> 
    <td height="2" id="fundo02"></td>
  </tr>
</table>
<p><br>
  <br>
</p>

<table width="307" cellspacing="0" cellpadding="0" align="center" class="borda_01">
  <tr id="fundo03" > 
    <td  align="center"  class="msg" valign="top"></td>
    <td  height="18" align="center"><b><?php echo $l_str_titulo ?></b></td>
    <td width="5%">&nbsp;</td>
  </tr>
  <tr> 
    <td id="fundo03">
	   <?php 
	     if ($l_fl_tipo == K_MSGAVISO) 
	        echo "<img src='nucleo/imgs/aviso.gif' align='absmiddle' hspace='5'>";	
         if ($l_fl_tipo == K_MSGERRO) 
		    echo "<img src='nucleo/imgs/erro.gif' align='absmiddle' hspace='5'>";
       ?>
	</td>
    <td height="18" align="center" id="fundo04"> <?php echo $l_str_msg ?></td>
    <td height="18" align="center" id="fundo03">&nbsp;</td>
  </tr>
  <tr><td colspan="3" id="fundo03" height="15"></td></tr>
</table>

<p align="center">
  <?php if ($l_fl_janela == K_FECHAR)
           echo "<input type='button' value='Voltar' class='botao01' onClick='javascript:window.close();'>";
       elseif ($l_fl_janela == K_VOLTAR) 
           echo "<input type='button' value='Voltar' class='botao01' onClick='javascript:history.go(-2);'>";
       else 
           echo "<input type='button' value='Voltar' class='botao01' onClick=\"GoTo('".$l_fl_janela."')\">";
  ?>
</p>
