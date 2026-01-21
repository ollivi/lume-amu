<script type="text/javascript" src="<?= base_url('public/js/users.js');?>"></script>
<div class="container">
	<div class="row my-4">
		<div class="col-lg-12">
			<h1>Gestion des Utilisateurs</h1>
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
				<input type="search" class="form-control rounded" id="user-search" placeholder="Rechercher" aria-label="Search" aria-describedby="search-addon" />
			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>Id</th>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Email</th>
							<th>Confirmé</th>
							<th>Actif</th>
							<th>Date Inscription</th>
							<th>Éditer</th>
							<th>Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $key => $user): ?>
							<tr class="user-row">
								<td><?php echo $user->id; ?></td>
								<td><?php echo $user->nom; ?></td>
								<td><?php echo $user->prenom; ?></td>
								<td><?php echo $user->email; ?></td>
								<td><?php echo ($user->confirmed) ? "Oui" : "Non"; ?></td>
								<td><?php echo ($user->active) ? "Oui" : "Non"; ?></td>
								<td><?php echo $user->created_at; ?></td>
								<td style="text-align: center;"><a href="#" class="editUser" data-toggle="modal" data-target=".edit" data-user="<?php echo urlencode(json_encode($user)); ?>"><i class="fas fa-edit"></i></a></td>
								<td style="text-align: center;"><a href="#" class="deleteUser" data-toggle="modal" data-target=".delete" data-user-id="<?php echo $user->id; ?>"><i class="fas fa-times-circle"></i></a></td>
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

	<!-- Modal edition -->
	<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Création d'utilisateur</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/users/add'); ?>
					<div class="modal-body">
						<div class="col-lg-6" style="display:block;float:left;">
							<div class="form-outline mb-4">
								<input type="text" name="nom" class="form-control form-control-lg" placeholder="Nom"/>
							</div>
							<div class="form-outline mb-4">
								<input type="text" name="prenom" class="form-control form-control-lg" placeholder="Prénom"/>
							</div>
							<div class="form-outline mb-4">
								<input type="email" name="email" class="form-control form-control-lg" placeholder="Adresse mail"/>
							</div>
						</div>
						<div class="col-lg-6" style="display:block;float: right;">
							<div class="form-group mb-4">
								<div class="datepicker date input-group p-0 shadow-sm">
									<input style="min-height: 44px;" type="text" placeholder="Date de naissance" class="form-control" name="birthdate" id="reservationDate">
									<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span></div>
								</div>
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
						</div>
						<div class="col-lg-12" style="display:block;float:left;">
							<div class="form-outline mb-4">
								<select class="form-control form-control-lg mb-4" name="role">
									<option selected="true" disabled="disabled">Role</option>
									<option value="0">Administrateur</option>
									<option value="1">Auteur</option>
									<option value="2">Membre</option>
								</select>
							</div>
							<div class="form-outline mb-4">
								<input type="password" id="" name="password" class="form-control form-control-lg" placeholder="Mot de passe"/>
							</div>
							<div class="form-outline mb-4">
								<input type="password" id="" name="password_confirm" class="form-control form-control-lg" placeholder="Confirmation mot de passe"/>
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" name="confirmed" id="customSwitch1">
								<label class="custom-control-label" for="customSwitch1">Confirmer l'email</label>
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" name="active" id="customSwitch2">
								<label class="custom-control-label" for="customSwitch2">Activer le compte</label>
							</div>
							<input type="hidden" name="id" value=""/>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Créer">
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
					<h5 class="modal-title h4" id="myLargeModalLabel">Édition d'utilisateur</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/users/update'); ?>
					<div class="modal-body">
						<div class="col-lg-6" style="display:block;float:left;">
							<div class="form-outline mb-4">
								<input type="text" name="nom" class="form-control form-control-lg" placeholder="Nom"/>
							</div>
							<div class="form-outline mb-4">
								<input type="text" name="prenom" class="form-control form-control-lg" placeholder="Prénom"/>
							</div>
							<div class="form-outline mb-4">
								<input type="email" name="email" class="form-control form-control-lg" placeholder="Adresse mail"/>
							</div>
						</div>
						<div class="col-lg-6" style="display:block;float: right;">
							<div class="form-group mb-4">
								<div class="datepicker date input-group p-0 shadow-sm">
									<input style="min-height: 44px;" type="text" placeholder="Date de naissance" class="form-control" name="birthdate" id="reservationDate">
									<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span></div>
								</div>
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
						</div>
						<div class="col-lg-12" style="display:block;float:left;">
							<div class="form-outline mb-4">
								<select class="form-control form-control-lg mb-4" name="role">
									<option selected="true" disabled="disabled">Role</option>
									<option value="0">Administrateur</option>
									<option value="1">Auteur</option>
									<option value="2">Membre</option>
								</select>
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" name="confirmed" id="customSwitch1">
								<label class="custom-control-label" for="customSwitch1">Confirmer l'email</label>
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" name="active" id="customSwitch2">
								<label class="custom-control-label" for="customSwitch2">Activer le compte</label>
							</div>
							<input type="hidden" name="id" value=""/>
						</div>
					</div>
					<div class="modal-footer">
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
					<h5 class="modal-title h4" id="myLargeModalLabel">Suppression d'utilisateur</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/users/delete'); ?>
					<div class="modal-body">
						Voulez-vous vraiment supprimer cet utilisateur ?
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