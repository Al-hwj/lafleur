<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application lafleur
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
?>
<!DOCTYPE html>
<html lang="fr" class="no-js"> 
<?php
/**
 * Classe de fonctions PDO accedant à la base de données
 */
class PdoLafleur
{
/**
 * Variables de la classe PdoLaFleur
 * @param $serveur Initialise le serveur de connexion à la base de données
 */
      	private static $serveur='';
/**
 * Variables de la classe PdoLaFleur
 * @param $bdd Initialise le nom de la base de données
 */
      	private static $bdd='dbname=lafleurnew';
/**
 * Variables de la classe PdoLaFleur
 * @param $user Initialise le login de connexion à la base de données
 */        
      	private static $user='' ;  
/**
 * Variables de la classe PdoLaFleur
 * @param $mdp Initialise le mot de passe de connexion à la base de données
 */        
      	private static $mdp='' ;	
 /**
 * Variables de la classe PdoLaFleur
 * @param $monPdo Initialise la variable monPdo
 */
        private static $monPdo;
/**
 * Variables de la classe PdoLaFleur
 * @param $monPdoLafleur Initialise la variable monPdoLafleur
 */
        private static $monPdoLafleur = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
    		PdoLafleur::$monPdo = new PDO(PdoLafleur::$serveur.';'.PdoLafleur::$bdd, PdoLafleur::$user, PdoLafleur::$mdp); 
			PdoLafleur::$monPdo->query("SET CHARACTER SET utf8");
	}
        
