// JavaScript Document
function carrega_titulo(){
	GetObject('texto_titulo').innerHTML      = GetObject('titulo').value;
	GetObject('texto_titulo').color          = GetObject('codigo_tit').value;
	GetObject('texto_titulo').face           = GetObject('fonte_tit').value;
	GetObject('texto_titulo_link').color     = GetObject('codigo_tit').value;
}
function carrega_comentario(){
	GetObject('fonte_comentario').color      		= GetObject('codigo_texto').value;
	GetObject('fonte_comentario_link').color 		= GetObject('codigo_texto').value;
	GetObject('fonte_comentario_link_fundo').color 	= GetObject('codigo_texto').value;
}
function carrega_cores(){
	//cor dos links da esquerda
	GetObject('fonte_links_esq').color       = GetObject('codigo_links').value;
	GetObject('fonte_links_esq_link').color  = GetObject('codigo_links').value;
	GetObject('fonte_links_esq_baixo').color = GetObject('codigo_links').value;
	//cor dos links da direita
	GetObject('fonte_links_dir').color       = GetObject('codigo_links').value;
	GetObject('fonte_links_dir_link').color  = GetObject('codigo_links').value;
	GetObject('fonte_links_dir_baixo').color = GetObject('codigo_links').value;
	//cor dos menus
	GetObject('menu_esq').bgColor            = GetObject('codigo_lados').value;
	GetObject('menu_dir').bgColor            = GetObject('codigo_lados').value;
	//cor do conteudo
	GetObject('conteudo').bgColor            = GetObject('codigo_meio').value;
}
