<?php 
class db extends dbconn {

    public function __construct()
    {
        $this->initDBO();
    }
    
    // -- START -- SELECT
    public function cekMenusUser($username,$id_menus)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "SELECT
                      tbl_users_menus.*,
                      tbl_menus.nama_menus,
                      tbl_menus.keterangan,
                      tbl_menus.status 
                    FROM
                      tbl_users_menus
                      INNER JOIN tbl_menus ON tbl_users_menus.id_menus = tbl_menus.id_menus
                    WHERE
                      tbl_users_menus.username = :username AND tbl_users_menus.id_menus = :id_menus AND tbl_menus.status = 'a' 
                    ";
            $stmt = $db->prepare($query);
            $stmt->bindParam("username",$username);
            $stmt->bindParam("id_menus",$id_menus);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stat[2] = $stmt->rowCount();
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = $ex->getMessage();
            $stat[2] = [];
            return $stat;
        }
    }

    public function getReferensi($kode,$item)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "SELECT * FROM tbl_referensi WHERE kode = :kode AND item = :item";
            $stmt = $db->prepare($query);
            $stmt->bindParam("kode",$kode);
            $stmt->bindParam("item",$item);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stat[2] = $stmt->rowCount();
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = $ex->getMessage();
            $stat[2] = [];
            return $stat;
        }
    }

    public function getReferensiByKode($kode)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "SELECT * FROM tbl_referensi WHERE kode = :kode AND status = 'a'";
            $stmt = $db->prepare($query);
            $stmt->bindParam("kode",$kode);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stat[2] = $stmt->rowCount();
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = $ex->getMessage();
            $stat[2] = [];
            return $stat;
        }
    }

    public function getTable($kriteria)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "SELECT * FROM tbl_kode WHERE id LIKE '%$kriteria%' OR nama LIKE '%$kriteria%' OR alamat LIKE '%$kriteria%' ORDER BY nama ASC LIMIT 100";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stat[2] = $stmt->rowCount();
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = $ex->getMessage();
            $stat[2] = [];
            return $stat;
        }
    }

    public function getDataById($id)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "SELECT * FROM tbl_kode WHERE id = :id  LIMIT 1";
            $stmt = $db->prepare($query);
            $stmt->bindParam("id",$id);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stat[2] = $stmt->rowCount();
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = $ex->getMessage();
            $stat[2] = [];
            return $stat;
        }
    }
    // -- END -- SELECT

    // -- START -- DELETE
    public function delete($id)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "DELETE FROM tbl_kode WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam("id",$id);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = "HAPUS!";
            $stat[2] = "Data berhasil dihapus.";
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = "HAPUS!";
            $stat[2] = $ex->getMessage();
            return $stat;
        }
    }
    // -- END -- DELETE

    // -- START -- CREATE
    public function create($nama,$alamat)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "INSERT INTO tbl_kode (nama, alamat) VALUES (:nama, :alamat)";
            $stmt = $db->prepare($query);
            $stmt->bindParam("nama",$nama);
            $stmt->bindParam("alamat",$alamat);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = "TAMBAH!";
            $stat[2] = "Data berhasil ditambahkan.";
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = "TAMBAH!";
            $stat[2] = $ex->getMessage();
            return $stat;
        }
    }
    // -- END -- CREATE

    // -- START -- UPDATE
    public function update($id,$nama,$alamat)
    {
        $db = $this->dblocal;
        try
        {   
            $query = "UPDATE tbl_kode SET nama = :nama, alamat = :alamat WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam("id",$id);
            $stmt->bindParam("nama",$nama);
            $stmt->bindParam("alamat",$alamat);
            $stmt->execute();
            $stat[0] = true;
            $stat[1] = "EDIT!";
            $stat[2] = "Data berhasil dirubah.";
            return $stat;
        }
        catch(PDOException $ex)
        {
            $stat[0] = false;
            $stat[1] = "EDIT!";
            $stat[2] = $ex->getMessage();
            return $stat;
        }
    }
    // -- END -- UPDATE

}