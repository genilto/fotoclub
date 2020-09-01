function GetObject(obj){
	if (document.getElementById) {
		return document.getElementById(obj);
	} else if (document.all) {
		return document.all[obj];
	}
}

function mostrar(obj, mostrar){
	if(mostrar == true){
		eval("GetObject('"+obj+"').style.display = 'block';");
	}else{
		eval("GetObject('"+obj+"').style.display = 'none';");
	}
}

function conteudo(obj, valor){
	eval("GetObject('"+obj+"').innerHTML = '"+valor+"';");
}

function mostra_pagina(){
	if(!GetObject('ck01').checked){
    	GetObject('camada_pagina').style.display = 'none';
    }else{ 
		GetObject('camada_pagina').style.display = 'block'; 
	}
}

function mOver(local,cor) {
	local.bgColor = cor;
}
function mOut(local,cor) {
	local.bgColor = cor;
}

function mostra_mao(obj){
	obj.style.cursor = 'hand';
}

function ponteiro(obj, ponteiro){
	obj.style.cursor = ponteiro;
}

function pula(obj1,dest,num){
	if (obj1.value.length == num){
		obj2=obj1.form;
		destino=eval("obj2."+dest);
		destino.focus();
	}
}


function scrollmarquee(){
         var sTexto = '';
		 sTexto = aLogo[iCont]+aData[iCont]+aTitulo[iCont]+aTrecho[iCont];
         iCont++;
         if (iCont == aTitulo.length) iCont=0;
         GetObject('sc').innerHTML = sTexto;
}

function abre_noticia(idnoticia){
	window.location = 'noticias.php?id='+idnoticia; 
}


//outras


function disable(form){
	form.sendBtn.disabled = true;
	form.sendBtn.value = "Aguarde...";
}

function chama_funcao(funcao) { 
  return eval(funcao);
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function valida_confirma(){
	if (confirm("Confirma exclusão?")){
		return true;
	}else{
		return false;
	}
}

function alerta(pagina){
	alert("Esta pagina abrirá em uma nova janela")
}

function atualiza_cores (form, form_des) {
	form_des.value = form.options[form.selectedIndex].value;
	if (form.options[form.selectedIndex].value == ""){
		form_des.focus();
		form_des.value = "#";
	}
}

function favoritos(url, titulo){
	if ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4)) {
	window.external.AddFavorite(url,titulo);
	}else{
		alert("Seu navegador não suporta essa função");
	}
}

function valida_comentario(form){
	//VERIFICA NOME
	if (GetObject('nome_comentario').value == ""){
		alert("Por favor preenha seu Nome");
		GetObject('nome_comentario').focus();
		return false;
	}
	//VERIFICA EMAIL	
	if (GetObject('email_comentario').value != ""){
		email = GetObject('email_comentario').value;
		posicaoDaArroba = email.indexOf("@");
		antesDaArroba = email.substring(0,posicaoDaArroba);
		depoisDaArroba = email.substring(posicaoDaArroba);
		primeiroPonto = depoisDaArroba.indexOf(".");
		depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);
		if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto==""){
			alert("Seu E-Mail não parece ser válido. Verifique!");
			GetObject('email_comentario').focus();
			return false;
		}
	}
		//VERIFICA comentario
	if (GetObject('comentario_comentario').value == ""){
		alert("Por favor preenha seu Comentário");
		GetObject('comentario_comentario').focus();
		return false;
	}
		
	form.sendBtn.disabled = true;
	form.sendBtn.value = "Aguarde...";
		
}

