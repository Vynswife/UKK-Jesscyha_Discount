<?php

namespace App\Models;
use CodeIgniter\Model;

class M_burger extends Model
{
    protected $table = 'photos'; // Change to your actual photos table name
    protected $primaryKey = 'id_';

    // Define the fields you want to work with
    protected $allowedFields = ['title', 'description', 'file_path', 'created_at'];

public function get_item_by_id($id_user) {
    return $this->db->table('user')
                    ->select('harga, diskon')
                    ->where('id_user', $id_user)
                    ->get()
                    ->getRowArray();
}
public function getUserById($id_user)
{
    return $this->db->table('user') // Pastikan nama tabel benar
        ->where('id_user', $id_user)
        ->get()
        ->getFirstRow('array'); // Mengembalikan data dalam bentuk array
}


public function getLatestPhotos() {
    return $this->db->table('foto')
                    ->select(' judul, deskripsi, tanggal_buat, lokasi')
                    ->orderBy('tanggal_buat', 'DESC')  // Optional: to get the latest photos
                    ->where('status', 'aktif')
                    ->limit(4) // Optional: to limit the number of photos shown
                    ->get()
                    ->getResultArray();
}

public function getRecentData($table, $columns = '*', $where = [], $order = [], $limit = null)
{
    $db = \Config\Database::connect();
    $query = $db->table($table)->select($columns);

    // Tambahkan kondisi WHERE jika ada
    if (!empty($where)) {
        $query->where($where);
    }

    // Tambahkan urutan data jika ada
    if (!empty($order)) {
        foreach ($order as $column => $direction) {
            $query->orderBy($column, $direction);
        }
    }

    // Batasi jumlah data jika ada
    if ($limit !== null) {
        $query->limit($limit);
    }

    return $query->get()->getResultArray();
}


public function getRecentNotifications($limit = 5) {
    return $this->db->table('notification')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
}
public function getRecentJadwal($limit = 7)
{
    return $this->db->table('jadwal as j')
                    ->select('j.id_jadwal, j.nama_jadwal, j.waktu_mulai, j.waktu_selesai, e.nama_event')
                    ->join('pilih as p', 'j.id_event = p.id_event', 'inner')
                    ->join('events as e', 'j.id_event = e.id_event', 'inner')
                    ->orderBy('j.waktu_mulai', 'ASC') // Menampilkan jadwal dari waktu mulai terdekat
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
}

// M_burger.php (Model)
public function getCurrentDaySchedules()
{
    return $this->db->table('jadwal as j')
                    ->select('j.id_jadwal, j.nama_jadwal, j.waktu_mulai, j.waktu_selesai, j.ringtone, e.nama_event')
                    ->join('pilih as p', 'p.id_event = j.id_event', 'inner')
                    ->join('events as e', 'j.id_event = e.id_event', 'inner')
                    ->orderBy('j.waktu_mulai', 'ASC')
                    ->get()
                    ->getResultArray();
}




// Contoh fungsi tampil di Model M_burger
public function tampilbycreate($table, $joinTable, $onCondition, $where = [], $order_by = '')
{
    $builder = $this->db->table($table)
                        ->join($joinTable, $onCondition); // Join dengan tabel lain
    
    if (!empty($where)) {
        $builder->where($where);
    }
    
    if (!empty($order_by)) {
        $builder->orderBy($order_by);
    }
    
    return $builder->get()->getResult();
}


public function insertID()
    {
        return $this->db->insertID();
    }

public function history_orders() {
    $id_user = $this->session->userdata('id_user');
    $data['orders'] = $this->order_model->get_orders_by_user($id_user);
    $this->load->view('order_history', $data);
}

public function getCount($table)
{
    return $this->db->table($table)->countAllResults();
}

public function isPhotoLikedByUser($idFoto, $idUser)
{
    return $this->db->table('likes')
        ->where('id_foto', $idFoto)
        ->where('id_user', $idUser)
        ->countAllResults() > 0; // Return true if the user has liked the photo
}

public function getLikeCountByPhoto($idFoto)
{
    return $this->db->table('likes')
        ->where('id_foto', $idFoto)
        ->countAllResults(); // Count total likes for the photo
}


public function getDokumenCount()
{
    return $this->db->table('surat_k')->countAllResults();
}
    public function getWherepol($table, $conditions)
    {
        // Ensure the table is valid
        if (!$this->db->tableExists($table)) {
            throw new \Exception("Table does not exist: $table");
        }

        // Build the query with the given conditions
        return $this->db->table($table)->where($conditions)->get()->getResult();
    }
    
public function tampil($org)
    {
        return $this->db->table($org)->get()->getResult();
    }

public function tampil_kategori($table, $where = [], $orderBy = null)
{
    $query = $this->db->table($table);

    // Tambahkan kondisi filter jika ada
    if (!empty($where)) {
        $query->where($where);
    }

    // Tambahkan sorting jika diberikan
    if (!empty($orderBy)) {
        $query->orderBy($orderBy);
    }

    return $query->get()->getResult();
}


