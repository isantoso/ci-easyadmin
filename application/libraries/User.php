<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User {
	
	var $table_core_user = 'core_user';
	
	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	 * user login
	 *
	 */
	function login($user_username, $user_password)
	{		
		$this->CI->db->limit(1);
		$this->CI->db->where('login_enabled',1);
		$this->CI->db->where('user_username',$user_username);
		$this->CI->db->where('user_password',$this->user_password_hash($user_password));
		$query = $this->CI->db->get($this->table_core_user);

		$row = $query->row();

		if($query->num_rows() == 1)
		{
			$user['user_id'] 		= $row->user_id;
			$user['ip_address'] 	= $this->CI->input->ip_address();
			
			//log success login
			$this->CI->db->limit(1);
			$this->CI->db->where('user_id',$row->user_id);
			$this->CI->db->set('last_login',time());
			$this->CI->db->set('last_ip',$user['ip_address']);
			$this->CI->db->update($this->table_core_user);
			
			//set session
			$this->CI->session->set_userdata('user',$user);
	
			$success = 1;
			$msg 		= 'Login Successfull';
		}
		else
		{
			$success = 0;
			$msg 		= 'Invalid login';
			
			//@todo log invalid login
		}

		$results['success'] 	= $success;
		$results['msg'] 		= $msg;

		return $results;
	}
	
	/**
	 * password hash used by user
	 */
	function user_password_hash($string)
	{
		$salt_md5 		= $this->CI->config->item('salt_md5');
		$string_hash 	= md5($string.$salt_md5);

		return $string_hash;
	}
	
	/* get user data */
	function logged_in_data()
	{
		$user 	= $this->CI->session->userdata('user');

		if($user <> '' && is_array($user))
		{
				$user_id = $user['user_id'];
	
				$this->CI->db->limit(1);
				$this->CI->db->where('login_enabled',1);
				$this->CI->db->where('user_id',$user_id);
				$query 		= $this->CI->db->get($this->table_core_user);
				$row 			= $query->row();
				$group_id 	= $row->group_id;
		}
		else
		{
			$user_id 	= 0;
			$group_id 	= 0;
		}
		
		$results['user_id'] 	= $user_id;
		$results['group_id'] = $group_id;

		return $results;
	}	
	
	/* get user group id */
	function get_user_group($user_id)
	{
		$this->CI->db->limit(1);
		$this->CI->db->where('user_id',$user_id);
		$query 		= $this->CI->db->get($this->table_core_user);
		$row 			= $query->row();
		$group_id 	= $row->group_id;

		if(!ctype_digit($group_id))
		{
			$group_id = 0;
		}

		return $group_id;
	}
	
	/* check if user is currently logged in */
	function check_user_login()
	{
		$user = $this->CI->session->userdata('user');
		
		if($user <> '' && is_array($user))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	} //end function
	
	function is_username_available($user_username)
	{
		$this->CI->db->where('user_username',$user_username);
		$query = $this->CI->db->get($this->table_core_user);
		$count = $query->num_rows();

		if($count == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/* clear login session */
	function clear_login()
	{
		$this->CI->session->unset_userdata('user');
	}
}
?>
