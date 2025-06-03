<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dom\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request,ProduitRepository $repo ): Response
  { 


  


    $session = $request->getSession(); 
          dump($session->all()); 
        $produits=$repo->findAll();

    
        $oneProduit=$repo->find(1);

        dump($oneProduit);

        $selectedProduit=null;

      if ($request->isMethod('POST')) { // Si le formulaire est en méthode POST

    // dump tout le POST pour voir ce qui est envoyé
    dump($request->request);
    dump($request->request->all()); 


    // On récupère la valeur d'un champ "form" dans les données POST
    $formType = $request->request->get('form'); // mieux que ->get('form') tout court pour POST

    if ($formType === 'select_produit') { // Si l'utilisateur a soumis le formulaire avec ce type
        // Récupère l'id du produit dans le POST
        $idProduit = $request->request->get('produit');

        // Cherche le produit en base de données par son ID
        $selectedProduit = $repo->find($idProduit);

        dump($selectedProduit); // On peut aussi vérifier l'objet récupéré
    }
}



    

        return $this->render('home/index.html.twig', [

            "produits"=>$produits,
            "oneProduit"=>$oneProduit,
            "selectedProduit"=>$selectedProduit
           
        ]);
    }
#[Route('/produit/{id}', name: 'showProduitId',methods: ['GET'])]
 public function showProduitId(Produit $produit) :Response
 {


    return $this->render('showProduitId/index.html.twig',[

        "produit"=>$produit

    ]);


 }
 




    #[Route('/apropos', name: 'apropos')]
    public function apropos(): Response
    {
        return $this->render('apropos/index.html.twig');
    }
  

 
}
