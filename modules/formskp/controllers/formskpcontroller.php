<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Formskpcontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->ion_auth->check_uri_permissions(); 
        $this->load->model('Skpmodel', 'skpmodel');
    } 
    public function index( ) {
        $data['listgol'] = $this->skpmodel->getallgolongan();
        $data['listeselon'] = $this->skpmodel->geteselon(); 
        $this->template->load('mainlayout', 'index', $data);
    }

    

    public function caripegjson() {
        $golongan = $this->input->post('golongan');
        $eselon = $this->input->post('eselon');
        $jabatan = $this->input->post('jabatan');
        $instansi = $this->input->post('instansi');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $struk = $this->input->post('struk');
        $fu = $this->input->post('fu');
        $ft = $this->input->post('ft');
//----
        $pendidikan = $this->input->post('pendidikan');
        $jeniskelamin = $this->input->post('kelamin');
        $agama = $this->input->post('agama');
        $usia = $this->input->post('usia');

        $arr["sEcho"] = $this->input->post('sEcho');
        $banyak = $this
                ->skpmodel
                ->getbanyakpencarianpegawai($struk, $fu, $ft, $instansi, null, $golongan, $pendidikan, $jeniskelamin, $agama, null, $eselon, $nip, $nama, $usia, null, null, null, $jabatan);

        $arr["iTotalRecords"] = $banyak;
        $arr["iTotalDisplayRecords"] = $banyak;


        $arr["aaData"] = $this
                ->skpmodel
                ->getlistpencarianpegawai($struk, $fu, $ft, $instansi, null, $golongan, $pendidikan, $jeniskelamin, $agama, null, $eselon, $this->input->post('iSortCol_0'), $this->input->post('sSortDir_0'), $nip, $nama, $this->input->post('iDisplayLength'), $this->input->post('iDisplayStart'), $usia, null, null, null, $jabatan);
        echo json_encode($arr);
    }

    public function detailpersonil($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
         $data['ketbadan'] = $this->personilmodel->getketbadanpegawaibyidpeg($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'detailpersonil', $data);
    }

    public function detailpendforpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatpenforpegawai($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatpendidikan', $data);
    }

    public function detailpendnonforpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatpennonformalpegawai($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatpendidikannonformal', $data);
    }

    public function detaildiklatfungpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatdiklatpegawai($idpegawai, "diklat_fungsional_id");
        $this->template->load('mainlayoutdetailpeg', 'riwayatdiklatfungsional', $data);
    }

    public function detaildiklatstrukgpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatdiklatstrukturalpegawai($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatdiklatstruktural', $data);
    }

    public function detaildiklattekgpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatdiklatpegawai($idpegawai, "diklat_teknis_id");
        $this->template->load('mainlayoutdetailpeg', 'riwayatdiklatteknis.php', $data);
    }

    public function detailrpangkatpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatpangkatpegawai($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatkepangkatan', $data);
    }

    public function detailrjabatanpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatjabatanpegawai($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatjabatan', $data);
    }

    public function detailrpenghargaanpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatpenghargaan($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatpenghargaan', $data);
    }

    public function detailranakpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayat($idpegawai, '1');
        $this->template->load('mainlayoutdetailpeg', 'detailriwayatanak', $data);
    }

    public function detailriwayatortu($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayat($idpegawai, '3');
        $this->template->load('mainlayoutdetailpeg', 'detailriwayatortu', $data);
    }

    public function detailriwayatistri($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayat($idpegawai, '4');
        $this->template->load('mainlayoutdetailpeg', 'pegawai/detailriwayatistri', $data);
    }

    public function detailriwayatsaudara($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayat($idpegawai, '2');
        $this->template->load('mainlayoutdetailpeg', 'detailriwayatsaudara', $data);
    }

    public function detailriwayathukuman($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['pendfor'] = $this->personilmodel->getdatariwayatdisiplinpegawai($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'detailriwayathukuman', $data);
    }

    public function detailriwayatorganisasi($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['org'] = $this->personilmodel->getdatariwayatorganisasi($idpegawai);
        $this->template->load('mainlayoutdetailpeg', 'riwayatorganisasi', $data);
    }

    public function detailketbadanpegawai($idjenis, $idpegawai) {
        $data['jenisjabatan'] = $idjenis;
        $data['peg'] = $this->personilmodel->getdatapegawaidetail($idpegawai);
        $data['ketbadan'] = $this->personilmodel->getketbadanpegawaibyidpeg($idpegawai);
        $data['peg_id'] = $idpegawai;
        $this->template->load('mainlayoutdetailpeg', 'riwayatcirifisik', $data);
    }

}
