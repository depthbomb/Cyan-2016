<nav class="navbar navbar-mobile navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header navbar-nav">
			<a href="javascript:" class="navbar-pages-toggle navbar-nav-link">
				<span class="fa fa-bars"></span>
			</a>
			<a href="{URL}" class="navbar-brand navbar-nav-link">
				<span class="navbar-brand-icon"></span>
			</a>
			<!--
			{if $logged_in eq false}
			<span class="navbar-nav-link navbar-nav-link-double navbar-user-login">
				<a href="{URL}/login?goto={CURL}" class="btn btn-success btn-block"><span class="fa fa-steam"></span> Log in</a>
			</span>
			{else}
			<span class="navbar-nav-link navbar-user-area">
				<span class="navbar-avatar">
					<a href="javascript:;" class="navbar-user-toggle">
						<img src="{$smarty.session.avatar}" width="40" height="40" alt="{$smarty.session.personaname}">
						<span class="navbar-avatar-loading">
							<span class="fa fa-refresh fa-spin"></span>
						</span>
					</a>
				</span>
			</span>
			{/if}
			-->
		</div>
	</div>
</nav>