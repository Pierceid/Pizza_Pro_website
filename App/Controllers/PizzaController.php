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
        $imagePath = "/public/images/pizzas/neapolitan.png";

        $pizza = new Pizza();
        $pizza->setName($name);
        $pizza->setDescription($description);
        $pizza->setCost($cost);
        $pizza->setImagePath($imagePath);
        $pizza->save();

        return $this->redirect($this->url('shop.index'));
    }

    public function remove(): Response
    {
        return $this->html();
    }

    public function removeItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue('id');
        $pizzaGetOne = Pizza::getOne($id);
        $pizzaGetOne->delete();

        return $this->redirect($this->url('shop.remove'));
    }
}