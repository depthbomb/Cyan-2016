<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.5/clipboard.min.js"></script>
<script src="{URL}/assets/js/vendor/smooth-scroll.js"></script>
<script src="{URL}/assets/js/vendor/cheet.min.js"></script>
<script src="{URL}/assets/js/vendor/validator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="{URL}/assets/js/vendor/bootstrap.min.js"></script>
<script src="{URL}/assets/js/vendor/bootstrap-select.min.js"></script>
<script src="{URL}/assets/js/vendor/bootstrap-switch.min.js"></script>
<script src="{URL}/assets/js/vendor/summernote.min.js"></script>
<script src="{URL}/assets/js/application.js?{md5(filemtime('assets/js/_core.js'))}"></script>
{if $logged_in eq true}
<script>
	App.user.steamid = "{$smarty.session.steamid}";
	App.user.rank = "{$smarty.session.rank}";
	App.user.personaname = "{addslashes($smarty.session.personaname)}";
	App.user.avatar = "{$smarty.session.avatar}";
	App.user.hide_ads = "{$smarty.session.hide_ads}";
</script>
<script>
	App.user.updateinfo();
</script>
{/if}
<script src="{URL}/assets/js/advertisement.js"></script>