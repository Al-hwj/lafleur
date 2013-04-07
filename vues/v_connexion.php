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
<form id ="connexion" method="POST" action="<?php echo HOME."index.php?uc=connexion&action=connecter"?>">
		<p>
			<label for="login">login*</label>
			<input id="login" type="text" name="login" value="" size="30" maxlength="45">
		</p>
		<p>
			<label for="mp">Mot de passe*</label>
			 <input id="mp" type="password" name="mp" value="" size="30" maxlength="45">
		</p>
		<p>
         <input type="submit" value="Valider" name="valider">
         <input type="reset" value="Annuler" name="annuler"> 
      </p>
</form>