<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function datatables()
	{
		$anggota = $this->db
			->from('anggota')
			->order_by('urutan')
			->get();
		
		$this->load->view('welcome_datatables', array (
			'anggota' => $anggota,
		));
	}
	
	private function _dt_query()
	{
		$keyword = $_POST['search']['value'];
		
		return $this->db
			->from('anggota')
			->where ("(
				nama LIKE '%{$keyword}%'
				OR tgl_lahir LIKE '%{$keyword}%'
				OR peran LIKE '%{$keyword}%'
				OR pekerjaan LIKE '%{$keyword}%'
			)");
	}
	
	public function post_datatable()
	{
		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		
		$data = $this->_dt_query()
			->order_by($order_by, $order_direction)
			->limit($num_rows, $offset)
			->get();
		
		$count = $this->_dt_query()->count_all_results();
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $data->num_rows(),
			'iTotalDisplayRecords' => $count,
			'aaData' => $data->result_array(),
		);
		
		echo json_encode($response);
	}
}
