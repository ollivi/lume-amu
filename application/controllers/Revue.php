<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revue extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('revue_model');
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
		$revue = $this->revue_model->get_latest();
		$archives = $this->revue_model->get_all();
		$data = array("archives" => $archives, "file" => $revue, "session" => $this->session->userdata());

		$this->complete_layout($data, "revue");
	}

	public function archive()
	{
		$revue = $this->revue_model->get_revue($this->uri->segment(3));
		$archives = $this->revue_model->get_all();
		$data = array("file" => $revue, "archives" => $archives);

		$this->complete_layout($data, "revue");
	}
}