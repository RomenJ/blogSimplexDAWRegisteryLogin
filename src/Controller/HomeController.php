<?php

namespace App\Controller;
use App\Repository\NoticiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comentario;
use App\Entity\Noticia;
use App\Form\ComentarioType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\NoticiaController;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]

    
    public function index(NoticiaRepository $noticiaRepository): Response
    {
       $comentario =new Comentario();
       $form = $this->createForm(ComentarioType::class, $comentario);
        

       
       return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'noticias' => $noticiaRepository->findAll(),
            'form'=>$form->createView(),
           
            
        ]);
    }

   #[Route('/create/{id}', name: 'app_create')]
 //  #[Route('/create', name: 'app_create')]
      //public function create(Request $request, ManagerRegistry $doctrine)
  public function create(Noticia $noticia, Request $request, ManagerRegistry $doctrine)
  //  public function create(Request $request, ManagerRegistry $doctrine)
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
  

    #[Route('/change{id}', name: 'app_change')]
    public function change($id)
    {
       
       exit('CHANGE comentario con id:'.$id);
        

       
       return $this->render('home/index.html.twig');
    }

    #[Route('/borrar{id}', name: 'app_borrar')]
    public function borrar($id)
    {
       
       exit('Se va a borrar el comentario con id:'.$id);
        

       
       return $this->render('home/index.html.twig');
    }

    
}
