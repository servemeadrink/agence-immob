<?php

    $dns = 'mysql:host=localhost;dbname=tp_immo';
	$utilisateur = 'root';
	$motDePasse = 'fares2007';

	// Options de connexion
	$options = array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	$connexion = new PDO( $dns, $utilisateur, $motDePasse, $options );
?>