<?php
class Hashtag_model extends CI_Model
{
	public function __construct()  
	{
		$this->load->database(); 
	}

	public function get_articles_hashtags($article_id)
	{
		$this->db->select('*');
		$this->db->from('article_hashtags');
		$this->db->where('article_id', $article_id);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_article_tags($article_id)
	{
		$this->db->select('*');
		$this->db->from('article_hashtags');
		$this->db->join('hashtags', 'article_hashtags.id = hashtags.id');
		$this->db->where('article_id', $article_id);
		$query = $this->db->get();

		return $query->result();
	}

	public function delete($table)
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}

	public function get_hashtags()
	{
		$this->db->select('*');
		$this->db->from('hashtags');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_hashtags_range($limit, $offset)
	{
		$query = $this->db->get('hashtags', $limit, $offset);

		return $query->result();
	}

	public function count_hashtags()
	{
		$this->db->select('*');
		$this->db->from('hashtags');
		$query = $this->db->get();
		$result = $query->result();

		return count($result);
	}

	public function add_hashtag()
	{
		$data = array(
			'hashtag'  => htmlspecialchars($this->input->post('hashtag', TRUE)),
			);

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);

		$this->db->insert('hashtags', $data);

		return true;
	}

	public function edit_hashtag()
	{
		$data = array(
			'hashtag' => htmlspecialchars($this->input->post('hashtag', TRUE)),
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('hashtags', $data);

		return $this->db->affected_rows();
	}
}
?>