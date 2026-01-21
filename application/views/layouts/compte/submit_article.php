<script src="https://cdn.tiny.cloud/1/p8pg9nh3gwqus8lct8d0xnxdr4g1ewha4wwb2ans2936mo8z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript" src="<?= base_url('public/js/article_creation.js');?>"></script>
<script type="text/javascript" src="<?= base_url('public/js/multi-select.js');?>"></script>
<link rel="stylesheet" href="<?= base_url('public/css/article_creation.css');?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('public/css/multi-select.css');?>" type="text/css" />

<div class="container">
	<div class="row my-4">
		<div class="col-lg-12">
			<h1>Rédaction de l'article</h1>
		</div>
	</div>
	<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $error; ?>
		</div>
	<?php endif; ?>
	<div class="row my-4">
		<div class="col-lg-12 col-md-12">
			<?php echo form_open('mon-compte/article/create'); ?>
				<div class="">
					<div class="col-lg-12" style="display:block;float:left;">
						<div class="form-outline mb-4" style="display: inline-block;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".file">Importer</button>
							<label for="header_image">L'image de la headline</label>
							<input type="hidden" name="header_image" value="" id="header_image" />
						</div>
						<div class="form-outline col-12 mb-4">
							<div class="text-center">
								<img src="<?php echo base_url("public/uploads/"); ?>" alt="" id="file-preview">
							</div>
						</div>
						<div class="form-outline mb-4">
							<input type="text" name="header_title" class="form-control form-control-lg" placeholder="Titre"/>
						</div>
						<div class="form-outline mb-4">
							<input type="text" name="header_subtitle" class="form-control form-control-lg" placeholder="Sous-titre"/>
						</div>
					</div>
					<div class="col-lg-12" style="display:block;float:left;margin-bottom: 10px;">
						<div class="form-outline">
 							<select class="form-control form-control-lg mb-4" name="category" data-placeholder="Catégorie">
								<?php foreach($categories as $key => $category): ?>
									<option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-outline">
 							<select class="form-control form-control-lg mb-4" name="hashtags[]" multiple data-placeholder="Hashtags">
								<?php foreach($hashtags as $key => $hashtag): ?>
									<option value="<?php echo $hashtag->id; ?>"><?php echo $hashtag->hashtag; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="text" name="text" rows="16"></textarea>
						</div>
					</div>
				</div>
				<div class="">
					<input type="submit" class="btn btn-primary" value="Soumettre">
					<a href="<?php echo base_url("mon-compte"); ?>" class="btn btn-secondary">Annuler</a>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<!-- Modal image selection -->
	<div class="modal fade file" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Selectionner une image</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<?php foreach($files as $key => $file): ?>
						<div class="col-2 img-thumb float-left <?php echo explode(".", $file)[0]; ?>">
							<div class="text-center">
								<img src="<?php echo site_url('/public/uploads/'.$file); ?>" alt="<?php echo $file; ?>" id="<?php echo explode(".", $file)[0]; ?>" class="file-preview">
								<p>
									<form>
										<input class="form-check-input" type="radio" name="new_image" value="<?php echo $file; ?>" id="<?php echo explode(".", $file)[0]; ?>-radio" />
										<?php echo explode(".", $file)[0]; ?>
									</form>
								</p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmImport">Confirmer</button>
				</div>
			</div>
		</div>
	</div>