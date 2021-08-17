<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchwellwertDAO
 *
 * @author andre
 */
class SchwellwertDAO {
    
    private $SensorID;
    private $SchwellwertVergleich;
    private $SchwellwertLevel;
    private $SchwellwertWert;
    private $SchwellwertText;
    private $SchwellwertVon;
    private $SchwellwertBis;
    
    
    public function get_SensorID() {
        return $this->SensorID;
    }

    public function get_SchwellwertVergleich() {
        return $this->SchwellwertVergleich;
    }

    public function get_SchwellwertLevel() {
        return $this->SchwellwertLevel;
    }

    public function get_SchwellwertWert() {
        return $this->SchwellwertWert;
    }

    public function get_SchwellwertText() {
        return $this->SchwellwertText;
    }

    public function get_SchwellwertVon() {
        return $this->SchwellwertVon;
    }

    public function get_SchwellwertBis() {
        return $this->SchwellwertBis;
    }

    public function set_SensorID($SensorID) {
        $this->SensorID = $SensorID;
    }

    public function set_SchwellwertVergleich($SchwellwertVergleich) {
        $this->SchwellwertVergleich = $SchwellwertVergleich;
    }

    public function set_SchwellwertLevel($SchwellwertLevel) {
        $this->SchwellwertLevel = $SchwellwertLevel;
    }

    public function set_SchwellwertWert($SchwellwertWert) {
        $this->SchwellwertWert = $SchwellwertWert;
    }

    public function set_SchwellwertText($SchwellwertText) {
        $this->SchwellwertText = $SchwellwertText;
    }

    public function set_SchwellwertVon($SchwellwertVon) {
        $this->SchwellwertVon = $SchwellwertVon;
    }

    public function set_SchwellwertBis($SchwellwertBis) {
        $this->SchwellwertBis = $SchwellwertBis;
    }

}
