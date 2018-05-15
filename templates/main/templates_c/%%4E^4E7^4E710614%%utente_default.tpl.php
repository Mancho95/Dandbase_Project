<?php /* Smarty version 2.6.26, created on 2018-05-14 19:01:34
         compiled from utente_default.tpl */ ?>
<form method="post" action="">
<div id="staff" class="container">
    <div class="title">
        <b><a color="#690813"><?php echo $this->_tpl_vars['errore']; ?>
</a></b>
        <b><fieldset class="bordo"><legend>&nbsp;Your Profile</legend>
            <p style="float: left;"><img src="profileimages/<?php echo $this->_tpl_vars['username']; ?>
" width="250" height="250" alt="" /></p>
            <p><font size="6.5" color="#690813">&nbsp <?php echo $this->_tpl_vars['username']; ?>
</font></p>
            <p><font size="2.5" color="black">&nbsp&nbsp&nbsp&nbsp Your e-mail: <?php echo $this->_tpl_vars['mail']; ?>
</font></p>
            <p>&nbsp&nbsp&nbsp&nbsp<a href="Changepic" class="button"> Change image</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="Upload" class="button"> Upload Adventure</a></p>
            <p>&nbsp&nbsp&nbsp&nbsp<a href="Changemail" class="button"> Change email</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="Changepass" class="button"> Change password &nbsp</a></p>
        </fieldset></b>
        <?php if ($this->_tpl_vars['_adventures_list'] != 0): ?>
        <p><input type="hidden" name="controller" value="ricerca" /></p>
        <p><input type="hidden" name="task" value="mostra" /></p>
        <b><fieldset class="bordo"><legend>&nbsp;Your adventures</legend>
                <p class="unicaRiga">
                <span class="margine_d"><font size="6.5" color="#690813">Link</font></span>
                <span class="margine_d2"><font size="6.5" color="#690813">Version</font></span>
                <span class="centrato"><font size="6.5" color="#690813">Name</font></span>
                </p>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['_adventures_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <p class="unicaRiga">
                            <span class="margine_d"><button type="submit" name="cod_avventura" value="<?php echo $this->_tpl_vars['_adventures_list'][$this->_sections['i']['index']]->cod_avventura; ?>
" class="button">Open</button></span>
                            <span class="margine_d2"><font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][$this->_sections['i']['index']]->versione; ?>
</font></span>
                            <span class="centrato"><font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][$this->_sections['i']['index']]->nome; ?>
</font></span>
                        </p>
            </br>
                    <?php endfor; endif; ?>
                <?php endif; ?>
        </fieldset></b>
    </div>
</div>