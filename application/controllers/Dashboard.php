<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('user_model');
		$this->load->model('article_model');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/admin/header');
		$this->load->view('layouts/admin/menu');
		$this->load->view('layouts/admin/'.$layout, $data);
		$this->load->view('layouts/admin/footer');
	}

	public function index()
	{
		$user_notif = $this->user_model->get_user_notif();
		$article_notif = $this->article_model->get_article_notif();
		$data = array("users" => $user_notif, "articles" => $article_notif);

		$this->complete_layout($data, "dashboard");
	}
}