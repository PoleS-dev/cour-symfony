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

        $produits=$repo->findAll();

    
        $oneProduit=$repo->find(1);

        dump($oneProduit);

        $selectedProduit=null;

        if($request->isMethod('POST')){// si form est POST 

            $formType=$request->get('form');

            if($formType==='select_produit'){// le name form dans le formulaire a une valeur de select_produit

                $idProduit=$request->get('produit'); // recupere l'id du produit

                $selectedProduit=$repo->find($idProduit);
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
