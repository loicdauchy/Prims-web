<?php

namespace App\Controller;

use App\Entity\Commerce;
use App\Form\AdminType;
use App\Form\CommerceType;
use App\Repository\CommerceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommerceController extends AbstractController
{

    /**
     * @Route("/ajout-commerce", name="Addcommerce")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $commerce = new Commerce();
        $form = $this->createForm(CommerceType::class, $commerce);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $commerce->setPatron($this->getUser());
            $manager->persist($commerce);
            $manager->flush();
            return $this->redirectToRoute('commerceUser');
        }
        return $this->render('commerce/index.html.twig', [
            'commerceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/mescommerces", name="commerceUser")
     */
    public function showCommerces(){
        return $this->render('commerce/Mycommerce.html.twig', [
        ]);
    }

    /**
     * @Route("/detail-commerce/{id}", name="detailCommerce")
     */
    public function showCommerce($id, CommerceRepository $repo, Request $request, EntityManagerInterface $manager, UserRepository $userRepo){

        $commerce = $repo->find($id);
        
        $form = $this->createForm(AdminType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $mail = $data['email'];
            $user = $userRepo->findOneByMail($mail);
            $user = $user[0];
            $commerce->addAdmin($user);
            
            $manager->persist($commerce);
            $manager->flush();
        }

        return $this->render('commerce/detailCommerce.html.twig', [
            'commerce' => $commerce,
            'addAdmin' => $form->createView()
        ]);
    }

}
