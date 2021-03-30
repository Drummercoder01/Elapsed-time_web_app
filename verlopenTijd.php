<?php

$_srv= $_SERVER['PHP_SELF'];
	
$_vandaag= strftime("%D");

if (!isset($_POST['submit']))
{
	//Form. Initialisatie
	$_output="
	<h1>Verlopen Tijd Bereken</h1>
	<form method=post action=$_srv>
	<label>van datum</label>
	<input type=date name=vanDatum><br><br>
	<label>tot datum</label>
	<input type= date name= totDatum><br><br>
	<input type= submit value= Verzenden name= submit></form>";
} 
else
{
	//Form. Verwerking
	$_vanDatum=$_POST["vanDatum"]!=""?
		$_POST["vanDatum"]:"1970-01-01";
	$_totDatum=$_POST["totDatum"]!=""?
		$_POST["totDatum"]:strftime("%Y-%m-%d");
	
	//verwerking
	list($_vJaar, $_vMaand, $_vDag) = explode("-", $_vanDatum,3);
	
	list($_tJaar, $_tMaand, $_tDag) = explode("-",$_totDatum,3);
	
	$_van= mktime(0,0,0,$_vMaand, $_vDag, $_vJaar);
	$_tot= mktime(0,0,0,$_tMaand, $_tDag, $_tJaar);
	$_seconden = $_tot - $_van;
	$_minuten = floor($_seconden /60);
	$_uren = floor($_minuten /60);
	$_dagen = floor($_uren /24);
	$_jaren = $_tJaar - $_vJaar;
	$_jaren = $_tMaand - $_vMaand < 0? $_tJaar - $_vJaar -1:$_tJaar - $_vJaar;
	$_maanden = $_jaren *12 + ($_tMaand - $_vMaand);
		
	$_output = 
		"<h2>Tussen $_vDag/$_vMaand/$_vJaar en $_tDag/$_tMaand/$_tJaar <br>verliepen er</h2>
		$_seconden seconden of<br>
		$_minuten minuten of<br>
		$_uren uren of<br>
		$_dagen dagen of<br>
		$_maanden maanden of<br>
		$_jaren jaren verlopen";
}

//output
echo($_output);

?>









