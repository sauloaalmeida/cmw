<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_enquete.php';
include 'nucleo/classes/cl_resposta.php';
include 'nucleo/classes/cl_menulink.php';
include 'nucleo/classes/cl_aniversario.php';

    $l_obj_aniversario = new Aniversario;

    //cria conexao com o banco
    $l_obj_aniversario->dbconn->conectar();

    $l_mes_pesquisa = ( isset($_REQUEST["l_mes_pesquisa"]) && trim($_REQUEST["l_mes_pesquisa"])!="" ) ? trim($_REQUEST["l_mes_pesquisa"]):date("m");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php include('incs/cabecalho.php'); ?>
</head>
<body>
<div id="content">
  <?php include('incs/top.php'); ?>
  <?php include('incs/menu_topo.php'); ?>
  <div id="container">
    <div id="column_1">
      <?php include('incs/menu.php'); ?>
      <?php include('incs/biblioteca.php'); ?>
    </div>
    <div id="column_2"><div id="texto">
        <h2>Aniversariantes
          <?php include('incs/barra_icones.php'); ?></h2>
<div id="texto_conteudo">
    <form action='aniversariantes.php' method='post'>

           <table align="center" width="200" >
                <tr>
                    <td align="right">M&ecirc;s:</td>
                    <td align="left">
                        <select name="l_mes_pesquisa" onchange="javascript:this.form.submit();">
                          <?php
                            for($i=1;$i<=12;$i++){
                               echo "<option value='".$i."' ".(($l_mes_pesquisa == $i)?" selected ":"")."> ".func_str_nome_mes($i)."</option>";
                            }
                          ?>
                      </select>
                  </td>
              </tr>
          </table>

      </form>

    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th align="left" >Nome</th>
            <th align="left" >M&ecirc;s</th>
            <th align="center" >Dia</th>
          </tr>
    <?php
    //pega recordset de noticias
    $rsAniversario = $l_obj_aniversario->getAniversarios($l_mes_pesquisa);

   //verifica se existe algum registro no recordset
   if(!$l_obj_aniversario->dbconn->getExisteRecordset($rsAniversario)){
       echo "<tr><td colspan='3' align='center'>Nenhum anivers&aacute;rio cadastrado para o m&ecirc;s selecionado.</td></tr>";
   }
   else{
     while ( $RStemp = $l_obj_aniversario->dbconn->getRecordsetArray($rsAniversario) ) { ?>

       <tr>
	   <td align="left"><?php echo $RStemp["aniv_aniv_nome"] ?></td>
           <td align="left"><?php echo func_str_nome_mes($RStemp["aniv_aniv_dt_mes_nasc"]) ?></td>
           <td align="center"><?php echo $RStemp["aniv_aniv_dt_dia_nasc"] ?></td>
	</tr>
	 <?php
	 }
   }
    $l_obj_aniversario->dbconn->fechar();
	?>
	</table>

</div>
    </div>
        </div>
    <div id="column_3">
      <?php include('incs/enquete.php'); ?>
      <?php include('incs/newsletter.php'); ?>
      <?php include('incs/parceiros.php'); ?>
    </div>
  </div><!-- content-->

  <div style="clear:both"> </div>
  <?php include('incs/rodape.php'); ?><!-- footer-->

</div><!-- container -->

</body>
</html>
