<?php
//$donnees = array(
//    'password' => 'toto',
//    'email' => 'titi@gmail.com',
//    'firstName' => 'Patrick',
//    'lastName' => 'NOLLET',
//    'address' => '4 place Jussieu',
//    'postalCode' => '75252',
//    'city' => 'Paris',
//    'country' => 'France',
//);
class UserEntity {
    private $id;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $address;
    private $postalCode;
    private $city;
    private $country;

    private $admin;

    public function __construct()
    {
    }

    /**
     * @param $id
     * @param $email
     * @param $password
     * @param $firstName
     * @param $lastName
     * @param $address
     * @param $postalCode
     * @param $city
     * @param $country
     */
//    public function __construct($id, $email, $password, $firstName, $lastName, $address, $postalCode, $city, $country)
//    {
//        $this->id = $id;
//        $this->email = $email;
//        $this->password = $password;
//        $this->firstName = $firstName;
//        $this->lastName = $lastName;
//        $this->address = $address;
//        $this->postalCode = $postalCode;
//        $this->city = $city;
//        $this->country = $country;
////        global $donnees;
////        $this->hydrate($donnees);
//    }




    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }




}