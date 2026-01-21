<?php
class Article_model extends CI_Model
{
	public function __construct()  
	{
		$this->load->database(); 
	}

	public function get_latest_articles()
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, categories.category, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->join('users', 'articles.user_id = users.id');
		$this->db->join('article_categories', 'articles.id = article_categories.article_id');
		$this->db->join('categories', 'article_categories.category_id = categories.id');
		$this->db->where('published', "1");
		$this->db->group_by('articles.id');
		$this->db->order_by('articles.updated_at', 'RANDOM');
		$this->db->limit('3');
		$query = $this->db->get('articles');

		return $query->result();
	}

	public function get_published_articles_by_category($limit, $offset, $category_id = null)
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, categories.id as cat_id, categories.category, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->join('users', 'articles.user_id = users.id');
		$this->db->join('article_categories', 'articles.id = article_categories.article_id');
		$this->db->join('categories', 'article_categories.category_id = categories.id');

		if($category_id != null)
			$this->db->where('article_categories.category_id', $category_id);
		
		$this->db->where('published', "1");
		$this->db->group_by('articles.id');
		$query = $this->db->get('articles', $limit, $offset);

		return $query->result();
	}

	public function get_published_articles($limit, $offset)
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, categories.category, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->join('users', 'articles.user_id = users.id');
		$this->db->join('article_categories', 'articles.id = article_categories.article_id');
		$this->db->join('categories', 'article_categories.category_id = categories.id');
		$this->db->where('published', "1");
		$this->db->group_by('articles.id');
		$query = $this->db->get('articles', $limit, $offset);

		return $query->result();
	}

	public function get_articles_range($limit, $offset)
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->join('users', 'articles.user_id = users.id');
		$query = $this->db->get('articles', $limit, $offset);

		return $query->result();
	}

	public function get_articles_categories($article_id)
	{
		$this->db->select('*');
		$this->db->from('article_categories');
		$this->db->where('article_id', $article_id);
		$query = $this->db->get();

		return $query->result();
	}

	public function count_articles()
	{
		$this->db->select('*');
		$this->db->from('articles');
		$query = $this->db->get();
		$result = $query->result();

		return count($result);
	}

	public function get_article($id)
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, categories.id as cat_id, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->from('articles');
		$this->db->join('article_categories', 'articles.id = article_categories.article_id');
		$this->db->join('categories', 'article_categories.category_id = categories.id');
		$this->db->join('users', 'articles.user_id = users.id');
		$this->db->where('articles.id', $id);
		$this->db->order_by('articles.created_at', 'desc');
		$result = $this->db->get()->result();

		if(!empty($result))
		{
			$this->db->select('*');
			$this->db->where("article_id", $id);
			$query = $this->db->get("article_likes");
			$likes = $query->result();

			$result[0]->likes = $likes;
		}

		return $result;
	}

	public function get_all()
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->from('articles');
		$this->db->join('users', 'articles.user_id = users.id');
		$this->db->order_by('articles.created_at', 'desc');
		$query = $this->db->get();

		return $query->result();
	}

	public function add_article($user_id)
	{
		$data = array(
			'user_id'  => $user_id,
			'header_image'  => $this->input->post('header_image', TRUE),
			'header_title'     => htmlspecialchars($this->input->post('header_title', TRUE)),
			'header_subtitle'  => htmlspecialchars($this->input->post('header_subtitle', TRUE)),
			'text'  => $this->input->post('text'),
			'published'     => $this->input->post('published', TRUE) == 'on' ? '1' : '0',
			);

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->insert('articles', $data);

		$article_id = $this->db->insert_id();
		$data = array("article_id" => $article_id, "category_id" => $this->input->post('category'));

		$this->db->insert('article_categories', $data);

		$hashtags = $this->input->post('hashtags');
		$data = array('article_id' => $article_id);

		if(is_array($hashtags) && !empty($hashtags))
		{
			foreach($hashtags as $key => $hashtag)
			{
				$data['hashtag_id'] = $hashtag;
				$this->db->insert('article_hashtags', $data);
			}
		}

		return true;
	}

	public function edit($id)
	{
		$data = array(
			'header_image'  => $this->input->post('header_image', TRUE),
			'header_title'     => htmlspecialchars($this->input->post('header_title', TRUE)),
			'header_subtitle'  => htmlspecialchars($this->input->post('header_subtitle', TRUE)),
			'text'  => htmlspecialchars($this->input->post('text', TRUE)),
			'published'     => $this->input->post('published', TRUE) == 'on' ? '1' : '0',
			);

		$this->db->where('id', $id);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('articles', $data);

		$data = array("category_id" => $this->input->post('category'));

		$this->db->where('article_id', $id);
		$this->db->where('category_id', $data["category_id"]);
		$this->db->update('article_categories', $data);

		$hashtags = $this->input->post('hashtags');
		$this->db->where('article_id', $id);

		if(is_array($hashtags) && !empty($hashtags))
		{
			foreach($hashtags as $key => $hashtag)
			{
				$this->db->where('hashtag_id', $hashtag);
				$query = $this->db->get('article_hashtags');

				if($query->num_rows() == 0)
					$this->db->insert('article_hashtags', array("article_id" => $id, "hashtag_id" => $hashtag));
			}
		}
	}

	public function delete($table)
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}

	public function get_article_notif()
	{
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where('published', '0');
		$query = $this->db->get();

		return count($query->result());
	}

	public function get_categories()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_categories_range($limit, $offset)
	{
		$query = $this->db->get('categories', $limit, $offset);

		return $query->result();
	}

	public function count_categories()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$query = $this->db->get();
		$result = $query->result();

		return count($result);
	}

	public function add_category()
	{
		$data = array(
			'category'  => htmlspecialchars($this->input->post('category', TRUE)),
			);

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);

		$this->db->insert('categories', $data);

		return true;
	}

	public function edit_category()
	{
		$data = array(
			'category' => htmlspecialchars($this->input->post('category', TRUE)),
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('categories', $data);

		return $this->db->affected_rows();
	}

	public function search($limit = null, $offset = null)
	{
		$this->db->select('*');
		$this->db->like('header_title', $this->input->post("search", TRUE));
		$query = $this->db->get("articles", $limit, $offset);

		return $query->result();
	}

	public function count_results()
	{
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->like('header_title', $this->input->post("search", TRUE));
		$query = $this->db->get();
		$result = $query->result();

		return count($result);
	}

	public function get_comments($article_id)
	{
		$this->db->select('commentaires.id as id, commentaires.user_id, article_id, text, commentaires.created_at, commentaires.updated_at, nom, prenom, email, picture');
		$this->db->from('commentaires');
		$this->db->join('users', 'commentaires.user_id = users.id');
		$this->db->where("article_id", $article_id);
		$result = $this->db->get()->result();

		foreach($result as $key => $row)
		{
			$this->db->select('*');
			$this->db->where("comment_id", $row->id);
			$query = $this->db->get("commentaire_likes");
			$likes = $query->result_array();

			$result[$key]->likes = $likes;
		}

		return $result;
	}

	public function add_comment($user_id)
	{
		$data = array(
			'user_id'  => $user_id,
			'article_id'  => htmlspecialchars($this->input->post('artid', TRUE)),
			'text'  => htmlspecialchars($this->input->post('text', TRUE))
			);

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);

		$this->db->insert('commentaires', $data);

		return true;
	}

	public function edit_comment($user_id)
	{
		$data = array(
			'text'  => htmlspecialchars($this->input->post('text', TRUE))
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->where('user_id', $user_id);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('commentaires', $data);

		return $this->db->affected_rows();
	}

	public function get_comments_by_user_id($user_id)
	{
		$this->db->select('*, commentaires.id, commentaires.text');
		$this->db->from('commentaires');
		$this->db->join('articles', 'articles.id = commentaires.article_id');
		$this->db->where("commentaires.user_id", $user_id);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_articles_by_user_id($user_id)
	{
		$this->db->select('users.id as user_id, nom, prenom, articles.id, header_image, header_title, header_subtitle, text, published, articles.created_at, articles.updated_at');
		$this->db->from('articles');
		$this->db->join('users', 'articles.user_id = users.id');
		$this->db->where("articles.user_id", $user_id);
		$this->db->order_by('articles.created_at', 'desc');
		$query = $this->db->get();

		return $query->result();
	}

	public function add_like($id, $user_id, $table)
	{
		$this->db->select('*')->where($id["field"], $id["value"])->where("user_id", $user_id);
		$check = $this->db->get($table)->result();

		if(count($check) > 0)
		{
			$this->db->where('id', $check[0]->id);
			$this->db->delete($table);
		}
		else
		{
			$data = array(
				$id["field"]	=> $id["value"],
				"user_id"		=> $user_id
				);

			$this->db->set('created_at', 'NOW()', FALSE);
			$this->db->set('updated_at', 'NOW()', FALSE);

			$this->db->insert($table, $data);
		}

		$this->db->where($id["field"], $id["value"]);
		return $this->db->count_all_results($table);
	}
}
?>