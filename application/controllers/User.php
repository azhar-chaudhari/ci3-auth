<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class User extends BaseController
{
    protected $singular = 'User';
    protected $plural = 'Users';
    protected $delete = '';
    protected $viewPrefix = 'user/user';
    protected $redirect_page = 'user';
    protected $verb = 'user';
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->isLoggedIn();
    }

    /**
     * This function is used to load the user list
     */
    public function index()
    {
        if ($this->isAdmin() == true) {
            $this->global['pageTitle'] = $this->config->item('web_app_name') . ' : Users';

            $data = array();
            $data['pageTitle2'] = $this->plural;
            $data['data'] = $this->User_model->select();

            $this->global['pageTitle'] = 'User';
            $this->global['singular'] = 'User';
            $this->global['plural'] = 'Users';
            $this->global['verb'] = $this->verb;
            $this->global['delete'] = $this->delete;
            $this->loadViews($this->viewPrefix . 'List', $this->global, $data, null);
        } else {
            $this->loadThis();

        }
    }

    public function add()
    {
        if ($this->isAdmin() == true) {
            $data = array();
            $data['pageTitle2'] = $this->plural;
            $this->global['pageTitle'] = $this->singular;
            $this->global['singular'] = $this->singular;
            $this->global['plural'] = $this->plural;
            $this->global['verb'] = $this->verb;
            $this->global['delete'] = $this->delete;
            $this->loadViews($this->viewPrefix . 'Create', $this->global, $data, null);
        } else {
            $this->loadThis();
        }
    }

    public function edit($id = '')
    {
        if ($this->isAdmin() == true) {
            $data = array();
            $data['pageTitle2'] = $this->plural;
            $this->global['pageTitle'] = $this->singular;
            $this->global['singular'] = $this->singular;
            $this->global['plural'] = $this->plural;
            $this->global['verb'] = $this->verb;
            $this->global['delete'] = $this->delete;
            $data['row'] = $this->User_model->single($id);
            $this->loadViews($this->viewPrefix . 'Edit', $this->global, $data, null);
        } else {
            $this->loadThis();
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . validation_errors() . '!</div>');
            redirect($this->redirect_page . '/add');
        } else {
            $name = strtolower($this->security->xss_clean($this->input->post('name')));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));

            $password = $this->input->post('password');
            $dataArray = array(
                'email' => $email,
                'password' => getHashedPassword($password),
                'name' => $name,
                'mobile' => $mobile,
                'role_id' => 2,
            );
            $inserted = $this->User_model->create($dataArray);
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
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">' . validation_errors() . '!</div>');
            redirect($this->redirect_page . '/edit/' . $id);
        } else {
            $name = strtolower($this->security->xss_clean($this->input->post('name')));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $dataArray = array(
                'email' => $email,
                'name' => $name,
                'mobile' => $mobile,
                'role_id' => 2,
            );
            $updated = $this->User_model->update($dataArray, $id);
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
        $deleted = $this->User_model->delete($id);
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
        echo json_encode($this->User_model->single($id));
    }
    /**
     * This function is used to check whether email already exist or not
     */
    public function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if (empty($userId)) {
            $result = $this->User_model->checkEmailExists($email);
        } else {
            $result = $this->User_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {echo ("true");} else {echo ("false");}
    }

    /**
     * This function is used to load the change password screen
     */
    public function loadChangePass()
    {
     
            $this->global['pageTitle'] = $this->config->item('web_app_name') . '  : Change Password';
            $this->loadViews("auth/changePassword", $this->global, null, null);
        
    }

    /**
     * This function is used to change the password of the user
     */
    public function changePassword()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword', 'Old password', 'required|max_length[20]');
        $this->form_validation->set_rules('newPassword', 'New password', 'required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword', 'Confirm new password', 'required|matches[newPassword]|max_length[20]');

        if ($this->form_validation->run() == false) {
            $this->loadChangePass();
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->User_model->matchOldPassword($this->user_id, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            } else {
                $usersData = array('password' => getHashedPassword($newPassword), 'updatedBy' => $this->user_id,
                    'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->User_model->changePassword($this->user_id, $usersData);

                if ($result > 0) {$this->session->set_flashdata('success', 'Password updation successful');} else { $this->session->set_flashdata('error', 'Password updation failed');}

                redirect('loadChangePass');
            }
        }
    }

    /**
     * Page not found : error 404
     */
    public function pageNotFound()
    {
        $this->global['pageTitle'] = $this->config->item('web_app_name') . '  : 404 - Page Not Found';

        $this->loadViews("404", $this->global, null, null);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    public function loginHistoy($userId = null)
    {
        if ($this->isAdmin() == true) {

            $userId = ($userId == null ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->User_model->getUserInfoById($userId);
            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            $this->load->library('pagination');
            $count = $this->User_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);
            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);
            $data['userRecords'] = $this->User_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->config->item('web_app_name') . '  : User Login History';
            $this->loadViews("auth/loginHistory", $this->global, $data, null);
        } else {
            $this->loadThis();
        }
    }

    /**
     * This function is used to show users profile
     */
    public function profile()
    {
        $data["userInfo"] = $this->User_model->getUserInfoWithRole($this->user_id);

        $this->global['pageTitle'] = $this->config->item('web_app_name') . ' |' . $this->lang->line('my_profile');
        $this->loadViews("auth/profile", $this->global, $data, null);
    }

    public function profileUpdate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_name', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == false) {
            $this->profile();
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('user_name'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array('name' => $name, 'mobile' => $mobile, 'updated_at' => date('Y-m-d H:i:s'));

            $result = $this->User_model->editUser($userInfo, $this->user_id);

            if ($result == true) {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile');
        }
    }
}
