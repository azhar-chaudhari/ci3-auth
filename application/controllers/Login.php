<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
		$data=array();
        $isLoggedIn = $this->session->userdata('is_logged_in');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('auth/login',$data);
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
      /**
     * This function used to logged in using mobile no. and password
     */
    public function loginMobile()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('mobile', 'Mobile No', 'required|max_length[10]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $mobile = strtolower($this->security->xss_clean($this->input->post('mobile')));
            $password = $this->input->post('password');
            
            $result = $this->Login_model->loginMobile($mobile, $password);
            
            if(!empty($result))
            {
                $lastLogin = $this->Login_model->lastLoginInfo($result->user_id);
                
                $sessionArray = array('user_id'=>$result->user_id,                    
                                        'role'=>$result->role_id,
                                        'role_title'=>$result->role_title,
                                        'name'=>$result->first_name,
                                        'last_login'=> $lastLogin->created_at,
                                        'is_logged_in' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['user_id'], $sessionArray['is_logged_in'], $sessionArray['last_login']);

                $loginInfo = array("user_id"=>$result->user_id, "session_data" => json_encode($sessionArray), "machine_ip"=>$_SERVER['REMOTE_ADDR'], "user_agent"=>getBrowserAgent(), "agent_string"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                $this->Login_model->lastLogin($loginInfo);
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Mobile No or password mismatch');
                
                $this->index();
            }
        }
    }
    /**
     * This function used to logged in user
     */
    public function checkLogin()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            
            $result = $this->Login_model->checkLoginByEmail($email, $password);
            
            if(!empty($result))
            {
                $lastLogin = $this->Login_model->lastLoginInfo($result->user_id);
				if(!empty($lastLogin)){
					$last_login_time=$lastLogin->created_at;
				}	
				else{
					$last_login_time=date('Y-m-d H:i:s');
				}
                $sessionArray = array('user_id'=>$result->user_id,                    
                                        'role'=>$result->role_id,
                                        'role_title'=>$result->role_title,
                                        'name'=>$result->name,
                                        'last_login'=> $last_login_time,
                                        'is_logged_in' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['user_id'], $sessionArray['is_logged_in'], $sessionArray['last_login']);

                $loginInfo = array("user_id"=>$result->user_id, "session_data" => json_encode($sessionArray), "machine_ip"=>$_SERVER['REMOTE_ADDR'], "user_agent"=>getBrowserAgent(), "agent_string"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                $this->Login_model->lastLogin($loginInfo);
                
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                $this->index();
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('is_logged_in');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('auth/forgotPassword');
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = strtolower($this->security->xss_clean($this->input->post('login_email')));
            
            if($this->Login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->Login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->Login_model->getUserInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo->name;
                        $data1["email"] = $userInfo->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('/forgotPassword');
        }
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->Login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->Login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->Login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password reset successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password reset failed';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }
}

?>