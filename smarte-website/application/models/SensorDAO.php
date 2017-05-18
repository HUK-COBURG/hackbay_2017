<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sensors
 *
 * @author andre
 */
class SensorDAO {
    
    private $SensorID;
    private $SensorBezeichnung;
    private $SensorAktiv;
    
    
    public function get_SensorID() {
        return $this->SensorID;
    }

    public function get_SensorBezeichnung() {
        return $this->SensorBezeichnung;
    }

    public function get_SensorAktiv() {
        return $this->SensorAktiv;
    }

    public function set_SensorID($SensorID) {
        $this->SensorID = $SensorID;
    }

    public function set_SensorBezeichnung($SensorBezeichnung) {
        $this->SensorBezeichnung = $SensorBezeichnung;
    }

    public function set_SensorAktiv($SensorAktiv) {
        $this->SensorAktiv = $SensorAktiv;
    }

}
