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

    public function profileManagement(): Response
    {
        $data = ["userId" => $this->findUser()->getId(), "editId" => $this->app->getRequest()->getValue('edit-id')];
        return $this->html($data);
    }

    public function message(): Response
    {
        $data = ["isAdmin" => $this->getIsAdmin($this->findUser())];
        return $this->html($data);
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

        $data = ["destination" => $destination, "message" => $message];
        return $this->redirect($this->url("user.message", $data));
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

        $data = ["destination" => $destination, "message" => $message];
        return $this->redirect($this->url("user.message", $data));
    }

    public function editProfile(): Response
    {
        $formData = $this->app->getRequest();
        $option = $formData->getValue("option-id");
        $userId = $formData->getValue("user-id");
        $nameNew = $formData->getValue("name");
        $emailNew = $formData->getValue("email");
        $passwordOld = $formData->getValue("password-old");
        $passwordNew = $formData->getValue("password-new");
        $imagePathNew = $_FILES["image-path"]['name'];
        $isAdminNew = $formData->getValue("is-admin");
        $editedUserId = $formData->getValue("edit-id");
        $destination = $option != "4" ? "shop.profile" : "shop.database";

        $message = match ($option) {
            "0" => $this->handleInput(imagePathNew: $imagePathNew),
            "1" => $this->handleInput(nameNew: $nameNew),
            "2" => $this->handleInput(emailNew: $emailNew),
            "3" => $this->handleInput(passwordOld: $passwordOld, passwordNew: $passwordNew),
            "4" => $this->handleInput(isAdminNew: $isAdminNew, editedUserId: $editedUserId),
            default => "Invalid option!",
        };

        $data = ["userId" => $userId, "message" => $message];
        return $this->redirect($this->url($destination, $data));
    }

    public function removeAccount(): Response
    {
        $formData = $this->app->getRequest();
        $userId = $formData->getValue("user-id");
        $user = User::getOne($userId);
        if (!is_null($user)) {
            $user->delete();
        }
        return $this->redirect($this->url("user.index"));
    }

    private function handleInput($nameNew = null, $emailNew = null, $passwordOld = null, $passwordNew = null, $imagePathNew = null, $isAdminNew = null, $editedUserId = null): string
    {
        $users = User::getAll();
        $currentUser = $this->findUser();
        $editedUser = User::getOne($editedUserId);

        if (!is_null($imagePathNew)) {
            return $this->validateImagePath($currentUser);
        } elseif (!is_null($nameNew)) {
            return $this->validateName($currentUser, $nameNew);
        } elseif (!is_null($emailNew)) {
            return $this->validateEmail($users, $currentUser, $emailNew);
        } elseif (!is_null($passwordOld) && !is_null($passwordNew)) {
            return $this->validatePassword($currentUser, $passwordOld, $passwordNew);
        } elseif (!is_null($editedUser) && !is_null($isAdminNew)) {
            return $this->validateIsAdmin($editedUser, $isAdminNew);
        } else {
            return "";
        }
    }

    private function validateName($currentUser, $nameNew): string
    {
        if ($nameNew == $currentUser->getLogin() || empty($nameNew) || strlen($nameNew) > 200) {
            return "Failed to update your name!";
        }

        $currentUser->setLogin($nameNew);
        $currentUser->save();
        $_SESSION['user'] = $nameNew;
        return "Your name has been successfully updated!";
    }

    private function validateEmail($users, $currentUser, $emailNew): string
    {
        $existingUser = array_filter($users, function ($user) use ($currentUser, $emailNew) {
            return $user !== $currentUser && $user->getEmail() == $emailNew;
        });

        if (!empty($existingUser) || empty($emailNew) || strlen($emailNew) > 200) {
            return "Failed to update your email!";
        }

        $currentUser->setEmail($emailNew);
        $currentUser->save();
        return "Your email has been successfully updated!";
    }

    private function validatePassword($currentUser, $passwordOld, $passwordNew): string
    {
        if (empty($passwordOld) || !password_verify($passwordOld, $currentUser->getPassword()) ||
            empty($passwordNew) || strlen($passwordNew) > 200 || $passwordNew == $passwordOld) {
            return "Failed to update your password!";
        }

        $currentUser->setPassword(password_hash($passwordNew, PASSWORD_DEFAULT));
        $currentUser->save();
        return "Your password has been successfully updated!";
    }

    private function validateImagePath($currentUser): string
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

    private function validateIsAdmin($currentUser, $isAdminNew): string
    {
        if ($currentUser->getIsAdmin() == $isAdminNew) {
            return "Failed to update admin privilege!";
        }

        $currentUser->setIsAdmin($isAdminNew);
        $currentUser->save();
        return "Admin privilege has been successfully updated!";
    }

    public function findUser(): ?User
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() == $this->app->getAuth()->getLoggedUserName()) {
                return $user;
            }
        }
        return null;
    }

    public function getIsAdmin($user): int
    {
        return $user ? $user->getIsAdmin() : 0;
    }
}
