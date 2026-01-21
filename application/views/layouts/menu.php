
<nav class="navbar-expand navbar-light">
	<div class="container-fluid">
		<div class="navbar-collapse" id="navbarColor03">
			<ul class="navbar-nav ml-auto">
				<?php if($this->session->userdata("logged") && intval($this->session->userdata("role")) == 0): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('administration/dashboard'); ?>">Administration</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mon-compte">Compte</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('deconnexion'); ?>">Déconnexion</a>
					</li>
				<?php elseif($this->session->userdata("logged")): ?>
					<li class="nav-item">
						<a class="nav-link" href="mon-compte'); ?>">Compte</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('deconnexion'); ?>">Déconnexion</a>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('connexion'); ?>">Connexion</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('inscription'); ?>">Inscription</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">
			<div class="one">
				<div class="two">
				</div>
			</div>
			<div class="three">
				LUME
			</div>
		</a>

		<div class="navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav me-auto">
				<li class="nav-item">
					<a class="nav-link <?php echo ($this->uri->segment(1) == 'article') ? 'active' : ''; ?>" href="<?php echo base_url('article'); ?>">Articles</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php echo ($this->uri->segment(1) == 'revue') ? 'active' : ''; ?>" href="<?php echo base_url('revue'); ?>">Revue</a>
				</li>
<!-- 				<li class="nav-item">
					<a class="nav-link" href="#">FAQ</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="lume-menu-dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Le LUME</a>
					<div class="dropdown-menu" id="submenu" aria-labelledby="lume-menu-dropdown">
						<a class="dropdown-item" href="#">Qui sommes nous ?</a>
						<a class="dropdown-item" href="#">L'équipe</a>
						<a class="dropdown-item" href="#">Où nous trouver ?</a>
						<a class="dropdown-item" href="#">Contact</a>
						<a class="dropdown-item" href="#">Partenaires</a>
					</div>
				</li> -->
			</ul>
			<?php echo form_open('article/search', array("class" => "d-flex ml-auto", "id" => "search-bar")); ?>
				<input class="form-control me-sm-2" type="text" name="search" placeholder="Rechercher">
				<input class="btn btn-secondary my-2 my-sm-0" type="submit" value="Valider">
			<?php echo form_close(); ?>
		</div>
	</div>
</nav>