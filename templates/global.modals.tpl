<div id="modal-small" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"></div>
	</div>
</div>
<div id="modal-normal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content"></div>
	</div>
</div>
<div id="modal-large" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div>
	</div>
</div>
{if $logged_in}
{if !$accepted_terms}
<div id="modal-terms" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cyan.TF Terms &amp; Guidelines</h4>
			</div>
			<div class="modal-body">
				<div class="panel-group" id="legal-panels">
					<div class="panel panel-info">
						<div class="panel-heading">
							<a href="#terms" data-toggle="collapse" data-parent="#legal-panels">Terms of Service</a>
						</div>
						<div id="terms" class="collapse">
							<div class="panel-body">
								<p>Let's keep this simple:</p><hr>
								<p>Everything on this site is <span class="fa fa-copyright"></span> <a href="{_re('http://steamcommunity.com/id/minorin')}" target="_blank">depthbomb</a> unless stated otherwise. No assets of this site may be redistributed or modified without permission.</p>
								<p>Content on this site may contain technical, photographic, and/or typographical errors. We do not warrant that the material found on this site is accurate, complete, or current. Changes may also be made to the website at any time without notice.</p>
								<p>We reserve the right to terminate the services you receive on both this website and the game server this site represents and we are not obligated to provide a reason for denial of access.</p>
								<p>By agreeing to these terms you give us permission to log info about you. This info is only kept for security &amp; statistical reasons and will not be made public.</p>
								<p>Both this site and game server are located in the United States so try not to break any laws.</p>
								<p>If and when these terms are updated you will be given the option to re-evaluate them.</p>
								<p>If you agree to these terms then click <b>I agree</b> below. If you do not agree then click <b>I don't agree</b>. If you do not agree to these terms then please stop using this service.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<a href="#donor-terms" data-toggle="collapse" data-parent="#legal-panels">Donation Terms of Service</a>
						</div>
						<div id="donor-terms" class="collapse">
							<div class="panel-body">
								<p>We are not responsible for payments made towards incorrect or invalid clients via the SteamID given in any transactions on CyanTF. You are responsible for providing the correct information. </p>
								<p>All payments made to CyanTF, be it item or monetary, are non-refundable unless under very rare occasions. Any monetary chargebacks that occur will result in immediate termination of our services on both this site and in the game server this site represents.</p>
								<p>Services may also be terminated in the event you misuse the service given or the service is improperly used to create/promote an unfriendly or unsatisfactory environment for others.</p>
								<p>You understand that donor benefits, or <q>perks</q>, can and will be modified or even removed from our service if the need arises.</p>
								<p>Service will be automatically terminated upon arrival of the expiration date that is set by the amount of your payment(s).</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="center">
					<small id="check" class="block">To ensure that you have fully read the Terms &amp; Guidelines you must wait <span id="countdown" class="text-primary">36</span> seconds before you may make your choice.</small>
					<form method="POST" action="{URL}/processor/terms.accept">
						<input type="hidden" value="{denc($smarty.session.steamid,EKEY,'en')}" name="steamid" required>
						<div class="btn-group" style="display:none;">
							<a class="btn btn-lg btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> I don't agree</a>
							<button type="submit" class="btn btn-lg btn-success"><i class="fa fa-check"></i> I agree</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{/if}
<div id="modal-settings" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
				<h4 class="modal-title">Your Settings</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="{URL}/processor/user.settings">
					{if $smarty.session.rank > 0}
					<fieldset class="form-group">
						<label for="hide_ads">
							Hide Ads?
							<input type="checkbox" name="hide_ads" class="switch" checked>
						</label>
					</fieldset>
					{/if}
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
{/if}