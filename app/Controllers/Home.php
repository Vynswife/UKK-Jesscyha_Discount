<?php namespace App\Controllers;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\M_burger;
use App\Models\FolderModel;
use App\Models\SuratModel;


class Home extends BaseController
{
    public function __construct()
{
    $this->m_burger = new M_burger();
    if (is_null($this->m_burger)) {
        log_message('error', 'M_burger model is null');
    }
}

    protected $M_burger; // Definisikan properti model
    //standard part
    public function beranda() {
    if (session()->get('level') > 0) {

        $db = \Config\Database::connect();
        $model = new M_burger();
        $user_id = session()->get('id_user');
        $recentHistory = $db->table('calculations')
            ->select('input, result, created_at')
            ->where('id_user', $user_id) // Filter berdasarkan id_user
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();


            $data['recent_history'] = $recentHistory;

        // Fetch the number of users
        $data['user'] = $model->getcount('user');

        // Fetch the store data
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'

        $where = array(
            'id_toko' => 1
        );
        $data['setting'] = $model->getWhere('toko', $where);


        // Load the view
        echo view('header', $data);
        echo view('menu', $data);
        echo view('beranda', $data);
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}
    public function posts($id) {
    if (session()->get('level') > 0) {
        $model = new M_burger();
        $user_id = session()->get('id_user');
        
       $where = ['calculations.id_user' => $id];
        $data['posts'] = $model->joinduawhere('calculations', 'user', 'calculations.id_user=user.id_user', 'created_at', $where);




        $data['jes'] = $model->tampilgambar('toko'); 

        // Fetch specific settings for 'toko'
        $where = ['id_toko' => 1];
        $data['setting'] = $model->getWhere('toko', $where);
        
        // Muat data ke view
        echo view('header');
        echo view('menu', $data);
        echo view('posts', $data);
        $model->logActivity($user_id, 'General', 'User accessed General View');
    } else {
        // Jika tidak login, redirect ke halaman login
        return redirect()->to(base_url('home/login'));
    }
}


     public function addcalc()
    {
        // Pastikan pengguna sudah login
        $user_id = session()->get('id_user');
        if (!$user_id) {
            return $this->response->setJSON(['error' => 'User not authenticated!']);
        }

        // Ambil data dari request
        $jsonData = $this->request->getJSON(true);
        $calculationInput = $jsonData['calculation_input'] ?? null;
        $calculationResult = $jsonData['calculation_result'] ?? null;

        // Validasi input
        if (empty($calculationInput) || empty($calculationResult)) {
            return $this->response->setJSON(['error' => 'Input or result cannot be empty!']);
        }
        // Siapkan data untuk disimpan
        $calcData = [
            'id_user' => $user_id,
            'input' => $calculationInput,
            'result' => $calculationResult,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $model = new M_burger();
        $insert = $model->tambah('calculations', $calcData);

        if ($insert) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Calculation saved successfully!',
                'input' => $calculationInput,
                'result' => $calculationResult
            ]);
        } else {
            return $this->response->setJSON(['error' => 'Failed to save calculation.']);
        }
    }

    public function getLatestHistory()
{
    $model = new M_burger();
    $user_id = session()->get('id_user');

    $history = $model->joinduawhere(
        'calculations',
        'user',
        'calculations.id_user=user.id_user',
        'created_at',
        ['calculations.id_user' => $user_id]
    );

    return $this->response->setJSON($history);
}







    public function login()
    {
        $model = new M_burger();
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
        $where = array(
            'id_toko' => 1
        );
        $data['setting'] = $model->getWhere('toko', $where);
        echo view('header', $data);
        echo view('login');

    }

    public function aksi_login() {
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('pw');

    $model = new M_burger();
    $where = [
        'username' => $u,
        'pw' => md5($p)
    ];

    $cek = $model->getWhere('user', $where);
    
    if ($cek > 0) {
        session()->set('id_user', $cek->id_user);
        session()->set('username', $cek->username);
        session()->set('level', $cek->level);
        session()->set('foto', $cek->foto);


        // Log the login activity
        $model->logActivity($cek->id_user, 'login', 'User logged in.');

        return redirect()->to('home/beranda');
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function logout() {

    $user_id = session()->get('id_user');
    
    if ($user_id) {
        // Log the logout activity
        $model = new M_burger();
        $model->logActivity($user_id, 'logout', 'User logged out.');
    }

    session()->destroy();
    return redirect()->to('http://localhost:8080/home/login');
}



public function aksi_reset($id)
    {
        $model = new M_burger();

        $where= array('id_user'=>$id);

        $isi = array(

            'pw' => md5('123')      

        );
        $model->editpw('user', $isi,$where);

        return redirect()->to('http://localhost:8080/home/user');
        
    }

    public function activity_log() {
    if (session()->get('level') > 0) {
        $model = new M_burger();
        $logs = $model->getActivityLogs();

        // Debug: Check if logs have data
        log_message('debug', 'Activity Logs: ' . print_r($logs, true));

        $data['logs'] = $logs;
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'

        $where = array(
            'id_toko' => 1
        );
        $data['setting'] = $model->getWhere('toko', $where);

        if (session()->get('level') == 2) {
            echo view('header', $data);
            echo view('menu', $data);
            return view('activity_log', $data);
        } else {
            return redirect()->to('http://localhost:8080/home/error_404');
        }
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}


public function history_edit() 
{   
    if(session()->get('level') > 0) {
    $model = new M_burger();
    $user_id = session()->get('id');
    $logs = $model->gethistoryedit();

    $data['logs'] = $logs;
    $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'

    $where = array(
        'id_toko' => 1
    );
    $data['setting'] = $model->getWhere('toko', $where);
    if(session()->get('level')==2 || session()->get('level') == 3) {
    echo view('header', $data);
    echo view('menu', $data);
    return view('history_edit', $data);
    $model->logActivity($user_id, 'Setting', 'User is accessing Setting page.');
    } else {
    return redirect()->to('http://localhost:8080/home/error_404');
    }
}else{
            return redirect()->to('http://localhost:8080/home/login');
        }
}






public function error_404()
{
     if (session()->get('level') >0) {
        $model = new M_burger();
        $user_id = session()->get('id_user');
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
         $where=array(
          'id_toko'=> 1
      );
         $data['setting'] = $model->getWhere('toko',$where);
        echo view('header', $data);
        echo view('menu',$data);
        echo view('errors/html/error_404', $data);
        } else {
        return redirect()->to(base_url('http://localhost:8080/home/login'));
    }
}





//form






public function setting()
{
     if (session()->get('level') > 0 ) {
        $model = new M_burger();
        $user_id = session()->get('id');
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
         $where=array(
          'id_toko'=> 1
      );
         $data['setting'] = $model->getWhere('toko',$where);

        if(session()->get('level')==2 ) {
        echo view('header',$data);
        echo view('menu',$data);
        echo view('setting', $data);
        $model->logActivity($user_id, 'Setting', 'User is accessing Setting page.');
        } else {
    return redirect()->to('http://localhost:8080/home/error_404');
    }
        } else {
        return redirect()->to(base_url('http://localhost:8080/home/login'));
    }
}






public function aksietoko()
{
    $model = new M_burger();
    $nama = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
    $userId = session()->get('id');

    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_toko' => $id);

    $isi = array(
        'nama_toko' => $nama
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $model->upload1($uploadedFile); // Mengupload file baru dan hapus yang lama
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('toko', $isi, $where);
    $model->history_edit($userId, 'Update Logo and Website name', 'User updated Logo/Website Name.');
    return redirect()->to('home/setting');
}














public function post($id) {
    if (session()->get('level') > 0) {
        $model = new M_burger();
        
        $user_id = session()->get('id_user');
        // Kondisi untuk filter berdasarkan id_user
        $where = ['calculations.id_user' => $id];

        // Ambil data dengan join
        $data['posts'] = $model->joinduawhere(
            'calculations', // Tabel utama
            'user',         // Tabel kedua
            'calculations.id_user=user.id_user', // Kondisi join
            'created_at',   // Urutan berdasarkan kolom created_at
            $where          // Kondisi filter berdasarkan id_user
        );

        $data['jes'] = $model->tampilgambar('toko'); 

        // Fetch specific settings for 'toko'
        $where = ['id_toko' => 1];
        $data['setting'] = $model->getWhere('toko', $where);
        
        // Muat data ke view
        echo view('header');
        echo view('menu', $data);
        echo view('post', $data);
        $model->logActivity($user_id, 'Scientific', 'User accessed Scientific View');
    } else {
        // Jika tidak login, redirect ke halaman login
        return redirect()->to(base_url('home/login'));
    }
}










public function deleteHistory($id)
{
    $model = new M_burger();
    $user_id = session()->get('id_user');
    $model->hapus('calculations', ['id' => $id]); // Sesuaikan nama tabel
    return $this->response->setJSON(['success' => true]);
}














public function e_post()
{
    $model = new M_burger();

    // Get the post data from the form
    $id = $this->request->getPost('id_post');
    $judul = $this->request->getPost('judul');
    $isi = $this->request->getPost('isi');
    $mapel_id = $this->request->getPost('mapel');
    $user_id = session()->get('id_user');

    // Add log to check data received
    log_message('info', 'Data received: ID=' . $id . ', Title=' . $judul . ', Content=' . $isi . ', Mapel ID=' . $mapel_id);

    // Define the condition for selecting the post
    $where = ['id_post' => $id];

    // Prepare the data to be updated in the database
    $data = [
        'judul' => $judul,
        'isi' => $isi,
        'id_mapel' => $mapel_id,
    ];

    // Check if a new photo was uploaded
    if ($this->request->getFile('foto')->isValid()) {
        $newFile = $this->request->getFile('foto');
        $newFileName = $newFile->getRandomName();
        $newFile->move('img/', $newFileName);

        // Add the new photo filename to the data
        $data['file'] = $newFileName;
    }

    // Run the update query
    $model->edit('posts', $data, $where);

    // Log the update in the history
    $model->history_edit($user_id, 'Update post', 'User updated a post.');

    // Redirect back to the posts page
    return redirect()->to(base_url('home/post/' . $user_id));   
}



public function r_post($id_post) {
    $model = new M_burger;

    // Update the status of the photo to 'active' based on the ID
    $model->db->table('posts')->where('id_post', $id_post)->update(['status' => 'aktif']);

    // Redirect to the photo page after restoring
    return redirect()->to(base_url('home/restore'));
}




public function restore() {
    if(session()->get('level') > 0) {
        $model = new M_burger;

        // Fetch active photos (status != 'deleted')
        $data['posts'] = $model->tampil_deleted2('posts','user','posts.id_user = user.id_user');  // Fetch only active photos

        // Fetch other necessary data like the toko information
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'

        // Setting data for the toko
        $where = array(
            'id_toko' => 1
        );
        $data['setting'] = $model->getWhere('toko', $where);

        // Load the view
        if(session()->get('level')==2 ) {
        echo view('header');
        echo view('menu', $data);
        echo view('restore', $data);
        } else {
    return redirect()->to('http://localhost:8080/home/error_404');
    }
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function h_photo($id)
{
    $model= new M_burger;
    $kil= array('id_foto'=>$id);
    $model->hapus('foto',$kil);
    return redirect()-> to('http://localhost:8080/home/restore');
}

public function r_photo($id_foto) {
    $model = new M_burger;

    // Update the status of the photo to 'active' based on the ID
    $model->db->table('foto')->where('id_foto', $id_foto)->update(['status' => 'aktif']);

    // Redirect to the photo page after restoring
    return redirect()->to(base_url('home/restore'));
}

 public function h_restore($id)
    {
        // Load the model
        $model = new M_burger();

        // Prepare the condition for deletion
        $kil = array('id_post' => $id);

        // Call the 'hapus' method from M_burger to delete the post
        $model->hapus('posts', $kil);

        // Redirect to the restore page
        return redirect()->to('/home/restore');
    }



public function aksi_t_user()
{
    $a= $this->request->getPost('nama');
    $b= md5($this->request->getPost('pw'));
    $c= $this->request->getPost('name');
    $d= $this->request->getPost('email');
    $e= $this->request->getPost('level');

    $uploadedFile = $this->request->getfile('foto');
    $foto = $uploadedFile->getName();

    $sis= array(
        'level'=>$e,
        'username'=>$a,
        'nama_asli'=>$c,
        'email'=>$d,
        'pw'=>$b,

        'foto'=>$foto);
    $model= new M_burger;
    $model->upload($uploadedFile);
    $model->tambah('user',$sis);

    return redirect()-> to ('http://localhost:8080/home/user');
}

public function t_mapel()
{
    
    $noSurat = $this->request->getPost('nama_mapel');
    $user_id = session()->get('id_user');
    $sis= array(
        'nama_mapel' => $noSurat);
    $model= new M_burger;

    $model->tambah('mapel',$sis);
    return redirect()->to(base_url('home/posts/'));
}

public function register()
{

    echo view('header');
    echo view('register');
}

public function aksi_t_register()
{
    // Capture the POST data
    $nama = $this->request->getPost('nama');
    $password = md5($this->request->getPost('pass')); // Make sure you handle encryption securely
    $email = $this->request->getPost('email');
    $nama_asli = $this->request->getPost('nama_asli');
    $uploadedFile = $this->request->getfile('foto');
    $foto = $uploadedFile->getName();

    // Prepare the data for insertion into 'd_user' table
    $data = array(
        'username' => $nama,     // Assuming 'nama' is the username
        'email' => $email,
        'level' => '1',          // Default level, assuming '1' is the user role
        'pw' => $password,
        'nama_asli' => $nama_asli,
        'foto' => $foto
    );

    // Insert data into the 'd_user' table
    $model = new M_burger();
    $model->upload($uploadedFile);
    $model->tambah('user', $data);

    // Redirect to the login page after successful registration
    return redirect()->to(base_url('home/login'));
}
public function aksi_t_posts()
{
    $sisi = $this->request->getPost('rumus');

    // Validasi input sisi
    if (!$sisi || $sisi <= 0) {
        return redirect()->to(base_url('home/persegi'))->with('error', 'Masukkan angka panjang sisi yang valid!');
    }

    // Hitung luas dan keliling persegi
    $luas = $rumus * $rumus;

    // Format hasil sebagai string
    $hasil = "Sisi: {$sisi} cm → Luas: {$luas} cm²";

    // Data untuk dimasukkan ke database
    $data = [
        'id_user'  => session()->get('id_user'),
        'result'    => $hasil,
        'input'    => $sisi
    ];

    // Simpan ke database
    $model = new M_burger();
    $model->tambah('history', $data);

    if ($model->tambah('calculations', $data)) {
        session()->setFlashdata('success', 'History berhasil diperbarui.');
    } else {
        session()->setFlashdata('error', 'Gagal memperbarui history.');
    }

    // Redirect dengan pesan sukses
    return redirect()->to(base_url('/home/posts/' . $user_id))->with('success', 'Perhitungan berhasil disimpan!');
}


public function t_foto()
{
    
    $noSurat = $this->request->getPost('judul');
    $tglSurat = $this->request->getPost('tanggal_buat');
    $pengirim = $this->request->getPost('deskripsi');
    $harga = $this->request->getPost('harga');
    $user_id = session()->get('id_user');


    $uploadedFile = $this->request->getfile('foto');
    $foto = $uploadedFile->getName();
    $sis= array(
        'judul' => $noSurat,
        'tanggal_buat' => $tglSurat,
        'deskripsi' => $pengirim,
        'id_user' => $user_id,
        'harga' => $harga,
        'lokasi'=>$foto);
    $model= new M_burger;
    $model->upload($uploadedFile);
    $model->tambah('foto',$sis);
    return redirect()-> to ('http://localhost:8080/home/photo');
}

public function e_foto()
{
    $model = new M_burger;
    $judul = $this->request->getPost('judul');
    $deskripsi = $this->request->getPost('deskripsi');
    $id = $this->request->getPost('id_foto');
    $uploadedFile = $this->request->getfile('lokasi');
    $foto = $uploadedFile->getName();


    $where = ['id_foto' => $id];
    $user_id = session()->get('id_user');
    $sis= array(
        'judul' => $judul,
        'deskripsi' => $deskripsi,
        'lokasi'=>$foto);
    $model= new M_burger;
    $model->upload($uploadedFile);
    $model->edit('foto', $sis, $where);
    $model->history_edit($user_id, 'Update Surat Masuk', 'User updated data surat masuk.');

    return redirect()->to('http://localhost:8080/home/photo');
}

public function e_harga()
{
    $model = new M_burger;
    $final_harga = $this->request->getPost('final_harga');
    $id = $this->request->getPost('id_pembayaran');


    $where = ['id_pembayaran' => $id];
    $user_id = session()->get('id_user');
    $sis= array(
        'final_harga' => $final_harga,
        'status_order' => 'Price Confirmed');
    $model= new M_burger;
    $model->edit('pembayaran', $sis, $where);
    $model->history_edit($user_id, 'Update Surat Masuk', 'User updated data surat masuk.');

    return redirect()->to('http://localhost:8080/home/orderadmin');
}

public function e_bukti()
{
    $model = new M_burger;
    $uploadedFile = $this->request->getfile('bukti');
    $foto = $uploadedFile->getName();
    $id = $this->request->getPost('id_pembayaran');



    $where = ['id_pembayaran' => $id];
    $userId = session()->get('id_user');
    $sis= array(
        'file' => $foto);
    $model= new M_burger;
    $model->upload($uploadedFile);
    $model->edit('pembayaran', $sis, $where);
    $model->history_edit($user_id, 'Update Surat Masuk', 'User updated data surat masuk.');

    return redirect()->to(base_url('home/order/' . $userId));
}


public function e_status()
{
    $model = new M_burger;
    $status = $this->request->getPost('status');
    $id = $this->request->getPost('id_pembayaran');



    $where = ['id_pembayaran' => $id];
    $userId = session()->get('id_user');
    $sis= array(
        'status_pembayaran' => $status);
    $model= new M_burger;
    $model->edit('pembayaran', $sis, $where);
    $model->history_edit($user_id, 'Update Surat Masuk', 'User updated data surat masuk.');

    return redirect()->to('http://localhost:8080/home/orderadmin');
}


public function e_design()
{
    $model = new M_burger;
    $uploadedFile = $this->request->getfile('design');
    $foto = $uploadedFile->getName();
    $id = $this->request->getPost('id_pembayaran');



    $where = ['id_pembayaran' => $id];
    $user_id = session()->get('id_user');
    $sis= array(
        'file_design' => $foto);
    $model= new M_burger;
    $model->upload($uploadedFile);
    $model->edit('pembayaran', $sis, $where);

    return redirect()->to('http://localhost:8080/home/orderadmin');
}





public function delete_foto()
{
    // Load the model
    $model = new M_burger;

    // Get the ID of the photo to delete
    $idFoto = $this->request->getPost('id_foto');
    $userId = session()->get('id_user');  // Current user performing the action

    // Set the status to "deleted"
    $updateData = ['status' => 'deleted'];

    // Define the condition for the update
    $where = ['id_foto' => $idFoto];

    // Perform the update operation
    $model->edit('foto', $updateData, $where);

    // Redirect back to the photo management page
    return redirect()->to(base_url('home/photo'));
}




public function h_suratk($id) {
    $model= new M_burger;
    $kil= array('id_surat'=>$id);
    $model->hapus('surat_k',$kil);
    return redirect()-> to('http://localhost:8080/home/surat_k');
}

public function t_album()
{
    
    $noSurat = $this->request->getPost('nama');
    $tglSurat = $this->request->getPost('deskripsi');
    $user_id = session()->get('id_user');
    $tanggalBuat = date('Y-m-d H:i:s'); // Current timestamp

    $uploadedFile = $this->request->getfile('foto');
    $foto = $uploadedFile->getName();

    $sis= array(
        'nama_album' => $noSurat,
        'deskripsi' => $tglSurat,
        'tanggal_buat' => $tanggalBuat, // Add timestamp
        'id_user' => $user_id,
        'foto_album' => $foto
    );
    $model= new M_burger;
    $model->upload($uploadedFile);
    $model->tambah('album',$sis);

    return redirect()-> to ('http://localhost:8080/home/photo');
}

public function e_album()
{
    $model = new M_burger;
    $album_id = $this->request->getPost('album');
    $foto_id = $this->request->getPost('id_foto');
    $user_id = session()->get('id_user');

    $data = array(
        'id_album' => $album_id
    );
    $where = ['id_foto' => $foto_id];

    // Update foto with the new album ID
    $model->edit('foto', $data, $where);

    // Log the history
    $model->history_edit($user_id, 'Update Foto Album', 'User assigned foto to album.');

    return redirect()->to('http://localhost:8080/home/photo');
}












//menu (udh)



public function h_keranjang($id)
{
    $model= new M_burger;
    $user_id = session()->get('id');
    $kil= array('id_keranjang'=>$id);
    $model->hapus('keranjang',$kil);
    $model->logActivity($user_id, 'user', 'User deleted an item from cart');
    return redirect()-> to('http://localhost:8080/home/keranjang');
}

public function hapusproduk($id){
    $model = new M_burger();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus produk'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    // Data yang akan diupdate untuk soft delete
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->logActivity($id_user, 'user', 'User deleted a product');
    $model->edit('makanan', $data, ['id_makanan' => $id]);

    return redirect()->to('home/keranjang');
}

public function aksi_bayar()
{
    $id_user = session()->get('id');
    $paymentMethod = $this->request->getPost('payment_method');
    $address = $this->request->getPost('address');
    $keranjang = $this->request->getPost('keranjang');
    $catatan = $this->request->getPost('catatan');

    if (empty($paymentMethod) || empty($address) || empty($keranjang)) {
        return redirect()->back()->with('error', 'Metode pembayaran, alamat pengiriman, dan data keranjang harus diisi.');
    }

    $model = new M_burger();
    $keranjangItems = $model->getWherecon('keranjang', ['id_user' => $id_user]);

    if (empty($keranjangItems)) {
        return redirect()->back()->with('error', 'Keranjang kosong!');
    }

    $kode_transaksi = '';

    foreach ($keranjangItems as $item) {
        if (is_object($item)) {
            $id_makanan = $item->id_makanan;
            $jumlah = $item->jumlah;
            $total_harga = $item->total_harga;

            $p1 = date("YmdHms");
            $kode_transaksi = ($p1 . $id_user);

            $dataTransaksi = [
                'tgl_transaksi' => date('Y-m-d H:i:s'),
                'kode_transaksi' => $kode_transaksi,
                'id_user' => $id_user,
                'id_makanan' => $id_makanan,
                'jumlah' => $jumlah,
                'total_harga' => $total_harga,
                'alamat' => $address,
                'catatan' => $catatan,
                'status_pembayaran' => 'unconfirmed'
            ];

            if (!$model->tambah1('transaksi', $dataTransaksi)) {
                log_message('error', 'Gagal menyimpan data transaksi: ' . json_encode($dataTransaksi));
                return redirect()->back()->with('error', 'Gagal menyimpan data transaksi.');
            }
        }
    }

    if (!$model->hapus('keranjang', ['id_user' => $id_user])) {
        return redirect()->back()->with('error', 'Gagal menghapus data keranjang.');
    }

     // Log the transaction activity
    $model->logActivity($id_user, 'transaction', 'User made a transaction.');


    session()->setFlashdata('success', 'Pesanan sedang diproses.');

    // Redirect to the printnota method with kode_transaksi
    return redirect()->to('home/printnota/' . $kode_transaksi);
}



public function printnota1($kode_transaksi)
{
    $model = new M_burger();

    if (empty($kode_transaksi)) {
        return redirect()->to('/home')->with('error', 'Kode transaksi tidak valid.');
    }

    $where1 = array('user.id_user' => session()->get('id'));
    $data['jes'] = $model->tampilgambar('toko');
    $where = array('id_toko' => 1);
    $data['setting'] = $model->getWhere('toko', $where);

    $dompdf = new \Dompdf\Dompdf();
    $where2 = array('kode_transaksi' => $kode_transaksi);
    $data['elly'] = $model->jointigawhere('transaksi', 'makanan', 'user', 'transaksi.id_makanan=makanan.id_makanan', 'transaksi.id_user=user.id_user', 'transaksi.kode_transaksi', $where2);

    $html = view('printnota', $data);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A6', 'portrait');
    $dompdf->render();
    $dompdf->stream('laporan_pesanan.pdf', array("Attachment" => false));
}















//pesan



//user (udh)
public function user()
{
    if (session()->get('level') > 0) {
        $model = new M_burger();
        $data['jel'] = $model->tampil_aktif('user');

        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
         $where=array(
          'id_toko'=> 1
      );
         $data['setting'] = $model->getWhere('toko',$where);

         
         if(session()->get('level')==2 ) {
        echo view('header',$data);
        echo view('menu', $data);
        echo view('user', $data);
        } else {
    return redirect()->to('http://localhost:8080/home/error_404');
    }
    } else {
        return redirect()->to(base_url('home/login'));
    }
}


public function aksi_e_user()
{
    // Ambil data yang dikirimkan dari form
    $id_user = $this->request->getPost('id_user');
    $username = $this->request->getPost('username');
    $nama_asli = $this->request->getPost('nama_asli');
    $email = $this->request->getPost('email');

    // Ambil foto lama dari database sebelum diupdate
    $model = new M_burger();
    $userData = $model->getUserById($id_user); // Pastikan ada fungsi ini untuk ambil data user

    $uploadedFile = $this->request->getFile('foto');
    $foto = $uploadedFile->getName();

    // Data yang akan diupdate
    $data = [
        'username'   => $username,
        'nama_asli'  => $nama_asli,
        'email'      => $email,
    ];

    // Jika user upload foto baru, update kolom 'foto', kalau nggak, tetap pakai foto lama
    if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        // Upload file foto
        $uploadedFile->move('img/', $foto);
        $data['foto'] = $foto;
    } else {
        // Gunakan foto lama kalau tidak ada file baru diupload
        $data['foto'] = $userData['foto'];
    }

    // Melakukan update data pengguna
    $model->edit('user', $data, ['id_user' => $id_user]);

    // Redirect setelah update berhasil
    return redirect()->to(base_url('home/user'));
}









public function profile($id)   
{
    if (session()->get('level') > 0) {
        $model = new M_burger();

        // Load user data based on the provided id
        $where= array('id_user'=>$id);


        $data['user']=$model->getWhere('user',$where);

        // Load other necessary data
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
        $data['setting'] = $model->getWhere('toko', ['id_toko' => 1]);


        // Load the views with the data
        echo view('header');
        echo view('menu', $data);
        echo view('profile', $data);
        echo view('footer');
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function changepass($id)   
{
    if (session()->get('level') > 0) {
        $model = new M_burger();

        // Load user data based on the provided id
        $where= array('id_user'=>$id);

        $data['user']=$model->getWhere('user',$where);

        // Load other necessary data
        $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
        $data['setting'] = $model->getWhere('toko', ['id_toko' => 1]);


        // Load the views with the data
        echo view('header');
        echo view('menu', $data);
        echo view('changepassword', $data);
        echo view('footer');
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function aksi_changepass()
{
    $model = new M_burger();
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
    $userId = session()->get('id_user');

    // Ambil password lama dari database
    $currentPassword = $model->getPassword($userId);

    // Verifikasi password lama
    if (md5($oldPassword) !== $currentPassword) {
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }

    // Update password baru
    $data = [
        'pw' => md5($newPassword),
        'updated_by' => $userId,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $userId];

    if ($model->edit('user', $data, $where)) {
        session()->setFlashdata('success', 'Password berhasil diperbarui.');
    } else {
        session()->setFlashdata('error', 'Gagal memperbarui password.');
    }

    return redirect()->to('/home/profile/' . $userId);
}

public function aksi_e_profile()
{
    // Mengambil data dari form
    $nama_asli = $this->request->getPost('nama_asli');
    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $alamat = $this->request->getPost('alamat');
    $id = $this->request->getPost('id'); // ID user yang akan diupdate

    // Jika ada file foto yang diupload
    $uploadedFile = $this->request->getFile('foto');
    $foto = $uploadedFile->getName();

    // Menyiapkan data yang akan diupdate
    $data = [
        'nama_asli' => $nama_asli,
        'username' => $username,
        'email' => $email,
        'alamat' => $alamat,
        'foto' => $foto
    ];

    // Tentukan kondisi untuk pencarian data berdasarkan ID
    $where = ['id_user' => $id];

    // Memanggil model untuk meng-upload foto jika ada dan update data user
    $model = new M_burger();

    // Jika ada foto yang diupload, lakukan upload
    if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        // Upload file foto
        $model->upload($uploadedFile);
    }

    // Update data user di tabel 'users' berdasarkan ID
    $model->edit('user', $data, $where);

    // Redirect ke halaman profile setelah data berhasil diperbarui
    return redirect()->to('/home/profile/' . $id);
}





// public function aksi_e_profile()
// {
//     $model= new M_burger;
//     $a= $this->request->getPost('nama');
//     $b= $this->request->getPost('jenis');
//     $id=$this->request->getPost('id_user');
//     $uploadedFile = $this->request->getfile('foto');
//     $foto = $uploadedFile->getName();
//     $where = array('id_user'=>$id);
//     $isi= array(
//         'username'=>$a,
//         'jk'=>$b,
//         'foto'=>$foto);
//     $model->edit('user', $isi, $where);
//     return redirect()->to('/home/profile/' . $id);
// }










}