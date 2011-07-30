<? 
$l_obj_categoria = new Categoria();
$l_str_acao = $_REQUEST["l_str_acao"];

if (isset($_REQUEST["news_cat_pk"])){
	    //cria conexao com o banco
		$news_cat_pk = $_REQUEST["news_cat_pk"];
		$l_obj_categoria->dbconn->conectar();
		$l_obj_RScategoria = $l_obj_categoria->GetCategoria($news_cat_pk);
	}
?>

<script language="JavaScript" type="text/javascript">

function frm_validar(frm, l_str_acao){


	if((l_str_acao == "<?php echo K_INCLUIR?>") || (l_str_acao == "<?php echo K_ALTERAR?>")){
	
	
	  if(func_bl_isvazio(frm.cad_cat_nome,'O Nome da categoria precisa ser preenchido!'))
	      return false;
	         
	  if(func_bl_isvazio(frm.cad_cat_descricao,'A descricao da categoria precisa ser preenchida!'))
	      return false;

	  if(frm.cad_cat_descricao.length() > 255 ){
		alert("O campo descricao possui "+ frm.cad_cat_descricao.length()+ " acrecteres, o maximo permitido sao 255");
		return false;
          }

	}else if (l_str_acao == "<?php echo K_EXCLUIR?>"){
	
		if(confirm("Tem certeza que gostaria de excluir esse registro?"))
			return true;
		else
			return false;
	
	}		
		  
		  		  		  	  	  
      return true;
  }
  
</script>
<br><br>
<form name="frm_cad_categoria" method="post" action="rn_categoria.php?l_str_acao=<? echo $l_str_acao?>" onSubmit="return frm_validar(this,'<?php echo $l_str_acao ?>');">
<input name="l_str_acao" type="hidden" value="<? echo $l_str_acao;?>">
<input name="l_str_pk" type="hidden" value="<? echo $news_cat_pk;?>">

<table width="579" align="center" border="0">

	<tr>
  		<td align="center">
			<table width="367" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="81" align="right" valign="top"><strong>Nome:&nbsp;</strong></td>
          <td width="280">
		  <? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?> 
		  	<input name='cad_cat_nome' type='text' 
id='cad_cat_nome' size='40' maxlenght='100' value='<? echo 
$l_obj_categoria->news_cat_nome; ?>'>
		  <?}else
		  	echo $l_obj_categoria->news_cat_nome;?>

			<br><br></td>
        </tr>
        <tr> 
          <td align="right" valign="top"><strong> Descricao:&nbsp;</strong></td>
          <td><? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?> 
	  		<textarea name='cad_cat_descricao' cols='40' rows='5'><? echo $l_obj_categoria->news_cat_descricao ?></textarea>
	      <?}else
		        echo $l_obj_categoria->news_cat_descricao;?>		  
		  <br><br></td>
        </tr>
      
        <tr> 
          <td colspan="2" align="center">
		  <input type="submit" name="Submit" value="<? echo $l_str_acao;?>">
		  <input type='button' value="&laquo; Voltar" 
onClick="GoTo('ap_index_lst_categoria.php')">
	  </td>
        </tr>
      </table>
		</td>
	</tr>

</table>
</form>
