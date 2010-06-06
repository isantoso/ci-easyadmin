<?php
class Menu extends Controller {
	function __construct()
	{
		parent::Controller();
		$this->load->model('menu_model');
		$this->acl->check();
		$this->admin_folder = $this->config->item('admin_folder').'/';
	}
	
	/* view all menus */
	function view()
	{
		$data['menus'] 			= $this->menu_model->get_all();
		$data['template_main'] 	= array('menu_view');

		$this->load->view($this->admin_folder.'main',$data);	
	} //end function
	
	/* add new menu */
	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('menu_title','Menu Title','trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$this->menu_model->add();
			redirect($this->admin_folder.'menu/view');
		}

		$data['template_main'] = array('menu_add');
		$this->load->view($this->admin_folder.'main',$data);

	} //end function

	function edit($menu_id)
	{
		//form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('menu_title', 'Menu Title', 'trim|required');
		$this->form_validation->set_error_delimiters('', '<br/>');

		if ($this->form_validation->run() == TRUE)
		{
			$this->menu_model->update($menu_id);
			redirect($this->admin_folder.'menu/view');
		}

		$data['menu']				= $this->menu_model->get($menu_id);
		$data['template_main']	= array('menu_edit');
		$this->load->view($this->admin_folder.'main',$data);
	} //end function

	function delete($menu_id)
	{
		$this->menu_model->delete($menu_id);
		redirect($this->admin_folder.'menu/view');
	} //end function

	function reorder($action = '')
	{
		
		if($action == 'ajax')
		{
			$this->menu_model->reorder();
		}
		
		$this->load->model('module_model');
		$data['menus'] = $this->menu_model->get_all();
		$data['template_main'] = array('menu_reorder');
		$this->load->view($this->admin_folder.'main',$data);
	} //end function
	
	function ajax_reorder()
	{
		
	}
}
?>
