<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class AlertDTO {
    
    private $id;
    private $relation;
    private $value;
    private $type;
    private $message;
    private $sensor;
    
    public function getId() {
        return $this->id;
    }

    public function getRelation() {
        return $this->relation;
    }

    public function getValue() {
        return $this->value;
    }

    public function getType() {
        return $this->type;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getSensor() {
        return $this->sensor;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setRelation($relation) {
        $this->relation = $relation;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function setSensor($sensor) {
        $this->sensor = $sensor;
        return $this;
    }

}
