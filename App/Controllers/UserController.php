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

    public function change(): Response
    {
        return $this->html();
    }

    public function message(): Response
    {
        return $this->html();
    }

    public function checkRegister(): Response
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue("sign-up-name");
        $email = $formData->getValue("sign-up-email");
        $password = $formData->getValue("sign-up-password");
        $message = "Failed to register!";
        $destination = -1;

        if (!empty($name) && !empty($email) && !empty($password)) {
            if ($this->app->getAuth()->register($name, $email)) {
                $user = new User();
                $user->setLogin($name);
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setIsAdmin(0);
                $user->setProfileImage("default_profile.png");
                $user->save();
                $message = "Successfully registered!";
                $destination = 1;
            }
        }
        return $this->redirect($this->url("user.message", ["message" => $message, "destination" => $destination]));
    }

    public function checkLogin(): Response
    {
        $formData = $this->app->getRequest();
        $email = $formData->getValue("sign-in-email");
        $password = $formData->getValue("sign-in-password");
        $message = "Failed to login!";
        $destination = -1;

        if (!empty($email) && !empty($password)) {
            if ($this->app->getAuth()->login($email, $password)) {
                $message = "Successfully logged in!";
                $destination = 1;
            }
        }
        return $this->redirect($this->url("user.message", ["message" => $message, "destination" => $destination]));
    }

    public function changeProfile(): Response
    {
        $formData = $this->app->getRequest();
        $option = $formData->getValue("option-id");
        $nameNew = $formData->getValue("name");
        $emailNew = $formData->getValue("email");
        $passwordOld = $formData->getValue("password-old");
        $passwordNew = $formData->getValue("password-new");
        $imagePathNew = $_FILES["image-path"]['name'];

        $message = match ($option) {
            "0" => $this->handleInput(imagePathNew: $imagePathNew),
            "1" => $this->handleInput(nameNew: $nameNew),
            "2" => $this->handleInput(emailNew: $emailNew),
            "3" => $this->handleInput(passwordOld: $passwordOld, passwordNew: $passwordNew),
            default => "Invalid option!",
        };

        return $this->redirect($this->url("shop.profile", ["message" => $message]));
    }

    public function handleInput($nameNew = null, $emailNew = null, $passwordOld = null, $passwordNew = null, $imagePathNew = null): string
    {
        $formData = $this->app->getRequest();
        $currentName = $this->app->getAuth()->getLoggedUserName();
        $currentEmail = $formData->getValue("user-email");

        $users = User::getAll();
        $currentUser = null;

        foreach ($users as $user) {
            if ($user->getEmail() == $currentEmail && $user->getLogin() == $currentName) {
                $currentUser = $user;
            }
        }
        $currentPassword = $currentUser->getPassword();
        if (!is_null($imagePathNew)) {
            return $this->validateImagePath($currentUser);
        } elseif (!is_null($nameNew)) {
            return $this->validateName($currentUser, $nameNew);
        } elseif (!is_null($emailNew)) {
            return $this->validateEmail($users, $currentUser, $emailNew);
        } elseif (!is_null($passwordOld) && !is_null($passwordNew)) {
            return $this->validatePassword($currentUser, $passwordOld, $passwordNew);
        } else {
            return "";
        }
    }

    public function validateName($currentUser, $nameNew): string
    {
        if ($nameNew == $currentUser->getLogin() || empty($nameNew) || strlen($nameNew) > 200) {
            return "Failed to update your name!";
        }

        $currentUser->setLogin($nameNew);
        $currentUser->save();
        $_SESSION['user'] = $nameNew;
        return "Your name has been successfully updated!";
    }


    public function validateEmail($users, $currentUser, $emailNew): string
    {
        $existingUser = array_filter($users, function ($user) use ($currentUser, $emailNew) {
            return $user !== $currentUser && $user->getEmail() == $emailNew;
        });

        if (empty($existingUser) || empty($emailNew) || strlen($emailNew) > 200) {
            return "Failed to update your email!";
        }

        $currentUser->setEmail($emailNew);
        $currentUser->save();
        return "Your email has been successfully updated!";
    }

    public function validatePassword($currentUser, $passwordOld, $passwordNew): string
    {
        if (empty($passwordOld) || !password_verify($passwordOld, $currentUser->getPassword()) ||
            empty($passwordNew) || strlen($passwordNew) > 200 || $passwordNew == $passwordOld) {
            return "Failed to update your password!";
        }

        $currentUser->setPassword(password_hash($passwordNew, PASSWORD_DEFAULT));
        $currentUser->save();
        return "Your password has been successfully updated!";
    }

    public function validateImagePath($currentUser): string
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES["image-path"])) {
                $fileName = $_FILES["image-path"]['name'];
                $fileTmpName = $_FILES["image-path"]['tmp_name'];
                $fileError = $_FILES["image-path"]['error'];

                $fileSeparated = explode('.', $fileName);
                $fileExt = strtolower(end($fileSeparated));
                $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                if (in_array($fileExt, $allowed)) {
                    if ($fileError === 0) {
                        $fileDestination = 'public/images/profiles/' . $fileName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $currentUser->setProfileImage($fileName);
                        $currentUser->save();
                        return "Your profile picture has been successfully updated!";
                    }
                }
            }
        }
        return "Failed to update your profile picture!";
    }
}
