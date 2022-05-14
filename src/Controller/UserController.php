<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $hasher){}
    
    #[Route('/signup', name: 'user_signup')]
    public function userSignup(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $user->setPassword($this->hasher->hashPassword($user, $user->getPassword()));

            $manager = $doctrine->getManager();
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'user_details')]
    public function userDetails($id, UserRepository $repo): Response
    {
        $user = $repo->find($id);
        return $this->render('user/details.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/', name: 'user_list')]
    public function userList(UserRepository $repo): Response
    {
        $users = $repo->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
}
