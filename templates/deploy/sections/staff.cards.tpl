{foreach from=$staff_array key=staff item=info}
	{foreach from=$info key=name item=i}
	{if $i.show_on_site}
	<div class="col-lg-3">
		<div class="staff-card">
			<img class="staff-avatar img-responsive" src="{URL}{bust($i.avatar,false)}">
			<div class="staff-name">
				<h4>{$name}</h4>
			</div>
			<div class="staff-description text-center">
				{foreach from=$i.role item=role}
				{$role}<br>
				{/foreach}
			</div>
			{if isset($i.override_button)}
			<a href="{_re($i.override_button)}" class="staff-add-button" target="_blank">
				<span class="fa fa-link"></span> URL
			</a>
			{else}
			<a href="{_re('http://steamcommunity.com/profiles/'|cat:$i.steamid)}" class="staff-add-button" target="_blank">
				<span class="fa fa-steam"></span> Steam Profile
			</a>
			{/if}
		</div>
	</div>
	{/if}
	{/foreach}
{/foreach}