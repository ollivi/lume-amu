<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->load->model('hashtag_model');
		$this->load->model('revue_model');
	}

	public function article_layout($data = null, $layout)
	{
		$this->load->view('layouts/article/header');
		$this->load->view('layouts/menu', $data);
		$this->load->view($layout, $data);
		$this->load->view('layouts/footer');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/menu', $data);
		$this->load->view($layout, $data);
		$this->load->view('layouts/footer');
	}

	public function index()
	{
		$categories = $this->article_model->get_categories();
		$latest = $this->article_model->get_latest_articles();
		$articles = array();

		foreach($categories as $key => $category)
		{
			$articles["category_".$category->id] = $this->article_model->get_published_articles_by_category("12", $this->uri->segment(4), $category->id);
		}

		$data = array("articles" => $articles, "latest" => $latest, "categories" => $categories);
		$this->complete_layout($data, "articles");
	}

	public function show_article()
	{
		$article = $this->article_model->get_article($this->uri->segment(2));
		$archives = $this->revue_model->get_all();
		$hashtags = $this->hashtag_model->get_article_tags($this->uri->segment(2));
		$categories = $this->article_model->get_categories();
		$comments = $this->article_model->get_comments($this->uri->segment(2));

		$data = array("archives" => $archives, "session" => $this->session->userdata(), "article" => $article, "hashtags" => $hashtags, "categories" => $categories, "comments" => $comments);

		if($data["article"] != null)
			$this->article_layout($data, "layouts/article/article.php");
		else
			redirect("article");
	}

	public function submit_comment()
	{
		$add = $this->article_model->add_comment($this->session->userdata("user_id"));

		if($add)
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_comment()
	{
		if($this->input->post('user_id') == $this->session->userdata("user_id"))
			$this->article_model->delete("commentaires");

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function edit_comment()
	{
		$this->article_model->edit_comment($this->session->userdata("user_id"));
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function search()
	{
		$config['base_url'] = base_url('article/page/');
		$config['first_url'] = base_url('article/page/1');
		$config['total_rows'] = $this->article_model->count_results();
		$config['per_page'] = 5;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);

		$articles = $this->article_model->search($config['per_page'], $this->uri->segment(3));
		$data = array("articles" => $articles);

		$this->complete_layout($data, "search_results");
	}

	public function like_comment()
	{
		echo json_encode($this->article_model->add_like(array("field" => "comment_id", "value" => $this->input->post("comment_id")), $this->session->userdata("user_id"), "commentaire_likes"));
	}

	public function like_article()
	{
		echo json_encode($this->article_model->add_like(array("field" => "article_id", "value" => $this->input->post("article_id")), $this->session->userdata("user_id"), "article_likes"));
	}
}