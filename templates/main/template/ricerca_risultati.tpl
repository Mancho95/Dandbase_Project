<form method="post" action="ShowAdventure">
<div id="staff" class="container">
    <div class="title">
        <p><input type="hidden" name="controller" value="ricerca" /></p>
        <p><input type="hidden" name="task" value="mostra" /></p>
        <b><fieldset class="bordo"><legend>&nbsp;Results</legend>
                {if $_adventures_list!=0}
                <p class="unicaRiga">
                    <span class="margine_d"><font size="6.5" color="#690813">Link</font></span>
                    <span class="margine_d2"><font size="6.5" color="#690813">Version</font></span>
                    <span class="centrato"><font size="6.5" color="#690813">Name</font></span>
                </p>
                {section name=i loop=$_adventures_list}
                    <p class="unicaRiga">
                        <span class="margine_d"><button type="submit" name="cod_avventura" value="{$_adventures_list[i]->cod_avventura}"  class="button">Open</button></span>
                        <span class="margine_d2"><font size="4.5" color="black">{$_adventures_list[i]->versione}</font></span>
                        <span class="centrato"><font size="4.5" color="black">{$_adventures_list[i]->nome}</font></span>
                    </p>
            </br>
                {/section}
                {/if}
                {if $_adventures_list==0}
                    <p><font size="4.5" color="black">No avable results. Change search parameters</font></p>
                {/if}
            </fieldset></b>
        <br></br>
        <p><a href="Search" class="button"> Go back</a></p>
    </div>
</div>
