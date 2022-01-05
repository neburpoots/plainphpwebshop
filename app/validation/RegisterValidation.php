<?php

class RegisterValidation {

    private bool $passed;
    private string $nameErr;
    private string $emailErr;
    private string $passwordErr;
    private string $passwordRepeatErr;

    private string $conceptName;
    private string $conceptEmail;
    private string $conceptPassword;
    private string $conceptRepeatPassword;

    function __construct()
    {
        $this->nameErr = '';
        $this->passwordRepeatErr = '';
        $this->emailErr = '';
        $this->passwordErr = '';


        $this->conceptName = "";
        $this->conceptEmail = "";
        $this->conceptPassword = "";
        $this->conceptRepeatPassword = "";    
    }

    public function getNameErr() {
        return $this->nameErr;
    }

    public function getEmailErr() {
        return $this->emailErr;
    }

    public function getPasswordErr() {
        return $this->passwordErr;
    }

    public function getPasswordRepeatErr() {
        return $this->passwordRepeatErr;
    }

    
    public function getConceptName() {
        return $this->conceptName;
    }

    public function getConceptEmail() {
        return $this->conceptEmail;
    }

    public function getConceptPassword() {
        return $this->conceptPassword;
    }

    public function getConceptRepeatPassword() {
        return $this->conceptRepeatPassword;
    }

    public function getPassed() {
        return $this->passed;
    }



    public function processValidation($name, $email, $password, $passwordrepeat) {
        $this->passed = false;

        $this->nameErr = '';
        $this->passwordRepeatErr = '';
        $this->emailErr = '';
        $this->passwordErr = '';

        $this->conceptName = $name;
        $this->conceptEmail = $email;
        $this->conceptPassword = $password;
        $this->conceptRepeatPassword = $passwordrepeat; 

        if (empty($name)) {
            $this->nameErr = "Naam is verplicht";
          } else {
            $name = $this->test_input($name);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
              $this->nameErr = "Alleen letter en spaties zijn toegestaan bij de naam";
            }
        }
        
        if (empty($email)) {
            $this->emailErr = "E-mail is verplicht";
          } else {
            $email = $this->test_input($email);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $this->emailErr = "Niet geldige e-mail ingevoerd";
            }
        }

        if(!empty($password) && ($password == $passwordrepeat)) {
            $password = $this->test_input($password);
            $passwordrepeat = $this->test_input($passwordrepeat);
            if (strlen($password) <= '8') {
                $this->passwordErr = "Uw wachtwoord moet 8 karakters lang zijn!";
            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                $this->passwordErr = "Uw wachtwoord moet minimaal 1 nummer bevatten!";
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                $this->passwordErr = "Uw wachtwoord moet 1 hoofdletter bevatten.";
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                $this->passwordErr = "Uw wachtwoord moet 1 kleine letter bevatten";
            }
        }
        elseif(!empty($_POST["password"])) {
            $this->passwordRepeatErr = "Check of de wachtwoorden hetzelfde zijn";
        } else {
            $this->passwordErr = "Vul uw wachtwoord in";
        }

        $userController = new UserController();

        if($userController->checkEmail($email)) {
            if($this->determinePass()) {
                $user = new User();
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($password);
                
                echo $user->getPassword();
                
                $userController->registerUser($user);
            }
        } else {
            $this->emailErr = "Er is al een account met deze e-mail";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function determinePass() {
        if(empty($this->nameErr) && empty($this->emailErr) && empty($this->passwordErr) && empty($this->passwordRepeatErr)) {
            $this->passed = true;
            return true;
        }
    }
}