<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\PegawaiModel;

class DashboardController extends BaseController
{
    public function __construct()
    {
        // Load Session
        $this->session = session();

        // Load the database library
        $this->db = \Config\Database::connect();

        // Load a model
        $this->model_absen = new AbsenModel();
        $this->model_pegawai = new PegawaiModel();
    }

    public function index()
    {
        $data['session'] = $this->session;

        if (session()->get('role') == 1) { // Role : Administrator
            $data['title'] = 'Dashboard Administrator';
            $data['getTotalHadirAllPegawaiPerhari'] = $this->model_absen->getTotalHadirAllPegawaiPerhari()[0]->total_data;
            $data['getTotalSakitBelumKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalSakitBelumKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalSakitSudahKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalSakitSudahKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalIzinBelumKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalIzinBelumKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalIzinSudahKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalIzinSudahKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalAlphaAllPegawaiPerhari'] = $this->model_absen->getTotalAlphaAllPegawaiPerhari()[0]->total_data;

            echo view('layout/v_header', $data);
            echo view('layout/v_sidebar');
            echo view('layout/v_navbar');
            echo view('dashboard/dashboard_administrator', $data);
            echo view('layout/v_footer');
        }
        elseif (session()->get('role') == 2) { // Role : Operator
            $data['title'] = 'Dashboard Operator';
            $data['getTotalHadirAllPegawaiPerhari'] = $this->model_absen->getTotalHadirAllPegawaiPerhari()[0]->total_data;
            $data['getTotalSakitBelumKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalSakitBelumKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalSakitSudahKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalSakitSudahKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalIzinBelumKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalIzinBelumKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalIzinSudahKonfirmasiAllPegawaiPerhari'] = $this->model_absen->getTotalIzinSudahKonfirmasiAllPegawaiPerhari()[0]->total_data;
            $data['getTotalAlphaAllPegawaiPerhari'] = $this->model_absen->getTotalAlphaAllPegawaiPerhari()[0]->total_data;

            echo view('layout/v_header', $data);
            echo view('layout/v_sidebar');
            echo view('layout/v_navbar');
            echo view('dashboard/dashboard_operator', $data);
            echo view('layout/v_footer');
        }
        elseif (session()->get('role') == 3) { // Role : Pegawai
            $data['title'] = 'Dashboard Pegawai';
            $data['getPegawaiByIdUser'] = $this->model_pegawai->getPegawaiByIdUser(session()->get('id'));
            $data['code'] = $data['getPegawaiByIdUser'][0]->nomor_induk;
            $data['getTotalKehadiranPegawaiPertahunByNomorInduk'] = $this->model_absen->getTotalKehadiranPegawaiPertahunByNomorInduk($data['code'])[0];
            echo view('layout/v_header', $data);
            echo view('layout/v_sidebar');
            echo view('layout/v_navbar');
            echo view('dashboard/dashboard_pegawai', $data);
            echo view('layout/v_footer');
        }
        else{
            return redirect()->to('/login'); 
        }

        
    }
}
