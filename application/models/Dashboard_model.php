<?php
require_once APPPATH . '/libraries/Base_model.php';
class Dashboard_model extends Base_model
{
    protected $table_name = 'tasks';
    protected $column_id = 'task_id';
    protected $column_name = 'task_title';
    public function __construct()
    {
        parent::__construct();
    }
    public function countTask(){
        $this->db->select('count(task_id) as value');
        $this->db->from("tasks");
        $query = $this->db->get();
        return $query->row()->value;
    }
    public function countUsers(){
        $this->db->select('count(user_id) as value');
        $this->db->from("users");
        $query = $this->db->get();
        return $query->row()->value;
    }
}
