<?php
session_start();

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
				<div id="banniere_image">
					
				</div>
				 <section>
					<article>
												
						<br>
						<br>
						<br>
						<br>
						<!--La personne qui se connecte est un membre-->
						<form method="post" action="traitement_connexion.php">
							<fieldset>
								<br>
								<legend>Vous etes membre :</legend>
								<label for="mail">adresse mail</label> 
								<input type="text" name="mail" /> 
								<br> 
								<br>       
								<label for="password">Mot de passe </label>
								<input type="password" name="password"/>
								<br>  
								<br>
							</fieldset>	
						  <input type="reset" name="reset"  />
						  <input type="submit"/>				  
						</form>		
						
						<br>
						<br>
						<br>
						<br>
						<br>
						<!--La personne qui se connecte est l'admin-->
						<form method="post" action="traitement_connexion_admin.php">
							<fieldset>
								<br>
								<legend>Vous etes administrateur :</legend>
								<label for="mail">adresse mail</label> 
								<input type="text" name="mail" /> 
								<br> 
								<br>       
								<label for="password">Mot de passe </label>
								<input type="password" name="password"/>
								<br>  
								<br>
							</fieldset>	
						  <input type="reset" name="reset"  />
						  <input type="submit"/>				  
						</form>		
				
					</article>
				</section>
			 </div>
		</div>
    </body>
</html>
