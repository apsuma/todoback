<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Repository\TodolistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FirstController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $title = (isset($_POST['title'])? $_POST['title']: 'title');
        $todo = (isset($_POST['todo'])? $_POST['todo']: 'tache à faire');
        $todolist = ['title' => $title, 'todo' => $todo];
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController', 'todolist' => $todolist
        ]);
    }

    /**
     * @Route("/todos", name="todos")
     * @param Environment $twig
     * @param TodolistRepository $todolistRepository
     * @return Response
     */
    public function show(Environment $twig, TodolistRepository $todolistRepository){
        return new Response($twig->render('todolist.html.twig', [
            'todos' =>$todolistRepository->findAll(['createdAt' => 'DESC'])
        ]));
    }
}
