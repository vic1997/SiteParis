<?php
	date_default_timezone_set('Europe/Paris');
	require("../Modele/modele_news.php");
		
	$r= new News();
	include("../utils/header.php");
	$lesNews=$r->readAll();
	include("../Vue/vue_accueil_paris.php");

	include('../newStyle.css.php');

?>	
