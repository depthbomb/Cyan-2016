{extends 'global.layout.tpl'}
{block body}
<article class="slim-article">
	<div class="container">
		<div class="widget widget-summary">
			<div class="summary-title">Create Post</div>
			<div class="summary-light summary-padded">
				{if $is_admin}
				<form method="post" action="{URL}/processor/admin.add.post">
					<fieldset class="form-group">
						<label>Post Title</label>
						<input name="post_title" type="text" class="form-control input-lg" placeholder="Post Title" required>
					</fieldset>
					<fieldset class="form-group">
						<label>Post Content</label>
						<textarea id="summernote" name="post_content" class="form-control" rows="20" placeholder="Post Content" require></textarea>
					</fieldset>
					<fieldset>
						<button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
					</fieldset>
				</form>
				{else}
				<h1 class="text-center text-danger">You do not have permission to access this page.</h1>
				{/if}
			</div>
		</div>
	</div>
</article>
{/block}