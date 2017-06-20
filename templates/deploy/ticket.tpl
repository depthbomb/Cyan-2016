{extends 'global.layout.tpl'}
{block body}
<article class="slim-article">
	<div class="container">
		<p class="lead text-center">
			Player reports, appeals, and admin applications will now be handled on the Steam group's discussion.
		</p>
		<div class="row">
			<div class="col-lg-6">
				<a class="btn btn-xl btn-primary btn-block" href="{'https://steamcommunity.com/groups/CyanTF/discussions/0/'|_re}">Report / Appeal</a>
			</div>
			<div class="col-lg-6">
				<a class="btn btn-xl btn-primary btn-block" href="{'https://steamcommunity.com/groups/CyanTF/discussions/1/'|_re}">Admin Applications</a>
			</div>
			<div class="col-lg-12 text-center top-small-margin">
				<small class="text-muted">You must be a member of the group to post in the discussions.</small>
			</div>
		</div>
	</div>
</article>
{/block}