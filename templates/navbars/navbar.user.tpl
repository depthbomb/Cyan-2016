{if $logged_in eq true}
<nav class="navbar-user navbar-secondary navbar-inverse">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li>
				<a href="{URL}/ticket">
					<span class="navbar-icon fa fa-ticket"></span>
					<span class="navbar-label">Submit a Ticket</span>
				</a>
			</li>
			{if $inbox_unread > 0}
			<li class="has-unread">
				<a href="{URL}/inbox">
					<span class="navbar-icon fa fa-inbox"></span>
					<span class="navbar-label">Go to Inbox ({$inbox_unread} new notification(s))</span>
				</a>
			</li>
			{else}
			<li>
				<a href="{URL}/inbox">
					<span class="navbar-icon fa fa-inbox"></span>
					<span class="navbar-label">Go to Inbox</span>
				</a>
			</li>
			{/if}
			{if $smarty.session.rank > 0}
			<li>
				<a href="{URL}/admin">
					<span class="navbar-icon fa fa-list-alt"></span>
					<span class="navbar-label">Staff Panel</span>
				</a>
			</li>
			{/if}
			<li>
				<a href="#modal-settings" data-toggle="modal">
					<span class="navbar-icon fa fa-gear"></span>
					<span class="navbar-label">Settings</span>
				</a>
			</li>
			<li>
				<a href="{URL}/logout">
					<span class="navbar-icon fa fa-sign-out"></span>
					<span class="navbar-label">Logout</span>
				</a>
			</li>
		</ul>
	</div>
</nav>
{/if}