/**
 * Destructeur public, supprime l'instance de PDO qui était sollicitée
 * pour toutes les méthodes de la classe
 */
	public function _destruct(){
		PdoLafleur::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdolafleur = PdoLafleur::getPdoLafleur();
 * @return l'unique objet de la classe PdoLafleur
 */
	public  static function getPdoLafleur()
	{
		if(PdoLafleur::$monPdoLafleur == null)
		{
			PdoLafleur::$monPdoLafleur= new PdoLafleur();
		}
		return PdoLafleur::$monPdoLafleur;  
	}
/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 * 
 * @return le tableau associatif des catégories 
*/
	public function getLesCategories()
	{
		$req = "select * from categorie";
		$res = PdoLafleur::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param $idCategorie 
 * @return un tableau associatif  
*/

	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $req="select * from produits where pdt_categorie = '$idCategorie'";
		$res = PdoLafleur::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param $desIdProduit tableau d'idProduits
 * @return un tableau associatif 
*/
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "select * from produits where pdt_ref = '$unIdProduit'";
				$res = PdoLafleur::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}
/**
 * Crée une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param $idClient 
 * @param $lesIdProduit
 * @param $qte 
*/
	public function creerCommande($idClient,$lesIdProduit,$qte)
	{
		$req = "select max(c_id) as maxi from commande";
		//echo $req."<br>";
		$res = PdoLafleur::$monPdo->query($req)->fetchAll(PDO::FETCH_OBJ);
                $maxi = $res[0]->maxi; 
		$maxi++;
		$idCommande = $maxi;
		//echo $idCommande."<br>";
		//echo $maxi."<br>";
		$date = date('Y/m/d');
		$req = "insert into commande values ('$idCommande', '$date')";
		//echo $req."<br>";
		$res = PdoLafleur::$monPdo->exec($req);
		foreach($lesIdProduit as $unIdProduit)
		{
			$req = "insert into contenucommande values ('$idCommande', '$idClient','$unIdProduit', '$qte')";
			//echo $req."<br>";
			$res = PdoLafleur::$monPdo->exec($req);
                        $req2 = "Update produits set pdt_qtedispo=pdt_qtedispo-'$qte' where pdt_ref='$unIdProduit'";
                        $res2 = PdoLafleur::$monPdo->exec($req2);
		}
	}
        
/**
 * Connecte un administrateur
 *
 * Crée une connexion d'un administrateur à partir des arguments validés passés en paramètre, la connexion est
 * construit à partir d'identifiant et de mot de passe passer en paramètre.
 * @param $login 
 * @param $motpasse
 * @return les informations de l'adminisrtateur sous forme de tableau associatif ou 0.
*/
        public function connexionAdmin($login, $motpasse)
	{
		$req = "SELECT * FROM administrateur WHERE a_login='$login' and a_mdp='$motpasse'";
		$res = PdoLafleur::$monPdo->query($req)->fetchAll(PDO::FETCH_ASSOC);
                if($res != NULL)
                {
                    return $res[0];
                }
                else
                {
                    return (0);
                }
	}
        
/**
 * Connecte un client
 *
 * Crée une connexion d'un client à partir des arguments validés passés en paramètre, la connexion est
 * construit à partir d'identifiant et de mot de passe passer en paramètre.
 * @param $login 
 * @param $motpasse
 * @return les informations du client sous forme de tableau associatif ou 0.
*/
        public function connexionClients($login, $motpasse)
        {
            $req = "SELECT * FROM clients WHERE clt_login='$login' and clt_mdp='$motpasse'";
		$res = PdoLafleur::$monPdo->query($req)->fetchAll(PDO::FETCH_ASSOC);
                if($res != NULL)
                {
                    return $res[0];
                }
                else
                {
                    return (0);
                }
        }
        
/**
 * Supprime un produit
 *
 * Supprime un produit de la base de données à partir d'un argument validés passés en paramètre,
 * la suppression de l'image du produit est éffectué suivi de la suppresion du produit
 * faite à partir de la référence produit passer en paramètre.
 * @param $ref 
*/
        public function supprimerProduit($ref){
            $a="SELECT pdt_image FROM produits WHERE pdt_ref='$ref'";
            $res = PdoLafleur::$monPdo->query($a);
            $lignes = $res->fetch();
            unlink($lignes[0]);
            $b="DELETE FROM produits WHERE pdt_ref='$ref'";
            $result2= PdoLafleur::$monPdo->exec($b);
            header('Location: '.HOME.'index.php?uc=admin');
        }
        
/**
 * Ajoute un produit
 *
 * Ajoute un produit de la base de données à partir d'arguments validés passés en paramètre,
 * l'ajout du produit est fait à partir de la référence, de la description, du prix, 
 * de la catégorie et de l'image du produit passer en paramètre.
 * @param $ref 
 * @param $description 
 * @param $prix
 * @param $cat
 * @param $image 
*/
        public function ajouterProduit($ref,$description,$prix,$cat,$image){
            $a="Insert Into produits Values ('$ref','$description','$prix','$image','$cat')";
            PdoLafleur::$monPdo->exec($a);
            header('Location: '.HOME.'index.php?uc=admin');
        }
        
/**
 * Modifie les informations d'un produit
 *
 * Modifie les informations d'un produit de la base de données à partir d'arguments validés passés en paramètre,
 * la modification du produit est faite à partir de la référence de produit suivi des nouvelles informations
 * à ajouter à la base de données.
 * @param $refold
 * @param $ref
 * @param $description 
 * @param $prix
 * @param $cat
 * @param $image 
*/
        public function modifierProduit($refold,$ref,$description,$prix,$cat,$image){
            $a="Update produit SET pdt_ref='$ref', pdt_designation='$description', pdt_prix='$prix', pdt_image='$image', pdt_categorie='$cat' WHERE pdt_ref='$refold'";
            PdoLafleur::$monPdo->exec($a);
            header('Location: '.HOME.'index.php?uc=admin');
        }
        
/**
 * Affiche les informations de tous les produits
 *
 * Affiche les informations de tous les produits de la base de données.
 * @return les informations des produits sous forme de tableau associatif.
*/
        public function afficherProduit(){
            $a="SELECT * FROM produits";
            return PdoLafleur::$monPdo->query($a)->fetchAll(PDO::FETCH_OBJ);
        }
        
/**
 * Affiche les informations d'un produit
 *
 * Affiche les informations d'un produit de la base de données à partir d'un argument validés passés en paramètre.
 * @param $ref
 * @return les informations d'un produit sous forme de tableau associatif.
*/
        public function afficherUnProduit($ref){
            $a="Select * FROM produit where pdt_ref ='$ref'";
            return PdoLafleur::$monPdo->query($a)->fetchAll(PDO::FETCH_OBJ);
        }
        
/**
 * Affiche les informations d'un compte client
 *
 * Affiche les informations d'un client de la base de données à partir d'un argument validés passés en paramètre.
 * @param $login
 * @return les informations d'un client sous forme de tableau associatif.
*/
        public function afficherUnCompte($login){
            $a="Select * from clients where clt_login = '$login'";
            return PdoLafleur::$monPdo->query($a)->fetchAll(PDO::FETCH_OBJ);
        }
        
/**
 * Affiche les informations d'une commande d'un client
 *
 * Affiche les informations des commandes d'un client de la base de données à partir d'un argument 
 * validés passés en paramètre.
 * @param $idClient
 * @return les informations des commandes d'un client sous forme de tableau associatif.
*/
        public function afficherCommande($idClient){
            $a="Select cc_produit, cc_quantite, c_date from contenucommande, commande where c_id = cc_id and cc_cltid=(Select clt_id from clients where clt_login='$idClient')";
            return PdoLafleur::$monPdo->query($a)->fetchAll(PDO::FETCH_OBJ);
        }
        
/**
 * Ajoute un client à la base de données
 *
 * Inscrit un client à la base de données à partir d'arguments validés passés en paramètre.
 * l'ajout du client est fait à partir du login, du mot de passe, du nom, de l'adresse, du code postale,
 * du téléphone, et de l'email du client passer en paramètre.
 * Si le login du client existe déjà l'ajout n'est pas éffectué et la valeur 0 est retourné sinon
 * l'ajout est éffectué et la valeur 1 est retourné.
 * @param $login
 * @param $mdp
 * @param $nom
 * @param $adresse
 * @param $cp
 * @param $tel
 * @param $email
 * @return 1 ou 0
*/
        public function inscriptionClient($login,$mdp,$nom,$adresse,$cp,$tel,$email)
        {
            $a="Select max(clt_id) as maxi from clients";
            $resultat = PdoLafleur::$monPdo->query($a)->fetchAll(PDO::FETCH_OBJ);
            $result = $resultat[0]->maxi;
            $result++;
            $b="Select clt_login from clients where clt_login='$login'";
            $resultat2 = PdoLafleur::$monPdo->query($b)->fetchAll(PDO::FETCH_OBJ);
            if($resultat2 == NULL)
            {
                $c="Insert into clients values ($result,'$login','$mdp','$nom','$adresse','$cp','$tel','$email')";
                PdoLafleur::$monPdo->exec($c);
                $resultat3=1;
            }
            else
            {
                $resultat3=0;
            }
            return($resultat3);
        }
}
?>