<?php
class Account extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->acl->check();
		$this->load->model('user_model');
		$this->admin_folder = $this->config->item('admin_folder');
	}
	
	function index()
	{
		exit();
	}
	
	/**
	 * edit user account
	 *
	 */
	function edit()
	{
		//get current user_id
		$user = $this->session->userdata('user');
		$user_id =  $user['user_id'];
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
	
		if($this->form_validation->run() == TRUE)
		{
			$this->user_model->update($user_id, FALSE);
			redirect($this->admin_folder.'/account/edit');	
		}

		$data['user'] = $this->user_model->get($user_id);
		$data['template_main'] 	= array('account_edit');
		$this->load->view($this->admin_folder.'/main',$data);
	}
	
	/**
	 * update user password
	 *
	 */
	function password()
	{
		//get current user_id
		$user = $this->session->userdata('user');
		$user_id = $user['user_id'];
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_password','Current Password','trim|required');
		$this->form_validation->set_rules('new_password','New Password','trim|required');
		$this->form_validation->set_rules('confirm_new_password','Confirm Password','trim|required|matches[new_password]');

		if($this->form_validation->run() == TRUE)
		{
			$flash_message = $this->user_model->update_password($user_id, $this->input->post('user_password'), $this->input->post('new_password'));
			$this->session->set_flashdata('flash_message',$flash_message);
			redirect($this->admin_folder.'/account/password');
		}
		
		$data['user'] = $this->user_model->get($user_id);
		$data['template_main'] = array('account_password');
		$this->load->view($this->admin_folder.'/main',$data);
	}
}
?>
