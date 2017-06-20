{extends 'error.layout.tpl'}
{block body}
	<h1 style="font-size:32pt;"><span class="fa fa-info-circle"></span> External Link Notice</h1>
	<p class="lead text-center">Be warned, traveler, out there be monsters! The link you have clicked is not associated with CyanTF and we can't promise you that it is safe.</p>
	<p class="text-center"><a style="font-size:18pt;" href="{$external_url}"><span class="fa fa-external-link"></span> {$external_url|htmlspecialchars}</a></p>
	<p class="text-center">You may click the link above to continue, but don't say we didn't warn you!</p>
{/block}