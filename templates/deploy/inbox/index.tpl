{extends 'global.layout.tpl'}
{block body}
	<div class="container">
		{if $logged_in}
		<div class="widget widget-summary widget-light top-large-margin">
			<div class="summary-title"><h2 class="no-margin"><span class="fa fa-inbox"></span> Inbox</h2></div>
			<div class="summary-padded summary-light">
				<p class="lead">This is where you can receive messages from Cyan.TF staff or notifications about your submitted tickets.</p>
			</div>
			{if $num_messages > 0}
			<table class="summary-light table table-striped">
				<tbody>
				{foreach $messages as $message}
				<tr id="{$message.message_hash}">
					<td class="col-md-2">
						{get_user_meta($message.from,"rank")} <img src="{get_user_meta($message.from,"avatar_small")}" class="small-avatar" width="24" height="24" alt="{get_user_meta($message.from,"personaname")}'s Avatar"> {get_user_meta($message.from,"personaname")}
					</td>
					<td>
						<a href="{URL}/inbox/message/{$message.message_hash}">{$message.subject}</a>
					</td>
					<td>
						<time class="pull-right" datetime="{date('c',$message.send_date)}" data-toggle="{human_date($message.send_date)}">{timeago($message.send_date)}</time>
					</td>
					<td class="col-md-1 text-center">
						{if !$message.seen}
						<form method="post" action="{URL}/processor/inbox.mark.seen" class="inline-block">
							<input type="hidden" name="message_id" value="{$message.message_hash}" required>
							<button type="submit" class="btn btn-success btn-sm" data-tooltip="Mark as seen"><span class="fa fa-eye"></span></button>
						</form>
						{else}
						<em class="text-muted">Seen</em>
						{/if}
					</td>
				</tr>
				{/foreach}
				</tbody>
			</table>
			{else}
			<div class="summary-subtitle text-center">
				<p class="lead">Nothing here, have a nice day! <span class="fa fa-smile-o"></span></p>
			</div>
			{/if}
		</div>
		{else}
		<h1 class="text-center text-danger">You must be logged in to view your inbox.</h1>
		{/if}
	</div>
{/block}