<?php defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model
{

    protected $table_name = 'tasks';
    protected $column_id = 'task_id';
    protected $column_name = 'task_title'; //drop down
    protected $status_column = 'is_active';
    protected $deleted_column = 'deleted_at';
    public function __construct()
    {
        parent::__construct();
    }

    public function create($value_array)
    {
        $this->db->insert($this->table_name, $value_array);
        $insertedId = $this->db->insert_id();
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    public function createWithID($value_array)
    {
        $this->db->insert($this->table_name, $value_array);
        $insertedId = $this->db->insert_id();
        $inserted = ($this->db->affected_rows() != 1) ? false : true;
        return array("inserted" => $inserted, "insert_id" => $insertedId);
    }
    public function createBatch($value_array)
    {
        $this->db->insert_batch($this->table_name, $value_array);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    public function update($value_array, $id)
    {
        $this->db->where($this->column_id, $id);
        if ($this->db->update($this->table_name, $value_array)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where($this->column_id, $id);
        if ($this->db->delete($this->table_name)) {
            return true;
        } else {
            return false;
        }
    }

    public function select()
    {
        
        if (!empty($this->input->get("search"))) {
            $this->db->like($this->column_name, $this->input->get("search"));
            
        }
        $query = $this->db->get($this->table_name); 
        return $query->result_array();
    }

    public function dropdown()
    {
        $sql = ' select ' . $this->column_id . ',' . $this->column_name . ' from ' . $this->table_name; //.' where deleted_at is null' ;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function single($id)
    {
        $sql = ' select * from ' . $this->table_name . ' where ' . $this->column_id . '=' . $id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function auto_inc()
    {
        $sql = ' SHOW TABLE STATUS LIKE "' . $this->table_name . '"';
        $query = $this->db->query($sql);
        return $query->row()->Auto_increment;
    }

    public function allcount($sql)
    {
        $query = $this->db->query($sql);
        return $query->row()->allcount;
    }
}
