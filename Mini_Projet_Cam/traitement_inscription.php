<?php
session_start();

?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mini_Projet PHP</title>
		<link rel="stylesheet" href="style_page.css">
    </head>
    
    <body>
		<div id="wrapper">
			<div id="bloc_page">
				<header>
					<div id="titre_principal">
						<div id="logo">
							<img src="logo.png" style="width:50px;height:60px" alt="Logo" />
						</div>
					</div>

					<nav>
						<ul>
							<li><a href="Accueil.php">Accueil</a></li>
							<li><a href="pokemon.php">Pokemon</a></li>
							<?php
							if($_SESSION["personne"]==null){
							?>
							<li><a href="connexion.php">Connexion</a></li>
							<?php }else{ ?>
							<li><a href="compte.php">Mon compte</a></li>
							<?php } ?>
							<li><a href="inscription.php">Inscription</a></li>
							<li><a href="panier.php">Panier</a></li>
						</ul>
					</nav>
				</header>
				<?php
					include_once("params.inc.php");
					$id = mysqli_connect($host, $user, $password, $dbname);

					if (!$id){
						die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error()); 
					}   
					
					
					$nom = $_POST["nom"]; // $POST["nom"] -> c'est le nom de la valeur que l'on va taper et ce nom est dans inscription.php
					$prenom = $_POST["prenom"];					
					$mail = $_POST["mail"];
					$mdp = $_POST["password"];
					$adresse = $_POST["adresse"];
					
					//Insertion de l'inscrit dans la base de données
					$req = "INSERT INTO membre(Nom,Prenom,adresse_mail,mot_de_passe,adresse) VALUES ('$nom','$prenom','$mail','$mdp','$adresse')";
					$result = mysqli_query($id,$req);
					
					if($result == TRUE){?>
					<!--Recapitulatif des informations-->
						Bonjour <?php echo $prenom?>, votre inscription a bien ete prise en compte !!!! <br><br>
								Voici vos informations : 
								<br> Nom : <?php echo $nom?>
								<br> Prenom : <?php echo $prenom?>
								<br> Adresse mail : <?php echo $mail?>
								<br> Mot de passe : <?php echo $mdp?>
								<br> Adresse : <?php echo $adresse?>
								<?php
					}else{
						echo "Une erreur s'est produite";
					}
					
					
				?>
				
			</div>
		</div>
	</body>
</html>