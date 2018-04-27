<?php /* Smarty version 2.6.26, created on 2018-04-23 11:25:41
         compiled from utente_default.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
    <?php echo $this->_tpl_vars['errore']; ?>

        <b><fieldset class="bordo"><legend>&nbsp;Your Profile</legend>
            <p style="float: left;"><img src="images/bulba.jpg" width="250" height="250" alt="" /></p>
            <p><font size="6.5" color="#690813">&nbsp <?php echo $this->_tpl_vars['username']; ?>
</font></p>
            <p><font size="2.5" color="black">&nbsp Your e-mail:<?php echo $this->_tpl_vars['mail']; ?>
</font></p>
            <p>&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Change image</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Upload Adventure</a></p>
            <p>&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Change email</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Change password &nbsp</a></p>
        </fieldset></b>
        <b><fieldset class="bordo"><legend>&nbsp;Your adventures</legend>

        </fieldset></b>
    </div>
</div>