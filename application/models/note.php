<?php 
	class Note extends CI_Model
	{
		public function add_note($post)
		{
			$array = array($post['title'], $post['message']);

			$query = "INSERT INTO notes (title, message, created_at, updated_at) 
					  VALUES (?, ?, NOW(), NOW())";

			$this->db->query($query, $array);
			//this is so we can do deletes, this returns the ID of the note we just created!
			return $this->db->insert_id();
		}

		public function get_notes()
		{
			$query = "SELECT * FROM notes";
			return $this->db->query($query)->result_array();
		}

		public function delete_note_by_id($id)
		{
			$query = "DELETE FROM notes WHERE id = {$id}";
			$this->db->query($query);
		}

		public function update_note_by_id($id, $array)
		{
			$query = "UPDATE notes
					  SET message = ?, title = ?
					  WHERE id = {$id}";
			$this->db->query($query, $array);
		}
	}

 ?>