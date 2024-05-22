<?php
use Ipai\Money\Db;
class Model extends Db{
    public $db;
    public function __construct(){
        parent::__construct();
        $this->db = new Db();
    }
}