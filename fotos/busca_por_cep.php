<? include "conf.php"; ?>
<html>
	<head>
		<title>Bem vindo ao website dos Correios</title>		
		<link rel="stylesheet" href="correios.css" type="text/css">
   <script Language="JavaScript">
function CriticaCampos()
{
  if (document.Geral.CEP.value == ""){
    alert("Informe no mínimo os 5(cinco) primeiros dígitos do CEP. Ex. 70001");
    document.Geral.CEP.focus();
    return (false);
  }

  if (document.Geral.CEP.value.length <= 4){
   	alert("Informe no mínimo os 5(cinco) primeiros dígitos do CEP. Ex. 70001");
   	document.Geral.CEP.focus();
   	return (false);
  }
  { 
   var Numeros = "0123456789";
   var Posic, Carac;
   var Temp = document.Geral.CEP.value.length;    
   var Cont = 0;
   for (var i=0; i < Temp; i++)   
   {  
   Carac =  document.Geral.CEP.value.charAt (i);
   Posic  = Numeros.indexOf (Carac);   
   if (Posic > -1)   
	  Cont++;      
   }   
   if (Cont == 9){
    	alert("O CEP tem no máximo 8(oito) digitos numéricos. Ex. 70001-970");
    	document.Geral.CEP.focus();
    	return (false);
   } 
 }
 { 
   var Numeros = "0123456789-";
   var Posic, Carac;
   var Temp = document.Geral.CEP.value.length;    
   var Cont = 0;
   for (var i=0; i < Temp; i++)   
   {  
   Carac =  document.Geral.CEP.value.charAt (i);
   Posic  = Numeros.indexOf (Carac);   
   if (Posic == -1)   
      {	  
    	alert("Informe um CEP válido. Ex. 70001-970");
    	document.Geral.CEP.focus();
    	return (false);
      }
   }   
 }
}    
</script> 
<script language="javascript">
	function MascaraCEP (formato, keypress, objeto)
	{
	campo = eval (objeto);
	if (formato=='CEP')
		{
		caracteres = '01234567890';
		separacoes = 1;
		separacao1 = '-';
		conjuntos = 2;
		conjunto1 = 5;
		conjunto2 = 3;
		if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < 
		(conjunto1 + conjunto2 + 1))
			{
			if (campo.value.length == conjunto1) 
			   campo.value = campo.value + separacao1;
			}
		else 
			event.returnValue = false;
		}
	}
</script>
<script Language="JavaScript"> 
 function AjudaporCEP()
 {   
   DocRemote = window.open ('http://www.correios.com.br/servicos/cep/ajuda_cep.htm','CEP','scrollbars,resizable,width=320,height=200');  	   
 }    
</script>
	</head>
	<body>			
		<!-- inicio borda -->	
		<table width="320" border="0" cellspacing="0" cellpadding="0">	
			<tr>				
				<td bgcolor="#002a78">					
					<table width="100%" border="0" cellspacing="1" cellpadding="5">								
						<tr>
							<td bgcolor="#FFFFFF">
								<img src="<? echo $end_objetos; ?>arquivos/images/cep/barra_correios.gif" border="0">		 								
								<hr>
								<h1>Consulta por CEP</h1>
								<table align="center" width="300" border="0" cellspacing="0" cellpadding="0">	
									<tr>				
										<td bgcolor="#002a78">									
											<table width="100%" border="0" cellspacing="1" cellpadding="5">								
												<tr>
													<td bgcolor="#d8e6ed">
													  <table width="100%" border="0" cellspacing="1" cellpadding="5">
  														<form name="Geral" method="post" onSubmit="return CriticaCampos();" action="http://www.correios.com.br/servicos/cep/cep_resp_pesq.cfm?RequestTimeout=50">
															<tr>
						    									<td><b>CEP:&nbsp;&nbsp;&nbsp;</b></td>
						    								</tr>
															<tr>
						    									<td><INPUT align=left maxLength=9 name=CEP size=9 onKeyPress="MascaraCEP('CEP', window.event.keyCode, 'document.Geral.CEP');"></td>
															</tr>															
															<tr>
																
                              <td colspan="2"> <a href="http://www.correios.com.br/servicos/cep/dne.cfm"><img src="../arquivos/images/cep/dne_azul_p.gif" width="38" height="34" border="0" align="right"></a>	
                                <input type="Submit" value="Ok" style="background-color: #FFCA00;">
      																<input type="Button" value=" ? " style="background-color: #FFCA00;" onclick="AjudaporCEP()">
			      													<a onclick="AjudaporCEP()"><b> Ajuda</b></a>
                                 								 </td>
															</tr>
  														</form>			
														</table>																											
													</td>
												</tr>
											</table>									
										</td>
									</tr>
								</table>														
							</td>				
						</tr>			
					</table>			
				</td>				
			</tr>			
		</table>								
	</body>
</html>

