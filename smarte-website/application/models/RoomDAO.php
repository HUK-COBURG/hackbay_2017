<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class RoomDAO extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('RoomDTO');
    }
    
    public function getRooms() {      
        $query = $this->db->get_where('rooms', array('active' => TRUE));
        $rooms = $query->result('RoomDTO');
        
        return $rooms;
    }
    
    public function getRoomById($id) {
        $query = $this->db->get_where('rooms', array('id' => $id));
        $room = $query->result('RoomDTO')[0];
        
        return $room;
    }
    
}
