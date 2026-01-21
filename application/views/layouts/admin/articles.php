<script type="text/javascript" src="<?= base_url('public/js/articles_admin.js');?>"></script>
<style type="text/css">
.table thead th
{
	text-align: center;
}
.article-row td
{
	text-align: center;
}
</style>
<div class="container">
	<div class="row my-4">
		<div class="col-lg-12">
			<h1>Gestion des Articles</h1>
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
				<input type="search" class="form-control rounded" id="article-search" placeholder="Rechercher" aria-label="Search" aria-describedby="search-addon" />
			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>Id</th>
							<th>Auteur</th>
							<th>Titre</th>
							<th>Publié</th>
							<th>Date Soumission</th>
							<th>Éditer</th>
							<th>Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($articles as $key => $article): ?>
							<tr class="article-row">
								<td><?php echo $article->id; ?></td>
								<td><?php echo $article->nom." ".$article->prenom; ?></td>
								<td><?php echo $article->header_title; ?></td>
								<td><?php echo ($article->published) ? "Oui" : "Non"; ?></td>
								<td><?php echo $article->created_at; ?></td>
								<td style="text-align: center;"><a href="<?php echo base_url("administration/articles/edition/".$article->id); ?>" class="editArticle"><i class="fas fa-edit"></i></a></td>
								<td style="text-align: center;"><a href="#" class="deleteArticle" data-toggle="modal" data-target=".delete" data-article-id="<?php echo $article->id; ?>"><i class="fas fa-times-circle"></i></a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<nav class="col-lg-12 col-md-12">
					<ul class="pagination justify-content-center">
						<?php echo $this->pagination->create_links(); ?>
					</ul>
				</nav>
				<a href="articles/new" class="btn btn-primary createArticle">Ajouter</a>
			</div>
		</div>
	</div>

	<!-- Modal delete -->
	<div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Suppression d'article</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('administration/articles/delete'); ?>
					<div class="modal-body">
						Voulez-vous vraiment supprimer cet article ?
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