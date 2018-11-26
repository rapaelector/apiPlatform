<?php

// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use JsonSchema\Validator;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
                $this->encodePassword($user, $passwordEncoder);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return new Response('You Are Registered in Nitehop', 201);
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/register-api", name="user_registration_api")
     * to register user in api
     */
    public function registerApi(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator)
    {
        if ($request->isMethod('post')) {
            $entityManager = $this->getDoctrine()->getManager();
            // your code
            // 1) build the form
            $content = $this->getContentAsArray($request);
            $user = new User();
            // set user as content send in post
            $user->setUsername($content->get('user_username'));
            $user->setEmail($content->get('user_email'));
            $user->setPlainPassword($content->get('plainPassword_first'));
            // Encode the password (you could also do this via Doctrine listener)
            $this->encodePassword($user, $passwordEncoder);

            $errors = $validator->validate($user);
            // validate user
            if (count($errors) > 0) {
                /*
                 * Uses a __toString method on the $errors variable which is a
                 * ConstraintViolationList object. This gives us a nice string
                 * for debugging.
                 */
                 $message = "";
                 foreach ($errors as $key => $value) {
                   if(0 != $key)
                    $message .= ", and ";
                    $message .= $value->getMessage();
                 }

                throw new \Exception($message, 422);
            }

            // 4) save the User!
            try{
              $entityManager->persist($user);
              $entityManager->flush();
            } catch (\Exception $e){
              throw new \Exception("Error Processing Request: ".$e, 400);

            }

            return new Response('You Are Registered in Nitehop', 201);
            }
        }

    protected function getContentAsArray(Request $request){
      $content = $request->getContent();

      if(empty($content)){
          throw new BadRequestHttpException("Content is empty");
      }

      if(!$this->is_JSON($content)){
          throw new BadRequestHttpException("Content is not a valid json");
      }

      return new ArrayCollection(json_decode($content, true));
  }

  protected function encodePassword(User $user, UserPasswordEncoderInterface $passwordEncoder){
    $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
    $user->setPassword($password);
  }

  private function is_JSON(...$args) {
      json_decode(...$args);
      return (json_last_error()===JSON_ERROR_NONE);
  }
}
