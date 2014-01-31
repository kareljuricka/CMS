{if isset($head.title)}
	<title>{$head.title}</title>
{/if}
{if isset($head.meta)}
	{foreach from = $head.meta key = "name" item = "content"}
		<meta name="{$name}" content="{$content}" />
	{/foreach}
{/if}
