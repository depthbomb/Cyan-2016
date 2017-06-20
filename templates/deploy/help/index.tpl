{extends 'global.layout.tpl'}
{block body}
	<div class="container">
		<div id="knowledge-base" class="widget widget-summary widget-light widget-info top-large-margin">
			<div class="summary-title">Cyan.TF Knowledge Base</div>
			{if $is_admin}
			<div class="summary-subtitle">
				<a href="{URL}/help/add" class="btn btn-primary btn-xs">Add new article</a>
			</div>
			{/if}
			<div class="summary-padded summary-light">
				<p class="lead">Here you can browse various help topics and frequently asked questions.</p>
			</div>
			{foreach $kb_articles as $article}
			{if $article.hidden === "false"}
			<div class="summary-subtitle" style="overflow:auto;">
				<div class="pull-left">
					<a data-toggle="collapse" data-parent="#knowledge-base" href="#{md5($article.id)}" class="collapsed"><span class="fa fa-sort"></span> {$article.title}</a>
				</div>
				<div class="pull-right">
					<div class="btn-group">
						{if $is_admin}
						<a href="{URL}/help/kb/{$article.id}/edit" class="btn btn-xs btn-success" data-toggle="tooltip" data-container="body" data-html="true" title="Edit kb{$article.id}, <b>{$article.title}</b>"><span class="fa fa-pencil"></span></a>
						{/if}
						<a href="{URL}/help/kb/{$article.id}" class="btn btn-xs btn-info" data-toggle="tooltip" data-container="body" data-html="true" title="Permalink to kb{$article.id}, <b>{$article.title}</b>"><span class="fa fa-link"></span></a>
					</div>
				</div>
			</div>
			<div class="panel-collapse collapse clearfix" id="{md5($article.id)}">
				<div class="summary-padded">
					{$article.content}
				</div>
			</div>
			{/if}
			{/foreach}
			<div class="summary-padded summary-light">
				<p>If you need more help then you should use our <a href="{URL}/ticket">ticket system.</a></p>
			</div>
		</div>
	</div>
{/block}