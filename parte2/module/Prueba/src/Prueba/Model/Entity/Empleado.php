<?php

namespace Prueba\Model\Entity;

/**
 * Description of Prueba
 *
 * @author Franz Orbezo
 */

class Empleado {
    
    private $id;
    private $isOnline;
    private $salary;
    private $age;
    private $position;
    private $name;
    private $gender;
    private $email;
    private $phone;
    private $address;
    private $skills;
    
    public function __construct($id = null, $isOnline = null, $salary = null, $age = null, $position = null, $name = null, $gender = null, $email = null, $phone = null, $address = null, $skills = null) {
        $this->id = $id;
        $this->isOnline = $isOnline;
        $this->salary = $salary;
        $this->age = $age;
        $this->position = $position;
        $this->name = $name;
        $this->gender = $gender;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->skills = $skills;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getIsOnline() {
        return $this->isOnline;
    }
    
    public function setIsOnline($isOnline) {
        $this->isOnline = $isOnline;
    }
    
    public function getSalary() {
        return $this->salary;
    }
    
    public function setSalary($salary) {
        $this->salary = $salary;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function setAge($age) {
        $this->age = $age;
    }

    public function getPosition() {
        return $this->position;
    }
    
    public function setPosition($position) {
        $this->position = $position;
    }

    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }

    public function getGender() {
        return $this->gender;
    }
    
    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }
    
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getAddress() {
        return $this->address;
    }
    
    public function setAddress($email) {
        $this->address = $address;
    }

    public function getSkills() {
        return $this->skills;
    }
    
    public function setSkills($phone) {
        $this->skills = $skills;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
}