{if $slim_hero eq false}
<div class="hero container-fluid parallax" style="background-image:url('https://cyan.tf/assets/img/hero/bg{rand(1,6)}.jpg');" role="banner">
	<main>
		<div class="container">
			<div class="hero-logo">
				<img src="https://cyan.tf/assets/img/cyanmoe-brand-lg.png">
			</div>
		</div>
	</main>
</div>
{else}
<div class="hero hero-slim container-fluid parallax" style="background-image:url('https://cyan.tf/assets/img/hero/bg{rand(1,6)}.jpg');" role="banner">
	<main>
		<div class="container">
			<div class="hero-logo">
				<img src="https://cyan.tf/assets/img/cyanmoe-brand-lg.png">
			</div>
		</div>
	</main>
</div>
{/if}
