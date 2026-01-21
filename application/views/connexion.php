<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>LUME Connexion</title>
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
	<link rel="stylesheet" href="<?= base_url('public/css/inscription.css');?>" type="text/css" />
	<script type="text/javascript" src="<?= base_url('public/js/jquery-3.6.0.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/js/bootstrap.min.js');?>"></script>
</head>
<body>
<section class="vh-100 bg-image h-100">
	<div class="col-lg-2" style="margin: 15px 0 0 15px;">
		<a href="article" id="back-to-website"><i class="prev-icon"></i>Retourner sur le site</a>
	</div>
	<div class="mask d-flex align-items-center h-100 gradient-custom-3">
		<div class="container h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-9 col-lg-7 col-xl-6">
					<div class="card" style="border-radius: 15px;">
						<div class="card-body p-5">
							<h2 class="text-uppercase text-center mb-5">Connexion</h2>
							<?php echo form_open('connexion/validation'); ?>
								<div class="form-outline mb-4">
									<input type="email" id="" name="email" class="form-control form-control-lg" placeholder="Adresse mail"/>
								</div>
								<div class="form-outline mb-4">
									<input type="password" id="" name="password" class="form-control form-control-lg" placeholder="Mot de passe"/>
									<a href="reset-password" class="text-body" style="font-size: 0.7rem !important;">Mot de passe oublié ?</a>
								</div>
								<div class="d-flex justify-content-center">
									<input type="submit" name="" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Valider">
								</div>
								<div class="text-center text-lg-start mt-4 pt-2">
									<p class="small fw-bold mt-2 pt-1 mb-0">Pas de compte ? <a href="inscription" class="link-danger">S'inscrire</a></p>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>