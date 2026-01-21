<?php
class Revue_model extends CI_Model
{
	public function __construct()  
	{
		$this->load->database(); 
	}

	public function add($name)
	{
		$data = array(
			'file_name'  => $name,
			);

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->insert('revues', $data);

		return true;
	}

	public function get_revue($id)
	{
		$this->db->select('*');
		$this->db->from('revues');
		$this->db->where('id', $id);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();

		return $query->first_row();
	}

	public function get_latest()
	{
		$this->db->select('*');
		$this->db->from('revues');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();

		return $query->first_row();
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete("revues");
	}

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from('revues');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();

		return $query->result();
	}
}
?>