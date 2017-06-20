{extends 'global.layout.tpl'}
{block body}
<article class="slim-article">
	<div class="container">
		<div class="widget widget-summary widget-admin-post">
			{if $logged_in}
			<div class="summary-title">
				<h2 class="no-margin"><span class="fa fa-gift"></span> {$ga_subject}</h2>
			</div>
			<div class="summary-light">
				<div class="summary-user-info" style="float:left">
					<a class="user-info-avatar" href="{_re('http://steamcommunity.com/profiles/'|cat:$ga_by)}" target="_blank">
						<img src="{get_user_meta($ga_by,'avatar_large')}" width="65" height="65" alt="{get_user_meta($ga_by, 'personaname')}'s Avatar">
					</a>
					<span class="user-info-rank">
						{get_user_meta($ga_by,'rank')|strip_tags}
					</span>
				</div>
				<div class="summary-post-body">
					<header>
						<h3 class="no-margin"><a href="{_re('http://steamcommunity.com/profiles/'|cat:$ga_by)}" target="_blank">{get_user_meta($ga_by, "personaname")}</a></h3>
						<div class="summary-post-toolbar">
							<time class="btn btn-sm btn-outline" datetime="{date('c',$ga_created)}" data-toggle="{human_date($ga_created)}">{timeago($ga_created)}</time>
						</div>
					</header>
					<div class="summary-post-content">
						<div class="panel panel-info">
							<div class="panel-heading">
								Prize
							</div>
							<div class="panel-body">
								{$ga_prize}
							</div>
						</div>
						<div class="text-center top-large-margin">
							<a href="#" class="btn btn-xl btn-success btn-block">Enter Giveaway</a>
							<p class="lead top-small-margin">This giveaway ends in {timeto($ga_ends)}</p>
						</div>
					</div>
				</div>
			</div>
			{else}
			<h1 class="text-danger text-center">You must be logged in to view this giveaway.</h1>
			{/if}
		</div>
	</div>
</article>
{/block}