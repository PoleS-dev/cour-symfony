<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(): Response
    {
        return $this->render('panier/index.html.twig', [
            
                    ]);
    }


#[Route('/panier/ajouter/{id}', name: 'panier_ajouter')]
    public function ajouter(Request $request) 
    {

        dump($request->query);
       $user=$this->getUser();
    }

#[Route('/panier/retirer/{id}', name: 'panier_retirer')]
public function retirer()
{
}

#[Route('/panier/vider', name: 'panier_vider')]
public function vider()
{

}
#[Route('/panier/modifier/{id}', name:'panier_modifier')]
public function modifierQantite()
{

}




}