function valida_indica(){
//VERIFICA NOME
   if (GetObject('nome').value == ""){
      alert("Por favor preenha seu Nome");
	  GetObject('nome').focus();
	  return false;
	}else if (GetObject('email').value == ""){
		alert("Por favor preecha seu E-mail!");
		GetObject('email').focus();
		return false;
	}else{
		email = GetObject('email').value;
		posicaoDaArroba = email.indexOf("@");
		antesDaArroba = email.substring(0,posicaoDaArroba);
		depoisDaArroba = email.substring(posicaoDaArroba);
		primeiroPonto = depoisDaArroba.indexOf(".");
		depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);
		
		if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto==""){
			alert("Seu E-Mail não parece ser válido. Verifique!");
			GetObject('email').focus();
			return false;
		}
	}
		

	//VERIFICA EMAIL AMIGO 1
	if (GetObject('email_amigo').value != ""){
			
		email = GetObject('email_amigo').value;
		posicaoDaArroba = email.indexOf("@");
		antesDaArroba = email.substring(0,posicaoDaArroba);
		depoisDaArroba = email.substring(posicaoDaArroba);
		primeiroPonto = depoisDaArroba.indexOf(".");
		depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);

		if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto==""){
			alert("O E-Mail de seu amigo não parece ser válido. Verifique!");
			GetObject('email_amigo').focus();
			return false;
		}
		//VERIFICA EMAIL AMIGO 2
		if (GetObject('email_amigo2').value != ""){

			email = GetObject('email_amigo2').value;
			posicaoDaArroba = email.indexOf("@");
			antesDaArroba = email.substring(0,posicaoDaArroba);
			depoisDaArroba = email.substring(posicaoDaArroba);
			primeiroPonto = depoisDaArroba.indexOf(".");
			depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);

			if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto==""){
				alert("O E-Mail de seu amigo não parece ser válido. Verifique!");
				GetObject('email_amigo2').focus();
				return false;
			}
			//VERIFICA EMAIL AMIGO 3
			if (GetObject('email_amigo3').value != ""){
				
				email = GetObject('email_amigo3').value;
				posicaoDaArroba = email.indexOf("@");
				antesDaArroba = email.substring(0,posicaoDaArroba);
				depoisDaArroba = email.substring(posicaoDaArroba);
				primeiroPonto = depoisDaArroba.indexOf(".");
				depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);

				if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto==""){
					alert("O E-Mail de seu amigo não parece ser válido. Verifique!");
					GetObject('email_amigo3').focus();
					return false;
				}
			}
		}
	}
}



function valida_login_menu(){
//VERIFICA USERNAME
 if (document.login_menu.username.value == ""){
      alert("Por favor preenha seu Username");
	  document.login_menu.username.focus();
	  return false;
	}
 //VERIFICA SENHA
 if (document.login_menu.senha.value == ""){
      alert("Por favor preenha sua Senha");
	  document.login_menu.senha.focus();
	  return false;
	}
}	

function valida_login(){
//VERIFICA USERNAME
 if (document.login.username.value == ""){
      alert("Por favor preenha seu Username");
	  document.login.username.focus();
	  return false;
	}
 if (document.login.senha.value == ""){
      alert("Por favor preenha sua Senha");
	  document.login.senha.focus();
	  return false;
	}
}	

function valida_contato(){
//VERIFICA NOME

 if (document.contato.nome.value == ""){
      alert("Por favor preenha seu Nome");
	  document.contato.nome.focus();
	  return false;
	}
	
	
//VERIFICA EMAIL
 if (document.contato.email.value == "")
				{
					alert("Por favor preecha seu E-mail!");
					document.contato.email.focus();
					return false;
				}
				else
				{
				email = document.contato.email.value;
				posicaoDaArroba = email.indexOf("@");
				antesDaArroba = email.substring(0,posicaoDaArroba);
				depoisDaArroba = email.substring(posicaoDaArroba);
				primeiroPonto = depoisDaArroba.indexOf(".");
				depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);
				if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto=="")
				{
					alert("Seu E-Mail não parece ser válido. Verifique!");
					document.contato.email.focus();
					return false;
				}
		 }	
	
	//VERIFICA TEXTO	 
   if (document.contato.texto.value == ""){
      alert("Por favor preenha sua mensagem, dúvida, sugestão ou reclamação");
	  document.contato.texto.focus();
	  return false;
	}
}



function testar_username(){
	v = document.cadastro.username.value;
	v = v.toLowerCase();
	document.cadastro.username.value = v;
	if(v.length < 3){
		alert("Username muito curto, deve conter no mínimo 3 caracteres.");
		document.cadastro.username.focus();
	}else{
		abre('testar_username.php?v='+ v,'testar_username','width=300,height=110');
	}
}


function ver_cor(form){
	erros = "";
	if (form.value == "" || form.value == "#"){
		alert("Preencha ou escolha uma cor!");
		form.focus();
		erros = "sem cor";
	}
	if (erros == ""){
		cor = escape(form.value);
		abre('ver_cor.php?cor='+ cor, 'ver_cor', 'width=100,height=100');
	}
}



function abre(theURL,winName,features) {
	window.open(theURL,winName,features);
}


