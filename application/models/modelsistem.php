<?php
defined('BASEPATH') or exit('No direct script access allowed');

    Class modelsistem extends CI_Model{
    // CRUD AJAX PETUGAS
    public function view(){
		return $this->db->get('barang')->result();
	}

	// Fungsi untuk validasi form tambah dan ubah
	public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya

		// Tambahkan if apakah $mode save atau update
		if($mode == "save")
		$this->form_validation->set_rules('input_nama', 'Nama Barang', 'required');

		$this->form_validation->set_rules('input_harga', 'Harga Barang', 'required');
		$this->form_validation->set_rules('input_stok', 'Stok Barang', 'required');

		if($this->form_validation->run()) // Jika validasi benar
			return true; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return false; // Maka kembalikan hasilnya dengan FALSE
	}

	// Fungsi untuk melakukan simpan data ke tabel barang
	public function save(){
		$data = array(
			"nama_barang" => $this->input->post('input_nama'),
			"harga_barang" => $this->input->post('input_harga'),
			"stok_barang" => $this->input->post('input_stok'),
		);

		$this->db->insert('barang', $data); // Untuk mengeksekusi perintah insert data
	}

	// Fungsi untuk melakukan ubah data barang berdasarkan ID barang
	public function edit($id_barang){
		$data = array(
			"nama_barang" => $this->input->post('input_nama'),
			"harga_barang" => $this->input->post('input_harga'),
			"stok_barang" => $this->input->post('input_stok'),
		);

		$this->db->where('id_barang', $id_barang);
		$this->db->update('barang', $data); // Untuk mengeksekusi perintah update data
	}

	// Fungsi untuk melakukan menghapus data barang berdasarkan ID barang
	public function delete($id_barang){
		$this->db->where('id_barang', $id_barang);
		$this->db->delete('barang'); // Untuk mengeksekusi perintah delete data
    }
    

}    
?>
