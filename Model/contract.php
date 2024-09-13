<?php
class contract
{
    private ?int $contract_id = null;
    private ?int $car_id = null;
    private ?int $customer_id = null;
    private ?int $agent_id = null;
    private ?string $start = null;
    private ?string $end = null;
    private ?float $total= null;
    private ?int $active_status = null;
    private ?int $payment_status = null;

    public function __construct($car_id, $customer_id, $agent_id, $start, $end,$total,$active_status,$payment_status)
    {
        $this->contract_id = null;
        $this->car_id = $car_id;
        $this->customer_id = $customer_id;
        $this->agent_id = $agent_id;
        $this->start = $start;
        $this->end = $end;
        $this->total= $total;
        $this->active_status = $active_status;
        $this->payment_status= $payment_status;
    }


    public function getIdcontract()
    {
        return $this->contract_id;
    }


    public function getagent_id()
    {
        return $this->agent_id;
    }

    public function setagent_id($agent_id)
    {
        $this->agent_id = $agent_id;

        return $this;
    }


    public function getstart()
    {
        return $this->start;
    }


    public function setstart($sn)
    {
        $this->start = $sn;

        return $this;
    }

    public function getcar_id()
    {
        return $this->car_id;
    }


    public function setcar_id($car_id)
    {
        $this->car_id = $car_id;

        return $this;
    }


    public function getcustomer_id()
    {
        return $this->customer_id;
    }


    public function setcustomer_id($customer_id)
    {
        $this->customer_id = $customer_id;

        return $this;
    }

   
    public function getpayment_status()
    {
        return $this->payment_status;
    }


    public function setpayment_status($payment_status)
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    public function getactive_status()
    {
        return $this->active_status;
    }


    public function setactive_status($active_status)
    {
        $this->active_status = $active_status;

        return $this;
    }
    public function getend()
    {
        return $this->end;
    }


    public function setend($end)
    {
        $this->end = $end;

        return $this;
    }

    public function gettotal()
    {
        return $this->total;
    }


    public function settotal($total)
    {
        $this->total = $total;

        return $this;
    }
}
