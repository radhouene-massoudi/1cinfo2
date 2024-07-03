<?php

namespace App\Controller;

use App\Entity\Pro;
use App\Form\AddproduitType;
use App\Repository\ProRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/st', name: 'st')]
    public function fetchStudents(ProRepository $repo)
    {
        $studnets=$repo->findAll();
        return $this->render('produit/listStudents.html.twig',[
            's'=>$studnets
        ]);
    }
    
    #[Route('/add', name: 'add')]
    public function addProduit(ManagerRegistry $mr)
    {
        $p=new Pro();
        $p->setName('test statique');
        $p->setPrice(55);
        $p->setQuantity(77);
        $em=$mr->getManager();
        $em->persist($p);
        $em->flush();
        return $this->redirectToRoute('st');
    }
    #[Route('/addproduit', name: 'addproduit')]
    public function addProduct(ManagerRegistry $mr, Request $req)
    {
        $p=new Pro();
        
        $formprouit=$this->createForm(AddproduitType::class,$p);
        $formprouit->handleRequest($req);
       if($formprouit->isSubmitted()){
        $em=$mr->getManager();
        $em->persist($p);
        $em->flush();
        return $this->redirectToRoute('st');
       }
        
        return $this->render('produit/addproduit.html.twig',[
            'f'=>$formprouit->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'u')]
    public function updateProduct(ManagerRegistry $mr, Request $req,$id,ProRepository $repo)
    {
       // $p=new Pro();
        $produit=$repo->find($id);
        $formprouit=$this->createForm(AddproduitType::class,$produit);
        $formprouit->handleRequest($req);
       if($formprouit->isSubmitted()){
        $em=$mr->getManager();
        $em->persist($produit);
        $em->flush();
        return $this->redirectToRoute('st');
       }
        
        return $this->render('produit/addproduit.html.twig',[
            'f'=>$formprouit->createView()
        ]);
    }
    #[Route('/updatetwo/{id}', name: 'two')]
    public function updateProducttwo(ManagerRegistry $mr, Request $req, Pro $produit)
    {
               $formprouit=$this->createForm(AddproduitType::class,$produit);
        $formprouit->handleRequest($req);
       if($formprouit->isSubmitted()){
        $em=$mr->getManager();
               $em->flush();
        return $this->redirectToRoute('st');
       }
        
        return $this->render('produit/addproduit.html.twig',[
            'f'=>$formprouit->createView()
        ]);
    }
}
