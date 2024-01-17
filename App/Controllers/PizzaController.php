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

    public function add(): Response
    {
        return $this->html();
    }

    public function addItem(): Response
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = $formData->getValue("cost");
        $imagePath = $_FILES["image-path"]["name"];
        $message = "Failed to add an item!";

        if ($this->validateInput($name, $description, $cost, $imagePath)) {
            $pizza = new Pizza();
            $pizza->setName($name);
            $pizza->setDescription($description);
            $pizza->setCost($cost);
            $pizza->setImagePath($imagePath);
            $pizza->save();
            $message = "Item has been successfully added!";
        }
        $data = ["message" => $message, "name" => $name, "description" => $description, "cost" => $cost];
        return $this->redirect($this->url("shop.add", $data));
    }

    public function update(): Response
    {
        return $this->html();
    }

    public function updateItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("pizza-id");
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = $formData->getValue("cost");
        $imagePath = $_FILES["image-path"]["name"];
        $message = "Failed to update the item!";

        if ($this->validateInput($name, $description, $cost, $imagePath)) {
            $pizzaGetOne = Pizza::getOne($id);

            if (!is_null($pizzaGetOne)) {
                $pizzaGetOne->setName($name);
                $pizzaGetOne->setDescription($description);
                $pizzaGetOne->setCost($cost);
                $pizzaGetOne->setImagePath($imagePath);
                $pizzaGetOne->save();
                $message = "Item has been successfully updated!";
            }
        }
        $data = ["message" => $message, "name" => $name, "description" => $description, "cost" => $cost];
        return $this->redirect($this->url("shop.update", $data));
    }

    public function removeItem(): Response
    {
        $id = $this->app->getRequest()->getValue("pizza-id");
        $pizzaGetOne = Pizza::getOne($id);
        $message = "Failed to remove the item!";

        if (!is_null($pizzaGetOne)) {
            $pizzaGetOne->delete();
            $message = "Item has been successfully removed!";
        }

        return $this->redirect($this->url("shop.remove", ["message" => $message]));
    }

    public function validateInput($name, $description, $cost, $imagePath): bool
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
                        $fileDestination = 'public/images/pizzas/' . $fileName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                    } else {
                        echo "There was an error while uploading your file!";
                        return false;
                    }
                } else {
                    echo "Not supported type of file!";
                    return false;
                }
            }
        }

        return !empty($name) && strlen($name) < 200 &&
            !empty($description) && strlen($description) < 200 &&
            is_numeric($cost) && strlen((string)$cost) < 200 &&
            !empty($imagePath);
    }
}
