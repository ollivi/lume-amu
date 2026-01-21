<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanager extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata("logged") || intval($this->session->userdata("role") > 0))
			redirect('connexion');
		
		$this->load->model('user_model');
	}

	public function complete_layout($data = null, $layout)
	{
		$this->load->view('layouts/admin/header');
		$this->load->view('layouts/admin/menu');
		$this->load->view('layouts/admin/'.$layout, $data);
		$this->load->view('layouts/admin/footer');
	}

	public function users()
	{
		$config['base_url'] = base_url('administration/users/page/');
		$config['first_url'] = base_url('administration/users');
		$config['total_rows'] = $this->user_model->count_users();
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'page-link');
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);

		$users = $this->user_model->get_users_range($config['per_page'], $this->uri->segment(4));
		$data = array("users" => $users);
		$this->complete_layout($data, "users");
	}

	public function update_user()
	{
		$users = $this->user_model->get_users();
		$data = array("users" => $users);

		$this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('prenom', 'prénom', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', array("is_unique" => "Un compte ayant cet email existe déjà."));
		$this->form_validation->set_rules('role', 'role', 'trim|required');
		$this->form_validation->set_rules('birthdate', 'date de naissance', 'trim|required');
		$this->form_validation->set_rules('discipline', 'discipline', 'trim|required');
		$this->form_validation->set_rules('study_year', 'année d\'étude', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$update = !$this->user_model->update_user();

			if($update)
				$data["success"] = "L'utilisateur a bien été mis à jour.";
			else
				$data["error"] =  "Aucun élément modifié.";
		}
		else
		{
			$data['error'] = validation_errors();
		}

		$this->complete_layout($data, "users");
	}

	public function delete_user()
	{
		$delete = $this->user_model->delete();
		redirect("administration/users");
	}

	public function create_user()
	{
		$this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('prenom', 'prénom', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]', array("is_unique" => "Un compte ayant cet email existe déjà."));
		$this->form_validation->set_rules('password', 'mot de passe', 'trim|required|matches[password_confirm]|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'de confirmation du mot de passe', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('role', 'role', 'trim|required');
		$this->form_validation->set_rules('birthdate', 'date de naissance', 'trim|required');
		$this->form_validation->set_rules('discipline', 'discipline', 'trim|required');
		$this->form_validation->set_rules('study_year', 'année d\'étude', 'trim|required');

		if($this->form_validation->run() == TRUE)
			$create = $this->user_model->admin_create_user();

		redirect("administration/users");
	}
}