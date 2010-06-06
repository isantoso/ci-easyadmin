<?php
class Admin extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->admin_folder = $this->config->item('admin_folder');
	}
	
	function index()
	{
		$this->login();
	} //end function

	/**
	 * admin login
	 */
	function login()
	{
		//load recaptcha library
		$this->load->library('recaptcha');
		$this->lang->load('recaptcha');
		
		$data['login_error']  = '';
		
		if(is_array($this->session->userdata('user')))
		{
			redirect($this->admin_folder.'/admin/main');
		}

		$this->load->helper(array('form'));

		//form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('recaptcha_response_field', 'Image Verification','required|callback__valid_recaptcha');

		$this->form_validation->set_error_delimiters('', '<br/>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$login = $this->user->login($this->input->post('user_username'), $this->input->post('user_password'));
			if($login['success'] == 1)
			{
				//successfull login
				redirect($this->admin_folder.'/admin/main');	
			}
			else
			{
				//failed login
				$data['login_error'] = 'Incorrect Username or Password. <br/>';

			}
		}

		$data['recaptcha_html'] = $this->recaptcha->get_html();
		$this->load->view($this->admin_folder.'/login',$data);

	} //end function

	/**
	 * form validation: user login
	 */
	function _valid_user_login()
	{
		$user_username		= $this->input->post('user_username');
		$user_password		= $this->input->post('user_password');
		
		$login = $this->user->login($user_username, $user_password);

		if($login['success'] == 0)
		{
			$msg = $login['msg'];
			$this->form_validation->set_message('_valid_user_login',$msg);

			return FALSE;
		}

	} //end function

	/**
	 * form validation: recaptcha
	 */
	function _valid_recaptcha($val)
	{
	  if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val)) {
	    return TRUE;
	  } else {
	    $this->form_validation->set_message('_valid_recaptcha',$this->lang->line('recaptcha_incorrect_response'));
	    return FALSE;
	  }
	} //end function

	/**
	 * admin login main page
	 */
	function main()
	{
		$this->acl->check();
		$data['template_main'] = array('home');
		$this->load->view($this->admin_folder.'/main',$data);
	} //end function

	/**
	 * logout
	 */
	function logout()
	{
		$this->user->clear_login();
		redirect($this->admin_folder.'/admin/login');
	} //end function
}
?>
