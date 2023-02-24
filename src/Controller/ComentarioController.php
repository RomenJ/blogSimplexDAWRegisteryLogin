<?php

namespace App\Controller;

use App\Entity\Comentario;
use App\Form\ComentarioType;
use App\Repository\ComentarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comentario')]
class ComentarioController extends AbstractController
{
    #[Route('/', name: 'app_comentario_index', methods: ['GET'])]
    public function index(ComentarioRepository $comentarioRepository): Response
    {
        return $this->render('comentario/index.html.twig', [
            'comentarios' => $comentarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_comentario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComentarioRepository $comentarioRepository): Response
    {
        $comentario = new Comentario();
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comentarioRepository->save($comentario, true);

            return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentario/new.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    
 //  #[Route('/create/{id}', name: 'comment_create', methods: ["POST"])]
 #[Route('/create/', name: 'comment_create', methods: ["POST"])]
   //  #[Route('/create', name: 'app_create')]
       
    public function create(Noticia $noticia, Request $request, ManagerRegistry $doctrine)
    
      {
       
  /*pilla la variable del form y es recogida y mostrada por el método  */
        
          $text=trim($request->request->get('texto'));
          var_dump($noticia->getId());
      if (empty($text))
          return $this->redirectToRoute('app_home');
    
          $entityManager = $doctrine->getManager();
          $comentario =new Comentario();
          $comentario->setTexto($text);
          $comentario->setAutor($this->getUser());
          $comentario-> setDate(new \DateTime());
          $comentario-> setNoticia($noticia);
          $entityManager->persist($comentario);
          $entityManager->flush();
          return $this->redirectToRoute('app_home');
      }
    
    #[Route('/{id}', name: 'app_comentario_show', methods: ['GET'])]
    public function show(Comentario $comentario): Response
    {
        return $this->render('comentario/show.html.twig', [
            'comentario' => $comentario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_comentario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comentario $comentario, ComentarioRepository $comentarioRepository): Response
    {
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comentarioRepository->save($comentario, true);

            return $this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comentario/edit.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comentario_delete', methods: ['POST'])]
    public function delete(Request $request, Comentario $comentario, ComentarioRepository $comentarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comentario->getId(), $request->request->get('_token'))) {
            $comentarioRepository->remove($comentario, true);
        }

      #   return 1this->redirectToRoute('app_comentario_index', [], Response::HTTP_SEE_OTHER); #
      return $this->redirectToRoute('app_home');
  
      
    }
}
