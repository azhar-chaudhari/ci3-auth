<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';
class Dashboard extends BaseController
{
    protected $singular = '';
    protected $plural = '';

    protected $viewPrefix = 'dashboard/dashboard';
    protected $redirect_page = 'dashboard'; //index
    protected $verb = 'dashboard'; //for all view pages
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data = array();
        $this->global['pageTitle'] = $this->config->item('web_app_name') .' : Dashboard';
        $this->global['singular'] = $this->config->item('web_app_name') .' : Dashboard';
        $this->global['plural'] = $this->config->item('web_app_name') .' : Dashboard';
        $this->global['verb'] = 'dashboard';
        $data['task_count'] = $this->Dashboard_model->countTask();
        $data['user_count'] = $this->Dashboard_model->countUsers();
        $this->loadViews("dashboard", $this->global, $data, null);
    }
    public function blank()
    {
        $data = array();
        $this->global['pageTitle'] = $this->config->item('web_app_name') .' : Blank Page';
        $this->global['singular'] = $this->config->item('web_app_name') .' : Blank Page';
        $this->global['plural'] = $this->config->item('web_app_name') .' : Blank Page';
        $this->global['verb'] = 'dashboard';
        $data['task_count'] = $this->Dashboard_model->countTask();
        $data['user_count'] = $this->Dashboard_model->countUsers();
        $this->loadViews("blank", $this->global, $data, null);
    }
}
