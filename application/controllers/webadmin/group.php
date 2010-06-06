<?php
class Group extends Controller {
	
	var $table_core_group = 'core_group';
	
	function __construct()
	{
		parent::Controller();
		$this->acl->check();
		$this->load->model('group_model');
		$this->admin_folder = $this->config->item('admin_folder');
	} //end function

	/* viewing all available groups */
	function view()
	{
		$data['groups'] 			= $this->group_model->get_all();
		$data['template_main'] 	= array('group_view');
		$this->load->view($this->admin_folder.'/main',$data);

	}	//end function
	
	/* add new group */
	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		$this->form_validation->set_rules('group_enabled', 'Group Enabled/Disabled', 'required');

		if($this->form_validation->run() == true)
		{
			$this->group_model->add();
			redirect($this->admin_folder.'/group/view');
		}

		$data['template_main'] = array('group_add');
		$this->load->view($this->admin_folder.'/main',$data);

		
	} //end function
	
	/* enable or disable group */
	function enable($group_id = 0)
	{
		if(ctype_digit($group_id))
		{
			$this->group_model->enable_disable($group_id);
		}

		redirect($this->admin_folder.'/group/view');

	} //end function
	
	/* delete a group */	
	function delete($group_id = 0)
	{
		if(ctype_digit($group_id)){
			$this->group_model->delete($group_id);
		}
		
		redirect($this->admin_folder.'/group/view');

	} //end function
	
	/* setting group - module permissions */
	function permission($group_id)
	{
		if(ctype_digit($group_id)){
			$this->load->model('module_model');

			if($this->input->post('update_module_permission') == '1')
			{
				$this->module_model->update_permission($group_id);
				redirect($this->admin_folder.'/group/permission/'.$group_id);
			}

			$data['template_main']  = array('group_permission');
			$data['group']				= $this->group_model->get($group_id);
			$data['modules']			= $this->module_model->get_all();
			$this->load->view($this->admin_folder.'/main',$data);
		}
	} //end function

	/* edit user group */
	function edit($group_id = 0)
	{
		if(ctype_digit($group_id))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('group_name', 'Group Name', 'required');
			$this->form_validation->set_rules('group_enabled', 'Group Enabled/Disabled', 'required');
			
			if($this->form_validation->run() == true)
			{
				$this->group_model->update($group_id);
				redirect($this->admin_folder.'/group/view');
			}

			$data['group'] 			= $this->group_model->get($group_id);
			$data['template_main'] 	= array('group_edit');
			$this->load->view($this->admin_folder.'/main',$data);
		}
	}
}
?>
