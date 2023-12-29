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
        $name = $formData->getValue("sign-up-name");
        $email = $formData->getValue("sign-up-email");
        $password = $formData->getValue("sign-up-password");

        if (!empty($name) && !empty($email) && !empty($password)) {
            if ($this->app->getAuth()->register($name, $email)) {
                $user = new User();
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->save();
                return $this->redirect($this->url("shop.index"));
            }
        }
        return $this->redirect($this->url("user.index"));
    }
    public function login(): Response
    {
        return $this->html();
    }

    public function checkLogin() :Response
    {
        $formData = $this->app->getRequest();
        $email = $formData->getValue("sign-in-email");
        $password = $formData->getValue("sign-in-password");

        if (!empty($email) && !empty($password)) {
            if ($this->app->getAuth()->login($email, $password)) {
                return $this->redirect($this->url("shop.index"));
            }
        }
        return $this->redirect($this->url("user.login"));
    }
}