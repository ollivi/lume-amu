<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commentmanager extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('comment_model');
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