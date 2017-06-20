{extends 'global.layout.tpl'}
{block body}
	<div class="container">
		{if $smarty.session.rank lt 2}
		{include 'deploy/errors/no.access.tpl'}
		{else}
		<div class="row">
			<div class="col-lg-12">
				<h1 class="top-large-margin bottom-large-margin">Cyan.TF Staff Panel</h1>
			</div>
			<div class="col-lg-6">
				<div class="widget widget-summary widget-info">
					<div class="summary-title">Site Users</div>
					<table class="summary-light table table-striped">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Name</th>
								<th>Accepted Terms</th>
								<th>Updated</th>
							</tr>
						</thead>
						<tbody>
							{foreach $admin_users as $user}
							<tr>
								<td>{get_user_meta($user.steamid,'rank',true)}</td>
								<td><a href="{_re('http://steamcommunity.com/profiles/'|cat:$user.steamid)}" target="_blank"><img src="{get_user_meta($user.steamid, 'avatar_small')}" class="small-avatar" width="24" height="24" alt="{get_user_meta($user.steamid, 'personaname')}'s Avatar"> {get_user_meta($user.steamid,'personaname')}</a></td>
								<td>{get_user_meta($user.steamid,'accepted_terms')}</td>
								<td><time datetime="{date('c',get_user_meta($user.steamid,'cache_time'))}">{timeago(get_user_meta($user.steamid,'cache_time'))}</time></td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{/if}
	</div>
{/block}