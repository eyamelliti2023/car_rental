<?php

require __DIR__ . '/../config.php';

class userC
{
    public function listusers()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function deleteuser($id)
    {
        $sql = "DELETE FROM user WHERE user_id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function adduser($user)
    {
        $sql = "INSERT INTO user(user_id, name, surname, email, password, type)
                VALUES (:id, :n, :sn, :email, :pwd, :role)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);

            // Store the method return values in variables
            $id = $user->getIduser();
            $name = $user->getn();
            $surname = $user->getsurname();
            $email = $user->getEmail();
            $password = $user->getpassword();
            $role = $user->gettype();

            // Bind the variables instead of method return values
            $query->bindParam(':id', $id);
            $query->bindParam(':n', $name);
            $query->bindParam(':sn', $surname);
            $query->bindParam(':email', $email);
            $query->bindParam(':pwd', $password);
            $query->bindParam(':role', $role);

            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showuser($id)
    {
        $sql = "SELECT * FROM user WHERE user_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateuser($user, $id)
    {
        $sql = "UPDATE user SET 
                    surname = :sn,
                    name = :n, 
                    email = :email, 
                    password = :pwd,  
                    type = :role
                WHERE user_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'sn' => $user->getsurname(),
                'n' => $user->getn(),
                'email' => $user->getEmail(),
                'pwd' => $user->getpassword(),
                'role' => $user->gettype()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getbyemail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':email' => $email
            ]);
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getbyName($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':email' => $email
            ]);
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function searchemail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':email' => $email
            ]);
            $users = $query->fetchAll(PDO::FETCH_ASSOC); // fetchAll() to get an array of results
            return $users;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function searchname($name)
    {
        $sql = "SELECT * FROM user WHERE name = :name";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':name' => $name
            ]);
            $users = $query->fetchAll(PDO::FETCH_ASSOC); // fetchAll() to get an array of results
            return $users;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getUsersByType($type)
    {
        $sql = "SELECT * FROM user WHERE type = :type ORDER BY name ASC";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([':type' => $type]);
            return $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all users of the selected type
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function getbyid($id)
    {
        $sql = "SELECT * FROM user WHERE user_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

class carC
{
    public function listcars()
    {
        $sql = "SELECT * FROM car";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function deletecar($id)
    {
        $sql = "DELETE FROM car WHERE car_id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addcar($car)
    {
        $sql = "INSERT INTO car(car_id, brand, model, price_per_day, color, transmission, seats, image, status)
                VALUES (:id, :brand, :model, :price, :color, :transmission, :seats, :image, :status)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $car->getIdcar(),
                'brand' => $car->getbrand(),
                'model' => $car->getmodel(),
                'price' => $car->getprice(),
                'color' => $car->getcolor(),
                'transmission' => $car->gettransmission(),
                'seats' => $car->getseats(),
                'image' => $car->getimage(),
                'status' => $car->getstatus()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showcar($id)
    {
        $sql = "SELECT * FROM car WHERE car_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $car = $query->fetch();
            return $car;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatecar($car, $id)
    {
        $sql = "UPDATE car SET 
                    brand = :brand,
                    model = :model,
                    price_per_day = :price,
                    color = :color,
                    transmission = :transmission,
                    seats = :seats,
                    image = :image,
                    status = :status
                WHERE car_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'brand' => $car->getbrand(),
                'model' => $car->getmodel(),
                'price' => $car->getprice(),
                'color' => $car->getcolor(),
                'transmission' => $car->gettransmission(),
                'seats' => $car->getseats(),
                'image' => $car->getimage(),
                'status' => $car->getstatus()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getbybrand($brand)
    {
        $sql = "SELECT * FROM car WHERE brand = :brand";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':brand' => $brand
            ]);
            $users = $query->fetchAll(PDO::FETCH_ASSOC); // fetchAll() to get an array of results
            return $users;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getbyColor($color)
    {
        $sql = "SELECT * FROM car WHERE color = :color";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':color' => $color
            ]);
            $users = $query->fetchAll(PDO::FETCH_ASSOC); // fetchAll() to get an array of results
            return $users;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getcarsByStatus($status)
    {
        $sql = "SELECT * FROM car WHERE status = :status ORDER BY brand ASC";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([':status' => $status]);
            return $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all users of the selected status
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getbyid($id)
    {
        $sql = "SELECT * FROM car WHERE car_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $car = $query->fetch();
            return $car;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

class contractC
{
    public function listcontracts()
    {
        $sql = "SELECT * FROM contract";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function deletecontract($id)
    {
        $sql = "DELETE FROM contract WHERE contract_id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addcontract($contract)
    {
        $sql = "INSERT INTO contract (contract_id, car_id, customer_id, agent_id, start_date, end_date, total,active_status,payment_status)
                VALUES (:contract_id, :car_id, :customer_id, :agent_id, :start, :end, :total, :active_status, :payment_status)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contract_id' => $contract->getIdcontract(),
                'car_id' => $contract->getcar_id(),
                'customer_id' => $contract->getcustomer_id(),
                'agent_id' => $contract->getagent_id(),
                'start' => $contract->getstart(),
                'end' => $contract->getend(),
                'total' =>$contract->gettotal(),
                'active_status' => $contract->getactive_status(),
                'payment_status' =>$contract->getpayment_status()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showcontract($id)
    {
        $sql = "SELECT * FROM contract WHERE contract_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $contract = $query->fetch();
            return $contract;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatecontract($contract, $id)
    {
        $sql = "UPDATE contract SET 
                    car_id = :car_id,
                    customer_id = :customer_id,
                    agent_id = :agent_id,
                    start_date = :start,
                    end_date = :end,
                    total = :total,
                    active_status= :active_status,
                    payment_status = :payment_status
                WHERE contract_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'car_id' => $contract->getcar_id(),
                'customer_id' => $contract->getcustomer_id(),
                'agent_id' => $contract->getagent_id(),
                'start' => $contract->getstart(),
                'end' => $contract->getend(),
                'total' =>$contract->gettotal(),
                'active_status' => $contract->getactive_status(),
                'payment_status' =>$contract->getpayment_status()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getbycustomer($customer_id)
    {
        $sql = "SELECT * FROM contract WHERE customer_id = :customer_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':customer_id' => $customer_id
            ]);
            $contract = $query->fetch();
            return $contract;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getbyid($id)
    {
        $sql = "SELECT * FROM contract WHERE contract_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $contract = $query->fetch();
            return $contract;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function countContractsWithStatusZero()
    {
        $sql = "SELECT COUNT(*) AS contract_count FROM contract WHERE active_status = 0";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            return $result['contract_count']; // Return the count of contracts with status 0
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0; // Return 0 in case of an error
        }
    }
    
    public function getContractStatistics()
    {
        $db = config::getConnexion();
        try {
            $sql = "
                SELECT 
                    SUM(CASE WHEN active_status = 1 AND payment_status = 1 THEN 1 ELSE 0 END) AS approved_paid,
                    SUM(CASE WHEN active_status = 1 AND payment_status = 0 THEN 1 ELSE 0 END) AS approved_not_paid,
                    SUM(CASE WHEN active_status = 0 THEN 1 ELSE 0 END) AS not_approved
                FROM contract";
            
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [
                'approved_paid' => 0,
                'approved_not_paid' => 0,
                'not_approved' => 0
            ];
        }
    }
}