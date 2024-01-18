<?php

namespace App\Models;

use App\Core\Model;

class Place extends Model
{
    protected ?int $id = null;
    protected ?string $street;
    protected ?string $city;
    protected ?int $zip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getZip(): ?int
    {
        return $this->zip;
    }

    public function setZip(?int $zip): void
    {
        $this->zip = $zip;
    }
}