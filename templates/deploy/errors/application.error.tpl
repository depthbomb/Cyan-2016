{extends 'error.layout.tpl'}
{block body}
	<h1 class="text-center text-danger top-margin bottom-margin">\(≧∇≦*)/</h1>
	<div class="widget widget-summary widget-error">
		<div class="summary-title">
			{if !empty($error_title)}
			{$error_title}
			{else}
			Error!
			{/if}
		</div>
		<div class="summary-light summary-padded">
			{if !empty($error_description)}
			{$error_description}
			{else}
			<p>A generic message. Something has gone wrong but there currently isn't an error specified by the application. You normally shouldn't see this message unless something is currently being worked on.</p>
			{/if}
		</div>
		<div class="summary-subtitle">
			<a href="{URL}" class="btn btn-primary btn-xs"><span class="fa fa-home"></span> Return to home</a>
		</div>
	</div>
{/block}