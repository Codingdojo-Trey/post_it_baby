<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function index()
	{
		$this->load->model('note');
		$view_data['notes'] = $this->note->get_notes();
		$this->load->view('notes_view', $view_data);
	}

	public function create()
	{
		$this->load->model('note');
		$id = $this->note->create_note($this->input->post());
		$data = array('id' => $id, 'message' => $this->input->post('message'), 'title' => $this->input->post('title'));
		echo json_encode($data);
	}

	public function delete($id)
	{
		$this->load->model('note');
		$this->note->delete_note($id);
	}

	public function update_title($id, $title)
	{
		$this->load->model('note');
		$this->note->edit_title($id, $title);
	}
	public function update($id)
	{
		$message = $this->input->post('message');
		$this->load->model('note');
		$this->note->edit_note($id, $message);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */