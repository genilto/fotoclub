<? include "conf.php"; ?>
<html>
	<head>
		<title><? echo $nome_site; ?>:: Correios Buscar Cep</title>		
		<link rel="stylesheet" href="correios.css" type="text/css">
    <script Language="JavaScript">
    function CriticaCampos()
    {
    if (document.Geral.Localidade.value == "")
    {
    alert("Informe o nome completo da Cidade/Município/Distrito/Povoado. Para o DF poderá ser informado o nome da Região Administrativa (Lago Sul, Lago Norte, Cruzeiro, Taguatinga, etc) !!");
    document.Geral.Localidade.focus();
    return (false);
    } 
    else
    { 
    var Branco = " ";
    var Posic, Carac;
    var Temp = document.Geral.Localidade.value.length;    
    var Cont = 0;
    for (var i=0; i < Temp; i++)   
    {  
    Carac =  document.Geral.Localidade.value.charAt (i);
    Posic  = Branco.indexOf (Carac);   
    if (Posic == -1)   
    Cont++;      
    }   
    if (Cont <= 0)
    {
    alert("Informe o nome completo da Cidade/Município/Distrito/Povoado. Para o DF poderá ser informado o nome da Região Administrativa (Lago Sul, Lago Norte, Cruzeiro, Taguatinga, etc) !!");
    document.Geral.Localidade.focus();
    return (false);
    }   
    }
    if (document.Geral.Logradouro.value == "")
    {
    alert("Informe o nome do logradouro");
    document.Geral.Logradouro.focus();
    return (false);
    }  
    else
    { 
    var Branco = " ";
    var Posic, Carac;
    var Temp = document.Geral.Logradouro.value.length;    
    var Cont = 0;
    for (var i=0; i < Temp; i++)   
    {  
    Carac =  document.Geral.Logradouro.value.charAt (i);
    Posic  = Branco.indexOf (Carac);   
    if (Posic == -1)   
    Cont++;      
    }   
    if (Cont <= 0)
    {
    alert("Informe o nome do logradouro");
    document.Geral.Logradouro.focus();
    return (false);
    }  
    }
    } 
    function AjudaLogradouro()
    {   
       DocRemote = window.open ('http://www.correios.com.br/servicos/cep/ajuda_cep_loc_log.htm','Logradouro','scrollbars,resizable,width=300,height=400');
    }   
    </script>
	</head>
	<body>
<table width="320" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>				
				<td bgcolor="#002a78">					
					<table width="100%" border="0" cellspacing="1" cellpadding="5">								
						<tr>
							
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="<? echo $end_objetos; ?>arquivos/images/fotoclubelogo_cep_correios.gif" width="100" height="67"></td>
                <td><img src="<? echo $end_objetos; ?>arquivos/images/cep/barra_correios.gif" width="200" height="25"></td>
              </tr>
            </table>
            <h1>Consulta de CEP - Localidade / Logradouro</h1>
								<table align="center" width="300" border="0" cellspacing="0" cellpadding="0">	
									<tr>				
										<td bgcolor="#002a78">									
											<table width="100%" border="0" cellspacing="1" cellpadding="5">								
												<tr>
													<td bgcolor="#d8e6ed">
													  <table border="0" cellspacing="1" cellpadding="5">
  														<form name="Geral" method="post" onSubmit="return CriticaCampos();" action="http://www.correios.com.br/servicos/cep/Resultado_Log.cfm?RequestTimeout=50" target="_blank">
																<tr> 
																	<td bgcolor="#d8e6ed"><b>UF:</b></td> 
																	<td bgcolor="#d8e6ed"><b>  
																	<select name=UF>
																	<option value="AC">AC</option>
																	<option value="AL">AL</option>
																	<option value="AM">AM</option>
																	<option value="AP">AP</option>
																	<option value="BA">BA</option>
																	<option value="CE">CE</option>
																	<option value="DF">DF</option>
																	<option value="ES">ES</option>
																	<option value="GO">GO</option>
																	<option value="MA">MA</option>
																	<option value="MG">MG</option>
																	<option value="MS">MS</option>
																	<option value="MT">MT</option>
																	<option value="PA">PA</option>
																	<option value="PB">PB</option>
																	<option value="PE">PE</option>
																	<option value="PI">PI</option>
																	<option value="PR">PR</option>
																	<option value="RJ">RJ</option>
																	<option value="RN">RN</option>
																	<option value="RO">RO</option>
																	<option value="RR">RR</option>
																	<option value="RS">RS</option>
																	<option value="SC">SC</option>
																	<option value="SE">SE</option>
																	<option value="SP">SP</option>
																	<option value="TO">TO</option>
																	</select>
																	</b>
                                  									</td>														
																</tr> 	
																<tr>
																	<td bgcolor="#d8e6ed"><b>Localidade:</b></td> 
																	<td bgcolor="#d8e6ed"><input align=left maxLength=40 name=Localidade size=32 ></td>
																</tr>														
																<tr> 
																	<td bgcolor="#d8e6ed"><b>Tipo:</b><br>
																	<td bgcolor="#d8e6ed"><b>
																	<select name=Tipo >
																	<option value=""></option>
																	<option value="Avenida">Avenida</option>
																	<option value="Bloco">Bloco</option>
																	<option value="Praça">Praça</option>
																	<option value="Quadra">Quadra</option>
																	<option value="Rua">Rua</option>
																	<option value="Outros">Outros</option>
																	</select>
																	</td>
																</tr>
																<tr>	
																	<td><b>Logradouro:</b></td>
																	<td><input align=left maxLength=60 name=Logradouro size=32 onKeypress="if ((event.keyCode > 32 && event.keyCode < 40) || (event.keyCode > 41 && event.keyCode < 48) || (event.keyCode > 57 && event.keyCode < 65) || (event.keyCode > 90 && event.keyCode < 97)) event.returnValue = false;"></td>
																</tr>
																<tr>
																	<td><b>Nº/Lote/Apto/Casa:</b></td>
																	<td><input align=left maxlength=5 name=Numero size=5></td>
																</tr>
																<tr>
																	<td colspan="2">
																	<a href="http://www.correios.com.br/servicos/cep/dne.cfm"><img src="../arquivos/images/cep/dne_azul_p.gif" align="right" border="0"></a>
      																<input type="Submit" value="Ok" style="background-color: #FFCA00;">
      																<input type="Button" value=" ? " style="background-color: #FFCA00;" onclick="AjudaLogradouro()">
			      													<a onclick="AjudaLogradouro()"><b> Ajuda</b></a>
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

