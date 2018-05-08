<div id="staff" class="container">
    <div class="title">
        <b><a color="#690813">{$errore}</a></b>
        {if $commentato==true}
            <b><a color="#690813">Your comment was uploaded correctly!</a></b>
        {/if}
        <span><font color="#690813" size="6.5"><b>{$_adventures_list[0]->nome}</b></font></span>
        <b><fieldset class="bordo">
                <p align="center"><label for="username"><font size="6.5" color="#690813">Creator:</font></label><br />
                    <font size="4.5" color="black">{$_adventures_list[0]->username}</font></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Description:</font></label><br />
                <td style="width:606px;text-align:left;vertical-align:top;white-space:wrap;"><font size="4.5" color="black">{$_adventures_list[0]->descrizione}</font></td></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Map:</font></label><br />
                    <img src="adventuresmap/{$_adventures_list[0]->username}{$_adventures_list[0]->nome}" width="400" height="400" alt="" /></p>
                <p align="center"><label for="username"><font size="6.5" color="#690813">Upvote Percentage:</font></label><br />
                    <font size="4.5" color="black">{$_upvote}</font></p>
                {if $admin=='admin'}
                <form method="post" action="index.php" id="form">
                <p><label for="username"><font size="4.5" color="black">Delete adventure:</font></label><br />
                    <p><input type="hidden" name="controller" value="upload" /></p>
                    <p><input type="hidden" name="task" value="deletea" /></p>
                    <p><input type="hidden" name="cod_avventura" value="{$_adventures_list[0]->cod_avventura}" /></p>
                    <input type="submit" name="submit" id="submit_1" class="button" value="delete" /></p>
                </form>
                {/if}
            </fieldset></b>
        {if $_comments_list!=0}
            <b><fieldset class="bordo"><legend>Comments</legend>
            {section name=i loop=$_comments_list}
                <fieldset class="bordo">
                <p align="left"><label for="username"><font size="4.5" color="#690813">{$_comments_list[i]->username}:</font></label><br />
                    <p style="float: left;"><img src="profileimages/{$_comments_list[i]->username}" width="100" height="100" alt="" />&nbsp&nbsp&nbsp</p>
                    <fieldset class="bordo">
                    <td style="width:606px;text-align:left;vertical-align:top;white-space:wrap;"><font size="2.5" color="black">{$_comments_list[i]->testo}</font></td></p>
                    {if $_comments_list[i]->upvote==true}
                    <p align="left"><img src="images/icon_like.png" width="32" height="32" alt="" /></p>
                    {/if}
                    {if $_comments_list[i]->upvote==false}
                    <p align="left"><img src="images/icon_dislike.png" width="32" height="32" alt="" /></p>
                    {/if}
                    {if $admin=='admin'}
                        <form method="post" action="index.php" id="form">
                        <p><label for="username"><font size="4.5" color="black">Delete comment:</font></label><br />
                        <p><input type="hidden" name="controller" value="upload" /></p>
                        <p><input type="hidden" name="task" value="deletec" /></p>
                        <p><input type="hidden" name="cod_avventura" value="{$_comments_list[i]->cod_commento}" /></p>
                        <input type="submit" name="submit" id="submit_1" class="button" value="delete" /></p>
                        </form>
                    {/if}
                    </fieldset>
                    </fieldset>
                </br>
            {/section}
                </fieldset></b>
        {/if}
        {if $user==true}
        <form method="post" action="index.php" id="form">
            <b><fieldset class="bordo"><legend>&nbsp;Add a comment</legend>
                    <p><input type="hidden" name="controller" value="ricerca" /></p>
                    <p><input type="hidden" name="task" value="commenta" /></p>
                    <p><input type="hidden" name="cod_avventura" value="{$_adventures_list[0]->cod_avventura}" /></p>
                    <p><input type="hidden" name="username" value="{$user}" /></p>
                    <p><label for="testo" class="left">Your comment:</label>
                        <textarea name="testo" id="testo" cols="30" rows="10"/></textarea></p>
                    <p><label for="Version" class="left">Upvote:</label>
                        <input type="radio" name="upvote" id="upvote" class="field" value=1 tabindex="4" />Yes
                        <input type="radio" name="upvote" id="upvote" class="field" value=0 tabindex="4" />No</p>
                    <p><input type="submit" name="submit" id="submit_1" class="button" value=" comment" tabindex="15" /></p>
                </fieldset></b>
        </form>
        {/if}
        </br>
        <p><a href="?controller=ricerca&task=modulo" class="button"> Search again</a>{if $user==true} or <a href="?controller=profile&task=mostra" class="button"> Go to your profile</a>{/if}</p>
    </div>
</div>