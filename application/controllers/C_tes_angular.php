<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class C_tes_angular extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_tes_angular'));
        }

        public function index()
        {
            $this->data['title']='Angular CRUD Tes';
            $this->load->view('V_tes_angular', $this->data);
        }

        public function tambah(){

            $postdata = json_decode(file_get_contents('php://input'), TRUE);

            if(isset($postdata['ins'])){
                $nama = (isset($postdata['ins']['nama']) ? $postdata['ins']['nama'] : NULL );
                $telp = (isset($postdata['ins']['telp']) ? $postdata['ins']['telp'] : NULL );
                $jenis_kelamin = (isset($postdata['ins']['jenis_kelamin']) ? $postdata['ins']['jenis_kelamin'] : NULL );
            }

            $data = array(
                'nama' => $nama,
                'telp' => $telp,
                'jk' => $jenis_kelamin
            );

            $this->M_tes_angular->tambah($data);

        } 

        public function show(){

            $record = $this->M_tes_angular->show_all()->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($record));

        }

        public function get_jk(){

            $jenis_kelamin = $this->M_tes_angular->show_jk()->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($jenis_kelamin));

        }

        public function updatein(){

            $postdata = json_decode(file_get_contents('php://input'), TRUE);

            if(isset($postdata['ins'])){

                $id = (isset($postdata['ins']['id']) ? $postdata['ins']['id'] : NULL);
                $nama = (isset($postdata['ins']['nama']) ? $postdata['ins']['nama'] : NULL);
                $telp = (isset($postdata['ins']['telp']) ? $postdata['ins']['telp'] : NULL);
                $jenis_kelamin = (isset($postdata['ins']['jenis_kelamin']) ? $postdata['ins']['jenis_kelamin'] : NULL);

                if($id == NULL){

                    http_response_code(400);
                    $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["ID Kosong !"]]));

                }else{

                    $data = array(
                        'id' => $id,
                        'nama' => $nama,
                        'telp' => $telp,
                        'jk' => $jenis_kelamin
                    );

                    $this->M_tes_angular->updatein($data);

                }

            }
        }

        public function hapus(){

            $postdata = json_decode(file_get_contents("php://input"));

            if(isset($postdata) && !empty($postdata)){

                $id = (int)$postdata->id;

                $this->M_tes_angular->hapus($id);

            }

        }


    }

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */