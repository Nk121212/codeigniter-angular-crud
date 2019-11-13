<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_m extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function get_all(){
    /*$this->db->select('p.*,k.*');
    $this->db->from('produk p');
    $this->db->join('kategori k', 'p.id_kat = k.id_kat', 'INNER');
    $this->db->order_by('p.nm_prod', 'desc');
    return $this->db->get();
    */

    $query = $this->db->query("
      select p.*, k.* from produk p 
      left join kategori k on p.id_kat = k.id_kat
      order by p.nm_prod desc;
    ");

    return $query;

  }

  public function show_all(){
    
    $query = $this->db->query("
      select a.*, b.nama as jk from tes_table a
      left join reff b on a.jenis_kelamin = b.id order by id asc
    ");

    return $query;
  }

  public function insert($data)
  {
    $this->db->insert('produk', $data);
    return TRUE;
  }

  public function update($data)
  {
    $this->db->where(array('id_prod'=>$data['id_prod']));
    $this->db->update('produk', $data);
    return TRUE;
  }

  public function updatein($data){

    $this->db->where(array('id'=>$data['id']));
    $this->db->update('produk', $data);
    return TRUE;

  }

  public function delete($id)
    {
        $this->db->where('id_prod', $id);
        $this->db->delete('produk');
    }

    public function hapus($id){
      $this->db->where('id', $id);
      $this->db->delete('tes_table');
    }
    /*Categories*/
  public function get_categories()
  {
   	$this->db->select('*');
   	$this->db->from('kategori');
    	return $this->db->get();
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