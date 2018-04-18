{php}$pathPROVVISORIA = "/Dandbase_Project";{/php}
{* Smarty *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : OpenSpace 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140131

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$title}</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a color="000000">DnBase <br><font size="2">{$content_title}!</font></a></br></h1>
		</div>
		<div id="menu">
			<ul>
				{if $nick!=false}
				<li><a href="?controller=profile&task=mostra">{$nick}</a></li>
                {/if}
                {if $tasti_in_cima!=false}
                    {section name=i loop=$tasti_in_cima}
						<li><a href="{$tasti_in_cima[i].link}">{$tasti_in_cima[i].testo}</a></li>
                    {/section}
                {/if}
			</ul>
		</div>
	</div>
</div>
<div id="wrapper">
	{$main_content}
</div>
<div id="copyright">
	<p>&copy; Francesco Mancini. Programmazione Web Univaq 2016/17. All rights reserved.</p>
</div>
</body>
</html>

