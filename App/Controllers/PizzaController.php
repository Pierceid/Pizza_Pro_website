<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Pizza;

class PizzaController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function addItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("pizza-id");
        $amount = $formData->getValue("pizza-amount");

        $pizza = Pizza::getOne($id);
        $pizza->setAmount($pizza->getAmount() + (int)$amount);
        $pizza->save();

        return $this->redirect($this->url("shop.cart"));
    }

    public function adjustItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("pizza-id");
        $amount = $formData->getValue("pizza-amount");

        $pizza = Pizza::getOne($id);
        $pizza->setAmount((int)$amount);
        $pizza->save();

        return $this->redirect($this->url("shop.cart"));
    }

    public function removeItem(): Response
    {
        $id = $this->app->getRequest()->getValue("pizza-id");

        $pizza = Pizza::getOne($id);
        $pizza->setAmount(0);
        $pizza->save();

        return $this->redirect($this->url("shop.cart"));
    }

    public function insertItem(): Response
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = str_replace(',', '.', $formData->getValue("cost"));
        $imagePath = $_FILES["image-path"]["name"];
        $message = "Failed to insert an item!";

        $result = $this->validateInput($name, $description, $cost, $imagePath, 1);
        if (is_string($result)) {
            $newPath = $result;
            $result = $this->validateInput($name, $description, $cost, $imagePath, 2);

            if (is_bool($result)) {
                $pizza = new Pizza();
                $pizza->setName($name);
                $pizza->setDescription($description);
                $pizza->setCost($cost);
                $pizza->setImagePath($newPath);
                $pizza->save();
                $message = "Item has been successfully inserted!";
                $name = $description = $cost = '';
            }
        }

        $cost = is_numeric($cost) ? $cost : '';
        $data = ["operation" => "insert", "name" => $name, "description" => $description, "cost" => $cost, "message" => $message];
        return $this->redirect($this->url("shop.crudManagement", $data));
    }

    public function updateItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("pizza-id");
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = str_replace(',', '.', $formData->getValue("cost"));
        $imagePath = $_FILES["image-path"]["name"];
        $message = "Failed to update the item!";

        $result = $this->validateInput($name, $description, $cost, $imagePath, 1);
        if (is_string($result)) {
            $newPath = $result;
            $result = $this->validateInput($name, $description, $cost, $imagePath, 2);

            if (is_bool($result)) {
                $pizzaGetOne = Pizza::getOne($id);

                if (!is_null($pizzaGetOne)) {
                    $pizzaGetOne->setName($name);
                    $pizzaGetOne->setDescription($description);
                    $pizzaGetOne->setCost($cost);
                    $pizzaGetOne->setImagePath($newPath);
                    $pizzaGetOne->save();
                    $message = "Item has been successfully updated!";
                }
            }
        }

        $data = ["operation" => "update", "pizza-id" => $id, "message" => $message];
        return $this->redirect($this->url("shop.crudManagement", $data));
    }

    public function deleteItem(): Response
    {
        $id = $this->app->getRequest()->getValue("pizza-id");
        $pizzaGetOne = Pizza::getOne($id);
        $message = "Failed to delete the item!";

        if (!is_null($pizzaGetOne)) {
            $pizzaGetOne->delete();
            $message = "Item has been successfully deleted!";
        }

        $data = ["operation" => "delete", "message" => $message];
        return $this->redirect($this->url("shop.crudManagement", $data));
    }

    public function validateInput($name, $description, $cost, $imagePath, $option): string|bool
    {
        $pizzas = Pizza::getAll();
        $existingPizza = array_filter($pizzas, function ($pizza) use ($name) {
            return $pizza->getName() == $name;
        });

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $option != 2) {
            if (isset($_FILES["image-path"])) {
                $fileName = $_FILES["image-path"]['name'];
                $fileTmpName = $_FILES["image-path"]['tmp_name'];
                $fileError = $_FILES["image-path"]['error'];

                $fileSeparated = explode('.', $fileName);
                $fileExt = strtolower(end($fileSeparated));
                $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                if (in_array($fileExt, $allowed)) {
                    if ($fileError === 0) {
                        $newFileName = time() . '.' . $fileExt;
                        $fileDestination = 'public/images/pizzas/' . $newFileName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        return $newFileName;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

        return empty($existingPizza) &&
            !empty($imagePath) &&
            !empty($name) && strlen($name) < 200 &&
            !empty($description) && strlen($description) < 200 &&
            is_numeric($cost) && strlen((string)$cost) < 200;
    }
}
