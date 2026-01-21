<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorie extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('article_model');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/admin/header');
		$this->load->view('layouts/admin/menu');
		$this->load->view('layouts/admin/'.$layout, $data);
		$this->load->view('layouts/admin/footer');
	}

	public function category_page()
	{
		$config['base_url'] = base_url('administration/categories/page/');
		$config['first_url'] = base_url('administration/categories');
		$config['total_rows'] = $this->article_model->count_categories();
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);

		$categories = $this->article_model->get_categories_range($config['per_page'], $this->uri->segment(4));
		$data = array("categories" => $categories);

		$this->complete_layout($data, "categories");
	}

	public function add_category()
	{
		$this->form_validation->set_rules('category', 'category', 'trim|required|max_length[255]');

		if($this->form_validation->run() == TRUE)
		{
			$this->article_model->add_category();
			redirect("administration/categories");
		}
		else
		{
			$data['error'] = validation_errors();
			$this->complete_layout($data, "categories");
		}
	}

	public function edit_category()
	{
		$this->article_model->edit_category();
		redirect("administration/categories");
	}

	public function delete_category()
	{
		$this->article_model->delete("categories");
		redirect("administration/categories");
	}
}