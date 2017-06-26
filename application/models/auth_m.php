<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: bahara
 * Date: 2017-06-15
 * Time: 오전 7:41
 */
class Auth_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function login($auth) {

		$sql ="SELECT user_id, user_name, email FROM users";
		$sql.=" WHERE user_id = '".$auth['user_id']."' AND password = '".$auth['password']."'";
		//echo $sql;
		$query = $this->db->query($sql);

		if ($result = $query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

}
