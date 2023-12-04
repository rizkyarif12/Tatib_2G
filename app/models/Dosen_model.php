<?php

class Dosen_model
{
    private $table = 'dosen';
    private $table2 = 'user';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDosen()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getDosenById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function tambahDataDosen($data){
        $query1 = "INSERT INTO " . $this->table2 . "
                    VALUES
                    ('', :username, :password, :level)";
        $this->db->query($query1);
        $this->db->bind('username',$data['nip']);
        $this->db->bind('password',$data['nip']);
        $this->db->bind('level',2);
        $this->db->execute();

        $query2 = "SELECT * FROM " . $this->table2 . " WHERE username=:username";
        $this->db->query($query2);
        $this->db->bind('username', $data['nip']);
        $res = $this->db->single();
        
        $query3 = "INSERT INTO " . $this->table . "
                VALUES
                (:nip, :nama, :TTL, :jenis_kelamin, :jabatan, :email, :no_phone, :alamat, :user_id)";
        $this->db->query($query3);
        $this->db->bind('nip',$data['nip']);
        $this->db->bind('nama',$data['nama']);
        $this->db->bind('TTL',$data['ttl']);
        $this->db->bind('jenis_kelamin',$data['jenkel']);
        $this->db->bind('jabatan',$data['jabatan']);
        $this->db->bind('email',$data['email']);
        $this->db->bind('no_phone',$data['no_phone']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('user_id', $res['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function hapusDataDosen($id){
        $query = "DELETE FROM dosen WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    // public function ubahDataDosen($data){
    //     $query = "UPDATE tb_dosen SET nama = :nama, nrp = :nrp, email = :email, jurusan = :jurusan WHERE id = :id";
    //     $this->db->query($query);
    //     $this->db->bind('nama',$data['nama']);
    //     $this->db->bind('nrp',$data['nrp']);
    //     $this->db->bind('email',$data['email']);
    //     $this->db->bind('jurusan',$data['jurusan']);
    //     $this->db->bind('id',$data['id']);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }
}