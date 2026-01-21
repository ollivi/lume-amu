<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hashtags extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('hashtag_model');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/admin/header');
		$this->load->view('layouts/admin/menu');
		$this->load->view('layouts/admin/'.$layout, $data);
		$this->load->view('layouts/admin/footer');
	}

	public function hashtag_page()
	{
		$config['base_url'] = base_url('administration/hashtags/page/');
		$config['first_url'] = base_url('administration/hashtags');
		$config['total_rows'] = $this->hashtag_model->count_hashtags();
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);

		$hashtags = $this->hashtag_model->get_hashtags_range($config['per_page'], $this->uri->segment(4));
		$data = array("hashtags" => $hashtags);

		$this->complete_layout($data, "hashtags");
	}

	public function add_hashtag()
	{
		$this->form_validation->set_rules('hashtag', 'hashtag', 'trim|required|max_length[255]');

		if($this->form_validation->run() == TRUE)
		{
			$this->hashtag_model->add_hashtag();
			redirect("administration/hashtags");
		}
		else
		{
			$data['error'] = validation_errors();
			$this->complete_layout($data, "hashtags");
		}
	}

	public function edit_hashtag()
	{
		$this->hashtag_model->edit_hashtag();
		redirect("administration/hashtags");
	}

	public function delete_hashtag()
	{
		$this->hashtag_model->delete("hashtags");
		redirect("administration/hashtags");
	}
}