{extends 'global.layout.tpl'}
{block body}
<div class="container">
	<div class="widget widget-summary widget-info top-large-margin">
		<div class="summary-title">Add an article</div>
		<div class="summary-light summary-padded">
			{if $is_admin}
			<form method="post" action="{URL}/processor/admin.add.kb">
				<fieldset class="form-group">
					<label>Article Title</label>
					<input name="kb_title" type="text" class="form-control" placeholder="Article Title" required>
				</fieldset>
				<fieldset class="form-group">
					<label>Article Content</label>
					<textarea id="summernote" name="kb_content" class="form-control" rows="20" placeholder="Article Content" require></textarea>
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
{/block}