<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request,ProduitRepository $repo ): Response
    {

        dump( get_class_methods($repo) ); 

        $produits=$repo->findAll();

        dump($produits);


    

        return $this->render('home/index.html.twig', [

            "produits"=>$produits,

           
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
