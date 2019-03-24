<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */

class RoomDTO{
    
    private $id;
    private $name;
    private $picture;
    private $active;
    private $sensors;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPicture() {
        return $this->picture;
    }

    public function getActive() {
        return $this->active;
    }

    public function getSensors() {
        return $this->sensors;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setPicture($picture) {
        $this->picture = $picture;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    public function setSensors($sensors) {
        $this->sensors = $sensors;
        return $this;
    }

}
