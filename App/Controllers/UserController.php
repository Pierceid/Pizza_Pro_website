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

    public function fail(): Response
    {
        $data["message"] = "Failed to complete the requested action!";
        return $this->html($data);
    }

    public function success(): Response
    {
        $data["message"] = "Action has been completed successfully!";
        return $this->html($data);
    }

    public function checkRegister(): Response
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue("sign-up-name");
        $email = $formData->getValue("sign-up-email");
        $password = $formData->getValue("sign-up-password");

        if (!empty($name) && !empty($email) && !empty($password)) {
            if ($this->app->getAuth()->register($name, $email)) {
                $user = new User();
                $user->setLogin($name);
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->save();
                return $this->redirect($this->url("user.success"));
            }
        }

        return $this->redirect($this->url("user.fail"));
    }

    public function checkLogin(): Response
    {
        $formData = $this->app->getRequest();
        $email = $formData->getValue("sign-in-email");
        $password = $formData->getValue("sign-in-password");

        if (!empty($email) && !empty($password)) {
            if ($this->app->getAuth()->login($email, $password)) {
                return $this->redirect($this->url("user.success"));
            }
        }

        return $this->redirect($this->url("user.fail"));
    }
}
