<?php 
	class Note extends CI_Model
	{
		public function create_note($post)
		{
			$query = "INSERT INTO notes (title, message, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";
			$array = array($post['title'], $post['message']);
			$this->db->query($query, $array);
		}

		public function edit_note($id, $message)
		{	
			$query = "UPDATE notes SET message = '{$message}' WHERE id = {$id}";
			$this->db->query($query);
		}

		public function edit_title($id, $title)
		{
			$query = "UPDATE notes SET title = '{$title}' WHERE id = {$id}";
			$this->db->query($query);
		}

		public function delete_note($id)
		{
			$query = "DELETE FROM notes WHERE id = $id";
			$this->db->query($query);
		}

		public function get_notes()
		{
			$query = "SELECT * FROM notes";
			return $this->db->query($query)->result_array();
		}

	}


 ?>