<?php

//inicializa as variaveis

$destinatario = "";
$url_redireciona = "";
$assunto = "Sem assunto";
$msg = "Problemas no envio do formulario.";
$corpo = "";

//recebe os valores do formulario
if( isset($_POST["form_destinatario"]) )
	$destinatario = $_POST["form_destinatario"];

if( isset($_POST["form_url_redireciona"]) )
	$url_redireciona = $_POST["form_url_redireciona"];

if( isset($_POST["form_assunto"]) )
	$assunto = $_POST["form_assunto"];

//Trata os campos que vieram
//se nao houver destinat�rio (o mais cr�tico)
if($destinatario == ""){

	//verifica se a pagina do redirecionamento veio
	if($url_redireciona == "")
		exit($msg." O destinat�rio n�o foi especificado.");
	else // se existe redirecionamento passa para la a msg de erro
		header('Location: '.$url_redireciona.'?l_str_msg='.urlencode($msg." O destinat�rio n�o foi especificado."));
}

//monta o corpo do email
foreach ($_POST as $key => $value) {
	
	if(
    		($key != "form_destinatario") &&
		($key != "form_assunto") &&
		($key != "form_url_redireciona") &&
		($key != "x") &&
		($key != "y")
    	)
    
    	$corpo.= "<b>".$key.":</b> ".$value."<br>\n";
}

// Cabecalhos para mandar email como html.
$headers = "MIME-Version: 1.0\r\n";
$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";

// Cabecalhos adicionais 
$headers .= "From: Formulario do site \r\n";

// Envia o email 
mail($destinatario, $assunto, $corpo, $headers);

//se chegou aqui o email ja foi enviado
//entao monta mensagem de sucesso
$msg = "Formul�rio enviado com sucesso.";

//se houver url redireciona e manda a mensagem
if($url_redireciona != "")
	header('Location: '.$url_redireciona.'?l_str_msg='.urlencode($msg));	
else // se nao, mostra aqui mesmo
	echo $msg;	



?>