function valida_cadastro(acao){

//VERIFICA NOME

 if (document.cadastro.nome_cadastro.value == ""){
      alert("Por favor preenha seu Nome");
	  document.cadastro.nome_cadastro.focus();
	  return false;
	}

//VERIFICA SOBRENOME
if (document.cadastro.sobrenome.value == ""){
      alert("Por favor preenha seu Sobrenome");
	  document.cadastro.sobrenome.focus();
	  return false;
	}

//VERIFICA EMAIL
if (document.cadastro.email.value == "")
				{
					alert("Por favor preecha seu E-mail!");
					document.cadastro.email.focus();
					return false;
				}
				else
				{
				email = document.cadastro.email.value;
				posicaoDaArroba = email.indexOf("@");
				antesDaArroba = email.substring(0,posicaoDaArroba);
				depoisDaArroba = email.substring(posicaoDaArroba);
				primeiroPonto = depoisDaArroba.indexOf(".");
				depoisDoPrimeiroPonto = depoisDaArroba.substring(primeiroPonto+1);
				if (antesDaArroba=="" || posicaoDaArroba=="-1" || email.indexOf(".") < 1 || primeiroPonto==1 || depoisDoPrimeiroPonto=="")
				{
					alert("Seu E-Mail não parece ser válido. Verifique!");
					document.cadastro.email.focus();
					return false;
				}
		}
 
//VERIFICA USERNAME
if (acao == "insere"){
	if (document.cadastro.username.value == ""){
		alert("Por favor preenha seu username");
		document.cadastro.username.focus();
		return false;
	}else if(document.cadastro.username.value.length < 3){
		alert("Seu nome de usuário deve conter no mínimo 3 caracteres");
		document.cadastro.username.focus();
		return false;
	}else{
		username = document.cadastro.username.value.toLowerCase();
		document.cadastro.username.value = username;
	}
}
//VERIFICA SENHA
if(document.cadastro.senha.value.length < 6 && document.cadastro.senha.value != ""){
	alert("Sua senha deve conter no mínimo 6 caracteres");
	document.cadastro.senha.focus();
	return false;
}else if (document.cadastro.senha.value == "" && acao == "insere"){
	alert("Por favor preenha sua senha");
	document.cadastro.senha.focus();
	return false;
	//VERIFICA SE AS SENHAS SÃO IGUAIS
}else if(acao == "insere"){
	if(document.cadastro.senha.value != document.cadastro.confirma.value){
		alert("As senhas não são iguais");
		document.cadastro.senha.focus();
		return false;
	}
}

//VERIFICA DIA
if (document.cadastro.dia_nasc.value == ""){
      alert("Por favor escolha o dia");
	  document.cadastro.dia_nasc.focus();
	  return false;
	}

//VERIFICA MES
if (document.cadastro.mes_nasc.value == ""){
      alert("Por favor escolha o mes");
	  document.cadastro.mes_nasc.focus();
	  return false;
	}

//VERIFICA ANO
if (document.cadastro.ano_nasc.value == ""){
      alert("Por favor escolha o ano");
	  document.cadastro.ano_nasc.focus();
	  return false;
	}	
	
//VERIFICA PAIS
if (document.cadastro.pais.value == ""){
      alert("Por favor preencha seu pais");
	  document.cadastro.pais.focus();
	  return false;
	}
//VERIFICA ESTADO
if (document.cadastro.estado.value == ""){
      alert("Por favor preencha seu estado");
	  document.cadastro.estado.focus();
	  return false;
	}
	
//VERIFICA CEP
if (document.cadastro.cep1.value == ""){
      alert("Por favor preenha seu cep");
	  document.cadastro.cep1.focus();
	  return false;
	}
else{
if (document.cadastro.cep2.value == ""){
      alert("Por favor preenha seu cep");
	  document.cadastro.cep2.focus();
	  return false;
	}
else{
if (document.cadastro.cep1.value.length < 5){
      alert("Por favor preenha seu cep corretamente");
	  document.cadastro.cep1.focus();
	  return false;
	}
else{
if (document.cadastro.cep2.value.length < 3){
      alert("Por favor preenha seu cep corretamente");
	  document.cadastro.cep2.focus();
	  return false;
	}
   }
  }	
 }
if (document.cadastro.sobre.value == ""){
      alert("Por favor preenha o campo \"Sobre mim\"");
	  document.cadastro.sobre.focus();
	  return false;
	}
}