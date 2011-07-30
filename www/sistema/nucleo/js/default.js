function GoTo(url){
	window.location = url;
}


function AbreJanela(url,nomejanela,parametros){
	window.open(url,nomejanela,parametros);
}


function func_bl_isInteiroPositivo(campo,msg){
    campo.value = func_str_trim(campo.value);
    var valor = campo.value;

    if(isNaN(valor)){
        alert(msg);
        campo.focus();
        return false;
    }else{
        if( (valor.indexOf("-", 0) != -1) || (valor.indexOf(".", 0) != -1)){
            alert(msg);
            campo.focus();
            return false;
        }
            
    }
    return true;
}


function selecionarTodos(checSel,objName){

    var arrSelec = document.getElementsByName(objName);

    for(var i=0;i<arrSelec.length;i++){
        arrSelec[i].checked = checSel.checked;
    }

}


function func_str_trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}


function func_bl_isvazio(field,msg){
   var thisChar;
   var counter = 0;
   var str;
   
    str = field.value
    if ( str == "" ) {
            if (typeof(msg) != "undefined"){ 
		   alert(msg)
		   field.focus()
		}   
		return true;
    }
    
    for (var i=0; i<str.length; i++){
       thisChar = str.substring(i, i+1);
       if (thisChar == " ")
           counter++;
   }
   
   if (counter == str.length){
       if (typeof(msg) != "undefined"){
	    alert(msg);
          field.focus();		
	 }   
      return true;
   }
   
    return false;	
}


function isEmail(str) {
  var supported = 0;
  if (window.RegExp) {
    var tempStr = "a";
    var tempReg = new RegExp(tempStr);
    if (tempReg.test(tempStr)) supported = 1;
  }
  if (!supported) 
    return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
  var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
  var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");
  return (!r1.test(str) && r2.test(str));
}



function isDate(dia,mes,ano,msg){

    if   ((isNaN(parseInt(dia)) || isNaN(parseInt(mes)) ||
    isNaN(parseInt(ano))) ||
		(ano < 1900 || ano > 9999) ||
        (mes < 1 || mes > 12) ||
        (dia < 1 || dia > 31) ||
        (mes == 2 && dia > 28 && (ano % 4 != 0)) ||
        (mes == 2 && dia > 29 && (ano % 4 == 0)) ||
        (dia > 30 && (mes == 4 || mes == 6 || mes == 9 || mes == 11))) {
			alert(msg);
			return false;
    }else 
	   return true;
}


function compara_data(tx_dia_ini,tx_mes_ini,tx_ano_ini,tx_dia_fim,tx_mes_fim,tx_ano_fim, msg){
  
	
  if (isDate(tx_dia_ini,tx_mes_ini,tx_ano_ini,"Data Inicial invalida"))
	var dtinicial = new Date(tx_ano_ini + "/" + tx_mes_ini + "/" + tx_dia_ini);
  else
     return false;		 	 
	
	
  if (isDate(tx_dia_fim,tx_mes_fim,tx_ano_fim,"Data Final invalida"))
	var dtfinal = new Date(tx_ano_fim + "/" + tx_mes_fim + "/" + tx_dia_fim);
   else
     return false;
	 		

   if (dtinicial > dtfinal){

      if (typeof(msg) != "undefined")
        alert(msg);
      else 	 
        alert("Data final deve ser maior que Data Inicial.");
	 
    return false;
  }
	return true;
}