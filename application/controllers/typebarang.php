<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller typebarang
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

class typebarang extends RestController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mtypebarang', 'tbrg');
  }

  public function index_get()
  {
    $id = $this->get('id_typebarang', true);
    if ($id === null) {
      $page = $this->get('page');
      $page = (empty($page) ? 1 : $page);
      $total_data = $this->tbrg->count();
      $total_page = ceil($total_data / 5);
      $start = ($page - 1) * 5;
      $list =  $this->ust->get(null, 5, $start);
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
      $data = $this->tbrg->get($id);
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
      'id_typebarang' => $this->post('id_typebarang', true),
      'nama_barang' => $this->post('nama_barang', true),
      'deskripsi' => $this->post('deskripsi', true)
    ];
    $simpan = $this->tbrg->add($data);
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
      'id_typebarang' => $this->put('id_typebarang', true),
      'nama_barang' => $this->put('nama_barang', true),
      'deskripsi' => $this->put('deskripsi', true)
    ];
    $id = $this->put('id_typebarang');
    if ($id === null) {
      $this->response([
        'status' => false,
        'msg' => 'Masukkan Id_typebarang'
      ], RestController::HTTP_BAD_REQUEST);
    }
    $simpan = $this->tbrg->update($id, $data);
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
    $id = $this->delete('id_typebarang', true);
    if ($id === null) {
      $this->response([
        'status' => false,
        'msg' => 'Masukkan Id_typebarang'
      ], RestController::HTTP_BAD_REQUEST);
    }
    $delete = $this->tbrg->delete($id);
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


/* End of file typebarang.php */
/* Location: ./application/controllers/typebarang.php */