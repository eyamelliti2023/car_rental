<?php
class car
{
    private ?int $car_id = null;
    private ?string $brand = null;
    private ?string $model = null;
    private ?float $price = null;
    private ?string $color = null;
    private ?int $transmission = null;
    private ?int $seats = null;
    private ?string $image = null;
    private ?int $status = null;

    public function __construct($brand, $model, $price, $color, $transmission, $seats, $image = null, $status)
    {
        $this->car_id = null;
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->color = $color;
        $this->transmission = $transmission;
        $this->seats = $seats;
        $this->image = $image; // Optionally pass image during construction
        $this->status = $status;
    }


    public function getIdcar()
    {
        return $this->car_id;
    }


    public function getprice()
    {
        return $this->price;
    }


    public function setprice($price)
    {
        $this->price = $price;

        return $this;
    }


    public function getcolor()
    {
        return $this->color;
    }


    public function setcolor($sn)
    {
        $this->color = $sn;

        return $this;
    }

    public function getimage()
    {
        return $this->image;
    }


    public function setimage($image)
    {
        $this->image = $image;

        return $this;
    }


    public function getbrand()
    {
        return $this->brand;
    }


    public function setbrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }


    public function getmodel()
    {
        return $this->model;
    }


    public function setmodel($model)
    {
        $this->model = $model;

        return $this;
    }

   
    public function gettransmission()
    {
        return $this->transmission;
    }


    public function settransmission($transmission)
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getseats()
    {
        return $this->seats;
    }


    public function setseats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    public function getstatus()
    {
        return $this->status;
    }


    public function setstatus($status)
    {
        $this->seats = $status;

        return $this;
    }
}
