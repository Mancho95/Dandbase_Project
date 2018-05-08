<div id="staff" class="container">
    <div class="title">
        <b><a color="#690813">{$errore}</a></b>
        <form method="post" id="form" action="index.php">
            <b><fieldset class="bordo"><legend>&nbsp;Change email</legend>
                    <p><label for="password" class="left">New Email:</label>
                        <input type="text" name="new" id="new" class="field" value="" tabindex="2" /></p>
                    <p><label for="password_1" class="left">Retype new Email:</label>
                        <input type="text" name="new_1" id="new_1" class="field" value="" tabindex="3" /></p>
                    <input type="hidden" name="controller" value="profile" />
                    <input type="hidden" name="task" value='modifica_mail'/>
                    <p><input type="submit" name="submit" id="submit_1" class="button" value="Change email" tabindex="15" /></p>
                </fieldset>
        </form>
    </div>
</div>