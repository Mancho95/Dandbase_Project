<?php /* Smarty version 2.6.26, created on 2018-05-14 14:26:59
         compiled from ricerca_default.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
        <span><b><h2>Enter your searching parameters</h2></b></span>
        <form method="post" action="Results" id="form">
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