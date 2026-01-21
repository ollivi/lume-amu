<?php if(!empty($file)): ?>
	<section class="pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-10 mt-4" style="margin: auto;height: 800px;">
					<embed
					src="<?php echo base_url("public/revue/".$file->file_name); ?>"
					type="application/pdf"
					frameBorder="0"
					scrolling="auto"
					height="100%"
					width="80%"
					></embed>
				</div>
				<aside class="col-md-2 blog-sidebar">
					<div class="p-3 text-right">
						<h4 class="font-italic">Archives</h4>
						<ol class="list-unstyled mb-0">
							<?php foreach($archives as $key => $revue): ?>
								<li><a href="<?php echo base_url("revue/archives/".$revue->id); ?>"><?php echo date('F, Y', strtotime($revue->created_at)); ?></a></li>
							<?php endforeach; ?>
						</ol>
					</div>
				</aside>
			</div>
		</div>
	</section>
<?php endif; ?>