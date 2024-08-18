<?php
// Memastikan file ini tidak diakses langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Mendefinisikan kelas ProfileController yang merupakan turunan dari CI_Controller
class ProfileController extends CI_Controller
{
    /**
     * Konstruktor untuk kelas ProfileController
     */
    public function __construct()
    {
        // Memanggil konstruktor parent dari CI_Controller
        parent::__construct();

        // Memeriksa apakah user sudah login berdasarkan sesi email, jika tidak, redirect ke halaman utama
        if (!$this->session->userdata('email')) {
            redirect(base_url(''));
        }
    }

    /**
     * Halaman utama profil
     */
    public function index()
    {
        // Mengambil data user berdasarkan email dari tabel 'user' dan menyimpannya dalam array $data
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Profile'; // Menetapkan judul halaman

        // Memuat view 'template/header', 'template/navbar', dan 'admin/profile' dengan data yang diperoleh
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('template/footer');
    }

    /**
     * Halaman untuk mengedit profil user
     */
    public function edit()
    {
        // Mengambil data user berdasarkan email dari tabel 'user' dan menyimpannya dalam array $data
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Profile'; // Menetapkan judul halaman

        // Menetapkan aturan validasi untuk bidang 'name' (nama lengkap)
        $this->form_validation->set_rules('name', 'Full Name', 'required');

        // Jika validasi form gagal
        if ($this->form_validation->run() == false) {
            // Memuat kembali view 'template/header', 'template/navbar', dan 'admin/profile' dengan data yang diperoleh
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('admin/profile', $data);
            $this->load->view('template/footer', $data);
        } else {
            // Jika validasi form berhasil, mengambil input dari form
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // Memproses upload gambar profil jika ada
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diizinkan
                $config['max_size'] = '100000'; // Ukuran maksimal file dalam kilobita
                $config['upload_path'] = './assets/images/users'; // Direktori untuk menyimpan file gambar

                // Memuat library 'upload' dengan konfigurasi yang telah ditetapkan
                $this->load->library('upload', $config);

                // Jika proses upload berhasil
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name'); // Mendapatkan nama file yang diupload
                    $this->db->set('image', $new_image); // Menyimpan nama file gambar ke dalam database
                } else {
                    echo $this->upload->display_errors(); // Menampilkan pesan error jika upload gagal
                }
            }

            // Menyimpan nama lengkap (name) ke dalam database
            $this->db->set('name', $name);
            // Memperbarui data user berdasarkan email
            $this->db->where('email', $email);
            $this->db->update('user');

            // Menyetel pesan sukses yang akan ditampilkan pada halaman profil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect(base_url('profile')); // Redirect kembali ke halaman profil setelah proses selesai
        }
    }
}
