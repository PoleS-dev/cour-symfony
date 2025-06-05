<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExoController extends AbstractController
{
    #[Route('/exo', name: 'exo')]
    public function index( Request $request, ProduitRepository $repo): Response
    {

         $produits = $repo->findBy([], ['id' => 'DESC'], 2);
         dump($produits);

         $p=$repo->findBy(['category' => 2]);
         dump($p);
         
$produitsss = $repo->findOneBy(['stock' => 6]);
dump($produitsss);

         $produitss = $repo->findBy([], ['prix' => 'ASC'], 3);
         dump($produitss);

        return $this->render('exo/index.html.twig', [
          "produit"=>$produits
        ]);
    }

#[Route('/result', name: 'result')]
    public function result(Request $request,ProduitRepository $repo): Response
    {

        // Récupérer la recherche de l'URL
        $query = $request->query->get('query');

        // Recherche simple : findBy avec exact match
        if ($query) {
            $produits = $repo->findBy(['nom' => $query]);
        } else {
            $produits = [];
        }
        return $this->render('exo/result.html.twig', [
             'produits' => $produits,
            'searchQuery' => $query,
        ]);
    }


#[Route('/form', name: 'form')]
    public function form(): Response
    {

        
        return $this->render('exo/form.html.twig', [


        ]);
    }   

#[Route('/result2', name: 'result2')]
    public function result2( Request $request ): Response

    {

         $query = $request->query->get('query');
         dump($query);




        return $this->render('exo/result2.html.twig', [
         $query
        ]);
    }


}
