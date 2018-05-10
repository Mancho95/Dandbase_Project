<?php /* Smarty version 2.6.26, created on 2018-05-10 19:36:05
         compiled from ricerca_mostra.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
        <b><a color="#690813"><?php echo $this->_tpl_vars['errore']; ?>
</a></b>
        <?php if ($this->_tpl_vars['commentato'] == true): ?>
            <b><a color="#690813">Your comment was uploaded correctly!</a></b>
        <?php endif; ?>
        <span><font color="#690813" size="6.5"><b><?php echo $this->_tpl_vars['_adventures_list'][0]->nome; ?>
</b></font></span>
        <b><fieldset class="bordo">
                <p align="center"><label for="username"><font size="6.5" color="#690813">Creator:</font></label><br />
                    <font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][0]->username; ?>
</font></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Description:</font></label><br />
                <td style="width:606px;text-align:left;vertical-align:top;white-space:wrap;"><font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][0]->descrizione; ?>
</font></td></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Map:</font></label><br />
                    <img src="adventuresmap/<?php echo $this->_tpl_vars['_adventures_list'][0]->username; ?>
<?php echo $this->_tpl_vars['_adventures_list'][0]->nome; ?>
" width="400" height="400" alt="" /></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Upvote Percentage:</font></label><br />
                    <font size="4.5" color="black"><?php echo $this->_tpl_vars['_upvote']; ?>
</font></p>
                <?php if ($this->_tpl_vars['user'] == 'admin'): ?>
                <form method="post" action="index.php" id="form">
                <p><label for="username"><font size="4.5" color="black">Delete adventure:</font></label><br />
                    <p><input type="hidden" name="controller" value="upload" /></p>
                    <p><input type="hidden" name="task" value="deletea" /></p>
                    <p><input type="hidden" name="cod_avventura" value="<?php echo $this->_tpl_vars['_adventures_list'][0]->cod_avventura; ?>
" /></p>
                    <input type="submit" name="submit" id="submit_1" class="button" value="delete" /></p>
                </form>
                <?php endif; ?>
            </fieldset></b>
        <?php if ($this->_tpl_vars['_comments_list'] != 0): ?>
            <b><fieldset class="bordo"><legend>Comments</legend>
            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['_comments_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <fieldset class="bordo">
                <p align="left"><label for="username"><font size="4.5" color="#690813"><?php echo $this->_tpl_vars['_comments_list'][$this->_sections['i']['index']]->username; ?>
:</font></label><br />
                    <p style="float: left;"><img src="profileimages/<?php echo $this->_tpl_vars['_comments_list'][$this->_sections['i']['index']]->username; ?>
" width="100" height="100" alt="" />&nbsp&nbsp&nbsp</p>
                    <fieldset class="bordo">
                    <td style="width:606px;text-align:left;vertical-align:top;white-space:wrap;"><font size="2.5" color="black"><?php echo $this->_tpl_vars['_comments_list'][$this->_sections['i']['index']]->testo; ?>
</font></td></p>
                    <?php if ($this->_tpl_vars['_comments_list'][$this->_sections['i']['index']]->upvote == true): ?>
                    <p align="left"><img src="images/icon_like.png" width="32" height="32" alt="" /></p>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['_comments_list'][$this->_sections['i']['index']]->upvote == false): ?>
                    <p align="left"><img src="images/icon_dislike.png" width="32" height="32" alt="" /></p>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['user'] == 'admin'): ?>
                        <form method="post" action="index.php" id="form">
                        <p><label for="username"><font size="4.5" color="black">Delete comment:</font></label><br />
                        <p><input type="hidden" name="controller" value="upload" /></p>
                        <p><input type="hidden" name="task" value="deletec" /></p>
                        <p><input type="hidden" name="cod_avventura" value="<?php echo $this->_tpl_vars['_comments_list'][$this->_sections['i']['index']]->cod_commento; ?>
" /></p>
                        <input type="submit" name="submit" id="submit_1" class="button" value="delete" /></p>
                        </form>
                    <?php endif; ?>
                    </fieldset>
                    </fieldset>
                </br>
            <?php endfor; endif; ?>
                </fieldset></b>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['user'] == true): ?>
        <form method="post" action="index.php" id="form">
            <b><fieldset class="bordo"><legend>&nbsp;Add a comment</legend>
                    <p><input type="hidden" name="controller" value="ricerca" /></p>
                    <p><input type="hidden" name="task" value="commenta" /></p>
                    <p><input type="hidden" name="cod_avventura" value="<?php echo $this->_tpl_vars['_adventures_list'][0]->cod_avventura; ?>
" /></p>
                    <p><input type="hidden" name="username" value="<?php echo $this->_tpl_vars['user']; ?>
" /></p>
                    <p><label for="testo" class="left">Your comment:</label>
                        <textarea name="testo" id="testo" cols="30" rows="10"/></textarea></p>
                    <p><label for="Version" class="left">Upvote:</label>
                        <input type="radio" name="upvote" id="upvote" class="field" value=1 tabindex="4" />Yes
                        <input type="radio" name="upvote" id="upvote" class="field" value=0 tabindex="4" />No</p>
                    <p><input type="submit" name="submit" id="submit_1" class="button" value=" comment" tabindex="15" /></p>
                </fieldset></b>
        </form>
        <?php endif; ?>
        </br>
        <p><a href="?controller=ricerca&task=modulo" class="button"> Search again</a><?php if ($this->_tpl_vars['user'] == true): ?> or <a href="?controller=profile&task=mostra" class="button"> Go to your profile</a><?php endif; ?></p>
    </div>
</div>