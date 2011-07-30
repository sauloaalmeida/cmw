<br>
<table width="100%" border="0" align="center">
<?php
$enqueteCategoria = new EnqueteCategoria;

//cria conexao com o banco
$enqueteCategoria->dbconn->conectar();

//pega as categorias
$RScategoria = $enqueteCategoria->GetCategorias();

while ( $RStemp = $enqueteCategoria->dbconn->getRecordsetArray($RScategoria) )
  echo "<tr><td><input type='button' value=\"".$RStemp["enq_cat_nome"]."\" class='botao01' onClick=\"GoTo('../enquete/ap_index_lst_enquete.php?enq_cat_pk=".$RStemp["enq_cat_pk"]."')\"><br><br></td></tr>";

$enqueteCategoria->dbconn->fechar();
?>
</table>