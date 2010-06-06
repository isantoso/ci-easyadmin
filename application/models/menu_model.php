<?php
class Menu_model extends Model {

	var $table_core_menu		= 'core_menu';
	var $table_core_module 	= 'core_module';

	function __construct()
	{
		parent::Model();
	}
	
	/* get all menu */
	function get_all()
	{
		$this->db->order_by('menu_order');
		$query 	= $this->db->get($this->table_core_menu);
		$results = $query->result();

		return $results;
	} //end function

	/* get menu item */
	function get($menu_id)
	{
		$this->db->limit(1);
		$this->db->where('menu_id',$menu_id);
		$query 	= $this->db->get($this->table_core_menu);
		$result 	= $query->row();

		return $result;
	} //end function
	
	/* update menu */
	function update($menu_id)
	{
		$this->db->limit(1);
		$this->db->where('menu_id',$menu_id);
		$this->db->set('menu_title',$this->input->post('menu_title'));
		$this->db->update($this->table_core_menu);

		$flash_message = '<strong>Done!.</strong><br/>';
		$flash_message .= 'Menu Item updated successfully';
		$this->session->set_flashdata('flash_message', $flash_message);

	} //end function

	/* delete menu */
	function delete($menu_id)
	{
		//make sure no modules linked to menu
		$this->db->where('menu_id',$menu_id);
		$query = $this->db->get($this->table_core_module);
		$count = $query->num_rows();	
		
		if($count == 0)
		{
			$this->db->where('menu_id',$menu_id);
			$this->db->delete($this->table_core_menu);
			$flash_message = 'Menu deleted successfully';
		}
		else
		{
			$flash_message = '<strong>Failed to delete menu</strong><br/>';
			$flash_message .= 'There are 1 or more modules linked to this menu';
		}
		
		$this->session->set_flashdata('flash_message', $flash_message);

	} //end function
	
	/* add menu */
	function add()
	{
		$this->db->set('menu_title',$this->input->post('menu_title'));
		$this->db->insert($this->table_core_menu);
		
		$flash_message = '<strong>Done!</strong><br/>';
		$flash_message .= 'New Menu Item has been added successfully';
		$this->session->set_flashdata('flash_message',$flash_message);

	} //end function
	
	/* ajax function to re-order menus and modules */
	function reorder()
	{
		$module_ids = $this->input->post('module_id');
		$menu_ids 	= $this->input->post('menu_id');
		
		//update module order
		if(is_array($module_ids))
		{
			foreach($module_ids as $module_order => $module_id)
			{
				$this->db->limit(1);
				$this->db->where('module_id',$module_id);
				$this->db->set('module_order',$module_order);
				$this->db->update($this->table_core_module);
			}
		}

		//update menu order
		if(is_array($menu_ids))
		{
			foreach($menu_ids as $menu_order => $menu_id )
			{
				$this->db->limit(1);
				$this->db->where('menu_id',$menu_id);
				$this->db->set('menu_order',$menu_order);
				$this->db->update($this->table_core_menu);
			}
		}
	}
}
?>