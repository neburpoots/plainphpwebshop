<?php

require __DIR__ . '/../autoload.php';

class UserRepository extends Repository {

    function login(User $user) {
        try {
            $sql = "SELECT user_id, role_id, name, email, password
                    FROM Users
                    WHERE email = :email";

            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $conceptuser = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($user->getPassword(), $conceptuser['password'])) {
                    $loggedInUser = new User();
                    $loggedInUser->setId($conceptuser['user_id']);
                    $loggedInUser->setName($conceptuser['name']);
                    $loggedInUser->setEmail($conceptuser['email']);
                    $loggedInUser->setRole($this->getRole($conceptuser['role_id']));
                    $_SESSION["user"] = serialize($loggedInUser);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getRole(int $id) : Role {
        try {
            $sql = "SELECT role_id, name
            FROM Roles
            WHERE role_id = :role_id";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":role_id", $id, PDO::PARAM_INT);
            
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $role = new Role();
                $role->setRole_id($data['role_id']);
                $role->setName($data['name']);
                return $role;
            } else {
                return new Role();
            }

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    
    function register(User $user) {
        try {
            $sql = "INSERT INTO Users (role_id, name, email, password)
            VALUES (:role_id, :name, :email, :password)";
    
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":role_id", 1, PDO::PARAM_INT);
            $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $user->getHash(), PDO::PARAM_STR);

            $stmt->execute();
            return true;

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function checkEmail(string $email) {
        try {
            $sql = "SELECT email FROM Users WHERE email = :email";
            
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
        
            if ($stmt->rowCount() == 1) {
                return false;
            } else {
                return true;
            }

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}