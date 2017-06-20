{extends 'global.layout.tpl'}
{block body}
<div class="container">
		{if $logged_in}
		<div class="widget widget-summary widget-light top-large-margin">
			<div class="summary-title">
				<h2 class="no-margin">Cyan.TF Giveaways</h2>
			</div>
			{if $num_giveaways > 0}
			<table class="summary-light table table-striped">
				<thead>
					<tr>
						<th>Creator</th>
						<th>Status</th>
						<th>Title</th>
						<th>Time Left</th>
						<th>Submitted</th>
					</tr>
				</thead>
				<tbody>
				{foreach $giveaways as $giveaway}
				<tr id="{$giveaway.hash}">
					<td>
						{get_user_meta($giveaway.by,"rank")} <img src="{get_user_meta($giveaway.by,"avatar_small")}" class="small-avatar" width="24" height="24" alt="{get_user_meta($giveaway.by,"personaname")}'s Avatar"> {get_user_meta($giveaway.by,"personaname")}
					</td>
					<td>
						{if $giveaway.completed}
						<span class="text-danger"><span class="fa fa-lock text-danger"></span> Done</span>
						{else}
						<span class="text-success"><span class="fa fa-unlock text-success"></span> Open</span>
						{/if}
					</td>
					<td>
						<a href="{URL}/giveaway/{$giveaway.hash}">{$giveaway.subject}</a>
					</td>
					<td>
						<time datetime="{date('c',$giveaway.ends)}" data-toggle="{human_date($giveaway.ends)}">{timeto($giveaway.ends)}</time>
					</td>
					<td>
						<time datetime="{date('c',$giveaway.created)}" data-toggle="{human_date($giveaway.created)}">{timeago($giveaway.created)}</time>
					</td>
				</tr>
				{/foreach}
				</tbody>
			</table>
			{else}
			<div class="summary-subtitle text-center">
				<p class="lead">There seems to be no giveaways here at the moment.</p>
			</div>
			{/if}
		</div>
		{else}
		<h1 class="text-center text-danger">You must be logged in to view giveaways.</h1>
		{/if}
	</div>
{/block}