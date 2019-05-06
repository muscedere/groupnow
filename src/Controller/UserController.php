<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UploadfileType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class UserController extends Controller
{
    
    /**
    * @Route("/user/{slug}", name="user_show")
    */
    public function index(User $user)
    {
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }
    /**
     * @Route("/image", name="upload_image", methods="GET|POST")
     */
    public function editimage(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UploadfileType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $user->setimageFile(null);
                $this->addFlash(
                    'succes',
                    'les modifications ont bien été enrengistrées'
                );
                return $this->redirectToRoute('homepage');

            }
        }
        return $this->render('user/upload.html.twig', [
            'user' => $user,
            'form' => $form->createView()]);
    }
}
