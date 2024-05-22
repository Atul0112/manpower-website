<?php
class View_pagesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function page_list()
    {
        $sql = "SELECT * FROM `editor`";
        return $this->db->query($sql)->fetchAll();
    }

    public function get_data($id)
    {
        $sql = "SELECT * FROM `editor` WHERE `id`='" . $id . "'";
        return $this->db->query($sql)->fetchArray();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE  `editor`  SET `title`='" . $data['title'] . "',`description`='".$data['description']."' WHERE `id`='" . $id . "'";
        $this->db->query($sql);
    }

}

