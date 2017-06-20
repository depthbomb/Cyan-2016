{extends 'global.layout.tpl'}
{block body}
	<div class="container">
		{if $logged_in}
		<div class="widget widget-summary widget-light top-large-margin">
			<div class="summary-title"><h2 class="no-margin">{$message_subject} <small>by <img src="{get_user_meta($message_from,'avatar_small')}" class="small-avatar" width="24" height="24" alt="{get_user_meta($message_from,'personaname')}'s Avatar"> {get_user_meta($message_from,'personaname')}</small></h2></div>
			<div class="summary-padded summary-light">
				{$message_body}
			</div>
		</div>
		{else}
		<h1 class="text-center text-danger">You must be logged in to view your inbox.</h1>
		{/if}
	</div>
{/block}