    public function tampil_deleted($table1)
    {
        return $this->db->table($table1)
                        ->where('status', 'deleted')
                        ->get()
                        ->getResultArray();
    }
    
public function tampil_aktif($table1) {
    // Return only active photos, filtering out deleted ones
    return $this->db->table($table1)
                    ->where('status', 'aktif')
                    ->get()
                    ->getResultArray(); 
}
public function tampil_deleted2($table1, $table2, $on) {
    // Return only posts with status 'deleted'
    return $this->db->table($table1)
        ->join($table2, $on, "left")
        ->where("$table1.status", 'deleted') // Pastikan kolom status di tabel pertama
        ->get()
        ->getResultArray();
}

public function getPassword($userId)
    {
        return $this->db->table('user')
            ->select('pw')
            ->where('id_user', $userId)
            ->get()
            ->getRow()
            ->pw;
    }

    public function tambah($table,$where)
    {
        return $this->db->table($table)->insert($where);
    }
    public function hapus($kolom,$where)
    {
        return $this->db->table($kolom)->delete($where);
    }
    public function hapus2($tabel, $where)
{
    // Debugging: Tampilkan query yang akan dijalankan
    $query = $this->db->table($tabel)->where($where)->getCompiledDelete();
    log_message('info', 'Query hapus: ' . $query);

    // Hapus data dari tabel sesuai kondisi
    return $this->db->table($tabel)->delete($where);
}
public function getWherecon($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get()->getResult();
}
    public function edit($kin,$isi,$where)
    {
        return $this->db->table($kin)->update($isi,$where);
    }
    public function join($kin,$tabel2,$on,$where)
    {
        return $this->db->table($kin)
                        ->join($tabel2,$on,"left")
                        ->getWhere($where)->getRow();
    }
    public function joinn($tabel, $tabel2, $tabel3, $on){
     return $this->db->table($tabel)
     ->join($tabel2, $on,'left')
    ->join($tabel3, $on,'left')
     ->get()
     ->getResult();

 }
public function tampil_join($table1, $table2, $onCondition, $joinType = 'left', $where = []) {
    return $this->db->table($table1)
                    ->join($table2, $onCondition, $joinType)
                    ->where($where)
                    ->get()
                    ->getResult();
}

public function tampil_join1($table1, $table2, $on)
{
    return $this->db->table($table1)
                    ->join($table2, $on, "left")
                    ->where("$table1.status", 'aktif') // Filter by 'status' column in $table1
                    ->get()
                    ->getResult();
}


public function tampil_joinwhere3($table1, $table2, $table3, $on, $on1)
{
    return $this->db->table($table1)
                    ->join($table2, $on, "left")
                    ->join($table3, $on1, "left")
                    ->where("$table1.status", 'aktif') // Filter by 'status' column in $table1
                    ->get()
                    ->getResult();
}

public function tampil_join2($table1, $table2, $on, $conditions = [])
{
    $query = $this->db->table($table1)
                      ->join($table2, $on, "left");

    // Apply conditions if provided
    if (!empty($conditions)) {
        $query->where($conditions);
    }

    return $query->get()->getResult();
}


public function tampil_join3($table1,$tabel2,$tabel3,$on,$on1)
    {
        return $this->db->table($table1)
                        ->join($tabel2,$on,"inner")
                        ->join($tabel3,$on1, "inner")
                        ->get()->getResult();
    }

public function tampil_join4($table1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3)
{
    return $this->db->table($table1)
                    ->join($tabel2, $on1, "inner")   // Joining orders and user based on id_user
                    ->join($tabel3, $on2, "inner")   // Joining orders and foto based on id_foto
                    ->join($tabel4, $on3, "inner")   // Joining orders and pembayaran based on id_pembayaran
                    ->get()
                    ->getResult();
}



