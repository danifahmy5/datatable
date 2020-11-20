<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatable extends CI_Controller
{
	private $modelDir = 'M_datatable';

	function __construct()
	{
		parent::__construct();

		$this->load->model($this->modelDir, 'functionModel');
	}

	public function index()
	{
		$this->load->view('datatable');
	}

	public function show()
	{
		$dateRange = $this->input->post('dateRange');
		$star 		 = $this->input->post('star');
		$end 			 = $this->input->post('end');

		$list = $this->functionModel->get_datatables($dateRange, $star, $end);
		$data = array();
		$no 	= $_POST['start'];

		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $field->jabatan;
			$row[] = $field->tgl_masuk;
			$row[] = '<button class="btn btn-success btn-sm edit" id=' . $field->id . '>Edit</button>';
			$data[] = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->functionModel->count_all(),
			"recordsFiltered" => $this->functionModel->count_filtered($dateRange, $star, $end),
			"data"            => $data,
		);

		echo json_encode($output); //output dalam format JSON
	}
}
