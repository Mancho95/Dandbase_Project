<div id="staff" class="container">
    <div class="title">
        <span><font color="#690813" size="4.5"><b>Enter your searching parameters</b></font></span>
        <form method="post" action="index.php">
            <b><fieldset class="bordo">
                    <p><label for="name" class="left">Adventure Name:</label>
                        <input type="text" name="nome" id="nome" class="field" value="" tabindex="2" /></p>
                    <p><label for="Version" class="left">Version:</label>
                        <input type="radio" name="versione" id="versione" class="field" value="3.5" tabindex="4" />3.5
                        <input type="radio" name="versione" id="versione" class="field" value="3" tabindex="4" />3
                        <input type="radio" name="versione" id="versione" class="field" value="4.0" tabindex="4" />4.0
                        <input type="radio" name="versione" id="versione" class="field" value="Pathfinder" tabindex="4" />Pathfinder</p>
                    <input type="hidden" name="controller" value="ricerca" />
                    <input type="hidden" name="task" value="ricerca" />
                    <p><input type="submit" name="submit" id="submit_1" class="button" value=" search" tabindex="15" /></p>
                </fieldset></b>
        </form>
    </div>
</div>