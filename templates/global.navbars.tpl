{include 'navbars/navbar.main.tpl'}
{include 'navbars/navbar.main.mobile.tpl'}

{if $classic_nav eq false}
{include 'navbars/navbar.secondary.tpl'}
{else}
{include 'navbars/navbar.secondary.classic.tpl'}
{/if}

{include 'navbars/navbar.user.tpl'}