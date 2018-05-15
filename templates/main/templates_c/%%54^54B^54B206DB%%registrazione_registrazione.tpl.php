<?php /* Smarty version 2.6.26, created on 2018-05-14 13:04:36
         compiled from registrazione_registrazione.tpl */ ?>
<div id="staff" class="container">
<div class="title">
    <h2>Are you ready to get started?</h2>
    <span><font color="#690813" size="4.5"><b>We just need a bit of your infos to register your account</b></font></span>
    <form method="post" id="form" action="index.php">
        <b><fieldset class="bordo"><legend>&nbsp;Login Infos</legend>
            <p><label for="username" class="left">Username:</label>
                <input type="text" name="username" id="username" class="field" value="" tabindex="1" /></p>
            <p><label for="password" class="left">Password:</label>
                <input type="password" name="password" id="password" class="field" value="" tabindex="2" /></p>
            <p><label for="password_1" class="left">Retype password:</label>
                <input type="password" name="password_1" id="password_1" class="field" value="" tabindex="3" /></p>
        </fieldset>
        <fieldset class="bordo"><legend>&nbsp;Personal details</legend>
            <p><label for="nome" class="left">Name:</label>
                <input type="text" name="nome" id="nome" class="field" value="" tabindex="4" /></p>
            <p><label for="cognome" class="left">Surname:</label>
                <input type="text" name="cognome" id="cognome" class="field" value="" tabindex="5" /></p>
            <p><label for="email" class="left">Email:</label>
                <input type="text" name="email" id="email" class="field" value="" tabindex="6" /></p>
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="salva" />
            <p><input type="submit" name="submit" id="submit_1" class="button" value=" Sign up" tabindex="15" /></p>
            </fieldset></b>
        <span><font color="#690813" size="4.5"><b>Already have an account?</b></font></span>
        <p><a href="Login" class="button"> Sign In</a></p>
    </form>
</div>
</div>