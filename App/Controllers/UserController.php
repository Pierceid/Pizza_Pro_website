<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use User;

class UserController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    /**
     * @throws \Exception
     */
    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $data = [];

        if (isset($formData['btn-submit'])) {
            $name = $formData['name'];
            $email = $formData['email'];
            $password = $formData['password'];

            if (!$this->app->getAuth()->register($name, $email, $password)) {
                $data = ['message' => 'User already exists!'];
            } else {
                $newUser = new User();
                $newUser->setName($name);
                $newUser->setEmail($email);
                $newUser->setPassword($password);
                $newUser->save();
                $data = ['message' => 'Registration was successful!'];
            }
        }
        return $this->html($data);
    }

    public function shop(): Response
    {
        return $this->html();
    }
}