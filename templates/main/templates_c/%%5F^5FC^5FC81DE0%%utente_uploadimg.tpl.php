<?php /* Smarty version 2.6.26, created on 2018-05-08 16:18:00
         compiled from utente_uploadimg.tpl */ ?>
<div id="staff" class="container">
    <div class="title">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <b><fieldset class="bordo">
            <span><font color="#690813" size="4.5"><b>Select an image to upload:</b></font></span>
            <input type="hidden" name="username" value="<?php echo $this->_tpl_vars['username']; ?>
" />
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
            <input type="hidden" name="controller" value="profile">
            <input type="hidden" name="task" value="mostra">
            </fieldset></b>
        </form>
    </div>
</div>