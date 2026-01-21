<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('encryption');
	}

	public function get_likes($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$comments = $this->db->get("commentaires")->result();
		$comment_likes = 0;

		foreach($comments as $key => $comment)
		{
			$this->db->select('*');
			$this->db->where('comment_id', $comment->id);
			$likes = $this->db->get("commentaire_likes")->result();
			$comment_likes = $comment_likes + count($likes);
		}

		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$articles = $this->db->get("articles")->result();
		$article_likes = 0;

		foreach($articles as $key => $article)
		{
			$this->db->select('*');
			$this->db->where('article_id', $article->id);
			$likes = $this->db->get("article_likes")->result();
			$article_likes = $article_likes + count($likes);
		}

		$result = $comment_likes + $article_likes;

		return $result;
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('users');

		return $this->db->affected_rows();
	}

	public function get_users()
	{
		$this->db->select('id, nom, prenom, email, confirmed, birthdate, study_year, discipline, role, active, created_at, updated_at');
		$query = $this->db->get("users");

		return $query->result();
	}

	public function login($email, $password)
	{
		$this->db->where("email", $email);
		$this->db->where("password", $password);

		$query = $this->db->get("users");

		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				if(!$row->active)
					return "innactive";
				elseif(!$row->confirmed)
					return "unconfirmed";

				$newdata = array(
					'user_id'   => $row->id,
					'nom'  => $row->nom,
					'prenom'  => $row->prenom,
					'email'     => $row->email,
					'role'     => $row->role,
					'logged'    => TRUE,
					);
			}

			$this->session->set_userdata($newdata);
			return true;
		}
		else
		{
			return "error";
		}
	}

	public function user_signup()
	{
		$email = htmlspecialchars($this->input->post('email', TRUE));

		$data = array(
			'nom'  => htmlspecialchars($this->input->post('nom', TRUE)),
			'prenom'  => htmlspecialchars($this->input->post('prenom', TRUE)),
			'email'     => $email,
			'email_verification_code'  => crypt($this->input->post('nom'), "sejzo0zm3kd4kLK3klk1"),
			'confirmed'     => "1",
			'password'  => crypt($this->input->post('password'), "sejzo0zm3kd4kLK3klk1"),
			'birthdate'  => htmlspecialchars($this->input->post('birthdate', TRUE)),
			'study_year'  => htmlspecialchars($this->input->post('study_year', TRUE)),
			'discipline'     => htmlspecialchars($this->input->post('discipline', TRUE)),
			'role'     => "2"
			);

		$email_check = explode("@", $email);

		if($email_check[1] == "etu.univ-amu.fr" || $email_check[1] == "univ-amu.fr")
			$data["active"] = "1";
		else
			$data["active"] = "0";

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->insert('users', $data);

		// $this->send_email($code, $email);

		return true;
	}

	public function admin_create_user()
	{
		$data = array(
			'nom'  => htmlspecialchars($this->input->post('nom', TRUE)),
			'prenom'  => htmlspecialchars($this->input->post('prenom', TRUE)),
			'email'     => htmlspecialchars($this->input->post('email', TRUE)),
			'email_verification_code'  => crypt($this->input->post('nom'), "sejzo0zm3kd4kLK3klk1"),
			'confirmed'     => htmlspecialchars($this->input->post('confirmed', TRUE) == 'on' ? '1' : '0'),
			'active'     => htmlspecialchars($this->input->post('active', TRUE) == 'on' ? '1' : '0'),
			'password'  => crypt($this->input->post('password'), "sejzo0zm3kd4kLK3klk1"),
			'birthdate'  => htmlspecialchars($this->input->post('birthdate', TRUE)),
			'study_year'  => htmlspecialchars($this->input->post('study_year', TRUE)),
			'discipline'     => htmlspecialchars($this->input->post('discipline', TRUE)),
			'role'     => htmlspecialchars($this->input->post('role', TRUE))
			);

		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->insert('users', $data);

		return true;
	}

	public function get_user_by_id($id)
	{
		$this->db->where("id", $id);

		$query = $this->db->get("users");

		return $query->result()[0];
	}

	public function get_users_range($limit, $offset)
	{
		$query = $this->db->get('users', $limit, $offset);

		return $query->result();
	}

	public function update_user()
	{
		$data = array(
			'nom'  => htmlspecialchars($this->input->post('nom', TRUE)),
			'prenom'  => htmlspecialchars($this->input->post('prenom', TRUE)),
			'email'     => htmlspecialchars($this->input->post('email', TRUE)),
			'birthdate'  => htmlspecialchars($this->input->post('birthdate', TRUE)),
			'study_year'  => htmlspecialchars($this->input->post('study_year', TRUE)),
			'discipline'     => htmlspecialchars($this->input->post('discipline', TRUE)),
			'confirmed'     => htmlspecialchars($this->input->post('confirmed', TRUE) == 'on' ? '1' : '0'),
			'active'     => htmlspecialchars($this->input->post('active', TRUE) == 'on' ? '1' : '0'),
			'role'     => htmlspecialchars($this->input->post('role', TRUE))
			);

		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('users', $data);

		return $this->db->affected_rows();
	}

	public function update_info($id)
	{
		$data = array(
			'nom'  => htmlspecialchars($this->input->post('nom', TRUE)),
			'prenom'  => htmlspecialchars($this->input->post('prenom', TRUE)),
			'email'     => htmlspecialchars($this->input->post('email', TRUE)),
			'birthdate'  => htmlspecialchars($this->input->post('birthdate', TRUE)),
			'study_year'  => htmlspecialchars($this->input->post('study_year', TRUE)),
			'discipline'     => htmlspecialchars($this->input->post('discipline', TRUE)),
			);

		$this->db->where('id', $id);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('users', $data);

		return $this->db->affected_rows();
	}

	public function send_email($code, $email)
	{
		$config = Array(
			'protocol' => '',
			'smtp_host' => '',
			'smtp_port' => 25,
			'smtp_user' => '', // change it to yours
			'smtp_pass' => '', // change it to yours
			'mailtype' => 'html',
			'charset' => 'UTF-8',
			'wordwrap' => TRUE
		);

        $this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('inscription@lume-amu.com', "Admin Team");
		$this->email->to($email);  
		$this->email->subject("Email Verification");
		$this->email->message("Bonjour, \nPour activer votre compte LUME veuillez cliquer sur l'url ci-dessous.\n\n ".base_url("/verify/$code")."\n"."\n\nMerci\nAdmin Team");
		$this->email->send();
	}

	function confirm_email($code)
	{
		$this->db->where('email_verification_code', $code);
		$this->db->set('confirmed', '1');
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('users', $data);

		return $this->db->affected_rows();
	}

	public function count_users()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		$result = $query->result();

		return count($result);
	}

	public function get_user_notif()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('active', '0');
		$query = $this->db->get();

		return count($query->result());
	}

	public function update_picture($id, $filename)
	{
		$data = array(
			'picture'     => $filename
			);

		$this->db->where('id', $id);
		$this->db->set('updated_at', 'NOW()', FALSE);
		$this->db->update('users', $data);
	}
}
?>