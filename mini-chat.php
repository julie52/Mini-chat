<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
		<title>Forum</title>
	</head>

	<body>
		<h2 id="titre">Forum pour les nuls</h2>

		<div id="formulaire">
			<form method="post" action="">
				<p>Pseudonyme :</p><input type="text" name="pseudo" placeholder="Pseudo" value="<?php if(isset($pseudo)){ echo $pre;}?>" /><br/><br/>
				<p>Message :</p><textarea type="text" name="message" placeholder="Message" rows="8" cols="45"></textarea><br/>
				<input type="submit" value="Envoyer">
			</form>
		</div>

		<?php
			$bdd = new PDO("mysql:host=127.0.0.1;dbname=chat;charset=utf8", "root", "");
			if(isset($_POST['pseudo']) AND isset ($_POST['message']) AND !empty($_POST['pseudo']) AND !empty($_POST['message']));
		{
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$message = htmlspecialchars($_POST['message']);
			$insertmsg = $bdd->prepare('INSERT INTO chat (pseudo, message) VALUES(?, ?)');
			$insertmsg->execute(array($pseudo, $message));
		}
		?>

		<?php
			$allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC');
			while($msg = $allmsg->fetch())
			{
		?>

			<b> <?php echo $msg['pseudo']; ?> : </b> <?php echo $msg['message']; ?></br>
		<?php
			}
		?>
		
	</body>
</html>