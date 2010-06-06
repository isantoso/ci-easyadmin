<?php
class Module_model extends Model {

	var $table_core_module 	= 'core_module';
	var $table_core_acl 		= 'core_acl';

	function __construct()
	{
		parent::Model();
	}

	/* get all available modules */
	function get_all($menu_id = 0, $show_all = 1)
	{
		if($menu_id > 0)
		{
			$this->db->where($this->table_core_module.'.menu_id',$menu_id);
		}
		
		if($show_all == 0)
		{
			$this->db->where('module_enabled',1);
			$this->db->where('show_on_menu',1);
		}
		$this->db->from($this->table_core_module);
		$this->db->join('core_menu',$this->table_core_module.'.menu_id = core_menu.menu_id');
		$this->db->order_by('core_menu.menu_order');
		$this->db->order_by('core_module.module_order');
		$this->db->order_by('core_module.menu_id');
		$this->db->order_by('core_module.access_path');
		$query 	= $this->db->get();

		$results = $query->result();

		return $results;
	} //end function
	
	function get($module_id)
	{
		$this->db->limit(1);
		$this->db->where('module_id',$module_id);
		$this->db->from($this->table_core_module);
		$this->db->join('core_menu','core_module.menu_id = core_menu.menu_id');
		$query 	= $this->db->get();
		$module 	= $query->row();

		return $module;

	} //end function
	
	/* get module - group permission */
	function get_module_permission($group_id,$module_id)
	{
		$this->db->limit(1);
		$this->db->where('module_id',$module_id);
		$this->db->where('group_id',$group_id);
		$query 		= $this->db->get($this->table_core_acl);
		$result 		= $query->row();
		$permission = $query->num_rows();

		if($query->num_rows() == 1)
		{
			return 1;
		}
		else
		{
			return 0;
		}

	} //end function	

	/* update module permission */
	function update_permission($group_id)
	{
		if(ctype_digit($group_id))
		{
			//reset group - module permission
			$this->db->where('group_id',$group_id);
			$this->db->delete($this->table_core_acl);
			
			//create new permission
			$module_ids = $this->input->post('module');
			foreach($module_ids as $module_id => $permission)
			{
				if($permission == 1)
				{
					$this->db->set('group_id', $group_id);
					$this->db->set('module_id', $module_id);
					$this->db->set('date_created', date("Y-m-d"));
					$this->db->insert($this->table_core_acl); 
				}
			}
			
			$flash_message = 'Module permission access updated successfully!.';
			$this->session->set_flashdata('flash_message', $flash_message);
		}
	} //end function

	/* add new module */
	function add()
	{
		$this->db->set('menu_id',$this->input->post('menu_id'));
		$this->db->set('module_name',$this->input->post('module_name'));
		$this->db->set('access_path',$this->input->post('access_path'));
		$this->db->set('class_name','');
		$this->db->set('class_method','');
		$this->db->set('show_on_menu',$this->input->post('show_on_menu'));
		$this->db->set('module_enabled',$this->input->post('module_enabled'));
		$this->db->set('module_order','999');
		$this->db->set('module_description',$this->input->post('module_description'));
		$this->db->set('date_created',date('Y-m-d H:i:s'));
		$this->db->insert($this->table_core_module);
		$module_id 		= $this->db->insert_id();

		//add acl to super admin
		$group_id 		= '1';
		$this->add_to_acl($module_id,$group_id);

		$flash_message = '<strong>Done!.</strong><br/>';
		$flash_message .= 'New module: "'.$this->input->post('module_name').'" has been added';
		$this->session->set_flashdata('flash_message', $flash_message);
	} //end function
	
	/* update module detail */
	function update($module_id)
	{
		$this->db->limit(1);
		$this->db->where('module_id',$module_id);
		$this->db->set('menu_id',$this->input->post('menu_id'));
		$this->db->set('module_name',$this->input->post('module_name'));
		$this->db->set('access_path',$this->input->post('access_path'));
		$this->db->set('class_name','');
		$this->db->set('class_method','');
		$this->db->set('show_on_menu',$this->input->post('show_on_menu'));
		$this->db->set('module_enabled',$this->input->post('module_enabled'));
		$this->db->set('module_description',$this->input->post('module_description'));
		$this->db->update($this->table_core_module);

		$flash_message = '<strong>Done!.</strong><br/>';
		$flash_message .= 'Module: "'.$this->input->post('module_name').'" has been updated successfully';
		$this->session->set_flashdata('flash_message', $flash_message);
	} //end function
	
	/* enable or disable a module */
	function enable_disable($module_id)
	{
		//get current module status
		$this->db->limit(1);
		$this->db->where('module_id',$module_id);
		$this->db->from($this->table_core_module);
		$query 	= $this->db->get();
		$module 	= $query->row();

		if($query->num_rows() == 1)
		{
			$current_status = $module->module_enabled;

			if($current_status == 0)
			{
				$module_enabled 	= 1;
				$action 				= 'Enabled';
			}
			else
			{
				$module_enabled 	= 0;
				$action				= 'Disabled';
			}

			//update module	
			$this->db->limit(1);
			$this->db->where('module_id',$module_id);
			$this->db->set('module_enabled', $module_enabled); 
			$this->db->update($this->table_core_module);
			
			$flash_message = '<strong>Done! </strong><br/>'.'Module: "'.$module->module_name.'" is now '.$action;
			$this->session->set_flashdata('flash_message', $flash_message);
		}
	} //end function
	
	/* get menu options */
	function get_menu_options()
	{
		$query 	= $this->db->get('core_menu');
		$result 	= $query->result();

		return $result;
	} //end function

	/* show or hide module on menu */
	function show_on_menu($module_id)
	{
		//get current module status
		$this->db->limit(1);
		$this->db->where('module_id',$module_id);
		$this->db->from($this->table_core_module);
		$query 	= $this->db->get();
		$module 	= $query->row();
		
		if($query->num_rows() == 1)
		{
			$current_status = $module->show_on_menu;
	
			if($current_status == 0)
			{
				$show_on_menu 	= 1;
				$action 			= 'shown on menu';
			}
			else
			{
				$show_on_menu 	= 0;
				$action			= 'hidden from menu';
			}
	
			//update module	
			$this->db->limit(1);
			$this->db->where('module_id',$module_id);
			$this->db->set('show_on_menu', $show_on_menu); 
			$this->db->update($this->table_core_module);
			
			$flash_message = '<strong>Done! </strong><br/>'.'Module: "'.$module->module_name.'" is now '.$action;
			$this->session->set_flashdata('flash_message', $flash_message);
		}
	} //end function

	/* add module permission for a group */
	function add_to_acl($module_id, $group_id)
	{
		//make sure there is no duplicate
		$this->db->where('module_id',$module_id);
		$this->db->where('group_id',$group_id);
		$query = $this->db->get($this->table_core_acl);
		
		if($query->num_rows() == 0)
		{
			$this->db->set('module_id',$module_id);
			$this->db->set('group_id',$group_id);
			$this->db->insert($this->table_core_acl);			
		}

	} //end function

	/* delete module */ 
	function delete($module_id)
	{
		//delete from acl
		$this->db->where('module_id',$module_id);
		$this->db->delete($this->table_core_acl);

		//delete module
		$this->db->limit(1);
		$this->db->where('module_id',$module_id);
		$this->db->delete($this->table_core_module);

		$flash_message = 'Module deleted.';
		$this->session->set_flashdata('flash_message', $flash_message);
	}
}
?>
