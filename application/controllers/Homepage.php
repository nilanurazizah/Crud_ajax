<?php

class Homepage extends CI_Controller{

    // PUBLIC FUNCTION ADMIN
    public function home_admin()
    {
        $data['title'] = "Pengaduan Masyarakat";
        $this->load->view('dashboard_admin',$data);
    }

    // MODEL
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelsistem');
    } 

    // CETAK PDF EXCEL Barang
    public function pdf_preview_barang(){
        $data['model'] = $this->modelsistem->view();
        $this->load->view('v_pdf_preview_barang', $data);
    }
    public function cetak_pdf_barang(){
        ob_start();
        $data['model'] = $this->modelsistem->view();
        $this->load->view('v_pdf_preview_barang',$data);
        $html = ob_get_contents();
                ob_end_clean();
        
        require './assets/html2pdf/autoload.php';

        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
        $pdf->WriteHtml($html);
        $pdf->Output('Data_barang_'.date('d-m-Y').'.pdf','D');
    }
    public function cetak_xls_barang(){
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attacment; filename="Data barang.xls"');
        //set nama file excel nya
        header('Cache-Control: max-age=0');

        $data['model'] = $this->modelsistem->view();
        $this->load->view('v_pdf_preview_barang',$data);
    }
    
    // CRUD AJAX Barang
    
    public function index(){
		$data['model'] = $this->modelsistem->view();
		$this->load->view('data_barang/index_barang', $data);
    }

	public function simpan(){
		if($this->modelsistem->validation("save")){ // Jika validasi sukses atau hasil validasi adalah true
			$this->modelsistem->save(); // Panggil fungsi save() yang ada di modelsistem.php

			// Load ulang view.php agar data yang baru bisa muncul di tabel pada view.php
			$html = $this->load->view('data_barang/view', array('model'=>$this->modelsistem->view()), true);

			$callback = array(
				'status'=>'sukses',
				'pesan'=>'Data berhasil disimpan',
				'html'=>$html
			);
		}else{
			$callback = array(
				'status'=>'gagal',
				'pesan'=>validation_errors()
			);
		}

		echo json_encode($callback);
	}

	public function ubah($id_barang){
		if($this->modelsistem->validation("update")){ // Jika validasi sukses atau hasil validasi adalah true
			$this->modelsistem->edit($id_barang); // Panggil fungsi edit() yang ada di modelsistem.php

			// Load ulang view.php agar data yang baru bisa muncul di tabel pada view.php
			$html = $this->load->view('data_barang/view', array('model'=>$this->modelsistem->view()), true);

			$callback = array(
				'status'=>'sukses',
				'pesan'=>'Data berhasil diubah',
				'html'=>$html
			);
		}else{
			$callback = array(
				'status'=>'gagal',
				'pesan'=>validation_errors()
			);
		}

		echo json_encode($callback);
	}

	public function hapus($id_barang){
		$this->modelsistem->delete($id_barang); // Panggil fungsi delete() yang ada di modelsistem.php

		// Load ulang view.php agar data yang baru bisa muncul di tabel pada view.php
		$html = $this->load->view('data_barang/view', array('model'=>$this->modelsistem->view()), true);
		
		$callback = array(
			'status'=>'sukses',
			'pesan'=>'Data berhasil dihapus',
			'html'=>$html
		);

		echo json_encode($callback);
    }
    

}

?>