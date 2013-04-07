<?php
    /**
    * Header content
    *
    * @author  My name
    *
    * @since 1.0.0
    */
?>
<!DOCTYPE html>
<html lang="fr" class="no-js"> 
<div id="creationCommande">
    
<?php if(fonction::isConnecteClient()){
   /*$information = $pdo->afficherUnCompte($_SESSION['client']);
   $desIdProduit = fonction::getLesIdProduitsDuPanier();
   $lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
   include("vues/v_validCommande.php");*/
   header('Location: '.HOME.'index.php?uc=gererPanier&action=recapitulatif');
}
else
{?>
<form method="POST" action="index.php?uc=connexion&action=inscription">
   <fieldset>
     <legend>Nouveau Client</legend>
                <p>
			<label for="nlogin">Login*</label>
			<input id="nlogin" type="text" name="nlogin" value="<?php echo $nlogin ?>" size="30" required maxlength="45">
		</p>
		<p>
			<label for="nmdp">Mot de passe*</label>
			 <input id="nmdp" type="password" name="nmdp" value="<?php echo $nmdp ?>" size="30" required maxlength="45">
		</p>
		<p>
			<label for="nnom">Nom*</label>
			<input id="nnom" type="text" name="nnom" value="<?php echo $nnom ?>" size="30" required maxlength="45">
		</p>
		<p>
			<label for="nadresse">Adresse*</label>
			<input id="nadresse" type="text" name="nadresse" value="<?php echo $nadresse ?>" size="30" required max length="45">
		</p>
		<p>
                        <label for="ncp">Code postal* </label>
                        <input id="ncp" type="text" name="ncp" value="<?php echo $ncp ?>" size="10" required maxlength="10">
                </p>
                <p>
                        <label for="ntel">Téléphone* </label>
                        <input id="ntel" type="tel" name="ntel" value="<?php echo $ntel ?>" size="10" required maxlength="10">
                </p>
                <p>
                        <label for="nmail">Email* </label>
                        <input id="nmail" type="email"  name="nmail" value="<?php echo $nmail ?>" size ="25" required maxlength="25">
                </p>
	  	<p>
                        <input type="submit" value="Valider" name="valider">
                        <input type="button" onclick="history.back();" value="Annuler">
                </p>
                </form>
</div>
    <div>
<form method="POST" action="index.php?uc=connexion&action=connecterCommande">
   <fieldset>
     <legend>Connexion</legend>
                <p>
			<label for="login">Login*</label>
			<input id="login" type="text" name="login" value="<?php echo $login ?>" size="30" maxlength="45">
		</p>
		<p>
			<label for="mp">Mot de passe*</label>
                        <input id="mp" type="password" name="mp" value="<?php echo $mp ?>" size="30" maxlength="45">
                </p>
                <p>
                        <input type="submit" value="Valider" name="valider">
                        <input type="button" onclick="history.back();" value="Annuler">
                </p>
</form>
<?php }?>
</div>






