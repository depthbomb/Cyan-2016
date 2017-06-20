{extends 'global.layout.tpl'}
{block body}
<div class="container">
	<div class="widget widget-summary widget-info top-large-margin">
		<div class="summary-title">{$article_title}</div>
		<div class="summary-light summary-padded">
			{$article_content}
		</div>
		<div class="summary-subtitle">
			<div class="btn-group">
				<a href="{URL}/help" class="btn btn-primary btn-sm"><span class="fa fa-arrow-left"></span> Return to Help</a>
				<a href="{URL}" class="btn btn-primary btn-sm"><span class="fa fa-home"></span> Return to Home</a>
				<a href="javascript:;" class="btn btn-primary btn-sm" clipboard data-clipboard-text="{URL}/help/kb/{$article_id}"><span class="fa fa-link"></span> Copy URL</a>
				{if $is_admin}
				<a href="#edit_kb{$article_id}" data-toggle="collapse" class="btn btn-success btn-sm"><span class="fa fa-pencil"></span> Edit this article</a>
				{/if}
			</div>
			{if $is_admin}
			<div id="edit_kb{$article_id}" class="collapse">
				<span class="horizontal-divider"></span>
				<form method="post" action="{URL}/processor/admin.edit.kb">
					<input name="kb_id" type="hidden" value="{$article_id}" required>
					<fieldset class="form-group">
						<label>Article Title</label>
						<input name="kb_title" type="text" class="form-control" placeholder="Article Title" value="{$article_title}" required>
					</fieldset>
					<fieldset class="form-group">
						<label>Article Content</label>
						<textarea id="summernote" name="kb_content" class="form-control" rows="20" placeholder="Article Content" required>{$article_content|htmlspecialchars}</textarea>
					</fieldset>
					<fieldset>
						<button type="submit" class="btn btn-success">Save</button>
					</fieldset>
				</form>
			</div>
			{/if}
		</div>
	</div>
</div>
{/block}