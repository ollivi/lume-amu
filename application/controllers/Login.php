<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		$data = array();

		if(!$this->session->userdata('logged'))
		{
			$this->load->view('connexion');
		}
		else
		{
			redirect('article');
		}
	}

	public function signup_page()
	{
		if(!$this->session->userdata('logged'))
		{
			$this->load->view('inscription');
			$this->load->view('layouts/footer');
		}
		else
		{
			redirect('article');
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = crypt($this->input->post('password'), "sejzo0zm3kd4kLK3klk1");

		$result = $this->user_model->login($email, $password);

		if($result)
		{
			redirect('article');
		}
		else
		{
			$error = array();
			$error["innactive"] = "Ce compte nécéssite d'être activé par un modérateur.";
			$error["unconfirmed"] = "Veuillez confirmer l'activation de votre compte via l'email de confirmation.";
			$error["error"] = "Email ou mot de passe incorrect.";

			$data = array('error' => $error[$result]);
			$this->load->view('connexion', $data);
		}
	}

	public function logout()
	{
		$newdata = array(
			'user_id'   => "",
			'nom'  => "",
			'prenom'  => "",
			'email'     => "",
			'role'     => "",
			'logged'    => FALSE,
			);

		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		redirect('/');
	}

	public function signup()
	{
		$this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('prenom', 'prénom', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]', array("is_unique" => "Un compte ayant cet email existe déjà."));
		$this->form_validation->set_rules('password', 'mot de passe', 'trim|required|matches[password_confirm]|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'de confirmation du mot de passe', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('birthdate', 'date de naissance', 'trim|required');
		$this->form_validation->set_rules('discipline', 'discipline', 'trim|required');
		$this->form_validation->set_rules('study_year', 'année d\'étude', 'trim|required');

		if($this->form_validation->run() == TRUE)
		{
			$try = $this->user_model->user_signup();
			$this->load->view('success');
		}
		else
		{
			$data = array('error' => validation_errors());
			$this->load->view('inscription', $data);
		}
	}

	public function email_confirmation()
	{
		$this->user_model->confirm_email($this->uri->segment(3));
	}
}