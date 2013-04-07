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
<table border='1'> <?php
foreach ($information as $i):
?>
<tr>
    Bienvenue à votre gestion de compte <?php echo $i->clt_nom ?><br><br>
   <td>Login : <?php echo $i->clt_login ?><br>
   Mot de passe : <?php echo $i->clt_mdp ?><br>
   Nom : <?php echo $i->clt_nom ?><br>
   Adresse : <?php echo $i->clt_adresse ?><br>
   Code Postal : <?php echo $i->clt_cpostal ?><br>
   Téléphone : <?php echo $i->clt_tel ?><br>
   Email : <?php echo $i->clt_email ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
Vos commandes :
<table border='1'> <?php
foreach ($commande as $c):
?>
<tr>
   <td>Produit : <?php echo $c->cc_produit ?><br>
   Quantité : <?php echo $c->cc_quantite ?><br>
   Date : <?php echo $c->c_date ?></td>
</tr>
<?php endforeach; ?>
</table>