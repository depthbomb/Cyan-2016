<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-js">
	<head>
		{include 'global.head.tpl'}
	</head>
	<body id="top" class="{$body_class}" data-spy="scroll" data-target=".navbar-secondary">
		{include 'global.analytics.tpl'}
		{include 'global.navbars.tpl'}
		<main>
			{include 'global.hero.tpl'}
			{include 'global.warnings.tpl'}
			<div class="main-container">
				<div class="main-column main-padded">
					{include 'serverbar.tpl'}
					{if $top_ad eq true}
					{include 'ads/index.leaderboard.top.tpl'}
					{/if}
					<section class="sections">
						{block "body"}
							Template Error
						{/block}
					</section>
					{if $bot_ad eq true}
					{include 'ads/index.leaderboard.bottom.tpl'}
					{/if}
				</div>
			</div>
		</main>
		{include 'global.modals.tpl'}
		{include 'global.footer.tpl'}
		{include 'global.scripts.tpl'}
	</body>
</html>