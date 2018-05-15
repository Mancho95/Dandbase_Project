<?php /* Smarty version 2.6.26, created on 2018-05-14 13:04:34
         compiled from registrazione_default.tpl */ ?>
<div id="staff" class="container">
		<div class="title">
			<b><a color="#690813"><?php echo $this->_tpl_vars['avviso']; ?>
</a></b>
			<h2>Welcome to DnBase, a very helpful tool for Role-players!</h2>
			<span><font color="#690813" size="4.5"><b>Share your adventures with a wide community of Role-players like you! A lot of epic stories await!</b></font></span>
		<div class="boxA"><img src="images/pic01.jpg" width="300" height="450" alt="" /></div>
		<div class="boxB"><img src="images/pic02.jpg" width="300" height="450" alt="" /></div>
		<div class="boxC"><img src="images/pic03.jpg" width="300" height="450" alt="" /></div>
	</div>
	<div id="page" class="container">
		<div class="boxA">
			<h2>Upload your adventure <br />
				<span></span></h2>
			<p>Share your fantastic adventures, let other players test it and wait for their feedback.</p>
			<ul class="style4">
				<li class="first"><a href="Upload">Upload an adventure</a></li>
				<li><a href="Profile">Go to "Your adventures"</a></li>
                <?php if ($this->_tpl_vars['loggato'] == false): ?>
				<li><a href="Register">Not yet registered? Click here to sign up!</a></li>
                <?php endif; ?>
			</ul>
		</div>
		<div class="boxB">
			<h2>Rate a lot of adventures<br />
				<span></span></h2>
			<p>Play other players adventures, and rate them without harrassing the creator.</p>
			<ul class="style4">
				<li class="first"><a href="Search">Search for an adventure</a></li>
				<li><a href="RandomAdventure">Random adventure, if you are brave enough</a></li>
                <?php if ($this->_tpl_vars['loggato'] == false): ?>
				<li><a href="Register">Dont forget to sign up!</a></li>
                <?php endif; ?>
			</ul>
		</div>
		<div class="boxC">
			<h2>Have fun<br />
				<span></span></h2>
			<p>Contact us if you find something offensive or someone is harrassing you.</p>
			<ul class="style4">
				<li class="first"><a href="ContactUs">Contact us</a></li>
				<li><a href="FAQ">FAQs</a></li>
				<?php if ($this->_tpl_vars['loggato'] == false): ?>
				<li><a href="Registra">...Really? Don't have an account yet?</a></li>
                <?php endif; ?>
			</ul>
		</div>
	</div>