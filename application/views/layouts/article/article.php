<script type="text/javascript" src="<?= base_url('public/js/article.js');?>"></script>
<section class="position-relative jarallax pt-5 pb-5 mt-0 align-items-end align-items-md-center w-100 d-flex bg-dark">
	<div class="jarallax-img bg" style="background-image: url(<?php echo base_url('public/uploads/'.$article[0]->header_image); ?>);"></div>
	<div class="container-fluid d-flex h-100">
		<div class="row justify-content-center w-100 align-items-start d-flex text-center h-100">
			<div class="col-12 col-md-10 h-50 ">
				<h1 class=" display-4 text-light mb-2 mt-5"><strong><?php echo $article[0]->header_title; ?></strong> </h1>
				<p class="lead text-light mb-5"><?php echo $article[0]->header_subtitle; ?></p>
				<div class="btn-container-wrapper p-relative d-block zindex-1">
					<a class="btn border-0 btn-lg pr-2 pl-2 pt-3 pb-3 mt-md-5 scroll align-self-center " href="#section-1">
						<i class="fa fa-angle-down fa-2x "></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-8 blog-main">
<!-- 				<h3 class="pb-3 mb-4 font-italic border-bottom">
					From the Firehose
				</h3> -->
				<div class="blog-post">
					<?php echo htmlspecialchars_decode($article[0]->text); ?>
				</div><!-- /.blog-post -->
				<hr>
				<h3 class="mb-3">Par <?php echo ucfirst($article[0]->nom)." ".ucfirst($article[0]->prenom); ?></h3>
				<!-- <img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" style="width: 150px; height: 150px;" src="" data-holder-rendered="true"> -->
				<p class="blog-post-meta">Le <?php echo date("d/m/Y", strtotime($article[0]->created_at)); ?></p>
				<hr>
			</div>
			<aside class="col-md-4 blog-sidebar">
				<div id="bk_social_counter-5" class="widget widget-social-counter">	
					<div class="wrap clearfix">
						<ul class="clearfix">

							<li class="clear-fix">
								<a target="_blank" href="">
									<div class="social-icon"><i class="fa-solid fa-comment"></i></div>
									<div class="data">
										<div class="counter comment"><?php echo count($comments); ?></div>
										<div class="text">Commentaires</div>
									</div>
								</a>
							</li>
							<li class="clear-fix">
								<a target="_blank" href="">
									<div class="social-icon likeArticle <?php echo (in_array($this->session->userdata("user_id"), array_column($article[0]->likes, "user_id"))) ? "liked" : "" ?>" data-url="<?php echo base_url('article/like') ?>" data-id="<?php echo $article[0]->id; ?>"><i class="fa-solid fa-thumbs-up"></i></div>
									<div class="data">
										<div class="counter article"><?php echo count($article[0]->likes); ?></div>
										<div class="text">Likes</div>
									</div>
								</a>
							</li>
<!-- 							<li class="clear-fix">
								<a target="_blank" href="">
									<div class="social-icon"><i class="fa-solid fa-user"></i></div>
									<div class="data">
										<div class="counter">160</div>
										<div class="text">Membres</div>	
									</div>
								</a>
							</li> -->
							<?php if(count($hashtags) > 0): ?>
								<li class="clear-fix">
									<a target="_blank" href="#">
										<div class="social-icon"><i class="fa-solid fa-tags"></i></i></div>
										<div class="data">
											<div class="subscribe">Tags</div>
											<div class="text">
												<?php foreach($hashtags as $key => $tag): ?>
													<?php echo $tag->hashtag; ?>,
												<?php endforeach; ?>
											</div>
										</div>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<div class="p-3 text-right">
					<h4 class="font-italic">Archives</h4>
					<ol class="list-unstyled mb-0">
						<?php foreach($archives as $key => $revue): ?>
							<li><a href="<?php echo base_url("revue/archives/".$revue->id); ?>"><?php echo date('F, Y', strtotime($revue->created_at)); ?></a></li>
						<?php endforeach; ?>
					</ol>
				</div>
