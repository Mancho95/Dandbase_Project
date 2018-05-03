<?php /* Smarty version 2.6.26, created on 2018-05-03 19:10:48
         compiled from ricerca_mostra.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
        <span><font color="#690813" size="6.5"><b><?php echo $this->_tpl_vars['_adventures_list'][0]->nome; ?>
</b></font></span>
        <b><fieldset class="bordo">
                <p align="center"><label for="username"><font size="6.5" color="#690813">Creator:</font></label><br />
                    <font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][0]->username; ?>
</font></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Description:</font></label><br />
                    <font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][0]->descrizione; ?>
</font></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">File:</font></label><br />
                    <font size="4.5" color="black"><?php echo $this->_tpl_vars['_adventures_list'][0]->file; ?>
</font></p>
            </fieldset></b>
        </br>
        <p><a href="?controller=ricerca&task=modulo" class="button"> Go back</a></p>
    </div>
</div>