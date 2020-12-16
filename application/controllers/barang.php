<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller barang
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller REST
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

use chriskacerguis\RestServer\RestController;

class barang extends RESTController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mbarang', 'brg');
  }

  public function index_get()
  {
    $id = $this->get('id_barang', true);
    if ($id === null) {
      $page = $this->get('page');
      $page = (empty($page) ? 1 : $page);
      $total_data = $this->brg->count();
      $total_page = ceil($total_data / 5);
      $start = ($page - 1) * 5;
      $list =  $this->brg->get(null, 5, $start);
      if ($list) {
        $data = [
          'status' => true,
          'page' => $page,
          'total data' => $total_data,
          'total page' => $total_page,
          'data' => $list
        ];
      } else {
        $data = [
          'status' => false,
          'msg' => 'Data Tidak di Temukan'
        ];
      }

      $this->response($data, RestController::HTTP_OK);
    } else {
      $data = $this->brg->get($id);
      if ($data) {
        $this->response([
          'status' => true,
          'data' => $data
        ], RestController::HTTP_OK);
      } else {
        $this->response([
          'status' => false,
          'msg' => $id . ' Data Tidak di Temukan'
        ], RestController::HTTP_NOT_FOUND);
      }
    }
  }
  public function index_post()
  {
    $data = [
      'id_barang' => $this->post('id_barang', true),
      'jenis_barang' => $this->post('jenis_barang', true),
      'harga' => $this->post('harga', true),
      'id_typebarang' => $this->post('id_typebarang', true),
      'nama_barang' => $this->post('nama_barang', true)
    ];
    $simpan = $this->brg->add($data);
    if ($simpan['status']) {
      $this->response([
        'status' => true,
        'msg' => $simpan['data'] . ' Data Telah di tambahkan'
      ], RestController::HTTP_CREATED);
    } else {
      $this->response([
        'status' => false,
        'msg' => $simpan['msg']
      ], RestController::HTTP_INTERNAL_ERROR);
    }
  }
  public function index_put()
  {
    $data = [
      'id_barang' => $this->put('id_barang', true),
      'jenis_barang' => $this->put('jenis_barang', true),
      'harga' => $this->put('harga', true),
      'id_typebarang' => $this->put('id_typebarang', true),
      'nama_barang' => $this->put('nama_barang', true),
    ];
    $id = $this->put('id_barang');
    if ($id === null) {
      $this->response([
        'status' => false,
        'msg' => 'Masukkan id_barang'
      ], RestController::HTTP_BAD_REQUEST);
    }
    $simpan = $this->brg->update($id, $data);
    if ($simpan['status']) {
      $status = (int)$simpan['data'];
      if ($status > 0) {
        $this->response([
          'status' => true,
          'msg' => $simpan['data'] . ' Data Telah di Rubah'
        ], RestController::HTTP_OK);
      } else {
        $this->response([
          'status' => false,
          'msg' => 'Tidak ada data yang di rubah'
        ], RestController::HTTP_BAD_REQUEST);
      }
    } else {
      $this->response([
        'status' => false,
        'msg' => $simpan['msg']
      ], RestController::HTTP_INTERNAL_ERROR);
    }
  }
  public function index_delete()
  {
    $id = $this->delete('id_barang', true);
    if ($id === null) {
      $this->response([
        'status' => false,
        'msg' => 'Masukkan id_barang'
      ], RestController::HTTP_BAD_REQUEST);
    }
    $delete = $this->brg->delete($id);
    if ($delete['status']) {
      $status = (int)$delete['data'];
      if ($status > 0) {
        $this->response([
          'status' => true,
          'msg' => $delete['data'] . ' Data Telah di Hapus'
        ], RestController::HTTP_OK);
      } else {
        $this->response([
          'status' => false,
          'msg' => 'Tidak ada data yang di hapus'
        ], RestController::HTTP_BAD_REQUEST);
      }
    } else {
      $this->response([
        'status' => false,
        'msg' => $delete['msg']
      ], RestController::HTTP_INTERNAL_ERROR);
    }
  }
}


/* End of file barang.php */
/* Location: ./application/controllers/barang.php */