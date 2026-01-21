<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>LUME Inscription</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/svg+xml" href="/favicon.svg">
	<meta property="og:title" content="Your Page Title">
	<meta property="og:description" content="Brief description">
	<meta property="og:image" content="/some-image.png">
	<meta property="og:url" content="/this-page.html">
	<meta property="og:site_name" content="Your Site Name">
	<link rel="stylesheet" href="<?= base_url('public/css/bootstrap.min.css');?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('public/css/font-awesome.min.css');?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('public/css/success.css');?>" type="text/css" />
	<script type="text/javascript" src="<?= base_url('public/js/jquery-3.6.0.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/js/bootstrap.min.js');?>"></script>
</head>
<body>
	<div class="card">
		<div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
			<i class="checkmark">✓</i>
		</div>
		<h1>Succès</h1> 
		<!-- <p>Un email vous a été envoyé.<br/>Pour activer votre compte, veuillez cliquer sur le lien de validation présent dans l'email.</p> -->
		<p>Votre compte est attente de validation par un administrateur, après un délais vous pourrez vous connecter.</p>
	</div>