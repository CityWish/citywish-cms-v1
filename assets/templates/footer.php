<footer id="footer">
	<div id="left" style="margin-top: 6px;">
		<p>© 2017 - <?= date('Y') ?> <b><?php echo $Configs['Nom']; ?> V.1.2</b></p>
        <p><b><?php echo $Configs['Nom']; ?></b> est un projet indépendant, à but non-lucratif, anciennement par <b>LOXI-</b> repris par <b>Cold</b>.</p>
        <p>CMS réalisé par <a style="color: white;" href="<?= $Configs['Url'] ?>profil/Neal"><b>Neal</b></a> et <a style="color: white;" href="<?= $Configs['Url'] ?>profil/Cold"><b>Cold</b></a>, copie interdite !</p>
	</div>
	<div id="right">
		<div class="sign" style="background-image: url(<?php echo $Configs['Web']; ?>imgs/footer.png)"></div>
	</div>
</footer>

<script type="text/javascript" src="assets/js/fireworks.js"></script>
<script>
  const container = document.getElementById('snowLimit');
  const fireworks = new Fireworks.default(container);
	fireworks.updateOptions({
		intensity: 30,
		flickering: 30
	});
  ///fireworks.start();
</script>