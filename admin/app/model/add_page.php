<?php
class Add_pageModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

 public function editor($data)
 {
    $sql = "INSERT INTO `editor` SET `title`='" . $data['title'] . "',`description`='".$data['description']."'";
    $this->db->query($sql);
}


}

