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
<?php
if(isset($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
    switch($action)
    {
       case 'afficherCompte' :
        {
           $information = $pdo->afficherUnCompte($_SESSION['client']);
           $desIdProduit = fonction::getLesIdProduitsDuPanier();
           $lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
           include("vues/v_validCommande.php");
           break;
        }
    }
}
else
{
    $information = $pdo->afficherUnCompte($_SESSION['client']);
    $commande = $pdo->afficherCommande($_SESSION['client']);
    include("vues/v_clients.php");
}
?>
