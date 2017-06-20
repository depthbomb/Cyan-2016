{extends 'error.layout.tpl'}
{block body}
	<div class="widget widget-summary widget-{$status_type}">
		<div class="summary-title">
			{$status_title}
		</div>
		<div class="summary-light summary-padded">
			<p>{$status_description}</p>
		</div>
		<div class="summary-subtitle">
			<a href="{URL}" class="btn btn-primary btn-xs"><span class="fa fa-home"></span> Return to home</a>
		</div>
	</div>
{/block}