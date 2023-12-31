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
        $imagePath = "/public/images/pizzas/" . str_replace(' ', '-', strtolower($name)) . ".png";
        $message = "Failed to add an item!";

        if ($this->validateInput($name, $description, $cost)) {
            $pizza = new Pizza();
            $pizza->setName($name);
            $pizza->setDescription($description);
            $pizza->setCost($cost);
            $pizza->setImagePath($imagePath);
            $pizza->save();
            $message = "Item has been successfully added!";
        }

        return $this->redirect($this->url("shop.add", ["message" => $message]));
    }

    public function update(): Response
    {
        return $this->html();
    }

    public function updateItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $this->request()->getValue('update-id');
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = $formData->getValue("cost");
        $imagePath = "/public/images/pizzas/" . str_replace(' ', '-', strtolower($name)) . ".png";
        $message = "Failed to update the item!";

        if ($this->validateInput($name, $description, $cost)) {
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

        return $this->redirect($this->url("shop.update", ["message" => $message]));
    }

    public function removeItem(): Response
    {
        $id = $this->request()->getValue('remove-id');
        $pizzaGetOne = Pizza::getOne($id);
        $message = "Failed to remove the item!";

        if (!is_null($pizzaGetOne)) {
            $pizzaGetOne->delete();
            $message = "Item has been successfully removed!";
        }

        return $this->redirect($this->url("shop.remove", ["message" => $message]));
    }

    public function validateInput($name, $description, $cost): bool
    {
        return !empty($name) && strlen($name) < 200 &&
            !empty($description) && strlen($description) < 200 &&
            is_numeric($cost) && strlen((string)$cost) < 200;
    }
}
