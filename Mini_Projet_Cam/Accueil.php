<?php
session_start();
$_SESSION["personne"]=null;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Projet_PHP</title>
		<link rel="stylesheet" href="style_page.css">
    </head>
	<body>      
      <div id="wrapper">
			 <div id="bloc_page">
				<header>				
					<div id="logo">
						<img src="logo.png" style="width:50px;height:60px" alt="Logo" />
					</div>	
					<nav>
						<ul>
							<li><a href="Accueil.php">Accueil</a></li>
							<li><a href="pokemon.php">Pokémon</a></li>
							<?php
							if($_SESSION["personne"]==null){
							?>
							<!--Si la personne n'est pas connecté on affiche connexion dans la barre de menu-->
								<li><a href="connexion.php">Connexion</a></li>
							<?php }else{ ?>
							<!--Si la personneest connecté, on affihe mon compte dans la barre de menu-->
								<li><a href="compte.php">Mon compte</a></li>
							<?php } ?>
							<li><a href="inscription.php">Inscription</a></li>
							<li><a href="panier.php">Panier</a></li>
						</ul>
					</nav>
				</header>
				<div id="banniere_image">
					<div id="banniere_description">
						Venez acheter vos POKEMONS !!!!!
					</div>
				</div>
				<section>
					<article>
						<p>Pokémon Go ayant eu un gros succès et ayant donné beaucoup d’importance aux endroits où les Pokémons virtuels sont placés, notre société vous offre la possibilité de pouvoir acheter des Pokémon chez nous afin qu'ils soit placés ensuite sur votre site afin d’attirer un maximum de visiteurs.
							Vous pouvez donc consulter la liste de Pokémons et les acheter. Si le devis vous convient, une facture vous sera émise.
						</p>
					</article>
				</section>
			 </div>
     </div>
    

	<!--------- CSS ----------->
	<meta charset=utf-8>
	<style type="text/css">	
	/* Bannière */

	#banniere_image{
		margin-top: 15px;
		height: 300px;
		border-radius: 5px;
		background: url('fond.jpg') no-repeat;
		position: relative;
		box-shadow: 0px 4px 4px #1c1a19; <!-- hombre bas de la banière-->
		margin-bottom: 25px; <!-- marge entre le texte et la banière-->
	}

	#banniere_description{
		position: absolute;
		bottom: 0;
		border-radius: 0px 0px 5px 5px;
		width: 99.5%;
		height: 33px;
		padding-top: 15px;
		padding-left: 4px;
		background-color: rgba(24,24,24,0.8);
		color: white;
		font-size: 0.8em;
	}
	</style>
	<!------------------------>





    </body>
</html>
