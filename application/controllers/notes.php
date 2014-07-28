<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function index()
	{	
		$this->load->model('note');
		$view_data['notes'] = $this->note->get_notes();
		$this->load->view('index_view', $view_data);
	}

	public function create()
	{
		//call the model
		$this->load->model('note');
		//invoke the model function
		$id = $this->note->add_note($this->input->post());
		//prep data for Ajax call!
		$array = array('title' => $this->input->post('title'),
						'message' => $this->input->post('message'), 
						'id' => $id);
		echo json_encode($array);
	}

	public function delete($id)
	{
		$this->load->model('note');
		$this->note->delete_note_by_id($id);
	}

	public function update($id)
	{
		$this->load->model('note');
		$array = array($this->input->post('message'), $this->input->post('title'));
		$this->note->update_note_by_id($id, $array);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */