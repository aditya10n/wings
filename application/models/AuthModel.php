<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	private $_table = "login";
	const SESSION_KEY = 'user';

	public function login($username, $password)
	{
		$this->db->where('user', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		if (!$user) {
			return FALSE;
		}

		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		$this->session->set_userdata([self::SESSION_KEY => $user->user]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['user' => $user]);
		return $query->row();
	}
}