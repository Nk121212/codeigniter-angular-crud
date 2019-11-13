<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_tes_angular extends CI_Model {

        public function __construct(){
            parent::__construct();
        }

        public function show_all(){

            $query = $this->db->query("
                select a.*, b.nama as jns from tes_table a
                left join reff b on a.jenis_kelamin = b.id order by id asc
            ");

            return $query;
        }

        public function updatein($data){

            $id = $data['id'];
            $nama = $data['nama'];
            $telp = $data['telp'];
            $jk = $data['jk'];

            $this->db->query("
                UPDATE tes_table SET nama = '$nama', telp = '$telp', jenis_kelamin = '$jk' WHERE id = $id
            ");

            return TRUE;

        }

        public function hapus($id){

            $this->db->where('id', $id);
            $this->db->delete('tes_table');

        }

        public function tambah($data){

            $nm = $data['nama'];
            $tlp = $data['telp'];
            $jk = INTVAL($data['jk']);

            $this->db->query("
                INSERT INTO tes_table (nama, telp, jenis_kelamin) VALUES('$nm','$tlp',$jk)
            ");

            return TRUE;

        }

        public function show_jk(){

            $query = $this->db->query("
                SELECT * FROM reff WHERE reff = '98430798339768321' ORDER BY nama ASC;
            ");

            return $query;

        }

    }

/* End of file Product_m.php */
/* Location: ./application/models/Product_m.php */