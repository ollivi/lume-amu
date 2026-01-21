<div class="wrapper">
	<nav id="sidebar" class="bg-dark">
		<div class="sidebar-header">
			<h3>LUME</h3>
		</div>
		<ul class="list-unstyled components">
			<!-- <p>Catégorie</p> -->
<!-- 			<li class="active">
				<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
				<ul class="collapse list-unstyled" id="homeSubmenu">
					<li>
						<a href="#">Home 1</a>
					</li>
					<li>
						<a href="#">Home 2</a>
					</li>
					<li>
						<a href="#">Home 3</a>
					</li>
				</ul>
			</li> -->
<!-- 			<li>
				<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
				<ul class="collapse list-unstyled" id="pageSubmenu">
					<li>
						<a href="#">Page 1</a>
					</li>
					<li>
						<a href="#">Page 2</a>
					</li>
					<li>
						<a href="#">Page 3</a>
					</li>
				</ul>
			</li> -->
			<li>
				<a href="<?php echo base_url('administration/users'); ?>">Utilisateurs</a>
			</li>
			<li>
				<a href="<?php echo base_url('administration/articles'); ?>">Articles</a>
			</li>
			<li>
				<a href="<?php echo base_url('administration/categories'); ?>">Categories</a>
			</li>
			<li>
				<a href="<?php echo base_url('administration/hashtags'); ?>">Hashtags</a>
			</li>
			<li>
				<a href="#">Commentaires</a>
			</li>
			<li>
				<a href="<?php echo base_url('administration/revue-manager'); ?>">Revue</a>
			</li>
			<li>
				<a href="<?php echo base_url('administration/file-manager'); ?>">File Manager</a>
			</li>
		</ul>

		<ul class="list-unstyled CTAs">
			<li>
				<a href="<?php echo base_url('article'); ?>" class="article">Retour au site</a>
			</li>
		</ul>
	</nav>