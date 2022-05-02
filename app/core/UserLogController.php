<?php 


class UserLogController {


    public function logImage($id){ 
        $db = new Database();
        $db->query('SELECT * FROM user_log WHERE user_id = :id ORDER BY id DESC');
        $db->bind(':id', $id);
        $result = $db->resultSet();
        return $result;
    }
}