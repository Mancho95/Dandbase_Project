<?php /* Smarty version 2.6.26, created on 2018-04-18 16:50:58
         compiled from home_default.tpl */ ?>
<?php $pathPROVVISORIA = "/Dandbase_Project"; ?>
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
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
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
			<h1><a href="." color="000000">DnBase <br><font size="2"><?php echo $this->_tpl_vars['content_title']; ?>
!</font></a></br></h1>
		</div>
		<div id="menu">
			<ul>
				<?php if ($this->_tpl_vars['nick'] != false): ?>
				<li><a href="?controller=profile&task=mostra"><?php echo $this->_tpl_vars['nick']; ?>
</a></li>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['tasti_in_cima'] != false): ?>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tasti_in_cima']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
						<li><a href="<?php echo $this->_tpl_vars['tasti_in_cima'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['tasti_in_cima'][$this->_sections['i']['index']]['testo']; ?>
</a></li>
                    <?php endfor; endif; ?>
                <?php endif; ?>
			</ul>
		</div>
	</div>
</div>
<div id="wrapper">
	<?php echo $this->_tpl_vars['main_content']; ?>

</div>
<div id="copyright">
	<p>&copy; Francesco Mancini. Programmazione Web Univaq 2016/17. All rights reserved.</p>
</div>
</body>
</html>
