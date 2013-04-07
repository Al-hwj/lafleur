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
$action = $_REQUEST['action'];
//case suivant les fonctionnatalités du l'utilisateur
switch($action)
{
        //action 1 : voir les produits
	case 'voirPanier':
	{
                //on utilise la fonction nbProduitsDuPanier pour vérifier si il existe des produits dans le panier
		$n= fonction::nbProduitsDuPanier();
		if($n >0)
		{
			$desIdProduit = fonction::getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			include("vues/v_panier.php");
		}
		else
		{
			$message = "Votre panier est actuellement vide.";
			include ("vues/v_message.php");
		}
		break;
	}
        //action 2 : supprimer un produit
	case 'supprimerUnProduit':
	{
                //Pour retirer un produit, on utilise la fonction retirerDuPanier pour le suprimer
		$idProduit=$_REQUEST['produit'];
		fonction::retirerDuPanier($idProduit);
		$desIdProduit = fonction::getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
		$message = "Cet article à bien été retiré de votre panier.";
		include("vues/v_message.php");
		include("vues/v_panier.php");
		break;
	}
        //action 3 : passer une commande
	case 'passerCommande' :
            //on vérifie d'abord si il y a un produit dans mon panier
	    $n= fonction::nbProduitsDuPanier();
		if($n>0)
		{
                        $nlogin=''; $nmdp=''; $ncmdp=''; $nnom ='';$nadresse='';$ntel ='';$ncp='';$nmail='';$nqte='';$login='';$mp='';
			include ("vues/v_commande.php");
		}
		else
		{
			$message = "Votre panier est actuellement vide.";
			include ("vues/v_message.php");
		}
		break;
                
        //action 4 : confirmer la commande
	case 'confirmerCommande'    :
	{
                $information = $pdo->afficherUnCompte($_SESSION['client']);
                //on enregistre dans la base de donné les informations de l'utilisateur avec la fonction creerCommande
                $lesIdProduit = fonction::getLesIdProduitsDuPanier();
                $pdo->creerCommande($information[0]->clt_id,$lesIdProduit, $_POST['qte']);
                $message = "Commande enregistrée";
                fonction::supprimerPanier();
                //La fonction supprimerPanier permet de tout supprimer les session du panier
                include ("vues/v_message.php");
		break;
	}
        
        case 'recapitulatif':
        {
            if(fonction::isConnecteClient()){
                $information = $pdo->afficherUnCompte($_SESSION['client']);
                $desIdProduit = fonction::getLesIdProduitsDuPanier();
                $lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
                $qte = $_POST['qte'];
                include("vues/v_validCommande.php");
                break; 
            }
            else
            {
                $nlogin=''; $nmdp=''; $ncmdp=''; $nnom ='';$nadresse='';$ntel ='';$ncp='';$nmail='';$nqte='';$login='';$mp='';
                include("vues/v_commande.php");
            }
        }
}
?>


