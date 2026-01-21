<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articlemanager extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('article_model');
		$this->load->model('hashtag_model');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/admin/header');
		$this->load->view('layouts/admin/menu');
		$this->load->view('layouts/admin/'.$layout, $data);
		$this->load->view('layouts/admin/footer');
	}

	public function article_list()
	{
		$config['base_url'] = base_url('administration/articles/page/');
		$config['first_url'] = base_url('administration/articles');
		$config['total_rows'] = $this->article_model->count_articles();
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);

		$articles = $this->article_model->get_articles_range($config['per_page'], $this->uri->segment(4));
		$data = array("articles" => $articles);

		$this->complete_layout($data, "articles");
	}

	public function article_creation_page()
	{
		$hashtags = $this->hashtag_model->get_hashtags();
		$categories = $this->article_model->get_categories();
		$files = get_filenames(APPPATH."../public/uploads");
		$data = array("hashtags" => $hashtags, "files" => $files, "categories" => $categories);
		$this->complete_layout($data, "article_creation");
	}

	public function create_article()
	{
		$this->form_validation->set_rules('header_title', 'header_title', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('header_subtitle', 'header_subtitle', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('text', 'text', 'required');

		if($this->form_validation->run() == TRUE)
		{
			$this->article_model->add_article($this->session->userdata("user_id"));
			redirect("administration/articles");
		}
		else
		{
			$hashtags = $this->hashtag_model->get_hashtags();
			$categories = $this->article_model->get_categories();
			$files = get_filenames(APPPATH."../public/uploads");
			$data = array('error' => validation_errors(), 'hashtags' => $hashtags, "categories" => $categories, "files" => $files);

			$this->complete_layout($data, "article_creation");
		}
	}

	public function edit_article_page()
	{
		$article = $this->article_model->get_article($this->uri->segment(4));
		$files = get_filenames(APPPATH."../public/uploads");
		$all_hashtags = $this->hashtag_model->get_hashtags();
		$categories = $this->article_model->get_categories();
		$selected_hashtags = $this->hashtag_model->get_articles_hashtags($this->uri->segment(4));
		$selected = array();

		foreach ($selected_hashtags as $key => $object)
		{
			$selected[] = $object->hashtag_id;
		}

		$data = array("article" => $article, "hashtags" => $all_hashtags, "selected" => $selected, "files" => $files, "categories" => $categories);

		if($data["article"] != null)
			$this->complete_layout($data, "article_edition");
		else
			redirect("administration/articles");
	}

	public function edit_article()
	{
		$this->article_model->edit($this->uri->segment(4));
		redirect("administration/articles");
	}

	public function delete_article()
	{
		$this->article_model->delete("articles");
		redirect("administration/articles");
	}
}