<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model
{
    function loginMobile($mobile, $password)
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.password, BaseTbl.name,BaseTbl.role_id, Roles.role_title');
        $this->db->from('users as BaseTbl');
        $this->db->join('roles as Roles','Roles.role_id = BaseTbl.role_id');
        $this->db->where('BaseTbl.mobile', $mobile);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->employee_password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function checkLoginByEmail($email, $password)
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.password, BaseTbl.name,BaseTbl.role_id, Roles.role_title');
        $this->db->from('users as BaseTbl');
        $this->db->join('roles as Roles','Roles.role_id = BaseTbl.role_id');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    /**
     * This function used to check mobile number exists or not
     * @param {string} $mobile : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkMobileExist($mobile)
    {
        $this->db->select('user_id');
        $this->db->where('mobile', $mobile);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('user_id');
        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('reset_passwords', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getUserInfoByEmail($email)
    {
        $this->db->select('user_id, email, name');
        $this->db->from('users');
        $this->db->where('is_deleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('reset_password_id');
        $this->db->from('reset_passwords');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);
        $this->db->update('users', array('password'=>getHashedPassword($password)));
        $this->db->delete('reset_passwords', array('email'=>$email));
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('last_logins', $loginInfo);
        $this->db->trans_complete();
    }

    /**
     * This function is used to get last login info by user id
     * @param number $user_id : This is user id
     * @return number $result : This is query result
     */
    function lastLoginInfo($user_id)
    {
        $this->db->select('created_at');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('user_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('last_logins');
        return $query->row();
    }
}

?>