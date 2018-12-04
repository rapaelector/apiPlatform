<?php

namespace App\Manager;

use App\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

class RegisterManager extends BaseManager
{
    /**
     * function to register User
     */
    public function register(Request $request)
    {
        if (!$request->isMethod('post')) {
            throw new \Exception("votre requet n'est pas POST", 400);
        }
        $user = new User();
        $content = $this->getContentAsArray($request);
        // set user as content send in post
        $username = !is_null($content->get('username'))? $content->get('username') : $content->get('name');
        $user->setUsername($username);
        $user->setName($content->get('name'));
        $user->setEmail($content->get('email'));
        $user->setFirstname($content->get('firstname'));
        $user->setAddress($content->get('address'));
        $user->setDateOfBirth(new \Datetime($content->get('dateOfBirth')));
        $user->setProfilPicture($content->get('profilePicture'));
        $user->setPlainPassword($content->get('user_plainPassword'));
        $this->encodePassword($user);
        $this->validate($user);

        return new Response('You Are Registered in Nitehop', 201);
    }

    private function validate(User $user)
    {
        $errors = $this->validator->validate($user);
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
        $this->save($user);

    }

    public function save($object){
        if(!is_object($object)){
            throw new \Exception("Vous devez vauvegardez un object", 400);
        }

        try{
            $this->em->persist($object);
            $this->em->flush();
          } catch (\Exception $e){
            throw new \Exception("Error Processing Request: ".$e, 400);

          }
    }

    /**
     * to encode password
     */
    protected function encodePassword(User $user){
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
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

    private function is_JSON(...$args) {
        json_decode(...$args);
        return (json_last_error()===JSON_ERROR_NONE);
    }
}