<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitForm;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\TextUI\XmlConfiguration\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/produit')]
final class AdminProduitController extends AbstractController
{
    #[Route(name: 'app_admin_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
         // outil debug comment  
        dump($produitRepository->findAll());
         dump(get_class_methods($produitRepository));

        return $this->render('admin_produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
            'salut'=> "bonjour"
        ]);
    }

    #[Route('/new', name: 'app_admin_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        dump($request);
        dump(get_class_methods($request));
        $session=$request->getSession( );

        dump($session->all());

        dump($request->getUserInfo());



        $produit = new Produit();
        $form = $this->createForm(ProduitForm::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


       // on accede au champs img du form $form->get('img')
       // getData() recupere la valeur du champs
            $imageFile=$form->get('img')->getData();

            if($imageFile){

               $newFileName=uniqid().'.'.$imageFile->guessExtension();

   
               try{

                $imageFile->move( // on deplace le fichier dans ....
                    $this->getParameter('images_produit'), // dessier de destianation issu de service.yaml
                    $newFileName); // nom du fichier

                    // on met à jour le nom de l'image dans le produit
                    $produit->setImg($newFileName);

               }catch(FileException $e)  {

                    $this->addFlash('danger', "Une erreur est survenue lors de l'upload de l'image");
               }



            }


            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('admin_produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitForm::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 

              $imageFile=$form->get('img')->getData();

            if($imageFile){

               $newFileName=uniqid().'.'.$imageFile->guessExtension();
               try{

                $imageFile->move( // on deplace le fichier dans ....
                    $this->getParameter('images_produit'), // dessier de destianation issu de service.yaml
                    $newFileName); // nom du fichier

                    // on met à jour le nom de l'image dans le produit
                    $produit->setImg($newFileName);

               }catch(FileException $e)  {

                    $this->addFlash('danger', "Une erreur est survenue lors de l'upload de l'image");
               }

            }









            $entityManager->flush();

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
