<?php
App::import('Vendor','xtcpdf'); 
$tcpdf = new XTCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// ... 
// etc. 
// see the TCPDF examples  

$html='
<style>
p{
	font-size: 10px;
	margin: 0 0 0 0;
	padding: 0 0 0 0;
}
.no_margin
	{
		margin: 0 0 0 0;
		padding: 0 0 0 0;	
	}
div
	{
		font-size: 11px;
		padding: 4px;
		margin 5 5;
	}
.tdmargin
	{
		margin: 10px 10px;
	}
</style>


<div style="text-align: center;" class="no_margin">UFPI/PRAEC/COORDENADORIA DE NUTRIÇÃO E DIETÉTICA - CND</div>
<div style="text-align: center;" class="no_margin"><b>RESTAURANTE UNIVERSITÁRIO DO CAMPUS TERESINA</b></div>
<div style="text-align: center;" class="no_margin">CARDÁPIO SEMANAL</div>

<table border="1px">
	<tr>
		<td style="text-align: center; height: 160px;" rowspan="2" width="50" heigth="300"> <h5>ALMOÇO</h5> </td>
		<td style="text-align: center;" width="122"><p><b>2a FEIRA ('.$days[0].')</b></p></td>
		<td style="text-align: center;" width="122"><p><b>3a FEIRA ('.$days[1].')</b></p></td>
		<td style="text-align: center;" width="122"><p><b>4a FEIRA ('.$days[2].')</b></p></td>
		<td style="text-align: center;" width="122"><p><b>5a FEIRA ('.$days[3].')</b></p></td>
		<td style="text-align: center;" width="122"><p><b>6a FEIRA ('.$days[4].')</b></p></td>
		<td style="text-align: center;" width="122"><p><b>SÁBADO ('.$days[5].')</b></p></td>	
	</tr>

	<tr>
		<td style="margin: 5px 5px; padding: 5px 5px;">'.$cardapio['Cardapio']['almoco_1'].'</td>
		<td>'.$cardapio['Cardapio']['almoco_2'].'</td>
		<td>'.$cardapio['Cardapio']['almoco_3'].'</td>
		<td>'.$cardapio['Cardapio']['almoco_4'].'</td>
		<td>'.$cardapio['Cardapio']['almoco_5'].'</td>
		<td>'.$cardapio['Cardapio']['almoco_6'].'</td>
	</tr>

	<tr>
		<td colspan="7" style="text-align: center; height: 15px;"><b>CARDÁPIO SUJEITO A ALTERAÇÕES, especialmente no JANTAR</b></td>
	</tr>	

	<tr>
		<td style="text-align: center; height: 145px;"> <h5>JARTAR</h5> </td>
		<td>'.$cardapio['Cardapio']['janta_1'].'</td>
		<td>'.$cardapio['Cardapio']['janta_2'].'</td>
		<td>'.$cardapio['Cardapio']['janta_3'].'</td>
		<td>'.$cardapio['Cardapio']['janta_4'].'</td>
		<td>'.$cardapio['Cardapio']['janta_5'].'</td>
		<td></td>
	</tr>
</table>

<h5 style="text-align: center;">AVISOS</h5><br/>

<table border="1">
	<tr>
		<td style="text-align: center;"><b>
			<span >ATENDENMOS EXCLUSIVAMENTE AA COMUNIDADE</span><br/>
			<center>UNIVERSITÁRIA - Funcionários UFPI, Terceirizados e<br/></center>
			<center>Estudantes regularmente matriculados.<br/></center>
			<br/>
			<span>Para aquisição de fichas, pedimos a gentiliza de trazer dinheiro trocado.
			Facilita o troco e agiliza filas</span>
			</b>
		</td>
		<td style="text-align: center;">
		<b>
		HORÁRIOS DE FUNCIONAMENTO:<br/><br/>
		De 2a a 6a Feira ALMOÇO-'.$cardapio['Cardapio']['h_almoco'].'<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JANTAR-&nbsp;'.$cardapio['Cardapio']['h_janta'].'<br/>
		Sábado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ALMOÇO-'.$cardapio['Cardapio']['h_sab'].'<br/>
		</b>
		</td>
	</tr>
</table>';
$tcpdf->writeHTML($html, true, false, true, false, '');

echo $tcpdf->Output('cardapio.pdf', 'D'); 
//echo $html;