    public function joinWhere($table,$tabel2,$on,$where)
    {
        return $this->db->table($tabel2)
                        ->join($tabel2,$on,"right")
                        ->getWhere($where)->getRow();
    }

    public function upload($file)
{
    $imageName = $file->getName();
    $file->move(ROOTPATH . 'public/img', $imageName);

    // Optionally log the upload operation
    log_message('debug', 'Uploaded file: ' . $imageName);
}

public function uploadaudio($file)
{
    $imageName = $file->getName();
    $file->move(ROOTPATH . 'public/audio', $imageName);

    // Optionally log the upload operation
    log_message('debug', 'Uploaded file: ' . $imageName);
}

public function updateByKodeTransaksi($kode_transaksi, $data)
{
    return $this->db->table('transaksi')
                    ->where('kode_transaksi', $kode_transaksi)
                    ->update($data);
}



public function getTransactionById($id_transaksi)
{
    return $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->get()->getRow();
}

public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();

}
public function joinduawhere($tabel, $tabel2, $on, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();

}

public function getWherejoin1($tabel, $tabel2, $on1, $tabel3, $on2, $where, $where1)
{
    return $this->db->table($tabel)
        ->join($tabel2, $on1, 'inner') // Join with the second table
        ->join($tabel3, $on2, 'inner') // Join with the third table
        ->where($where) // Add conditions
        ->where($where1) // Add conditions
        ->get()
        ->getResult(); // Return as an array of objects
}



public function getWherejoin($tabel, $tabel2, $on1, $tabel3, $on2,$tabel4, $on3, $where)
{
    return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left') // Join with the second table
        ->join($tabel3, $on2, 'left') // Join with the third table
        ->join($tabel4, $on3, 'left') // Join with the third table
        ->where($where) // Add conditions
        ->get()
        ->getResult(); // Return as an array of objects
}


public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}





//bagian multilogin

public function edituser($table, $data, $where)
    {
        // Check if the 'pw' field exists in the $data array
        if (isset($data['pw'])) {
            // Encrypt the password before saving
            $data['pw'] = password_hash($data['pw'], PASSWORD_DEFAULT);
        }

        $this->db->table($table)->update($data, $where);
    }

 // public function editpw($tabel, $isi, $where){
 //    return $this->db->table($tabel)
 //    ->update($isi, $where);
 // }
public function editpw($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }

    public function updateuser($id, $data)
    {
        return $this->db->table($this->table)->update($data, ['id_user' => $id]);
    }

    public function deleteUser($id)
    {
        return $this->db->table($this->table)->delete(['id_user' => $id]);
    }

public function tambahpass($table, $data)
    {
        // Encrypt password if it exists in the data
        if (isset($data['pw'])) {
            $data['pw'] = password_hash($data['pw'], PASSWORD_DEFAULT);
        }

        return $this->db->table($table)->insert($data);
    }

    public function editpass($table, $data, $where)
    {
        // Encrypt password if it exists in the data
        if (isset($data['pw'])) {
            $data['pw'] = password_hash($data['pw'], PASSWORD_DEFAULT);
        }

        return $this->db->table($table)->update($data, $where);
    }



    public function encryptPasswordMD5($password)
{
    return md5($password); // Enkripsi password menggunakan MD5
}




