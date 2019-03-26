<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author andre
 */
class Smarte extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('RoomDAO');
        $this->load->model('SensorDAO');
    }
    
    public function index() {
        $data['menu'] = $this->getMenu();
        
        $this->load->view('smarte', $data);
    }
    
    private function getMenu() {
        $this->load->model('MenuDTO');
        
        $menu = array();
        
        $item = new MenuDTO(null, '/dashboard', 'ti-dashboard', 'Dashboard');
        $menu[] = $item;
        
        $item = new MenuDTO(null, '/room', 'ti-home', 'Räume');
        $submenus = array();
        
        $rooms = $this->RoomDAO->getRooms();
        foreach ($rooms as $room) {
            $subitem = new MenuDTO(null, '/room/info/'.$room->getId(), null, $room->getName());
            $subsubmenus = array();
            
            $sensors = $this->SensorDAO->getSensorsByRoom($room);
            foreach ($sensors as $sensor) {
                $subsubitem = new MenuDTO(null, '/sensor/info/'.$sensor->getId(), null, $sensor->getName());
                $subsubmenus[] = $subsubitem;
            }
            $subitem->setSubmenus($subsubmenus);
            $submenus[] = $subitem;
        }
        $item->setSubmenus($submenus);
        $menu[] = $item;
        
        $item = new MenuDTO(null, '/report', 'ti-comments', 'Schadensmeldung');
        $menu[] = $item;

        return $menu;
    }
    
    

    
    
}
