<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once APPPATH . '/libraries/BaseController.php';
class Task extends BaseController
{

    protected $singular = 'Task';
    protected $plural = 'Tasks';
    protected $delete = '';
    protected $viewPrefix = 'task/task';
    protected $redirect_page = 'task';
    protected $verb = 'task';

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Task_model');
        $this->singular ='Task';
        $this->plural = 'Tasks';
        $this->delete ='Delete Task';

    }

    public function index()
    {
        $data = array();
        
        $data['data'] = $this->Task_model->select();
        $this->global['pageTitle'] = $this->singular;
        $this->global['singular'] = $this->singular;
        $this->global['plural'] = $this->plural;
        $this->global['verb'] = $this->verb;
        $this->global['delete'] = $this->delete;
        $this->loadViews($this->viewPrefix . 'List', $this->global, $data, null);
    }

    public function add()
    {
        $data = array();
        
        $this->global['pageTitle'] = $this->singular;
        $this->global['singular'] = $this->singular;
        $this->global['plural'] = $this->plural;
        $this->global['verb'] = $this->verb;
        $this->global['delete'] = $this->delete;
        $this->loadViews($this->viewPrefix . 'Create', $this->global, $data, null);
    }

    public function edit($id = '')
    {
        $data = array();
        
        $this->global['pageTitle'] = $this->singular;
        $this->global['singular'] = $this->singular;
        $this->global['plural'] = $this->plural;
        $this->global['verb'] = $this->verb;
        $this->global['delete'] = $this->delete;
        //$id = $this->uri->segment(3);
        $data['row'] = $this->Task_model->single($id);
        $this->loadViews($this->viewPrefix . 'Edit', $this->global, $data, null);
    }

    public function create()
    {

        $this->form_validation->set_rules('task_title', 'Task title', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . validation_errors() . '!</div>');
            redirect($this->redirect_page . '/add');
        } else {
            $dataArray = array('task_title' => $this->input->post('task_title'),
            );
            $inserted = $this->Task_model->create($dataArray);
            if ($inserted) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('data_added_successfully') . '!</div>');

            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . $this->lang->line('data_not_saved') . '!</div>');

            }
            redirect($this->redirect_page);
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('task_title', 'Task title', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . validation_errors() . '!</div>');
            redirect($this->redirect_page . '/edit/' . $id);
        } else {
            $dataArray = array('task_title' => $this->input->post('task_title'),
            );
            $updated = $this->Task_model->update($dataArray, $id);
            if ($updated) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('data_updated_successfully') . '!</div>');

            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . $this->lang->line('data_not_saved') . '!</div>');

            }
            redirect($this->redirect_page);
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $deleted = $this->Task_model->delete($id);
        if ($deleted) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('data_deleted_successfully') . '!</div>');
            header('Content-Type:application/json');
            echo json_encode(array("code" => 1, "message" => $this->lang->line('data_added_successfully')));

        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . $this->lang->line('data_not_saved') . '!</div>');
            header('Content-Type:application/json');
            echo json_encode(array("code" => 2, "message" => $this->lang->line('data_not_saved')));

        }
    }

    public function single()
    {
        header('Content-Type:application/json');
        $id = $this->input->post('id');
        echo json_encode($this->Task_model->single($id));
    }

    public function dropdown()
    {
        header('Content-Type:application/json');
        echo json_encode($this->Task_model->dropdown());
    }
    public function datatable()
    {
        $parameters['draw'] = $this->input->post('draw');
        $parameters['start'] = $this->input->post('start');
        $parameters['length'] = $this->input->post('length');
        $parameters['searchValue'] = $this->input->post('search')['value'];
        return $this->Task_model->datatable($parameters);
    }
}