// Di dalam model M_burger
public function tambahTransaksi($data)
{
    return $this->db->table('transaksi')->insert($data);
}


public function tambah1($table, $data)
{
    if ($this->db->table($table)->insert($data)) {
        return true;
    } else {
        log_message('error', 'Database error: ' . $this->db->error());
        return false;
    }
}

public function upload2($file)
{
    if ($file->isValid() && !$file->hasMoved())
    {
        $newName = $file->getRandomName();
        $file->move('./uploads', $newName);
    }
}
public function hapus1($tabel, $where)
{
    return $this->db->table($tabel)->delete($where);
}





//untuk mengubah logo menu
public function updateSetting2($field, $data)
    {
        $this->db->table('setting')->update($data, ['id_setting' => 1]);
    }


public function getReportData()
    {
        return $this->db->table($this->table)
                        ->select('id_transaksi, tgl_transaksi, kode_transaksi, id_user, id_makanan, jumlah, total_harga')
                        ->get()
                        ->getResult();
    }

public function uploadgambar($file)
{
    $targetPath = ROOTPATH . 'public/images/logo.png';

    // Hapus file lama jika ada
    if (file_exists($targetPath)) {
        unlink($targetPath);
    }

    // Simpan file baru
    $file->move(ROOTPATH . 'public/images', 'logo.png');
    
    return 'logo.png'; // Mengembalikan nama file baru
}


public function editgambar($table, $data, $where)
{
    return $this->db->table($table)->update($data, $where);
}

public function tampilgambar($table)
{
    return $this->db->table($table)->get()->getResult(); // Mengambil semua data dari tabel
}



//untuk laporan print
// protected $table = 'transaksi';
//     protected $primaryKey = 'id_transaksi';

    public function getTransactionsByDate($start_date, $end_date)
    {
        return $this->where('tgl_transaksi >=', $start_date)
                    ->where('tgl_transaksi <=', $end_date)
                    ->findAll();
    }

public function getLaporanByDate($start_date, $end_date)
{
    return $this->db->table('transaksi')
    ->where('tgl_transaksi >=', $start_date)
    ->where('tgl_transaksi <=', $end_date)
    ->get()
    ->getResult();
}

public function getLaporanByDateForExcel($start_date, $end_date)
{
    $query = $this->db->table('transaksi')
    ->where('tgl_transaksi >=', $start_date)
    ->where('tgl_transaksi <=', $end_date)
    ->get();

    return $query->getResultArray();
}


    public function upload1($file)
{
    $targetPath = ROOTPATH . 'public/images/logo.png';
    
    // Hapus file lama jika ada
    if (file_exists($targetPath)) {
        unlink($targetPath);
    }

    // Simpan file baru
    $file->move(ROOTPATH . 'public/images', 'logo.png');
    
    return 'logo.png'; // Mengembalikan nama file baru
}


    // Mendapatkan gambar dari tabel toko
    public function tampilgambarnota($table)
    {
        return $this->db->table($table)->get()->getResultArray();
    }

//utk pesanan
public function joinAndGroupByTransaction() {
        $query = $this->db->table('transaksi')
                          ->select('kode_transaksi, user.username, transaksi.tgl_transaksi, SUM(transaksi.total_harga) as total_harga, GROUP_CONCAT(makanan.nama SEPARATOR ", ") as nama, GROUP_CONCAT(transaksi.jumlah SEPARATOR ", ") as jumlah, transaksi.status')
                          ->join('makanan', 'transaksi.id_makanan = makanan.id_makanan')
                          ->join('user', 'transaksi.id_user = user.id_user')
                          ->groupBy('kode_transaksi, user.username, transaksi.tgl_transaksi, transaksi.status')
                          ->orderBy('transaksi.tgl_transaksi', 'desc')
                          ->get();
        return $query->getResult();
    }


