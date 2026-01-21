<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged"))
			redirect('connexion');

		$this->load->model('user_model');
		$this->load->model('article_model');
		$this->load->model('hashtag_model');
	}

	public function complete_layout($data, $layout)
	{
		$this->load->view('layouts/compte/header');
		$this->load->view('layouts/menu', $data);
		$this->load->view($layout, $data);
		$this->load->view('layouts/footer');
	}

	public function index($error = null)
	{
		$user = $this->user_model->get_user_by_id($this->session->userdata("user_id"));
		$comments = $this->article_model->get_comments_by_user_id($this->session->userdata("user_id"));
		$articles = $this->article_model->get_articles_by_user_id($this->session->userdata("user_id"));
		$likes = $this->user_model->get_likes($this->session->userdata("user_id"));
		$year = array("L1" => "License 1", "L2" => "License 2", "L3" => "License 3",
					"M1" => "Master 1", "M2" => "Master 2", "doctorant" => "Doctorant", "other" => "Autres");
		$data = array("session" => $this->session->userdata(), "user" => $user, "year" => $year, "articles" => $articles, "comments" => $comments, "likes" => $likes);

		if($error != null)
			$data["error"] = $error;

		$this->complete_layout($data, "compte");
	}

	public function article_creation_page()
	{
		$hashtags = $this->hashtag_model->get_hashtags();
		$categories = $this->article_model->get_categories();
		$files = get_filenames(APPPATH."../public/uploads");
		$data = array("hashtags" => $hashtags, "files" => $files, "categories" => $categories);
		$this->complete_layout($data, "layouts/compte/submit_article");
	}

	public function create_article()
	{
		$this->form_validation->set_rules('header_title', 'header_title', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('header_subtitle', 'header_subtitle', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('text', 'text', 'required');

		if($this->form_validation->run() == TRUE)
		{
			$this->article_model->add_article($this->session->userdata("user_id"));
			redirect("mon-compte");
		}
		else
		{
			$hashtags = $this->hashtag_model->get_hashtags();
			$categories = $this->article_model->get_categories();
			$files = get_filenames(APPPATH."../public/uploads");
			$data = array('error' => validation_errors(), 'hashtags' => $hashtags, "categories" => $categories, "files" => $files);
			
			$this->complete_layout($data, "layouts/compte/submit_article");
		}
	}

	public function edit_article_page()
	{
		$article = $this->article_model->get_article($this->uri->segment(4));

		if($article[0]->user_id != $this->session->userdata("user_id"))
			redirect("mon-compte");

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
			$this->complete_layout($data, "layouts/compte/edit_article");
		else
			redirect("mon-compte");
	}

	public function edit_article()
	{
		$this->article_model->edit($this->uri->segment(5));
		redirect("mon-compte");
	}

	public function edit_info()
	{
		$this->user_model->update_info($this->session->userdata("user_id"));
		redirect("mon-compte");
	}

	public function upload()
	{
		$user = $this->user_model->get_user_by_id($this->session->userdata("user_id"));

		if(!is_dir(APPPATH."../public/profils/".$user->picture) && file_exists(APPPATH."../public/profils/".$user->picture))
			unlink(APPPATH."../public/profils/".$user->picture);

		$config['upload_path']          = './public/profils/';
		$config['allowed_types']        = 'jpg|png';
		$ext 							= explode(".", $_FILES["picture"]['name'])[1];
		$config['file_name'] 			= $this->session->userdata("user_id").".".$ext;
		$config['max_size']             = 2048;
		$config['max_width']            = 170;
		$config['max_height']           = 150;

		$this->upload->initialize($config);

		if($this->upload->do_upload('picture'))
		{
			$this->user_model->update_picture($this->session->userdata("user_id"), $config['file_name']);
			redirect("mon-compte");
		}
		else
		{
			$error = $this->upload->display_errors();

			$this->index($error);
		}
	}
}