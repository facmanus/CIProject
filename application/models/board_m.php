<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: bahara
 * Date: 2017-06-15
 * Time: 오전 7:41
 */
class Board_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function getList($table='board', $type='', $offset='', $limit='', $search_word) {

		$limit_query = $search_query = '';

		// 검색어 쿼리
		if ($search_word != '') {
			$search_query = " WHERE title LIKE '%".$search_word."%' OR contents LIKE '%".$search_word."%'";
		}
		if ($limit != '' || $offset != '') {
			$limit_query = ' LIMIT '.$offset.','.$limit;
		}
		$sql="SELECT * FROM ".$table.$search_query." ORDER BY id DESC". $limit_query;
		//echo $sql;
		$query = $this->db->query($sql);
		//$result = $query->result_array();

		if ($type == 'count') {
			$result = $query->num_rows();
		} else {
			$result = $query->result();
		}

		return $result;
	}

	function getView($table='board', $id) {
		$sql = "UPDATE ".$table. " SET hits=hits+1 WHERE id = '".$id."'";
		$this->db->query($sql);

		$sql = "SELECT * FROM ".$table. " WHERE id = '".$id."'";
		$query = $this->db->query($sql);

		$result = $query->row();

		return $result;
	}

	function insert($arrays) {

		$insert_array = array(
			'pid' => 0,
			'user_id' => $arrays['user_id'],
			'user_name' => $arrays['user_name'],
			'title' => $arrays['title'],
			'contents' => $arrays['contents']
		);

		$result = $this->db->insert($arrays['table'], $insert_array);
		return $result;

	}

	function modify($arrays) {

		$modify_array = array(
			'title' => $arrays['title'],
			'contents' => $arrays['contents']
		);

		$where = array(
			'id' => $arrays['id']
		);


		$result = $this->db->update($arrays['table'], $modify_array, $where);
		return $result;

	}

	function delete($table, $id) {

		$delete_array = array(
			'id' => $id
		);

		$result = $this->db->delete($table, $delete_array);
		return $result;

	}

	function writer_check($table, $id) {

		$sql = "SELECT user_id FROM ".$table. " WHERE id = '".$id."'";
		$query = $this->db->query($sql);

		return $query->row();
	}

	function insert_comment($arrays) {

		$insert_array = array(
			'bid' => $arrays['bid'],
			'user_id' => $arrays['user_id'],
			'user_name' => $arrays['user_name'],
			'contents' => $arrays['contents']
		);

		$result = $this->db->insert($arrays['table'], $insert_array);
		return $result;

	}

	function getCommentsList($table='comments', $id) {

		$sql="SELECT * FROM ".$table." WHERE bid = '".$id."' ORDER BY id DESC";
		//echo $sql;
		$query = $this->db->query($sql);
		return $result = $query->result();
	}
}