public function edit2($table, $data, $where)
{
    return $this->db->table($table)->update($data, $where);
}

public function insert($data = NULL, bool $returnID = true)
{
    if ($data === NULL) {
        throw new \InvalidArgumentException('Data cannot be NULL.');
    }

    $this->db->table('keranjang')->insert($data);

    // Optionally, return the ID of the inserted row
    if ($returnID) {
        return $this->db->insertID();
    }

    return true;
}

public function logActivity($user_id, $activity, $description) {
    date_default_timezone_set('Asia/Jakarta'); // Set timezone ke WIB
    $timestamp = date('Y-m-d H:i:s'); // Waktu dalam WIB

    $data = [
        'user_id' => $user_id,
        'activity' => $activity,
        'description' => $description,
        'timestamp' => $timestamp, // Tambahkan timestamp ke data
    ];

    $this->db->table('activity_logs')->insert($data);
}


public function getActivityLogs() {
    $query = $this->db->table('activity_logs')
                      ->join('user', 'activity_logs.user_id = user.id_user', 'left')
                      ->select('user.username, activity_logs.activity, activity_logs.description, activity_logs.timestamp')
                      ->orderBy('activity_logs.timestamp', 'DESC')
                      ->get();

    $results = $query->getResultArray();
    return $results;
}

public function getLoginHistoryByUserId($userId)
    {
        $loginModel = new \App\Models\HsLoginModel();
        return $loginModel->where('id_users', $userId)->orderBy('login_time')->findAll();
    }
    
public function history_edit($user_id, $activity, $description) {
    date_default_timezone_set('Asia/Jakarta'); // Set timezone ke WIB
    $timestamp = date('Y-m-d H:i:s'); // Waktu dalam WIB

    $data = [
        'user_id' => $user_id, // Pastikan nama kolom sesuai dengan tabel
        'activity' => $activity,
        'description' => $description,
        'timestamp' => $timestamp, // Tambahkan timestamp ke data
    ];

    if (!$this->db->table('history_edit')->insert($data)) {
        // Log error untuk debugging
        log_message('error', 'Failed to insert history_edit data: ' . $this->db->error());
    }
}

public function gethistoryedit() {
    // Define the query
    $builder = $this->db->table('history_edit');
    $builder->join('user', 'history_edit.user_id = user.id_user', 'left');
    $builder->select('user.username, history_edit.activity, history_edit.description, history_edit.timestamp');
    $builder->orderBy('history_edit.timestamp', 'DESC');

    $query = $builder->get();

    // Cek apakah query berhasil
    if ($query === false) {
        // Log error untuk debugging
        log_message('error', 'Query Error: ' . $this->db->getLastQuery());
        return []; // Atau handle error sesuai kebutuhan
    }

    // Retrieve results
    $results = $query->getResultArray();
    return $results;
}

public function updateRating($kode_transaksi, $data)
{
    return $this->db->table('transaksi')
                    ->where('kode_transaksi', $kode_transaksi)
                    ->update($data);
}





public function fetchCounts()
    {
        $model = new M_burger();

        // Fetch user count
        $userCount = $model->db->table('users')->countAllResults();

        // Fetch transaction count
        $transactionCount = $model->db->table('transaksi')->countAllResults();

        // Return counts as JSON
        return $this->response->setJSON(['users' => $userCount, 'transactions' => $transactionCount]);
    }


    public function getSuratById($id_surat)
{
    return $this->db->table('surat_k')  // Replace 'surat' with the actual table name if different
                     ->where('id_surat', $id_surat)
                     ->get()
                     ->getRow();  // Returns a single row as an object
}

public function getDocumentsByFolder($folder_id)
    {
        return $this->where('id_folder', $folder_id)->findAll();  // Adjust as needed
    }

    // Method to get all folders
    public function getAllFolders()
    {
        return $this->db->table('folder')->get()->getResult();  // Adjust table and query as needed
    }




}