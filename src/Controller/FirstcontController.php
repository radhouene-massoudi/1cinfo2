<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstcontController extends AbstractController
{
    #[Route('/h', name: 'sayhelo')]
    public function sayhello()
    {
       // echo "hello";
        return new Response("bonjour à tous");
    }

    #[Route('/s/{name}')]
    public function secondmethode($name)
    {
       // echo "hello";
        return $this->render("firstfiletwig/1cinfo2.html.twig",
        [
"n"=>$name
        ]);
    }

    #[Route('/detail/{id}')]
    public function detailProduct($id)
    {
       // echo "hello";
        return new Response($id);
    }
}
