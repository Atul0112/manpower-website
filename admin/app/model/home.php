<?php
class HomeModel extends Model{
    public function __construct(){
        parent::__construct();
    }
    public function index($userId){
        return $this->db->query("SELECT * FROM users WHERE id = '".$userId."'")->fetchArray();
    }

    public function selectbycolumn($table,$column,$value){
        $sql="SELECT * FROM  $table  WHERE  $column ='".$value."'";
        $data=$this->db->query($sql);
        return $data->fetchArray();
    }


    public function insertpage($name,$url,$pos){
        $sql="INSERT INTO `tbl_pages` (`name`, `url`, `position`) VALUES ('$name', '$url', '$pos')";
           $this->db->query($sql);
           return $this->db->lastInsertID();
    }

    public function selectall($table){
        $sql="SELECT * FROM  `$table`";
        $data=$this->db->query($sql);
        return $data->fetchAll();
    }

    public function getTotalLeads($userId){
        $sql = "SELECT count(id) `total_loan_leads` FROM `lead_connections` WHERE `dsa_id` = '".$userId."'";
        $total_loan_leads = $this->db->query($sql)->fetchArray();

        $sql = "SELECT count(id) `total_insurance_leads` FROM `insurance_lead` WHERE `dsa_id` = '".$userId."'";
        $total_insurance_leads = $this->db->query($sql)->fetchArray();

        $sql = "SELECT count(ho.`id`) `total_hm_orders` FROM `hm_lead` hl LEFT JOIN `hm_orders` ho ON hl.`id` = ho.`lead_id` WHERE hl.`dsa_id` = '".$userId."'";
        $total_hm_leads = $this->db->query($sql)->fetchArray();

        $sql = "SELECT count(mo.`id`) `total_mu_orders` FROM `mudra_lead` ml LEFT JOIN `mudra_orders` mo ON ml.`id` = mo.`lead_id` WHERE ml.`dsa_id` = '".$userId."'";
        $total_mu_leads = $this->db->query($sql)->fetchArray();

        $sql = "SELECT count(ro.`id`) `total_roc_orders` FROM `roc_lead` rl LEFT JOIN `roc_orders` ro ON rl.`id` = ro.`lead_id` WHERE rl.`dsa_id` = '".$userId."'";
        $total_roc_leads = $this->db->query($sql)->fetchArray();

        $data = [
            'total_loan_leads' => $total_loan_leads['total_loan_leads'],
            'total_insurance_leads' => $total_insurance_leads['total_insurance_leads'],
            'total_hm_leads' => $total_hm_leads['total_hm_orders'],
            'total_mu_leads' => $total_mu_leads['total_mu_orders'],
            'total_roc_leads' => $total_roc_leads['total_roc_orders'],
        ];
        return $data;
    }

    public function getTodaysTotalLeads($userId){
        $sql = "SELECT count( DISTINCT ml.id) today_leads FROM `micro_loan_links` mll LEFT JOIN micro_loan ml ON mll.lead_id = ml.id WHERE `bank` IN ('Kreditbee') AND ml.dsa_id = '".$userId."' AND ml.`created_at` BETWEEN '".date("Y-m-d")." 00:00:01' AND '".date("Y-m-d")." 23:59:59'";
        $res = $this->db->query($sql)->fetchArray();
        return $res['today_leads'];
    }

    public function getLatestSubscribers($userId){
        $sql = "SELECT u.`id`, u.`type`, u.`role`, u.`name`, u.`status`, (SELECT uk.`document_value` FROM `user_kycs` uk WHERE uk.`user_id` = u.`id` AND `document_name` = 'profile_photo') as `document_value` FROM `users` u WHERE u.`connector_id` = '".$userId."' AND u.status = 1 ORDER BY u.`created_at` DESC LIMIT 5";
        return $this->db->query($sql)->fetchAll();
    }
}