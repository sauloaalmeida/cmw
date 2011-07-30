<?php
include 'nucleo/classes/cl_enquete.php';
include 'nucleo/classes/cl_resposta.php';

$l_obj_enquete = new Enquete;
$l_obj_enquete->dbconn->conectar();

$l_obj_enquete->getUltimaEnquete(K_CAT_ENQUETE_CAPA);
?>

<script>

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}


 function votarEnquete(botao){

    if(botao.name=='votar'){

        var enqueteRespondida=false;
        var respostas = document.getElementsByName("enqRespPk[]");

        for(i=0;i<respostas.length;i++){
           if(respostas[i].checked)
                enqueteRespondida = true;
        }

       if(!enqueteRespondida ){
             alert("Selecione pelo menos uma resposta da enquete.");
              return false;
       }
  }

    //se ja foi respondida, faz os preparativos para a votacao.
      if(botao.name=='votar')
             document.getElementById("l_str_acao_enquete").value="<?php echo K_VOTAR; ?>";

     if(botao.name=='resultado')
              document.getElementById("l_str_acao_enquete").value="<?php echo K_RESULTADO; ?>";

	window.open('blank.php','winPopResultadoEnquete','width=350,height=300,top=200,left=200,scrollbars=yes,resizable=yes');
    
    sleep(500);

     botao.form.submit();

   }
</script>

<?php if ($l_obj_enquete->enqEnqPk != NULL) { ?>

<div id="enquete">

        <h2>Enquete</h2>

        <p><?php echo $l_obj_enquete->enqEnqPergunta; ?></p>
        <form action="resultado_enquete.php" method="post" target="winPopResultadoEnquete">
        <input type="hidden" name="enqEnqPk" value="<?php echo $l_obj_enquete->enqEnqPk; ?>" >
        <input type="hidden" name="l_str_acao_enquete" id="l_str_acao_enquete" value="<?php echo K_VOTAR; ?>" >
        <input type="hidden" name="ip"  value="<?php echo $l_obj_enquete->getIp(); ?>" >
        <?php
        $i=0;
        foreach ($l_obj_enquete->respostas as $resp ) { ?>
        <div <?php echo ($i%2==0)?"class='bg01'":"";?> ><input name="enqRespPk[]" value="<?php echo $resp->enqRespPk;?>" type="<?php echo ($l_obj_enquete->enqEnqTipoResposta == K_ENQUETE_RESP_MULTIPLA)?"checkbox":"radio";?>" class="radiobutton" /><?php echo $resp->enqRespResposta;?></div>
        <?php
            $i++;
        }?>
        <div style="text-align:center; margin-top:2px; border-top:1px solid #E3E3E3; border-bottom:1px solid #E3E3E3; padding-top:3px; padding-bottom:3px;">
          <input name="votar" type="button" class="btn1" value="votar" onclick="javascript:votarEnquete(this);" />
          <input name="resultado" type="button" class="btn1" value="resultado" onclick="javascript:votarEnquete(this);" />
        </div>
   </form>
</div>
<?php } ?>
<?php $l_obj_enquete->dbconn->fechar(); ?>

