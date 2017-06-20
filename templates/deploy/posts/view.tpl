{extends 'global.layout.tpl'}
{block body}
<article class="slim-article">
	<div class="container">
		<div id="post_{$post_id}" class="widget widget-summary widget-admin-post">
			{if $admin_only && $smarty.session.rank > 1}
			<div class="summary-title">
				<h2 class="no-margin">{$post_title}</h2>
			</div>
			<div class="summary-light">
				<div class="summary-user-info" style="float:left">
					<a class="user-info-avatar" href="{_re('http://steamcommunity.com/profiles/'|cat:$post_submitter)}" target="_blank">
						<img src="{get_user_meta($post_submitter,'avatar_large')}" width="65" height="65" alt="{get_user_meta($post_submitter, 'personaname')}'s Avatar">
					</a>
					<span class="user-info-rank">
						{get_user_meta($post_submitter,'rank')|strip_tags}
					</span>
				</div>
				<div class="summary-post-body">
					<header>
						<h3 class="no-margin"><a href="{_re('http://steamcommunity.com/profiles/'|cat:$post_submitter)}" target="_blank">{get_user_meta($post_submitter, "personaname")}</a></h3>
						<div class="summary-post-toolbar">
							<time class="btn btn-sm btn-outline" datetime="{date('c',$post_date)}" data-toggle="{human_date($post_date)}">{timeago($post_date)}</time>
							<a class="btn btn-inverse btn-sm" href="#post_{$post_id}">#{$post_id}</a>
						</div>
					</header>
					<div class="summary-post-content">
						{$post_content}
					</div>
				</div>
				<footer class="summary-post-footer text-right">
					<a href="#reply_to_{$post_hash}" data-toggle="collapse" class="btn btn-inverse btn-sm"><span class="fa fa-reply fa-flip-horizontal"></span> Reply</a>
					<a href="javascript:;" class="btn btn-inverse btn-sm" clipboard data-clipboard-text="{URL}/post/{$post_id}"><span class="fa fa-link"></span> Copy URL</a>
					{if $is_admin}
					<a href="#edit_post_{$post_hash}" data-toggle="collapse" class="btn btn-inverse btn-sm"><span class="fa fa-pencil"></span> Edit this post</a>
					{/if}
				</footer>
			</div>
			{if $is_admin}
			<div id="edit_post_{$post_hash}" class="collapse summary-light">
				<div class="summary-padded">
					<form method="post" action="{URL}/processor/admin.edit.post">
						<input name="post_id" type="hidden" value="{$post_hash}" required>
						<fieldset class="form-group">
							<label>Post Title</label>
							<input name="post_title" type="text" class="form-control" placeholder="Post Title" value="{$post_title}" required>
						</fieldset>
						<fieldset class="form-group">
							<label>Post Content</label>
							<textarea id="summernote" name="post_content" class="form-control" rows="20" placeholder="Post Content" required>{$post_content|htmlspecialchars}</textarea>
						</fieldset>
						<fieldset>
							<button type="submit" class="btn btn-success">Save</button>
						</fieldset>
					</form>
				</div>
			</div>
			{/if}
			{if $logged_in}
			<div id="reply_to_{$post_hash}" class="collapse summary-light">
				<div class="summary-padded">
					<form method="post" action="{URL}/processor/post.add.reply">
						<input name="post_id" type="hidden" value="{$post_hash}" required>
						<fieldset class="form-group">
							<label>Comment</label>
							<textarea id="summernote_reply" name="reply_content" class="form-control" rows="20" placeholder="Post Content" required></textarea>
						</fieldset>
						<fieldset>
							<button type="submit" class="btn btn-success">Submit</button>
						</fieldset>
					</form>
				</div>
			</div>
			{/if}
			{else}
			<h1 class="text-danger text-center">You must be an admin to view this post</h1>
			{/if}
		</div>
	</div>
</article>
{/block}