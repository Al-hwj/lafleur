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
/**
 * Classe de fonctions n'accédant pas à la base de données.
*/
class fonction{
    
/**
 * Teste si l'administrateur est connecté
 *
 * Teste si l'administrateur est actuellement connecté grâce à la variable $_SESSION['admin']
 * @return : $_SESSION['admin'] ou faux
*/
static function isConnecteAdmin(){
    if(isset($_SESSION['admin'])){
        return $_SESSION['admin']; 
    }
    else{
        return(FALSE);
    }
}

/**
 * Teste si le client est connecté
 *
 * Teste si le client est actuellement connecté grâce à la variable $_SESSION['client']
 * @return : $_SESSION['client'] ou faux
*/
static function isConnecteClient(){
    if(isset($_SESSION['client'])){
        return $_SESSION['client']; 
    }
    else{
        return(FALSE);
    }
}
    
/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
*/
static function initPanier()
{
	if(!isset($_SESSION['produits']))
	{
		$_SESSION['produits']= array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
static function supprimerPanier()
{
	unset($_SESSION['produits']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit n'était pas dans la variable, faux sinon 
*/
static public function ajouterAuPanier($idProduit)
{
	if(in_array($idProduit,$_SESSION['produits']))
	{
		$ok = TRUE;
	}
	else
	{
                $ok = FALSE;
		$_SESSION['produits'][]= $idProduit;
	}
	return $ok;
}
/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produit
 * @return : le tableau
*/
static function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits'];
}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
*/
static function nbProduitsDuPanier()
{
	$n = 0;
	if(isset($_SESSION['produits']))
	{
	$n = count($_SESSION['produits']);
	}
	return $n;
}
/**
 * Retire un de produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * @param $idProduit : identifiant de produit
 
*/
static function retirerDuPanier($idProduit)
{
	$index =array_search($idProduit,$_SESSION['produits']);
	unset($_SESSION['produits'][$index]);
}
/**
 * Teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
*/
static function estUnCp($codePostal)
{
   return strlen($codePostal)== 5 && fonction::estEntier($codePostal);
}
/**
 * Teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param $valeur : la chaîne testée
 * @return : vrai ou faux
*/

static function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * @param $mail : la chaîne testée
 * @return : vrai ou faux
*/
static function estUnMail($mail)
{
        return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/**
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param $nom : chaîne
 * @param $rue : chaîne
 * @param $ville : chaîne
 * @param $cp : chaîne
 * @param $mail : chaîne 
 * @return : un tableau de chaînes d'erreurs
*/
static function getErreursSaisieCommande($nom,$rue,$ville,$cp,$mail)
{
	$lesErreurs = array();
	if($nom=="")
	{
		$lesErreurs[]="Il faut saisir le champ nom";
	}
	if($rue=="")
	{
	$lesErreurs[]="Il faut saisir le champ rue";
	}
	if($ville=="")
	{
		$lesErreurs[]="Il faut saisir le champ ville";
	}
	if($cp=="")
	{
		$lesErreurs[]="Il faut saisir le champ Code postal";
	}
	else
	{
		if(!fonction::estUnCp($cp))
		{
			$lesErreurs[]= "erreur de code postal";
		}
	}
	if($mail=="")
	{
		$lesErreurs[]="Il faut saisir le champ mail";
	}
	else
	{
		if(!fonction::estUnMail($mail))
		{
			$lesErreurs[]= "erreur de mail";
		}
	}
	return $lesErreurs;
}
}
?>
