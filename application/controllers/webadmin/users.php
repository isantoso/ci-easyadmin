<?php
class Users extends Controller {

	var $table_core_user = 'core_user';

	function __construct()
	{
		parent::Controller();
		$this->acl->check();
		$this->load->model('user_model');
		$this->admin_folder = $this->config->item('admin_folder').'/';
	} //end function

	/**
	 * view all users
	 *
	 */
	function view()
	{
		$this->load->library('pagination');

		$config['base_url'] 			= base_url().$this->admin_folder.'users/view';
		$config['total_rows'] 		= $this->db->get($this->table_core_user)->num_rows();
		$config['per_page'] 			= 30;
		$config['full_tag_open'] 	= '<div class="pagination">';
		$config['full_tag_close'] 	= '</div>';
		$config['cur_tag_open'] 	= '<span class="page_selected">';
		$config['cur_tag_close'] 	= '</span>';
		$config['uri_segment'] 		= 4;
		$page 							= $this->uri->segment($config['uri_segment']);

		$users 							= $this->user_model->get_all($page, $config['per_page']);

		$this->pagination->initialize($config);

		$data['pagination']			= $this->pagination->create_links();
		$data['users'] 				= $users;
		$data['template_main'] 		= array('user_view');

		$this->load->view($this->admin_folder.'main',$data);
	} //end function
	
	/**
	 *	add new user
	 */
	function add()
	{
		$this->load->library('form_validation');
		$this->load->model('group_model');

		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('group_id','Group','trim|required');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('user_username','User Name','trim|required|callback__check_username');
		$this->form_validation->set_rules('user_password','Password','trim|required');
		$this->form_validation->set_rules('user_password_confirm','Repeat Password','trim|matches[user_password]');
		$this->form_validation->set_rules('login_enabled','Enable/Disable Login','trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$this->user_model->add();
			redirect($this->admin_folder.'users/view');	
		}

		$data['group_options'] = $this->group_model->get_all();
		$data['template_main'] = array('user_add');
		$this->load->view($this->admin_folder.'main',$data);
	}
	
	/**
	 * edit new user
	 * 
	 */
	function edit($user_id)
	{
		$this->load->library('form_validation');
		$this->load->model('group_model');

		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('group_id','Group','trim|required');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');

		if($this->form_validation->run() == TRUE)
		{
			$this->user_model->update($user_id);
			redirect($this->admin_folder.'users/view');	
		}

		$data['group_options'] = $this->group_model->get_all();
		$data['user'] 				= $this->user_model->get($user_id);
		$data['template_main'] 	= array('user_edit');

		$this->load->view($this->admin_folder.'main',$data);
	} //end function
	
	/**
	 * form validation check username is unique
	 *
	 */
	function _check_username()
	{
		$user_username = $this->input->post('user_username');

		if($this->user->is_username_available($user_username))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_check_username', 'Username: <em>'.$user_username.'</em> cannot be used!');
			return FALSE;
		}

	} //end function

	/**
	 * delete user login
	 *
	 */
	function delete($user_id)
	{
		$this->user_model->delete($user_id);
		$page = $this->uri->segment(5);
		redirect($this->admin_folder.'users/view/'.$page);

	} //end function

	/* enable/disable user login */
	function enable($user_id)
	{
		$this->user_model->enable_disable($user_id);
		$page = $this->uri->segment(5);
		redirect($this->admin_folder.'users/view/'.$page);
	} //end function
	
	/* update user login */
	function update($user_id)
	{
		$this->user_model->update($user_id);
	} //end function
}
?>
