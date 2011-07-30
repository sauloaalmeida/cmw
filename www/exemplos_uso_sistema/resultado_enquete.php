<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_enquete.php';
include 'nucleo/classes/cl_resposta.php';
include 'nucleo/classes/cl_voto.php';

    //pega os dados da votacao

    $l_bl_pode_votar = false;
    $l_bl_quer_votar = false;
    $respostas = $_POST["enqRespPk"];
    $l_str_acao_enquete = $_POST["l_str_acao_enquete"];
    $enqEnqPk = $_POST["enqEnqPk"];
    $ip = $_POST["ip"];

    //se fot votacao, registra o voto
    if($l_str_acao_enquete == K_VOTAR){

        $l_obj_voto = new Voto;
        $l_obj_voto->dbconn->conectar();
        $l_bl_quer_votar = true;

        //verifica se esse ip pode votar nessa enquete
      if($l_obj_voto->permiteVotar($enqEnqPk,$ip)){

        $l_bl_pode_votar = true;

       //se ok, registra o(s) voto(s)
        $l_obj_voto->enqVotoIp = $ip;

         $l_obj_voto->registrarVotacao($respostas);

        $l_obj_voto->dbconn->fechar();
     }
  }

    //apresenta o resultado
    $l_obj_enquete = new enquete;
    $l_obj_enquete->dbconn->conectar();

   //pega a enquete desejada
   $l_obj_enquete->getEnquete($enqEnqPk);

   //pega o resultado da enquete
   $rsResultado = $l_obj_enquete->getResultadoEnquete($enqEnqPk);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Enquete</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.border_bottom { border-bottom:1px solid #D7E2E8}
-->
</style>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {border-bottom: 1px solid #D7E2E8; font-weight: bold; }
.style2 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td height="30" colspan="4" align="left" bgcolor="#D7E2E8"><span class="style2">Resultado da Enquete </span></td>
  </tr>
<?php if($l_bl_quer_votar && !$l_bl_pode_votar) {  ?>
  <tr>
    <td colspan="4" align="left" bgcolor="#F7F7F7" class="style1">Voc&ecirc; j&aacute; votou nessa enquete.</td>
  </tr>
<?php } ?>
  <tr>
    <td align="left" class="style1">Respostas</td>
    <?php if($l_obj_enquete->enqEnqResultadoAbsoluto=='A') { ?>
    <td align="center" class="border_bottom"><strong>Votos</strong></td>
    <?php } ?>
    <?php if($l_obj_enquete->enqEnqResultadoPorcentagem=='A') { ?>
    <td align="center" class="border_bottom"><strong>%</strong></td>
    <?php } ?>
    <td width="100" align="left" bgcolor="#F7F7F7" class="border_bottom">&nbsp;</td>
  </tr>

    <?php
      $l_total_votos=0;
      $l_total_porcent=0;
      $i=1;
      while($rsTempResultado = $l_obj_enquete->dbconn->getRecordsetArray($rsResultado)) { ?>
  <tr>
    <td align="left" class="border_bottom"><?php echo $rsTempResultado["enq_resp_resposta"]; ?></td>
    <?php if($l_obj_enquete->enqEnqResultadoAbsoluto=='A') { ?>
       <td align="center" class="border_bottom"><?php echo $rsTempResultado["absoluto"]; ?></td>
    <?php } ?>
    <?php if($l_obj_enquete->enqEnqResultadoPorcentagem=='A') { ?>
       <td align="center" class="border_bottom"><?php echo ($i<count($l_obj_enquete->respostas))?$rsTempResultado["porcentagem"]:(100-$l_total_porcent); ?>%</td>
    <?php } ?>
    <td width="100" align="left" bgcolor="#F7F7F7" class="border_bottom"><img src="images/barra_enquete.gif" width="<?php echo $rsTempResultado["porcentagem"]; ?>%" height="22" /></td>
  </tr>
    <?php
      $l_total_votos+=$rsTempResultado["absoluto"];
      $l_total_porcent+=$rsTempResultado["porcentagem"];
      $i++;
       } ?>
  <tr>
    <td bgcolor="#F2F6F9">&nbsp;</td>
    <?php if($l_obj_enquete->enqEnqResultadoAbsoluto=='A') { ?>
    <td align="center" bgcolor="#F2F6F9"><strong><?php echo $l_total_votos; ?></strong></td>
    <?php } ?>
    <?php if($l_obj_enquete->enqEnqResultadoPorcentagem=='A') { ?>
    <td align="center" bgcolor="#F2F6F9"><strong>100</strong></td>
    <?php } ?>
    <td align="left" bgcolor="#F2F6F9">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php   $l_obj_enquete->dbconn->fechar(); ?>
