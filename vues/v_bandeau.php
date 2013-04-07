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
<div id="bandeau">
<!-- Images En-t�te -->
<!--<img src="images/menuGauche.gif"	alt="Choisir" title="Choisir"/>-->
<img src="images/bandeau.png" alt="Lafleur" title="Lafleur"/>
</div>
<!--  Menu haut-->
<div id="menu">
         <li><a href="index.php?uc=accueil"> Accueil </a></li>
	 <li><a href="index.php?uc=voirProduits&action=voirCategories"> Catalogue </a></li>
	 <li><a href="index.php?uc=gererPanier&action=voirPanier"> Panier </a></li>
         <?php if(fonction::isConnecteAdmin()){?>
              <li><a href="index.php?uc=admin"> Admin </a></li>
              <li><a href="index.php?uc=connexion&action=deconnecter"> Deconnexion </a></li>
         <?php }elseif(fonction::isConnecteClient()){ ?>
              <li><a href="index.php?uc=clients"> Mon Compte </a></li>
              <li><a href="index.php?uc=connexion&action=deconnecter"> Deconnexion </a></li>
         <?php }else{ ?>
              <li><a href="index.php?uc=connexion"> Se connecter </a></li>
         <?php } ?>
</div>