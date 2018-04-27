<?php /* Smarty version 2.6.26, created on 2018-04-27 18:44:30
         compiled from upload_default.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
        <span><font color="#690813" size="4.5"><b>Enter your adventure details</b></font></span>
        <form enctype="multipart/form-data" id="form" action="index.php" method="POST">
            <b><fieldset class="bordo">
                    <input type="hidden" name="username" value="<?php echo $this->_tpl_vars['nick']; ?>
" tabindex="1" />
                    <p><label for="name" class="left">Adventure Name:</label>
                        <input type="text" name="nome" id="nome" class="field" value="" tabindex="2" /></p>
                    <p><label for="desc" class="left">Description:</label>
                        <input type="text" name="descrizione" id="descrizione" class="field" value="" tabindex="3"/></p>
                    <p><label for="Version" class="left">Version:</label>
                        <input type="radio" name="versione" id="versione" class="field" value="3.5" tabindex="4" />3.5
                        <input type="radio" name="versione" id="versione" class="field" value="3" tabindex="4" />3
                        <input type="radio" name="versione" id="versione" class="field" value="4.0" tabindex="4" />4.0
                        <input type="radio" name="versione" id="versione" class="field" value="Pathfinder" tabindex="4" />Pathfinder</p>
                    <p><label for="file" class="left">File:</label>
                        <input type="file" name="file" id="file" class="field" value="" tabindex="5" /></p>
                    <input type="hidden" name="controller" value="upload" />
                    <input type="hidden" name="task" value="upload" />
                    <p><input type="submit" name="submit" id="submit_1" class="button" value=" upload" tabindex="15" /></p>
                </fieldset></b>
        </form>
    </div>
</div>