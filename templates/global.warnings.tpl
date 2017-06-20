{if !$accepted_terms && $logged_in}
<aside class="alert alert-global alert-danger" role="alert">
	<div class="container">
		<p><span class="fa fa-info-circle"></span> Hey there, <b>{get_user_meta($smarty.session.steamid, 'personaname')}</b>, it seems you have not accepted our terms of service. I know it must be an annoyance to do so but it is really important that you do acknowledge them.</p>
		<p><a href="#" data-toggle="modal" data-target="#modal-terms" data-backdrop="static" data-keyboard="false">Click here to review our terms of service.</a></p>
	</div>
</aside>
{/if}
<noscript>
	<aside class="alert alert-global alert-warning" role="alert">
		<div class="container">
			<p><span class="fa fa-warning"></span> I see you don't have JavaScript enabled. That's fine since this site doesn't use much of it, but it is a good idea to enable it. <a href="http://enable-javascript.com/" target="_blank" rel="nofollow">Click here for instructions to enable JavaScript.</a></p>
		</div>
	</aside>
</noscript>
<aside class="ie alert alert-global alert-warning" role="alert">
	<div class="container">
		<p><span class="fa fa-warning"></span> Listen, Internet Explorer is nice and all, but it is widely unsupported and doesn't handle modern websites well. You should try upgrading to a superior browser such as <a href="http://google.com/chrome" target="_blank" rel="nofollow"><span class="fa fa-chrome"></span> Google Chrome</a> or <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank" rel="nofollow"><span class="fa fa-firefox"></span> Mozilla Firefox.</a></p>
	</div>
</aside>