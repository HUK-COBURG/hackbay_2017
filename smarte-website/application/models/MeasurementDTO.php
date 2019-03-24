<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class MeasurementDTO {
    
    private $id;
    private $time;
    private $value;
    
    public function getId() {
        return $this->id;
    }

    public function getTime() {
        return $this->time;
    }

    public function getValue() {
        return number_format($this->value, 2);
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTime($time) {
        $this->time = $time;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

}
