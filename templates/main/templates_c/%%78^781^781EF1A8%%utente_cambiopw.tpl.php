<?php /* Smarty version 2.6.26, created on 2018-05-10 23:09:37
         compiled from utente_cambiopw.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
        <b><a color="#690813"><?php echo $this->_tpl_vars['errore']; ?>
</a></b>
        <form method="post" id="form" action="index.php">
            <b><fieldset class="bordo"><legend>&nbsp;Change password</legend>
                    <p><label for="username" class="left">Old password:</label>
                        <input type="password" name="old" id="old" class="field" value="" tabindex="1" /></p>
                    <p><label for="password" class="left">New Password:</label>
                        <input type="password" name="new" id="new" class="field" value="" tabindex="2" /></p>
                    <p><label for="password_1" class="left">Retype new password:</label>
                        <input type="password" name="new_1" id="new_1" class="field" value="" tabindex="3" /></p>
                    <input type="hidden" name="controller" value="profile" />
                    <input type="hidden" name="task" value='modifica_password'/>
                    <p><input type="submit" name="submit" id="submit_1" class="button" value="Change password" tabindex="15" /></p>
                </fieldset>
        </form>
    </div>
</div>