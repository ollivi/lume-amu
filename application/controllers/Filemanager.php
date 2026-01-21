<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('revue_model');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/admin/header');
		$this->load->view('layouts/admin/menu');
		$this->load->view('layouts/admin/'.$layout, $data);
		$this->load->view('layouts/admin/footer');
	}

	public function file_manager_page($error = null)
	{
		$files = get_filenames(APPPATH."../public/uploads");
		$data = array("files" => $files);

		if($error != null)
			$data['error'] = $error;

		$this->complete_layout($data, "file_manager");
	}

	public function file_manager_delete()
	{
		$file = $this->input->post('file_name', TRUE);

		if(file_exists(APPPATH."../public/uploads/".$file))
			unlink(APPPATH."../public/uploads/".$file);
		
		redirect("administration/file-manager");
	}

	public function revue_manager_page($error = null)
	{
		$files = $this->revue_model->get_all();
		$data = array("files" => $files);

		if($error != null)
			$data['error'] = $error;

		$this->complete_layout($data, "revue_manager");
	}

	public function revue_manager_delete()
	{
		$file = $this->input->post('file_name', TRUE);

		if(file_exists(APPPATH."../public/revue/".$file))
			unlink(APPPATH."../public/revue/".$file);
		
		$this->revue_model->delete();

		redirect("administration/revue-manager");
	}

	public function upload()
	{
		$config['upload_path']          = './public/uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['encrypt_name'] 		= TRUE;
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_upload'))
		{
			$this->file_manager_page($this->upload->display_errors());
		}
		else
		{
			redirect("administration/file-manager");
		}
	}

	public function upload_revue()
	{
		$config['upload_path']          = './public/revue/';
		$config['allowed_types']        = 'pdf';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file_upload'))
		{
			$this->revue_manager_page($this->upload->display_errors());
		}
		else
		{
			$this->revue_model->add($this->upload->file_name);
			redirect("administration/revue-manager");
		}
	}
}