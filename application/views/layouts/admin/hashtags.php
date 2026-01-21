<script type="text/javascript" src="<?= base_url('public/js/hashtags.js');?>"></script>
<div class="container">
	<div class="row my-4">
		<div class="col-lg-12">
			<h1>Gestion des Hashtags</h1>
		</div>
	</div>
	<?php if(isset($success)): ?>
		<div class="alert alert-success" role="alert">
			<?php echo $success; ?>
		</div>
		<?php elseif(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $error; ?>
		</div>
	<?php endif; ?>
	<div class="row my-4">
		<div class="col-lg-2" style="margin-bottom: 15px;float: left;">
			<div class="input-group rounded">
				<input type="search" class="form-control rounded" id="hashtag-search" placeholder="Rechercher" aria-label="Search" aria-describedby="search-addon" />
			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>Id</th>
							<th>Hashtag</th>
							<th style="text-align: center;">Éditer</th>
							<th style="text-align: center;">Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($hashtags as $key => $hashtag): ?>
							<tr class="hashtag-row">
								<td><?php echo $hashtag->id; ?></td>
								<td><?php echo $hashtag->hashtag; ?></td>
								<td style="text-align: center;"><a href="#" class="editHashtag" data-toggle="modal" data-target=".edit" data-hashtag-id="<?php echo $hashtag->id; ?>" data-hashtag-name="<?php echo $hashtag->hashtag; ?>"><i class="fas fa-edit"></i></a></td>
								<td style="text-align: center;"><a href="#" class="deleteHashtag" data-toggle="modal" data-target=".delete" data-hashtag-id="<?php echo $hashtag->id; ?>"><i class="fas fa-times-circle"></i></a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<nav class="col-lg-12 col-md-12">
					<ul class="pagination justify-content-center">
						<?php echo $this->pagination->create_links(); ?>
					</ul>
				</nav>
				<button type="button" class="btn btn-primary createUser" data-toggle="modal" data-target=".add">Ajouter</button>
			</div>
		</div>
	</div>

	<!-- Modal ajout -->
	<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Ajout d'un Hashtag</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/hashtags/add'); ?>
					<div class="modal-body">
						<div class="col-lg-12" style="display:block;float:left;">
							<div class="form-outline mb-4">
								<input type="text" name="hashtag" class="form-control form-control-lg" placeholder="Nom du Hashtag"/>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Ajouter">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<!-- Modal edition -->
	<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Edition d'Hashtag</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/hashtags/edit'); ?>
					<div class="modal-body">
						<div class="col-lg-12" style="display:block;float:left;">
							<div class="form-outline mb-4">
								<input type="text" name="hashtag" class="form-control form-control-lg" placeholder="Categorie"/>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" value=""/>
						<input type="submit" class="btn btn-primary" value="Modifier">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<!-- Modal delete -->
	<div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Suppression d'Hashtag</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/hashtags/delete'); ?>
					<div class="modal-body">
						Voulez-vous vraiment supprimer cet hashtag ?
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" value=""/>
						<input type="submit" class="btn btn-primary" value="Supprimer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>