<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once APPPATH . '/libraries/Base_model.php';

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data
 * @author : Azhar Chaudhari
 * @version : 1.1
 * @since : 16 July 2022
 */
class User_model extends Base_model
{
    protected $table_name = 'users';
    protected $column_id = 'user_id';
    protected $column_name = 'name';

        public function select()
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.mobile,BaseTbl.email, BaseTbl.name');
        $this->db->from('users as BaseTbl');
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.role_id', 2);
        $this->db->order_by('BaseTbl.user_id desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checkMobileExist($mobile)
    {
        $this->db->select('userId,first_name,last_name, email, mobile, role_id');
        $this->db->from('users');
        $this->db->where('isDeleted', 0);

        $this->db->where("lower(trim(mobile))", strtolower($mobile));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.created_at, Role.role_title');
        $this->db->from('users as BaseTbl');
        $this->db->join('roles as Role', 'Role.role_id = BaseTbl.role_id', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.name  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.mobile  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.role_id !=', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    public function userListing($searchText = '', $page = 1, $segment = 10)
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.created_at, Role.role_title');
        $this->db->from('users as BaseTbl');
        $this->db->join('roles as Role', 'Role.role_id = BaseTbl.role_id', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.name  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.mobile  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.role_id !=', 1);
        $this->db->order_by('BaseTbl.user_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    public function getUserRoles()
    {
        $this->db->select('role_id, role_title');
        $this->db->from('roles');
        $this->db->where('role_id !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    public function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("users");
        $this->db->where("email", $email);
        $this->db->where("is_deleted", 0);
        if ($userId != 0) {
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    public function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('users', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    public function getUserInfo($userId)
    {
        $this->db->select('user_id, name, email, mobile, role_id');
        $this->db->from('users');
        $this->db->where('is_deleted', 0);
        $this->db->where('role_id !=', 1);
        $this->db->where('user_id', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    public function editUser($userInfo, $userId)
    {
        $this->db->where('user_id', $userId);
        $this->db->update('users', $userInfo);

        return true;
    }

    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteUser($userId, $userInfo)
    {
        $this->db->where('user_id', $userId);
        $this->db->update('users', $userInfo);

        return $this->db->affected_rows();
    }

    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    public function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('user_id, password');
        $this->db->where('user_id', $userId);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('users');

        $user = $query->result();

        if (!empty($user)) {
            if (verifyHashedPassword($oldPassword, $user[0]->password)) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    public function changePassword($userId, $userInfo)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('is_deleted', 0);
        $this->db->update('users', $userInfo);

        return $this->db->affected_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    public function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.session_data, BaseTbl.machine_ip, BaseTbl.user_agent, BaseTbl.agent_string, BaseTbl.platform, BaseTbl.created_at');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.session_data LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.created_at, '%Y-%m-%d' ) >= '" . date('Y-m-d', strtotime($fromDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if (!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.created_at, '%Y-%m-%d' ) <= '" . date('Y-m-d', strtotime($toDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if ($userId >= 1) {
            $this->db->where('BaseTbl.user_id', $userId);
        }
        $this->db->from('last_logins as BaseTbl');
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    public function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.user_id, BaseTbl.session_data, BaseTbl.machine_ip, BaseTbl.user_agent, BaseTbl.agent_string, BaseTbl.platform, BaseTbl.created_at');
        $this->db->from('last_logins as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.session_data  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.created_at, '%Y-%m-%d' ) >= '" . date('Y-m-d', strtotime($fromDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if (!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.created_at, '%Y-%m-%d' ) <= '" . date('Y-m-d', strtotime($toDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if ($userId >= 1) {
            $this->db->where('BaseTbl.user_id', $userId);
        }
        $this->db->order_by('BaseTbl.user_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    public function getUserInfoById($userId)
    {
        $this->db->select('user_id, name, email, mobile, role_id');
        $this->db->from('users');
        $this->db->where('is_deleted', 0);
        $this->db->where('user_id', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    public function getUserInfoWithRole($userId)
    {
        $this->db->select('user_id, email, name, mobile, users.role_id, roles.role_title');
        $this->db->from('users');
        $this->db->join('roles', 'roles.role_id = users.role_id');
        $this->db->where('user_id', $userId);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();

        return $query->row();
    }

}
