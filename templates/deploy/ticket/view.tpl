{extends 'global.layout.tpl'}
{block body}
<article class="slim-article">
	<div class="container">
		{if $is_submitted}
		<div class="alert alert-success">
			<p>Your ticket has been successfully submitted!</p>
			<p>You will receive a notification in your <a href="{URL}/inbox">inbox</a> when an admin replies to your ticket so make sure to check it often!</p>
		</div>
		{/if}
		<div class="notes post widget widget-summary {if $t_is_closed}widget-error{else}widget-success{/if}">
			<div class="post-title summary-title container-fluid">
				<div class="row">
					<div class="post-user col-md-6">
						<ul class="summary-meta">
							<li>{if $t_is_closed}<span class="text-danger" data-tooltip="This ticket has been closed by an admin. You can find their reponse below."><span class="fa fa-lock"></span> CLOSED</span>{else}<span class="text-success" data-tooltip="This ticket is open for an admin's reply."><span class="fa fa-unlock"></span> OPEN</span>{/if}</li>
							<li>{$t_section}</li>
							<li>by <img src="{get_user_meta($t_submitter_steamid, 'avatar_small')}" class="small-avatar" width="24" height="24" alt="{get_user_meta($t_submitter_steamid, 'personaname')}'s Avatar"> {get_user_meta($t_submitter_steamid, "rank")} {get_user_meta($t_submitter_steamid, "personaname")}</li>
						</ul>
					</div>
					<div class="post-time col-md-6">
						<span>submitted</span> <time datetime="{date('c',$t_date)}" data-toggle="{human_date($t_date)}">{timeago($t_date)}</time>
					</div>
				</div>
			</div>
			<div class="notes-content summary-padded summary-light">
				<p>
					{$t_content}
				</p>			
			</div>
			{if $is_admin}
			<div class="summary-padded summary-light container-fluid">
				{if $t_is_closed}
				<form method="post" action="{URL}/processor/admin.ticket.open" class="inline-block">
					<input type="hidden" name="ticket_id" value="{$t_id}">
					<button type="submit" class="btn btn-success"><span class="fa fa-unlock"></span> Open Ticket</button>
				</form>
				{else}
				<form method="post" action="{URL}/processor/admin.ticket.lock" class="inline-block">
					<input type="hidden" name="ticket_id" value="{$t_id}">
					<button type="submit" class="btn btn-danger"><span class="fa fa-lock"></span> Close Ticket</button>
				</form>
				{/if}
				<a href="#reply-menu" class="btn btn-warning" data-toggle="collapse"><span class="fa fa-reply"></span> Reply</a>	
			</div>
			<div id="reply-menu" class="collapse">
				<div class="summary-padded summary-light">
					<form method="post" action="{URL}/processor/admin.ticket.reply">
						<input type="hidden" name="ticket_id" value="{$t_id}">
						<fieldset class="form-group">
							<label for="admin-reply">Reply</label>
							<textarea id="summernote_admin" rows="6" name="admin-reply" class="form-control" required></textarea>
						</fieldset>
						<fieldset>
							<button type="submit" class="btn btn-primary">Submit Reply <span class="fa fa-arrow-right"></span></button>
						</fieldset>
					</form>
				</div>
			</div>
			{elseif $t_submitter_steamid === $smarty.session.steamid}
			<div class="summary-padded summary-light container-fluid">
				<a href="#reply-menu" class="btn btn-warning" data-toggle="collapse"><span class="fa fa-reply"></span> Reply</a>
			</div>
			<div class="summary-light container-fluid">
				<div id="reply-menu" class="collapse">
					<div class="summary-padded summary-light">
						<form method="post" action="{URL}/processor/user.ticket.reply">
							<input type="hidden" name="ticket_id" value="{$t_id}">
							<fieldset class="form-group">
								<label for="user-reply">Reply</label>
								<textarea id="summernote" rows="6" name="user-reply" class="form-control" required></textarea>
							</fieldset>
							<fieldset>
								<button type="submit" class="btn btn-primary">Submit Reply <span class="fa fa-arrow-right"></span></button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			{/if}
		</div>
		{if $has_replies}
		{foreach $a_replies as $reply}
		<div class="post widget widget-summary">
			<div class="post-avatar">
				<a href="{_re('http://steamcommunity.com/profiles/'|cat:$reply.admin_steamid)}" target="_blank">
					<img src="{get_user_meta($reply.admin_steamid, "avatar_medium")}" width="60" height="60">
				</a>
			</div>
			<div class="post-title summary-title container-fluid">
				<div class="row">
					<div class="post-user col-md-6">
						<a href="{_re('http://steamcommunity.com/profiles/'|cat:$reply.admin_steamid)}" target="_blank">
							{get_user_meta($reply.admin_steamid, "rank")} {get_user_meta($reply.admin_steamid, "personaname")}
						</a>
					</div>
					<div class="post-time col-md-6">
						submitted <time datetime="{date('c',$reply.reply_date)}" data-toggle="{human_date($reply.reply_date)}">{timeago($reply.reply_date)}</time>
					</div>
				</div>
			</div>
			<div class="summary-padded summary-light">
				<div class="post-message">
					<p>
						{$reply.reply_content}
					</p>
				</div>
			</div>
		</div>
		{/foreach}
		{/if}
	</div>
</article>
{/block}