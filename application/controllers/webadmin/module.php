<?php
class Module extends controller {
	
	function __construct()
	{
		parent::Controller();
		$this->load->model('module_model');
		$this->acl->check();
		$this->admin_folder = $this->config->item('admin_folder').'/';
	}

	/* add new module */
	function add()
	{		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('module_name', 'Module Name', 'required');
		$this->form_validation->set_rules('access_path', 'Access Path', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu Item', 'required');
		$this->form_validation->set_rules('show_on_menu', 'Show on Menu', 'required');
		$this->form_validation->set_rules('module_enabled', 'Enable Module', 'required');

		$data['menu_options'] = $this->module_model->get_menu_options();

		if($this->form_validation->run() == true)
		{
			$this->module_model->add();
			redirect($this->admin_folder.'module/view');
		}
		else
		{
			$data['template_main'] 	= array('module_add');
			$this->load->view($this->admin_folder.'main',$data);	
		}

	} //end function
	
	/* view all modules */
	function view($print = '')
	{
		$data['modules'] 			= $this->module_model->get_all();
		$data['template_main'] 	= array('module_view');

		$this->load->view($this->admin_folder.'main',$data);
	} //end function
	
	/* enable or disable a module */
	function enable($module_id = 0)
	{
		if(ctype_digit($module_id))
		{
			$this->module_model->enable_disable($module_id);
		}

		redirect($this->admin_folder.'module/view');

	} //end function

	/* show or hide module as menu item */
	function menu($module_id = 0)
	{
		if(ctype_digit($module_id))
		{
			$this->module_model->show_on_menu($module_id);
		}

		redirect($this->admin_folder.'module/view');

	} //end function

	/* delete module */
	function delete($module_id)
	{
		if(ctype_digit($module_id))
		{
			$this->module_model->delete($module_id);
		}

		redirect($this->admin_folder.'module/view');

	} //end function
	
	/* update module detail */
	function edit($module_id = 0)
	{
		if(ctype_digit($module_id))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('module_name', 'Module Name', 'required');
			$this->form_validation->set_rules('access_path', 'Access Path', 'required');
			$this->form_validation->set_rules('menu_id', 'Menu Item', 'required');
			$this->form_validation->set_rules('show_on_menu', 'Show on Menu', 'required');
			$this->form_validation->set_rules('module_enabled', 'Enable Module', 'required');

			if($this->form_validation->run() == true)
			{
				$this->module_model->update($module_id);
				redirect($this->admin_folder.'module/view');
			}

			$data['module']			= $this->module_model->get($module_id);
			$data['menu_options'] 	= $this->module_model->get_menu_options();
			$data['template_main'] 	= array('module_edit');

			$this->load->view($this->admin_folder.'main',$data);
		}
	}
}
?>
