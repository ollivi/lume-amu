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
	<link rel="stylesheet" href="<?= base_url('public/css/all.min.css');?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('public/css/bootstrap-icons.min.css');?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('public/css/bootstrap-datepicker.css');?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('public/css/inscription.css');?>" type="text/css" />
	<script type="text/javascript" src="<?= base_url('public/js/jquery-3.6.0.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/js/bootstrap.bundle.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/js/bootstrap-datepicker.min.js');?>"></script>
	<script type="text/javascript" src="<?= base_url('public/js/inscription.js');?>"></script>
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
							<h2 class="text-uppercase text-center mb-5">Créer un compte</h2>
							<?php echo form_open('inscription/validation'); ?>
								<?php if(isset($error) && !empty($error)): ?>
									<div class="alert alert-danger" role="alert" style="font-size: 0.9rem;">
										<?php echo $error; ?>
									</div>
								<?php endif; ?>
								<div class="form-outline mb-4">
									<input type="text" id="" name="nom" class="form-control form-control-lg" placeholder="Nom"/>
								</div>
								<div class="form-outline mb-4">
									<input type="text" id="" name="prenom" class="form-control form-control-lg" placeholder="Prénom"/>
								</div>
								<div class="form-group mb-4">
									<div class="datepicker date input-group p-0 shadow-sm">
										<input type="text" placeholder="Date de naissance" class="form-control" name="birthdate" id="birthdate">
										<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span></div>
									</div>
								</div>
								<div class="form-outline mb-4">
									<input type="email" id="" name="email" class="form-control form-control-lg" placeholder="Adresse mail"/>
								</div>
								<div class="form-outline mb-4">
									<input type="password" id="" name="password" class="form-control form-control-lg" placeholder="Mot de passe"/>
								</div>
								<div class="form-outline mb-4">
									<input type="password" id="" name="password_confirm" class="form-control form-control-lg" placeholder="Confirmation mot de passe"/>
								</div>
								<div class="form-outline mb-4">
									<select class="form-control form-control-lg mb-4" name="discipline">
										<option selected="true" disabled="disabled">Discipline</option>
										<option value="ALLSH">Arts, Lettres, Langues et Sciences Humaines</option>
										<option value="DSP">Droit et Science politique</option>
										<option value="EG">Economie et Gestion</option>
										<option value="sante">Santé</option>
										<option value="ST">Sciences et Technologies</option>
										<option value="ene">Energie</option>
										<option value="env">Environnemen</option>
										<option value="humanite">Humanité</option>
										<option value="SSV">Santé & Sciences de la Vie</option>
										<option value="STA">Sciences & Technologies Avancée</option>
									</select>
								</div>
								<div class="form-outline mb-4">
									<select class="form-control form-control-lg mb-4" name="study_year">
										<option selected="true" disabled="disabled">Année d'étude</option>
										<option value="L1">License 1</option>
										<option value="L2">License 2</option>
										<option value="L3">License 3</option>
										<option value="M1">Master 1</option>
										<option value="M2">Master 2</option>
										<option value="doctorant">Doctorant</option>
										<option value="other">Autres</option>
									</select>
								</div>
								<div class="form-check d-flex justify-content-center mb-5">
									<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg"/>
									<label class="form-check-label terms" for="form2Example3g">
										J'accepte les conditions et termes d'utilisations: <a href="#!" class="text-body"><u>Termes de services</u></a>
									</label>
								</div>
								<div class="d-flex justify-content-center">
									<input type="submit" name="" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="S'inscrire">
								</div>
								<p class="text-center text-muted mt-5 mb-0">Vous avez déjà un compte ? <a href="connexion" class="fw-bold text-body"><u>Connectez-vous ici</u></a></p>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>