<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SensorData
 *
 * @author andre
 */
class SensorDataDAO {
    
    private $SensorZeit;
    private $SensorID;
    private $SensorWert;
    
    public function get_SensorZeit() {
        return $this->SensorZeit;
    }

    public function get_SensorID() {
        return $this->SensorID;
    }

    public function get_SensorWert() {
        return $this->SensorWert;
    }

    public function set_SensorZeit($SensorZeit) {
        $this->SensorZeit = $SensorZeit;
    }

    public function set_SensorID($SensorID) {
        $this->SensorID = $SensorID;
    }

    public function set_SensorWert($SensorWert) {
        $this->SensorWert = $SensorWert;
    }

}
