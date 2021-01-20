<?php 
class prosesCrud {

    protected $db;
    function __construct($db){
        $this->db = $db;
    }

    function proses_login($user,$pass)
    {
        // untuk password kita enkrip dengan md5
        $row = $this->db->prepare('SELECT * FROM tbl_user WHERE username=? AND password=md5(?)');
        $row->execute(array($user,$pass));
        $count = $row->rowCount();
        if($count > 0)
        {
            return $hasil = $row->fetch();
        }else{
            return 'gagal';
        }
    }

    // variable $tabel adalah isi dari nama table database yang ingin ditampilkan

    function tampil_data($tabel)
    {
        $row = $this->db->prepare("SELECT * FROM $tabel");
        $row->execute();
        return $hasil = $row->fetchAll();
    }

    // variable $tabel adalah isi dari nama table database yang ingin ditampilkan
    // variable where adalah isi kolom tabel yang mau diambil
    // variable id adalah id yang mau di ambil
    
    function tampil_data_id($tabel,$where,$id)
    {
        $row = $this->db->prepare("SELECT * FROM $tabel WHERE $where = ?");
        $row->execute(array($id));
        return $hasil = $row->fetch();
    }

    function tambah_data($tabel,$data)
    {
        // buat array untuk isi values insert sumber kode 
        // http://thisinterestsme.com/pdo-prepared-multi-inserts/
        $rowsSQL = array();
        // buat bind param Prepared Statement
        $toBind = array();
        // list nama kolom
        $columnNames = array_keys($data[0]);
        // looping untuk mengambil isi dari kolom / values
        foreach($data as $arrayIndex => $row){
            $params = array();
            foreach($row as $columnName => $columnValue){
                $param = ":" . $columnName . $arrayIndex;
                $params[] = $param;
                $toBind[$param] = $columnValue;
            }
            $rowsSQL[] = "(" . implode(", ", $params) . ")";
        }
        $sql = "INSERT INTO $tabel (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);
        $row = $this->db->prepare($sql);
        //Bind our values.
        foreach($toBind as $param => $val){
            $row ->bindValue($param, $val);
        }
        //Execute our statement (i.e. insert the data).
        return $row ->execute();
    }

    function edit_data($tabel,$data,$where,$id)
    {
        // sumber kode 
        // https://stackoverflow.com/questions/23019219/creating-generic-update-function-using-php-mysql
        $setPart = array();
        foreach ($data as $key => $value)
        {
            $setPart[] = $key."=:".$key;
        }
        $sql = "UPDATE $tabel SET ".implode(', ', $setPart)." WHERE $where = :id";
        $row = $this->db->prepare($sql);
        //Bind our values.
        $row ->bindValue(':id',$id); // where
        foreach($data as $param => $val)
        {
            $row ->bindValue($param, $val);
        }
        return $row ->execute();
    }

    function hapus_data($tabel,$where,$id)
    {
        $sql = "DELETE FROM $tabel WHERE $where = ?";
        $row = $this->db->prepare($sql);
        return $row ->execute(array($id));
    }


}
        