<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class SensorDTO {
    
    private $id;
    private $topic;
    private $name;
    private $unit;
    private $active;
    private $measurements;
    
    public function getId() {
        return $this->id;
    }

    public function getTopic() {
        return $this->topic;
    }

    public function getName() {
        return $this->name;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function getActive() {
        return $this->active;
    }

    public function getMeasurements() {
        return $this->measurements;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTopic($topic) {
        $this->topic = $topic;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    public function setMeasurements($measurements) {
        $this->measurements = $measurements;
        return $this;
    }

}
