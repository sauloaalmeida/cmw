<div id="newsletter">

<script src="nucleo/js/default.js"></script>
<script>

   function validaForm(frm){

     if(func_bl_isvazio(frm.nome,"O preenchimento do campo nome \u00e9 obrigat\u00f3rio."))
	return false;

     if(!isEmail(frm.email.value)){
	alert("E-mail em branco ou formato inv\u00e1lido.");
        frm.email.focus();
	return false;
     }

	window.open('blank.php','winPopNewsLetter','width=250,height=130,top=200,left=200');

     frm.submit();

   }

</script>
<form action="newsletter_done.php" method="post" onsubmit="return validaForm(this);" target="winPopNewsLetter">
        <h2>RECEBA NOSSO NEWS</h2>
        <div class="box"> <span class="txt01">Receba novidades em seu <br />
          email do CRMV-BA</span><br>
          <label>nome
          <input type="text" name="nome" id="nome" style="width:170px">
          </label>
          <label>email
          <input type="text" name="email" id="email" style="width:170px">
          </label>
          <div align="right" style="text-align:right; border-top:1px solid #ccc; padding-top:5px;">
            <input name="ok" type="submit" class="botao1" id="ok" value="ok" style="margin-bottom:0;" alt="Confirmar" />
          </div>
          <label></label>
        </div>
        </form>
      </div>