<?php 
defined('BASEPATH') OR wait('No direct script access allowed'); 

class Spp extends CI_Controller
{
	public function __construct()
	{
		parent :: __construct();
		$this->load->model("Spp_model");
		$this->load->library('form_validation');
		$this->load->helper('rupiah_helper'); 
	}

	public function index()
	{
		if($this->session->userdata('akses')=='admin' || $this->session->userdata('akses')=='petugas')
		{
			$data["spp"] = $this->Spp_model->getAll();
			$this->load->view("admin/spp_view/list", $data);

		}
		else
		{
			echo "Anda tidak berhak mengakses halaman ini";
		}
	}

	public function add()
	{
		if($this->session->userdata('akses')=='admin' || $this->session->userdata('akses')=='petugas')
		{
			$spp = $this->Spp_model;
			$validation = $this->form_validation;
			$validation->set_rules($spp->rules());

			if($validation->run()){
				$spp->save();
				$this->session->set_flashdata('success', 'Berhasil disimpan');
			}

			$this->load->view("admin/spp_view/new_form");
		}
		else
		{
			echo "Anda tidak berhak mengakses halaman ini";
		}
	}

	public function edit($id = null)
	{
		if(!isset($id)) redirect('admin/spp');

		$spp = $this->Spp_model;
		$validation = $this->form_validation;
		$validation->set_rules($spp->rules());

		if ($validation->run()) {
			$spp->update();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect(site_url('admin/spp'));
		}

		$data["spp"] = $spp->getById($id);
		if (!$data["spp"]) show_404();

		$this->load->view("admin/spp_view/edit_form", $data);

	}


	public function delete($id=null)
	{
		if (!isset($id)) show_404();

		if ($this->Spp_model->delete($id))
		{
			redirect(site_url('admin/spp'));
		}
	}

	public function cetak()
	{
		// load view yang akan digenerate atau diconvert
		// contoh kita akan membuat pdf dari halaman welcome
		// codeigniter

		$data[spp] = $this->Spp_model->getAll();
		$this->load->view("admin/spp_view/cetak", $data);
		//dapatkan output html

		$html = $this->output->get_output();

		// panggil library dompdf
		$this->load->library('dompdf_gen');

		//convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();

		//untuk menampilkan preview pdf
		$this->dompdf->stream("welcome.pdf", array('attachment' => 0));
		//atau jika tidak ingin ditampilkan preview dihalaman browser
		//$this->dompdf->stream("welcome.pdf");
	}
}

 ?>