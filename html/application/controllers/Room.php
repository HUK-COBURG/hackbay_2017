<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author andre
 */
class Room extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('RoomDAO');
        $this->load->model('SensorDAO');
        $this->load->model('MeasurementDAO');
    }
    
    public function index() {
        $data['rooms'] = $this->RoomDAO->getRooms();
        foreach ($data['rooms'] as $room) {
            $sensors = $this->SensorDAO->getSensorsByRoom($room);
            foreach ($sensors as $sensor) {
                $this->MeasurementDAO->getLatestBySensor($sensor);
            }
        }
        
        $this->load->view('rooms', $data);
    }
    
    public function info($id) {
        $data['room'] = $this->RoomDAO->getRoomById($id);
        $data['sensors'] = $this->SensorDAO->getSensorsByRoom($data['room']);
        
        $this->load->view('room', $data);
    }
    
}
