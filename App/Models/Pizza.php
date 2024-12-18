<?php

namespace App\Models;

use App\Core\Model;

class Pizza extends Model
{
    protected ?int $id = null;
    protected ?string $name;
    protected ?string $description;
    protected float $cost;
    protected ?string $imagePath;
    protected ?int $amount = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): void
    {
        $this->cost = $cost;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }
}
