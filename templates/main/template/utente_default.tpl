<div id="staff" class="container">
    <div class="title">
    {$errore}
        <b><fieldset class="bordo"><legend>&nbsp;Your Profile</legend>
            <p style="float: left;"><img src="images/bulba.jpg" width="250" height="250" alt="" /></p>
            <p><font size="6.5" color="#690813">&nbsp {$username}</font></p>
            <p><font size="2.5" color="black">&nbsp Your e-mail:{$mail}</font></p>
            <p>&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Change image</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="?controller=upload&task=modulo" class="button"> Upload Adventure</a></p>
            <p>&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Change email</a>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="?controller=registrazione&task=registra" class="button"> Change password &nbsp</a></p>
        </fieldset></b>
        <b><fieldset class="bordo"><legend>&nbsp;Your adventures</legend>
                <p class="unicaRiga">
                <span class="margine_d"><font size="6.5" color="#690813">Link</font></span>
                <span class="margine_d2"><font size="6.5" color="#690813">Version</font></span>
                <span class="centrato"><font size="6.5" color="#690813">Name</font></span>
                </p>
                    {section name=i loop=$_adventures_list}
                        <p class="unicaRiga">
                            <span class="margine_d"><font size="4.5" color="black">Link</font></span>
                            <span class="margine_d2"><font size="4.5" color="black">{$_adventures_list[i]->versione}</font></span>
                            <span class="centrato"><font size="4.5" color="black">{$_adventures_list[i]->nome}</font></span>
                        </p>
                    {/section}
        </fieldset></b>
    </div>
</div>