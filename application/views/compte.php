<link rel="stylesheet" href="<?= base_url('public/css/particles.css');?>" type="text/css" />
<script type="text/javascript" src="<?= base_url('public/js/compte.js');?>"></script>
<script type="text/javascript" src="<?= base_url('public/js/particles.min.js');?>"></script>
<div id="particles-js"></div>
<div class="container emp-profile">
	<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $error; ?>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-4 justify-content-center mb-switch">
			<div class="profile-img col-6">
				<img style="max-height: 183px !important;max-width: 275px !important;" src="<?php echo base_url("public/profils/".$user->picture); ?>" alt=""/>
			</div>
			<div class="col-md-6">
				<?php echo form_open_multipart('mon-compte/upload', array("id" => "picture_form")); ?>
					<input type="file" accept="image/jpg|png" class="picture_submit py-3" style="max-width: 180px;" name="picture"/>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="profile-head">
				<div class="justify-content-center justify-responsive">
					<h5>
						<?php echo $user->nom." ".$user->prenom; ?>
					</h5>
					<h6>
						<?php echo $year[$user->study_year]." ".$user->discipline; ?>
					</h6>
					<p class="proile-rating">Mes likes : <span><?php echo $likes; ?></span></p>
				</div>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link pad-rl-1-rem active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Informations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link pad-rl-1-rem" id="articles-tab" data-toggle="tab" href="#articles" role="tab" aria-controls="articles" aria-selected="false">Mes articles</a>
					</li>
					<li class="nav-item">
						<a class="nav-link pad-rl-1-rem" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Mes commentaires</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-4 justify-content-end dis-grid mb-hide">
			<div class="profile-img col-6">
				<img style="max-height: 183px !important;max-width: 275px !important;" src="<?php echo base_url("public/profils/".$user->picture); ?>" alt=""/>
			</div>
			<div class="col-md-6">
				<?php echo form_open_multipart('mon-compte/upload', array("id" => "picture_form")); ?>
					<input type="file" class="picture_submit py-3" style="max-width: 180px;" name="picture"/>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="tab-content profile-tab" id="myTabContent">
				<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row">
						<div class="col-md-4">
							<label>Nom</label>
						</div>
						<div class="col-md-4">
							<p><?php echo $user->nom; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Prénom</label>
						</div>
						<div class="col-md-4">
							<p><?php echo $user->prenom; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Email</label>
						</div>
						<div class="col-md-4">
							<p><?php echo $user->email; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Année</label>
						</div>
						<div class="col-md-4">
							<p><?php echo $year[$user->study_year]; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Discipline</label>
						</div>
						<div class="col-md-4">
							<p><?php echo $user->discipline; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 py-3">
							<a class="editUser" data-toggle="modal" data-target=".editInfo" data-user="<?php echo urlencode(json_encode($user)); ?>" class="profile-edit-btn">Modifier</a>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
					<?php foreach($articles as $key => $article): ?>
						<div class="row">
							<div class="col-md-4">
								<label>De <?php echo $article->nom." ".$article->prenom; ?></label>
							</div>
							<div class="col-md-4">
								<a href="<?php echo base_url("article/".$article->id); ?>"><?php echo substr($article->header_title, 0, 120); ?></a>
							</div>
							<div class="col-md-2">
								<a href="<?php echo base_url("mon-compte/article/edition/".$article->id); ?>" class="editArticle"><i class="fas fa-edit"></i></a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
					<?php foreach($comments as $key => $comment): ?>
						<div class="row">
							<div class="col-md-4">
								<label><?php echo substr($comment->header_title, 0, 50); ?></label>
							</div>
							<div class="col-md-4">
								<a href="<?php echo base_url("article/".$comment->article_id); ?>"><?php echo strip_tags(htmlspecialchars_decode(substr($comment->text, 0, 70))); ?></a>
							</div>
							<div class="col-md-2">
								<a class="editComment" href="" data-toggle="modal" data-target=".edit" data-comment-id="<?php echo $comment->id; ?>" data-user-id="<?php echo $comment->user_id; ?>" data-comment-text="<?php echo $comment->text; ?>"><i class="fas fa-edit"></i></a>
							</div>
							<div class="col-md-2">
								<a href="#" class="deleteComment" data-toggle="modal" data-target=".delete" data-comment-id="<?php echo $comment->id; ?>" data-user-id="<?php echo $comment->user_id; ?>"><i class="fas fa-times-circle"></i></a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="profile-work">
				<p><a href="<?php echo base_url("mon-compte/article/submit") ?>" class="add-article" value="">Soumettre un article</a></p>
			</div>
		</div>
	</div>
</div>

<!-- Modal delete -->
<div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h4" id="myLargeModalLabel">Supprimer le commentaire ?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<?php echo form_open('article/commentaire/delete'); ?>
				<div class="modal-body">
					Voulez-vous vraiment supprimer ce commentaire ?
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value=""/>
					<input type="hidden" name="user_id" value=""/>
					<input type="submit" class="btn btn-primary" value="Supprimer">
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
				<h5 class="modal-title h4" id="myLargeModalLabel">Éditer mon commentaire</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<?php echo form_open('article/commentaire/edition'); ?>
				<div class="modal-body">
					<div class="form-group">
						<textarea class="form-control" id="text" name="text" rows="6"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value=""/>
					<input type="hidden" name="user_id" value=""/>
					<input type="submit" class="btn btn-primary" value="Modifier">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

	<!-- Modal edition user -->
	<div class="modal fade editInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Édition d'utilisateur</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('mon-compte/user/update'); ?>
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
					</div>
					<div class="modal-footer" style="width: 100%;">
						<input type="submit" class="btn btn-primary" value="Modifier">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>