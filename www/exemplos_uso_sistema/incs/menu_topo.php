<script type="text/javascript" language="javascript">
function pop(){
  //if(bw.ie6||bw.ie5||bw.ie4){
    var newWin;
    var email = window.document.getElementById("User").value;

    //extract domain from email
    //var at = Number(email.indexOf("@"));
    //var domain = email.substr(at+1,email.length-at);
    var domain = "crmvba.org.br";
    var url = "http://webmail."+domain+"/WorldClient.dll?View=Main";

    window.document.getElementById("webmail").action=url;
    newWin =window.open(url,"WorldClient",'resizable=yes,scrollbars=yes,width=780,height=600,toolbar=yes');
    setTimeout('window.document.getElementById("webmail").reset();',10000);

    return false;
  //}
}
</script>
<div id="menu_topo">
    <div id="links_menu"> <a href="index.php">P&Aacute;GINA PRINCIPAL</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="fale_conosco.php">FALE CONOSCO</a></div>
        <div id="buscar"><form id="formBuscaTopo" action="pesquisa_done.php" method="post">BUSCAR:
          <input name="pesquisa" type="text" id="textfield5" value="<?php echo (isset($_POST["pesquisa"]))?trim($_POST["pesquisa"]):"";?>" style="width:180px">
          <a href="javascript:void(0);" onclick="javascript:getElementById('formBuscaTopo').submit();"><img src="images/btn_buscar.gif" width="29" height="29" border="0" align="right"></a></form></div>
    <div id="webmail"><form id="webmail" action="http://webmail.vlsweb.com.br/WorldClient.dll?View=Main" method="POST" target="WorldClient" onsubmit="pop();">WEBMAIL:
      <input type="text" name="User" id="User" onblur="this.className='textBoxNormal';" onfocus="this.className='textBoxFocus';" style="width:160px" value="Digite seu email">
      <input type="password" name="Password" id="Password" onblur="this.className='textBoxNormal';" onfocus="this.className='textBoxFocus';" style="width:100px" value="password" >
      <input type="image" name="ENTRAR" src="images/btn_ok.gif" class="checkbox" style="width: 27px;height: 26px;" align="right" />
    </form></div>
  </div>