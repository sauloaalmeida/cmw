function ShowHideLayer(layer,acao){
  obj=document.getElementById(layer);
  obj.style.visibility = acao;
}

function AbreJanela(url,nomejanela,parametros){
	window.open(url,nomejanela,parametros);
}


function GoTo(url){
	window.location = url;
}

function func_str_trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}

function AbreJanela(url,nomejanela,parametros){
	window.open(url,nomejanela,parametros);
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



function isDate(objdata,msg){	
dia = objdata.value.substr(0,2);
mes = objdata.value.substr(3,2);
ano = objdata.value.substr(6,4);
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
    }else {
            return true;
    }
}

function maskdata(field,teclapres){

  var caracter = teclapres.keyCode;
  
  if (caracter  == 13)
    return true;
  
  if (((field.value.length == 2) || (field.value.length == 5)) && (caracter == 47))
     field.value = field.value + '/';
 
  if ((caracter  < 48) || (caracter  > 57)){  
     field.focus();     
     return false
  }
  else{
        if (  ((field.value.length == 2) || (field.value.length == 5))  && (caracter != 8)  )
 	      field.value = field.value + '/';
  }
  
 
return true;
}


function ExibeVideos(video,w,h,titulo) {
	var file   = video;
	var larg   = w;
	var alt    = h;
	var title  = titulo;

	var tamanho = file.length;
	objType = file.substr(tamanho-5);
	objType = objType.split(".")[1];
	objType = (objType=="mpg"||objType=="mpeg")?"video/mpeg":
             (objType=="avi"||objType=="wmv")?"video/x-msvideo":
				 (objType=="ra"||objType=="rm"||objType=="rmv")?"audio/x-pn-realaudio-plugin":"video/quicktime";

	var pluginspace = (objType=="video/x-msvideo")?"http://www.microsoft.com/windows/windowsmedia/default.aspx":(objType=="video/quicktime")?"http://www.apple.com/quicktime/download/":"";
	var codebase    = (objType=="video/x-msvideo")?"http://www.microsoft.com/windows/windowsmedia/default.aspx":(objType=="video/quicktime")?"http://www.apple.com/qtactivex/qtplugin.cab":"";

	if (objType == "video/x-msvideo" || objType == "video/mpeg") {
	if (navigator.appName != "Microsoft Internet Explorer") {
			alt = parseInt(alt) + 46;
			document.write('<object pluginspace="'+pluginspace+'" codebase="'+codebase+'" data="'+file+'" type="'+objType+'" width="'+larg+'" height="'+alt+'">');
			document.write('	<param name="ShowControls" value="1">');
			document.write('  <param name="ShowDisplay" value="1">');
			document.write('  <param name="ShowStatusBar" value="1">');
			document.write('</object>');
		} else {
			alt = parseInt(alt) + 50;
			document.write('<embed pluginspace="'+pluginspace+'" src="'+file+'" type="'+objType+'" width="'+larg+'" height="'+alt+'" showcontrols="1" showaudiocontrols="1" ShowStatusBar="1"></embed>');
		};
	} else {
		if (navigator.appName != "Microsoft Internet Explorer") {
			document.write('<object pluginspace="'+pluginspace+'" codebase="'+codebase+'" data="'+file+'" standby="Carregando Video..." type="'+objType+'" width="'+larg+'" height="'+alt+'"></object>');
		} else {
			document.write('<embed pluginspace="'+pluginspace+'" src="'+file+'" type="'+objType+'" width="'+larg+'" height="'+alt+'"></embed>');
		};
	};
}


function TocaAudio(audio) {
	var file   = audio;
	var larg   = 224;
	var alt    = 23;

	document.write('<object id="MediaPlayer" name="MediaPlayer" border=0 width="'+larg+'" height="'+alt+'" classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715" standby="Carregando..." type="application/x-oleobject">');
	document.write('	<param name="FileName" value="'+file+'">');
	document.write('	<param name="ShowDisplay" value="FALSE">');
	document.write('	<param name="uiMode" value="mini">');
	document.write('	<param name="ShowStatusBar" value="TRUE">');
	document.write('	<param name="StatusBar" value="TRUE">');
	document.write('	<param name="AnimationAtStart" value="FALSE">');
	document.write('	<param name="ShowAudioControls" value="TRUE">');
	document.write('	<param name="ShowPositionControls" value="TRUE">');
	document.write('	<param name="Volume" value="120">');
	document.write('	<param name="ShowControls" value="FALSE">');
	document.write('	<param name="AutoSize" value="FALSE">');
	document.write('	<param name="AutoStart" value="TRUE">');
	document.write('	<param name="AutoRewind" value="TRUE">');
	document.write('<embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/windows/mediaplayer/download/default.asp" filename="'+file+'" uimode="mini" src="'+file+'" autostart="1" showstatusbar="1" showdisplay="0" autosize="0" showcontrols="0" autorewind="1" statusbar="0" animationatstart="0" showaudiocontrols="1" showpositioncontrols="0" width="'+larg+'" height="'+alt+'"></embed>');
	document.write('</object>');
}