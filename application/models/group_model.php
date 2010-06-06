<?php
class Group_model extends Model {

	var $table_core_group 	= 'core_group';
	var $table_core_user		= 'core_user';

	function __construct()
	{
		parent::Model();
	}

	/* get all available groups  */
	function get_all()
	{
		$query = $this->db->get($this->table_core_group);
		$results = $query->result();

		return $results;

	} //end function
	
	/* get group detail */
	function get($group_id = 0)
	{
		$this->db->limit(1);
		$this->db->where('group_id',$group_id);
		$query 	= $this->db->get($this->table_core_group);
		$row 		= $query->row();

		return $row;

	} //end function

	/* add new group */
	function add()
	{
		$this->db->set('group_name',$this->input->post('group_name'));
		$this->db->set('group_enabled',$this->input->post('group_enabled'));
		$this->db->set('group_description',$this->input->post('group_description'));
		$this->db->insert($this->table_core_group);
		
		$flash_message = '<strong>Done!.</strong><br/>';
		$flash_message .= 'New User Group has been added successfully';
		$this->session->set_flashdata('flash_message', $flash_message);
		
	} //end function

	/* enable/disable group */
	function enable_disable($group_id)
	{
		//make sure the group is not super administrator (1)
		if($group_id <> 1)
		{
			$this->db->limit(1);
			$this->db->where('group_id',$group_id);
			$query = $this->db->get($this->table_core_group);
			$group = $query->row();
			
			if($query->num_rows() == 1){
				$current_status = $group->group_enabled;
				
				if($current_status == 1)
				{
					$group_enabled = 0;
					$action = ' disabled';
				}
				else
				{
					$group_enabled = 1;
					$action = ' enabled'; 
				}
				
				$this->db->where('group_id',$group_id);
				$this->db->set('group_enabled',$group_enabled);
				$this->db->update($this->table_core_group);
				
				$flash_message = '<strong>Done! </strong><br/>'.'Group: "'.$group->group_name.'" is now '.$action;
			}
			else
			{
				$flash_message = 'I cannot find group id you are looking for';
			}
		}
		else
		{
			$flash_message = '<strong>Sorry, I cannnot disable \'Super Admin\' group</strong>';
		}

		$this->session->set_flashdata('flash_message', $flash_message);
		
	} //end function

	/* update group details */
	function update($group_id)
	{
		$this->db->limit(1);
		$this->db->where('group_id',$group_id);
		$this->db->set('group_name',$this->input->post('group_name'));
		$this->db->set('group_enabled',$this->input->post('group_enabled'));
		$this->db->set('group_description',$this->input->post('group_description'));
		$this->db->update($this->table_core_group);
		
		$flash_message = '<strong>User Group has been updated successfully</strong>';
		$this->session->set_flashdata('flash_message', $flash_message);
		
	} //end function

	/* delete group */
	function delete($group_id)
	{
		//make sure group is empty
		$this->db->where('group_id',$group_id);
		$this->db->from($this->table_core_user);
		$query = $this->db->get();

		if($query->num_rows() == 0)
		{
			$this->db->limit(1);
			$this->db->where('group_id',$group_id);
			$this->db->delete($this->table_core_group);
			
			$flash_message = '<strong>User Group Deleted</strong><br/>';
		}
		else
		{
			$flash_message = '<strong>Unable to delete User Group</strong><br/>';
			$flash_message .= 'User group you are trying to delete is not empty!';
		}
		
		$this->session->set_flashdata('flash_message', $flash_message);
	} //end function

}
?>
