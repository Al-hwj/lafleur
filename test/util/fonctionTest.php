<?php

require_once ("../../util/fonctions.inc.php");

/**
 * Classe de test de la classe fonctions n'accédant pas à la base de données.
 */
class fonctionTest extends PHPUnit_Framework_TestCase {

    /**
     * Variable object
     * @var $object
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new fonction;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * Test de la fonction isConnecteAdmin()
     * @covers fonction::isConnecteAdmin
     */
    public function testIsConnecteAdmin() {
        $this->assertEquals(FALSE, $this->object->isConnecteAdmin());
    }
    
    /**
     * Test de la fonction isConnecteAdmin()
     * @var $_SESSION['admin'] Correspond à la variable de session d'un administrateur
     * @covers fonction::isConnecteAdmin
     */
    public function testIsConnecteAdmin2() {
        $_SESSION['admin'] = 'admin';
        $this->assertEquals('admin', $this->object->isConnecteAdmin());
    }
    
    /**
     * Test de la fonction initPanier
     * 
     * @covers fonction::initPanier
     * @todo   Implement testInitPanier().
     */
    public function testInitPanier() {
       // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
    
    /**
     * Test de la fonction supprimerPanier
     * 
     * @covers fonction::supprimerPanier
     * @todo   Implement testSupprimerPanier().
     */
    public function testSupprimerPanier() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * Test de la fonction ajouterAuPanier
     * 
     * @var $_SESSION['produits'] Correspond à la liste de produit existant dans le panier courant
     * @var $idProduit Correspond au produit à ajouter à la liste des produits du panier courant
     * @covers fonction::ajouterAuPanier
     */
    public function testAjouterAuPanier() {
        $_SESSION['produits'] = array('001', '002', '003', '004');
        $idProduit = '001';
        $this->assertEquals(TRUE, $this->object->ajouterAuPanier($idProduit));
    }
    
    /**
     * Test de la fonction ajouterAuPanier
     * 
     * @var $_SESSION['produits'] Correspond à la liste de produits existant dans le panier courant
     * @var $idProduit Correspond au produit à ajouter à la liste des produits du panier courant
     * @covers fonction::ajouterAuPanier
     */
    public function testAjouterAuPanier2() {
        $_SESSION['produits'] = array('001', '002', '003', '004');
        $idProduit = '005';
        $this->assertEquals(FALSE, $this->object->ajouterAuPanier($idProduit));
    }

    /**
     * Test de la fonction getLesIdProduitsDuPanier
     * 
     * @var $_SESSION['produits'] Correspond à la liste de produits existant dans le panier courant
     * @covers fonction::getLesIdProduitsDuPanier
     */
    public function testGetLesIdProduitsDuPanier() {
        $_SESSION['produits'] = array('001', '002', '003', '004');
        $this->assertEquals($_SESSION['produits'], $this->object->getLesIdProduitsDuPanier());
    }

    /**
     * Test de la fonction nbProduitsDuPanier
     * 
     * @var $_SESSION['produits'] Correspond à la liste de produits existant dans le panier courant
     * @covers fonction::nbProduitsDuPanier
     */
    public function testNbProduitsDuPanier() {
        $_SESSION['produits'] = array('001', '002', '003', '004', '005');
        $this->assertEquals(5, $this->object->nbProduitsDuPanier());
    }
    
    /**
     * Test de la fonction nbProduitsDuPanier
     * 
     * @var $_SESSION['produits'] Correspond à la liste de produits existant dans le panier courant
     * @covers fonction::nbProduitsDuPanier
     */
    public function testNbProduitsDuPanier2() {
        $_SESSION['produits'] = array();
        $this->assertEquals(0, $this->object->nbProduitsDuPanier());
    }

    /**
     * Test de la fonction retirerDuPanier
     * 
     * @covers fonction::retirerDuPanier
     * @todo   Implement testRetirerDuPanier().
     */
    public function testRetirerDuPanier() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * Test de la fonction estUnCp
     * 
     * @var $cp Correspond à un code postale à tester
     * @covers fonction::estUnCp
     */
    public function testEstUnCp() {
        $cp = 75000;
        $this->assertEquals(TRUE, $this->object->estUnCp($cp));
    }
    
    /**
     * Test de la fonction estUnCp
     * 
     * @var $cp Correspond à un code postale à tester
     * @covers fonction::estUnCp
     */
    public function testEstUnCp2() {
        $cp = "code postale";
        $this->assertEquals(FALSE, $this->object->estUnCp($cp));
    }

    /**
     * Test de la fonction estEntier
     * 
     * @var $valeur Correspond à un entier à tester
     * @covers fonction::estEntier
     */
    public function testEstEntier() {
        $valeur = '005';
        $this->assertEquals(TRUE, $this->object->estEntier($valeur));
    }
    
    /**
     * Test de la fonction estEntier
     * 
     * @var $valeur Correspond à un entier à tester
     * @covers fonction::estEntier
     */
    public function testEstEntier2() {
        $valeur = 'abc';
        $this->assertEquals(FALSE, $this->object->estEntier($valeur));
    }

    /**
     * Test de la fonction estUnMail
     * 
     * @var $mail Correspond à un email à tester
     * @covers fonction::estUnMail
     */
    public function testEstUnMail() {
        $mail = 'abc@abc.fr';
        $this->assertEquals(1, $this->object->estUnMail($mail));
    }
    
    /**
     * Test de la fonction estUnMail
     * 
     * @var $mail Correspond à un email à tester
     * @covers fonction::estUnMail
     */
    public function testEstUnMail2() {
        $mail = 'abc';
        $this->assertEquals(0, $this->object->estUnMail($mail));
    }

    /**
     * Test de la fonction getErreursSaisieCommande
     * 
     * @var $nom Correspond à un nom à tester
     * @var $rue Correspond à une rue à tester
     * @var $ville Correspond à une ville à tester
     * @var $cp Correspond à un code postale à tester
     * @var $mail Correspond à un email à tester
     * @covers fonction::getErreursSaisieCommande
     */
    public function testGetErreursSaisieCommande() {
        $nom="Test";
        $rue="1 rue du test";
        $ville="Testville";
        $cp="00000";
        $mail="test@test.fr";
        $this->assertEquals(array(), $this->object->getErreursSaisieCommande($nom,$rue,$ville,$cp,$mail));
    }
    
    /**
     * Test de la fonction getErreursSaisieCommande
     * 
     * @var $nom Correspond à un nom à tester
     * @var $rue Correspond à une rue à tester
     * @var $ville Correspond à une ville à tester
     * @var $cp Correspond à un code postale à tester
     * @var $mail Correspond à un email à tester
     * @covers fonction::getErreursSaisieCommande
     */
    public function testGetErreursSaisieCommande2() {
        $nom="15646";
        $rue="15646";
        $ville="15646";
        $cp="qdqzdzq";
        $mail="15646";
        $this->assertNotEquals(array(), $this->object->getErreursSaisieCommande($nom,$rue,$ville,$cp,$mail));
    }

}
