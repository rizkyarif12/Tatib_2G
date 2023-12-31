<?php

class Admin_model
{
    private $table1 = 'dosen';
    private $table2 = 'mahasiswa';
    private $table3 = 'pengaduan';
    private $table4 = 'pelanggaran';
    private $table5 = 'prodi';
    private $table6 = 'riwayat';
    private $table = 'user';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDosen()
    {
        $this->db->query('SELECT * FROM ' . $this->table1);
        return $this->db->resultSet();
    }
    public function getMahasiswa()
    {
        $this->db->query('SELECT  m.nama, m.nim, p.prodi_nama, m.TTL, m.jenis_kelamin, m.phone_ortu, m.alamat, m.user_id, m.mahasiswa_img 
        FROM ' . $this->table2 . ' as m
        JOIN ' . $this->table5 . ' as p ON m.prodi_id = p.prodi_id');
        return $this->db->resultSet();
    }
    public function getLaporanPelanggaran()
    {
        $this->db->query('SELECT p.pengaduan_id, p.status_pengaduan, p.tanggal_pengaduan, d.nama as nama_dosen, m.nama, m.nim, pe.tingkat, pe.pelanggaran
        FROM ' . $this->table3 . ' AS p 
        JOIN ' . $this->table1 . ' AS d ON p.nip = d.nip  
        JOIN ' . $this->table2 . ' AS m ON p.nim = m.nim
        JOIN ' . $this->table4 . ' AS pe ON p.pelanggaran_id = pe.pelanggaran_id');
        return $this->db->resultSet();
    }
    public function getLaporanPelanggaranById($id)
    {
        $this->db->query('SELECT p.pengaduan_id, p.tanggal_pengaduan, p.bukti_pelanggaran, p.catatan, d.nama as nama_dosen, m.nama, m.nim, m.jenis_kelamin, m.no_phone, m.mahasiswa_img, pr.prodi_nama, m.phone_ortu, pe.tingkat, pe.pelanggaran
        FROM ' . $this->table3 . ' AS p 
        JOIN ' . $this->table1 . ' AS d ON p.nip = d.nip  
        JOIN ' . $this->table2 . ' AS m ON p.nim = m.nim
        JOIN ' . $this->table4 . ' AS pe ON p.pelanggaran_id = pe.pelanggaran_id
        JOIN ' . $this->table5 . ' AS pr ON m.prodi_id = pr.prodi_id
        WHERE p.pengaduan_id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getLaporanKompenById($id)
    {
        $this->db->query('SELECT r.riwayat_id, r.bukti_kompen, r.catatan_kompen, p.pengaduan_id, p.tanggal_pengaduan, p.bukti_pelanggaran, p.catatan, d.nama as nama_dosen, m.mahasiswa_img, m.nama as nama_mhs, m.nim, m.jenis_kelamin, m.no_phone, pr.prodi_nama, m.phone_ortu, pe.tingkat, pe.pelanggaran
        FROM ' . $this->table3 . ' AS p 
        JOIN ' . $this->table1 . ' AS d ON p.nip = d.nip  
        JOIN ' . $this->table2 . ' AS m ON p.nim = m.nim
        JOIN ' . $this->table4 . ' AS pe ON p.pelanggaran_id = pe.pelanggaran_id
        JOIN ' . $this->table5 . ' AS pr ON m.prodi_id = pr.prodi_id
        JOIN ' . $this->table6 . ' AS r ON p.pengaduan_id = r.pengaduan_id
        WHERE r.riwayat_id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function hasilLaporanPelanggaran($param, $data)
    {
        if($param == 'terima'){
            $paramResult = 'valid';
            $query1 = "INSERT INTO riwayat(nim, pengaduan_id, status_kompen) VALUES (:nim, :pengaduan_id, :status_kompen)";
            $this->db->query($query1);
            $this->db->bind('nim', $data['nim']);
            $this->db->bind('pengaduan_id', $data['pengaduan_id']);
            $this->db->bind('status_kompen', 'baru');
            $this->db->execute();
        }else if($param == 'tolak'){
            $paramResult = 'tidak valid';
        }
        $query = "UPDATE pengaduan SET status_pengaduan = :status_pengaduan, catatan = :catatan WHERE pengaduan_id = :pengaduan_id";
        $this->db->query($query);
        $this->db->bind('catatan', $data['catatan']);
        $this->db->bind('status_pengaduan', $paramResult);
        $this->db->bind('pengaduan_id', $data['pengaduan_id']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function hasilLaporanKompen($param, $data)
    {
        if($param == 'terima'){
            $paramResult = 'selesai';
        }else if($param == 'tolak'){
            $paramResult = 'ditolak';
        }
        $query = "UPDATE riwayat SET status_kompen = :status_kompen, catatan_kompen = :catatan_kompen WHERE riwayat_id = :riwayat_id";
        $this->db->query($query);
        $this->db->bind('catatan_kompen', $data['catatan_kompen']);
        $this->db->bind('status_kompen', $paramResult);
        $this->db->bind('riwayat_id', $data['riwayat_id']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getLaporanKompen()
    {
        $this->db->query('SELECT r.riwayat_id, r.status_kompen, p.pengaduan_id, r.status_kompen, p.tanggal_pengaduan, d.nama as nama_dosen, m.nama, m.nim, pe.tingkat, pe.pelanggaran
        FROM ' . $this->table3 . ' AS p 
        JOIN ' . $this->table1 . ' AS d ON p.nip = d.nip  
        JOIN ' . $this->table2 . ' AS m ON p.nim = m.nim
        JOIN ' . $this->table4 . ' AS pe ON p.pelanggaran_id = pe.pelanggaran_id
        JOIN '. $this->table6 . ' AS r ON p.pengaduan_id = r.pengaduan_id');
        return $this->db->resultSet();
    }
    public function hitungDosen()
    {
        $this->db->query('SELECT COUNT(nip) as jumlah_dosen FROM dosen');
        return $this->db->single();
    }
    public function hitungMahasiswa()
    {
        $this->db->query('SELECT COUNT(nim) as jumlah_mahasiswa FROM mahasiswa');
        return $this->db->single();
    }
    public function hitungPelanggaran()
    {
        $this->db->query('SELECT COUNT(pelanggaran_id) as jumlah_pelanggaran FROM pelanggaran');
        return $this->db->single();
    }
    public function hitungProdi()
    {
        $this->db->query('SELECT COUNT(prodi_id) as jumlah_prodi FROM prodi');
        return $this->db->single();
    }
    public function laporanTerbaru()
    {
        $this->db->query('SELECT
            m.nama, m.nim, date_format(p.tanggal_pengaduan, "%d %M %Y") as tanggal_pengaduan, pe.pelanggaran, pe.tingkat
        FROM ' . $this->table2 . ' AS m 
        JOIN ' . $this->table3 . ' AS p ON m.nim = p.nim 
        JOIN ' . $this->table4 . ' AS pe ON p.pelanggaran_id = pe.pelanggaran_id
        ORDER BY p.pengaduan_id DESC
        LIMIT 10');
        return $this->db->resultSet();
    }
    public function updatePassword($data)
    {
        $query = 'UPDATE '. $this->table .' SET password = :password WHERE username = :username';
        $pass = (md5($data['newPass']));
        $this->db->query($query);
        $this->db->bind('password', $pass);
        $this->db->bind('username', $data['username']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
