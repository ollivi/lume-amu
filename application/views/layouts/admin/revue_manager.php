<script type="text/javascript" src="<?= base_url('public/js/file_manager.js');?>"></script>
<script type="text/javascript" src="<?= base_url('public/js/revue_manager.js');?>"></script>
<link rel="stylesheet" href="<?= base_url('public/css/file_manager.css');?>" type="text/css" />


<div class="container">
	<div class="row my-4">
		<div class="col-lg-12">
			<h1>Gestion des revues</h1>
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
				<input type="search" class="form-control rounded" id="file-search" placeholder="Rechercher" aria-label="Search" aria-describedby="search-addon" />
			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<?php foreach($files as $key => $file): ?>
				<div class="col-2 pdf img-thumb float-left <?php echo explode(".", $file->file_name)[0]; ?>">
					<div class="text-center">
						<i class="fa-solid fa-file-pdf" style="font-size:50px;margin-bottom: 15px;"></i>
						<p>
							<span style="font-size: 15px;"><?php echo explode(".", $file->file_name)[0]; ?></span>
							<a href="#" class="deleteFile" data-toggle="modal" data-target=".delete" data-file-name="<?php echo $file->file_name; ?>" data-id="<?php echo $file->id; ?>"><i class="fas fa-times-circle"></i></a>
						</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".add">Importer</button>
	</div>

	<!-- Modal delete -->
	<div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Suppression de fichier</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/revue-manager/delete'); ?>
					<div class="modal-body">
						Voulez-vous vraiment supprimer ce fichier ?
					</div>
					<div class="modal-footer">
						<input type="hidden" name="file_name" value=""/>
						<input type="hidden" name="id" value=""/>
						<input type="submit" class="btn btn-primary" value="Supprimer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<!-- Modal upload -->
	<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Importer un fichier</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open_multipart('administration/revue-manager/upload'); ?>
					<div class="modal-body">
						Selectionner un fichier à importer
						<input type="file" class="form-control-file" name="file_upload" id="file">
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Importer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>