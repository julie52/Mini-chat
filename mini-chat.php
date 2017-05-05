<?php
			$bdd = new PDO("mysql:host=127.0.0.1;dbname=chat;charset=utf8", "root", "");
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if(isset($_POST['pseudo'] , $_POST['message'])){
				if(!empty($_POST['pseudo']) AND ($_POST['message'])){

					$pseudo = htmlspecialchars($_POST['pseudo']);
					$message = htmlspecialchars($_POST['pseudo']);
					$insertmsg = $bdd->prepare('INSERT INTO chat (pseudo, message) VALUES (?,?)');
					$insertmsg->execute(array($pseudo,$message));
				} else {
					$error = 'Remplis tout les champs !';
				}
			}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
		<title>Forum</title>
	</head>

	<body>
		<h2 id="titre">Forum pour les nuls</h2>

		<?php if(isset($error)) {echo $error; } ?>

		<div id="formulaire">
			<form method="post" action="">
				<p>Pseudonyme :</p><input type="text" name="pseudo" placeholder="Pseudo"  /><br/><br/>
				<p>Message :</p><textarea type="text" name="message" placeholder="Message" rows="8" cols="45"></textarea><br/>
				<input type="submit" value="Envoyer">
			</form>
		</div><br>

		<?php
			$allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC');
			while($msg = $allmsg->fetch())
			{
		?>

		<b><?php echo $msg['pseudo']; ?> : </b> <?php echo $msg['message']; ?></br></br>
		<?php
			}
		?>

	</body>
</html>
