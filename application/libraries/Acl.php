<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Acl {
	var $table_core_acl 		= 'core_acl';
	var $table_core_module 	= 'core_module';
	var $table_core_user 	= 'core_user';
	var $table_core_group	= 'core_group';
	var $table_core_menu		= 'core_menu';

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('user');
		$this->admin_folder = $this->CI->config->item('admin_folder');
	}
	
	/* generate menu */
	function generate_menu()
	{
		$html_menu 	= '';

		$user 		= $this->CI->user->logged_in_data();
		$user_id 	= $user['user_id'];
		$group_id 	= $user['group_id'];

		if($user_id > 0 && $group_id > 0)
		{
			$this->CI->db->order_by('menu_order');
			$this->CI->db->order_by('module_order');
			$this->CI->db->where('show_on_menu',1);
			$this->CI->db->where('module_enabled',1);
			$this->CI->db->where('group_id',$group_id);
			$this->CI->db->select('menu_title,module_name, access_path');
			$this->CI->db->from($this->table_core_acl);
			$this->CI->db->join($this->table_core_module, $this->table_core_module.'.module_id = '.$this->table_core_acl.'.module_id');
			$this->CI->db->join($this->table_core_menu, $this->table_core_menu.'.menu_id = '.$this->table_core_module.'.menu_id');
			$query 	= $this->CI->db->get();
			$results = $query->result();

			foreach($results as $row)
			{
				$menu[$row->menu_title][$row->module_name] = $row->access_path;
			}

			if(is_array($menu)) {
				foreach($menu as $menu_group=> $menu_list)
				{
					//main menu	
					$html_menu .= '<ul>';	
					$html_menu .= '<li class="mainmenu">'.$menu_group.'</li>';
	
					foreach($menu_list as $module_name=>$access_path)
					{
						//sub menu
						$html_menu .= '<li>'.anchor($this->admin_folder.'/'.$access_path,$module_name).'</li>';
					}
					$html_menu .= '</ul>';
				}
			}

				//add logout
				$html_menu .= '<ul>';
				$html_menu .= '<li>'.anchor($this->admin_folder.'/admin/logout','Log Out').'</li>';
				$html_menu .= '</ul>';
		}
		else
		{
			$html_menu .= '&nbsp;';
		}

		return $html_menu;
	}

	function check()
	{
		$logged_in = $this->CI->user->check_user_login();


		if($logged_in)
		{
			//check user module permission
			$user = $this->CI->user->logged_in_data();
			$access_path = ($this->CI->uri->segment(2).'/'.$this->CI->uri->segment(3));

			$this->CI->db->limit(1);
			$this->CI->db->where('module_enabled',1);
			$this->CI->db->where('access_path',$access_path);
			$this->CI->db->where('group_id',$user['group_id']);
			$this->CI->db->from('core_acl');
			$this->CI->db->join('core_module','core_acl.module_id = core_module.module_id');
			$query = $this->CI->db->get();

			if($query->num_rows() <> 1 && $access_path <> 'admin/main')
			{
				echo 'you are not authorised to access this module';
				exit();
			}
		}
		else
		{
			redirect($this->admin_folder.'/admin/login');
		}
	}
	
}
?>
