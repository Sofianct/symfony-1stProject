<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{

    // public function __construct(private ManagerRegistry $doctrine)
    // {
    // }

    public function index(ManagerRegistry $doctrine): Response
    {
        //Replace
        $em = $this->$doctrine->getManager();
        $task_repo = $this->$doctrine->getRepository();
        $tasks = $task_repo->findAll();

        foreach ($tasks as $task) {
            echo $task->getTitle() . '<br/>';
        }

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
