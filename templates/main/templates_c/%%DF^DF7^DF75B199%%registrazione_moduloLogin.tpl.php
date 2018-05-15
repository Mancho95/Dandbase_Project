<?php /* Smarty version 2.6.26, created on 2018-05-15 14:18:12
         compiled from registrazione_moduloLogin.tpl */ ?>
<form method="post">
    <div id="staff" class="container">
    <div class="title">
        <p><input type="hidden" name="controller" value="registrazione" /></p>
        <p><input type="hidden" name="task" value="autentica" /></p>
        <b><h2>Enter your login infos here!</h2>
        <?php echo $this->_tpl_vars['url']; ?>

        <fieldset class="bordo">
            <p><label for="username" class="left">Username:</label><br />
                <input type="text" name="username" id="username" tabindex="1" class="field" value="" /></p>
            <p><label for="password" class="left">Password:</label><br />
                <input type="password" name="password" id="password" tabindex="2" class="field" value="" /></p>
            <p><input type="submit" class="button" value="LOGIN"/></p>
        </fieldset></b>
        <span><font color="#690813" size="4.5"><b>Don't have an account?</b></font></span>
        <p><a href="Register" class="button"> Sign Up</a></p>
        <span><font color="#690813" size="4.5"><b>Do you need some help?</b></font></span>
        <p><a href="FAQ" class="button"> Read FAQs</a> or <a href="ContactUs" class="button"> Contact us!</a></div></p>
    </div>
    </div>
</form>