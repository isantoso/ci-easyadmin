<?php
class User_model extends Model {

	var $table_core_user 	= 'core_user';
	var $table_core_group 	= 'core_group';

	function __construct()
	{
		parent::Model();
	} //end function

	/**
	 * get all user logins
	 *
	 * retrieve all the user logins
	 * use this with paging
	 */
	function get_all($from = 0,$page_limit = 0)
	{
		$this->db->order_by('user_id');
		$this->db->limit($page_limit,$from);
		$this->db->from($this->table_core_user);
		$this->db->join($this->table_core_group, $this->table_core_user.'.group_id = '.$this->table_core_group.'.group_id');
		$query 	= $this->db->get();
		$result 	= $query->result();

		return $result;

	} //end function
	
	/**
	 * get a single user
	 *
	 */
	function get($user_id)
	{
		$this->db->limit(1);
		$this->db->where('user_id',$user_id);
		$this->db->from($this->table_core_user);
		$this->db->join($this->table_core_group, $this->table_core_user.'.group_id = '.$this->table_core_group.'.group_id');

		$query 	= $this->db->get();
		$row 		= $query->row();

		return $row;
	} //end function
	
	/**
	 * add user
	 *
	 * add new user login to database
	 */
	function add()
	{
	
		$user_password_hash 	= $this->user->user_password_hash($this->input->post('user_password'));
		
		$this->db->set('name',$this->input->post('name'));
		$this->db->set('phone',$this->input->post('phone'));
		$this->db->set('email',$this->input->post('email'));
		$this->db->set('user_username',$this->input->post('user_username'));
		$this->db->set('user_password',$user_password_hash);
		$this->db->set('login_enabled',$this->input->post('login_enabled'));
		$this->db->set('group_id',$this->input->post('group_id'));
		$this->db->set('date_created',date('Y-m-d H:i:s'));
		$this->db->insert($this->table_core_user);

		$flash_message = 'New User Login has been added successfully';
		$this->session->set_flashdata('flash_message', $flash_message);
	} //end function

	/**
	 * delete user
	 *
	 * if the user is a licensee, it will delete the licensee details as well.
	 *
	 */
	function delete($user_id)
	{

		if(ctype_digit($user_id) && $user_id <> 1)
		{
			//delete from core_user table
			$this->db->limit(1);
			$this->db->where('user_id',$user_id);
			$this->db->delete($this->table_core_user);

			$flash_message = 'User has been deleted successfully';
		}
		else
		{
			$flash_message = 'Sorry you cannot delete that user';
		}

		$this->session->set_flashdata('flash_message', $flash_message);

	} //end function
	
	/**
	 * enable/disable user login
	 *
	 */
	function enable_disable($user_id)
	{
		if(!ctype_digit($user_id) || $user_id == 1)
		{
			$flash_message = 'Sorry you cannot disable that user';
		}
		else
		{
			$this->db->limit(1);
			$this->db->where('user_id',$user_id);
			$query = $this->db->get($this->table_core_user);
			$row = $query->row();

			$current_login_status = $row->login_enabled;

			if($current_login_status == 1)
			{
				$status_now 	= 'disabled';
				$login_enabled = 0;
			}
			else
			{
				$status_now 	= 'enabled';
				$login_enabled = 1;
			}

			$this->db->where('user_id',$user_id);
			$this->db->set('login_enabled',$login_enabled);
			$this->db->update($this->table_core_user);

			$flash_message = 'Selected user has been '.$status_now;
		}
		
		$this->session->set_flashdata('flash_message',$flash_message);
	} //end function
	
	/**
	 * update user login details
	 *
	 */
	function update($user_id, $admin = TRUE)
	{
		$this->db->limit(1);
		$this->db->where('user_id',$user_id);
		$this->db->set('name',$this->input->post('name'));
		$this->db->set('phone',$this->input->post('phone'));
		$this->db->set('email',$this->input->post('email'));

		if($admin == TRUE)
		{
			$this->db->set('group_id',$this->input->post('group_id'));
		}

		$this->db->update($this->table_core_user);

		$flash_message = 'User Login has been updated successully';
		$this->session->set_flashdata('flash_message',$flash_message);
	} //end function

	/**
	 * update user password
	 *
	 */
	function update_password($user_id, $current_password, $new_password)
	{
		$this->db->limit(1);
		$this->db->where('user_id',$user_id);
		$this->db->where('user_password',$this->user->user_password_hash($current_password));
		$query  = $this->db->get($this->table_core_user);

		if($query->num_rows() == 1)
		{
			//update password success
			$this->db->limit(1);
			$this->db->where('user_id',$user_id);
			$this->db->set('user_password',$this->user->user_password_hash($new_password));
			$this->db->update($this->table_core_user);

			$message = 'Your password has been updated successfully<br/>';
			$message .= 'Please use your new password on your next login';
		}
		else
		{
			//update password fail
			$message = 'Your current password is incorrect.';
		}

		return $message;

	} //end function
	

	
}
?>
