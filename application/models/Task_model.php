<?php
require_once APPPATH . '/libraries/Base_model.php';
class Task_model extends Base_model
{
    protected $table_name = 'tasks';
    protected $column_id = 'task_id';
    protected $column_name = 'task_title';
    public function __construct()
    {

        parent::__construct();
    }

    public function datatable($parameters = null)
    {
        $data = array();

        $searchQuery = " ";
        if ($parameters['searchValue'] != '') {
            $searchValue = $parameters['searchValue'];
            $searchQuery = " and (task_title like '%" . $searchValue . "%') ";
        }

        $countQuery = "select count(*) as allcount from tasks ";
        $data['totalRecords'] = $this->allcount($countQuery);
        $data['totalRecordwithFilter'] = $this->allcount($countQuery . $searchQuery);

        $sql = "select * from  tasks " . $searchQuery . " limit " . $parameters['start'] . "," . $parameters['length']; //3
        $query = $this->db->query($sql);
        $records = $query->result_array(); 
        $aaData = array();
        $i = 0;
        foreach ($records as $record) {
            $i++;
            $action='';
            $aaData[] = array(
                "sr_no" => $i,
                "task_id" => $record['task_id'],
                "task_title" => $record['task_title'],
                "action" =>$action);
        }

        $response = array(
            "draw" => intval($parameters['draw']),
            "iTotalRecords" => $data['totalRecordwithFilter'],
            "iTotalDisplayRecords" => $data['totalRecords'],
            "aaData" => $aaData,
        );

        echo json_encode($response);
    }

}