<!-- 				<div class="p-3 text-right">
					<h4 class="font-italic">Elsewhere</h4>
					<ol class="list-unstyled">
						<li><a href="#">GitHub</a></li>
						<li><a href="#">Twitter</a></li>
						<li><a href="#">Facebook</a></li>
					</ol>
				</div> -->
			</aside>
		</div>
		<br />
		<div class="row">
			<div class="col-12">
				<?php echo form_open("article/commenter", array("class" => "form-block")); ?>
					<div class="row">
						<?php if($this->session->userdata("logged")): ?>
<!-- 								<div class="col-12">
									<div class="form-group fl_icon">
										<div class="icon"><i class="fa fa-user"></i></div>
										<input class="form-input" type="text" placeholder="Your name">
									</div>
								</div>
								<div class="col-12 fl_icon">
									<div class="form-group fl_icon">
										<div class="icon"><i class="fa fa-envelope-o"></i></div>
										<input class="form-input" type="text" placeholder="Your email">
									</div>
								</div> -->
								<div class="col-12">
									<div class="form-group">
										<textarea class="form-input" required="true" name="text" placeholder="Votre commentaire"></textarea>
									</div>
								</div>
								<div class="col-12 d-flex justify-content-center">
									<input type="hidden" name="artid" value="<?php echo $article[0]->id; ?>">
									<input type="submit" class="btn btn-primary ml-auto" value="Envoyer">
								</div>
						<?php endif; ?>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<?php if(count($comments) > 0): ?>
							<h4 class="card-title">Commentaires récents</h4>
							<h6 class="card-subtitle">Derniers Commentaires des utilisateurs</h6>
						<?php else: ?>
							<h4 class="card-title">Pas de commentaires pour l'instant,</h4>
							<h6 class="card-subtitle">Soyez le premier a commenter!</h6>
						<?php endif; ?>
					</div>
					<div class="comment-widgets m-b-20">
						<?php foreach($comments as $key => $comment): ?>
							<div class="d-flex flex-row comment-row">
								<div class="p-2"><span class="round"><img src="<?php echo base_url('public/profils/'.$comment->picture); ?>" alt="" width="50"></span></div>
								<div class="comment-text w-100">
									<h5><?php echo $comment->prenom." ".substr($comment->nom, 0, 1); ?></h5>
									<div class="comment-footer"> <span class="date">Le <?php echo date("d/m/Y", strtotime($comment->created_at)); ?></span></div>
									<p class="m-b-5 m-t-10"><?php echo $comment->text; ?></p>
									<?php if($this->session->userdata("user_id") == $comment->user_id): ?>
										<ul class="list-inline d-sm-flex my-0 comment-footer action-icons">
											<li class="list-inline-item g-mr-20">
												<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover likeComment <?php echo $comment->id ?> <?php echo (in_array($comment->user_id, array_column($comment->likes, "user_id"))) ? "liked" : "" ?>" data-comment-id="<?php echo $comment->id; ?>" data-url="<?php echo base_url('article/commentaire/like') ?>" href="">
													<i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
												</a>
											</li>
											<li class="list-inline-item g-mr-20">
												<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover editComment" href="" data-toggle="modal" data-target=".edit" data-comment-id="<?php echo $comment->id; ?>" data-user-id="<?php echo $comment->user_id; ?>" data-comment-text="<?php echo $comment->text; ?>">
													<i class="fa fa-pencil g-pos-rel g-top-1 g-mr-3"></i>
												</a>
											</li>
											<li class="list-inline-item g-mr-20">
												<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover deleteComment" href="" data-toggle="modal" data-target=".delete" data-comment-id="<?php echo $comment->id; ?>" data-user-id="<?php echo $comment->user_id; ?>">
													<i class="fa-solid fa-trash g-pos-rel g-top-1 g-mr-3"></i>
												</a>
											</li>
	<!-- 										<li class="list-inline-item ml-auto">
												<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
													<i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
													Répondre
												</a>
											</li> -->
										</ul>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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