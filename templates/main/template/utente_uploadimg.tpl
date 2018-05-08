<div id="staff" class="container">
    <div class="title">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <b><fieldset class="bordo">
            <span><font color="#690813" size="4.5"><b>Select an image to upload:</b></font></span>
            <input type="hidden" name="username" value="{$username}" />
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
            <input type="hidden" name="controller" value="profile">
            <input type="hidden" name="task" value="mostra">
            </fieldset></b>
        </form>
    </div>
</div>