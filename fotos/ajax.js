// JavaScript Document

function salva(titulo, codigo_lados, codigo_meio, codigo_tit, codigo_links, codigo_texto, fonte_tit){
	if (titulo.value == ""){
		alert("Por favor preenha o campo Título");
		titulo.focus();
		return false;
	}else{
		//Verifica e inicia o ajax
		inicia_ajax();
	
		if(ajax){

			ajax.open("POST", "adm_pagina.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

			//passa os parametros
			var params = "titulo="+titulo.value+"&codigo_lados="+codigo_lados.value+"&codigo_meio="+codigo_meio.value+"&codigo_tit="+codigo_tit.value+"&codigo_links="+codigo_links.value+"&codigo_texto="+codigo_texto.value+"&fonte_tit="+fonte_tit.value+"&acao=editar&modo=ajax";
			ajax.send(params);

			conteudo("status_td", "Salvando, aguarde...");
			mostrar('status_tr', true);				
			
			ajax.onreadystatechange = function(){

				if(ajax.readyState == 4) {
					if(ajax.responseText){
						conteudo("status_td", ajax.responseText);
						mostrar("status_tr", true);
						termina_ajax();
					}else{
						conteudo('status_td', "Ocorreu um erro ao tentar salvar suas alterações!");
						mostrar('status_tr', true);
						termina_ajax();
					}
				}
			}
			return false;
		}else{
			termina_ajax();
			return true;
		}
	}
}






//FUNCÕES PARA AJAX
function inicia_ajax(){
	//verifica se o browser tem suporte a ajax
	try{
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch(e){
		try{
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(ex){
			try{
				ajax = new XMLHttpRequest();
			}
			catch(exc){
				ajax = null;
			}
		}
	}
}

function termina_ajax(){
	ajax = null;
}