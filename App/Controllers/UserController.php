<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

class UserController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function shop(): Response
    {
        return $this->html();
    }

    /**
     * @throws \Exception
     */
    public function register(): Response
    {
        return $this->html();
    }

    public function checkRegister() :Response
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue("name");
        $email = $formData->getValue("email");
        $password = $formData->getValue("password");

        if (!is_null($name) && !is_null($email) && !is_null($password)) {
            if (!$this->app->getAuth()->register($name, $email)) {
                $data = ['message' => 'User already exists!'];
            } else {
                $user = new User();
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->save();
                return $this->redirect($this->url('shop.index'));
            }
        }
        return $this->redirect($this->url('user.register'));
    }
}