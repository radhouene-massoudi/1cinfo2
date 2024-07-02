<?php

namespace App\Controller;

use App\Repository\ProRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
