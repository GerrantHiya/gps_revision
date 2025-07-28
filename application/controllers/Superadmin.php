<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Pagination $pagination
 * @property array $pagination_config
 */

class Superadmin extends MY_Controller
{
    protected $pagination_config;
    public $per_page = 10;

    public function __construct()
    {
        parent::__construct();

        $this->user = $this->session->get_userdata();

        $this->pagination_config = [
            'full_tag_open'    => '<ul class="pagination">',
            'full_tag_close'   => '</ul>',
            'first_link'       => '&laquo;',
            'first_tag_open'   => '<li class="page-item">',
            'first_tag_close'  => '</li>',
            'last_link'        => '&raquo;',
            'last_tag_open'    => '<li class="page-item">',
            'last_tag_close'   => '</li>',
            'next_link'        => '&rsaquo;',
            'next_tag_open'    => '<li class="page-item">',
            'next_tag_close'   => '</li>',
            'prev_link'        => '&lsaquo;',
            'prev_tag_open'    => '<li class="page-item">',
            'prev_tag_close'   => '</li>',
            'cur_tag_open'     => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close'    => '</span></li>',
            'num_tag_open'     => '<li class="page-item">',
            'num_tag_close'    => '</li>',
            'attributes'       => ['class' => 'page-link']
        ];
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user' => $this->user,
            'belum_proses' => $this->Superadmin_Model->hitung_paket_belum_proses(),
            'belum_tiba' => $this->Superadmin_Model->hitung_paket_belum_tiba(),
            'selesai' => $this->Superadmin_Model->hitung_paket_selesai(),
            'piutang' => $this->Customer_Model->hitung_tunggakan(),
            'tipe_kurir_terlaris' => $this->Superadmin_Model->tipe_kurir_terlaris(),
            'kota_tujuan_terbanyak' => $this->Superadmin_Model->kota_tujuan_terbanyak(),
            'pie_chart_data' => $this->Superadmin_Model->distribusi_tipe_kurir(),
        ];

        $this->load_template('dashboard-admin', $data);
    }

    // AJAX untuk cari data kota
    public function cari_kota_ajax()
    {
        $search = $this->input->get('search');

        if (!$search) {
            echo json_encode([]);
            return;
        }

        $response = $this->rajaongkir->get_domestic_destination($search);
        $decoded = json_decode($response, true);

        // var_dump($response);
        if (!isset($decoded['data'])) {
            echo json_encode([]);
            return;
        }

        echo json_encode($decoded['data']);
        // var_dump($decoded['data']);
    }

    public function kirim_paket()
    {
        $data = [
            'title' => 'Kirim Paket',
            'user' => $this->user,
            'list_kategori' => $this->Superadmin_Model->kategori(),
            'list_kota_tujuan' => $this->rajaongkir->get_domestic_destination(),
            'daftar_customer' => $this->Superadmin_Model->get_customer(),
            'list_tipekurir' => $this->Superadmin_Model->get_tipekurir(),
        ];

        $this->form_validation->set_rules('sender_ID', 'Nama Pengirim', 'required|trim');
        $this->form_validation->set_rules('receiver_name', 'Nama Penerima', 'required|trim');
        $this->form_validation->set_rules('receiver_telp', 'Nomor Telepon Penerima', 'required|trim');
        $this->form_validation->set_rules('kota_tujuan', 'Kota Tujuan', 'required|trim');
        $this->form_validation->set_rules('alamat_tujuan', 'Alamat Tujuan', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori Paket', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load_template('admin/kirim_paket', $data);
            // $this->load_template('admin/tes_post', $data);
        } else {
            $data_insert = [
                'sender_ID' => $this->input->post('sender_ID'),
                'receiver_name' => $this->input->post('receiver_name'),
                'receiver_telp' => $this->input->post('receiver_telp'),
                'kota_tujuan' => $this->input->post('kota_tujuan'), # zip code
                // 'kota_tujuan' => '17111', # zip code
                'alamat_tujuan' => $this->input->post('alamat_tujuan'),
                'bobot' => $this->input->post('bobot'),
                'kategori' => $this->input->post('kategori'),
                'volume' => $this->input->post('volume'),
                'tipe_kurir' => $this->input->post('tipe_kurir'),
            ];

            $ID = $this->_simpan_data_paket($data_insert);

            if (empty($ID)) {
                $this->session->set_flashdata('error', 'Gagal simpan data');
            } else {
                // konfirmasi
                redirect('superadmin/kirim-paket/' . md5($ID));
            }

            // echo $this->input->post('sender_ID');
        }
    }

    private function _simpan_data_paket($data)
    {
        $ID = "KRM" . ($this->General_Model->hitung_row('pengiriman') + 1) . date('Y');

        // zip code dan kota
        $str_expl = explode('-', $data['kota_tujuan']);

        $zip_code_tujuan = $str_expl[0];
        $kota_tujuan = $str_expl[1];

        $total_biaya = 0;
        $bobot = 0;

        /** BERAT VOLUMETRIK
         * konstanta metode kirim darat: 4000
         * 
         * RUMUS: VOLUME / 4000 (hasil untuk satuan KG)
         */

        /** SUMBER VARIABLE BOBOT
         * 
         * diambil mana yang terbesar: berat volumetrik atau bobot asli
         * 
         */

        /** SUMBER:
         * https://repositori.uin-alauddin.ac.id/20253/1/Nikmatul%20Magfirah.pdf?utm_source=chatgpt.com
         */

        $berat_volumetrik = (int) $data['volume'] / 4000;
        $berat_asli_kg = $data['bobot'] / 1000; # diubah satuan ke KG

        if ($berat_asli_kg > $berat_volumetrik) {
            $bobot = $berat_asli_kg;
        } else if ($berat_asli_kg == $berat_volumetrik) {
            $bobot = $berat_asli_kg;
        } else {
            $bobot = $berat_volumetrik;
        }

        $biaya_bobot = (int) $this->Superadmin_Model->kelompok_harga_bobot($bobot); # biaya per Kg. input per kilogram
        $biaya_kategori = (int) $this->Superadmin_Model->kelompok_harga_kategori($data['kategori']);

        // untuk sementara (09/07/2025 biaya volume tidak perlu digunakan)
        // $biaya_volume = (int) $this->Superadmin_Model->kelompok_harga_volume($data['volume']); # biaya per meter kubik. input per cm kubik

        $response_jarak = $this->zipcodebase->get_distance('17435', $zip_code_tujuan, 'id'); # JSON

        # harus diganti per titik
        $jarak = (int) $response_jarak['results'][$zip_code_tujuan]; # jarak per Km

        $biaya_jarak = (int) $this->Superadmin_Model->kelompok_harga_jarak($jarak); # biaya per km

        # bobot input
        $bobot_kg = (int) $bobot;

        // # volume input CENTIMETER KUBIK diubah ke METER KUBIK
        // $volume_m_kubik = (int) $data['volume'] / 1000000;

        # total + (bobot_kg * biaya_bobot)
        $total_biaya += ($bobot_kg * $biaya_bobot);

        // # total + (volume_m_kubik * biaya_volume)
        // $total_biaya += ($volume_m_kubik * $biaya_volume);

        # total + kategori
        $total_biaya += $biaya_kategori;

        # total + (jarak_km * biaya_jarak)
        $total_biaya += ($jarak * $biaya_jarak);

        # tanggal kirim dan limit tanggal tiba
        $sent_date = date('Y-m-d');

        $tipe_kurir = $this->Superadmin_Model->get_tipekurir_id($data['tipe_kurir']);
        $target_tiba_angka = strtotime('+' . (int)$tipe_kurir['durasi_hari'] . ' days', strtotime($sent_date));
        $target_tiba = date('Y-m-d', $target_tiba_angka);

        $total_biaya += (int) $tipe_kurir['biaya'];

        $data_insert = [
            'ID' => $ID,
            'sender_ID' => $data['sender_ID'],
            'receiver_name' => $data['receiver_name'],
            'receiver_telp' => $data['receiver_telp'],
            'alamat_tujuan' => $data['alamat_tujuan'],
            'kota_tujuan' => $kota_tujuan,
            'bobot' => $bobot_kg,
            'jarak' => $jarak,
            'kategori_ID' => $data['kategori'],
            'harga_total' => $total_biaya,
            'tipe_kurir' => $data['tipe_kurir'],
            'sent_date' => $sent_date,
            'volume' => $data['volume'],
            'target_tiba' => $target_tiba,
        ];

        // var_dump($data['kota_tujuan']);

        $this->db->insert('pengiriman', $data_insert);

        if ($this->General_Model->aff_row() > 0) {
            return $ID;
        } else {
            return 0;
        }
    }

    public function konfirmasi_paket($id_paket = "")
    {
        $data = [
            'title' => 'Halaman Konfirmasi Paket Pengiriman',
            'user' => $this->user,
            'list_kategori' => $this->Superadmin_Model->kategori(),
            'data_paket' => $this->Superadmin_Model->get_paket($id_paket),
        ];

        if (empty($data['data_paket'])) redirect('superadmin/kirim-paket');

        $this->load_template('admin/konfirmasi_kirim_paket', $data);
    }

    public function harga_per_kg($offset = 0)
    {
        $data = [
            'title' => 'Harga per Kilogram',
            'user' => $this->user,
            'list_harga' => $this->Superadmin_Model->kelompok_harga_bobot("", $this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/harga-bobot');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->kelompok_harga_bobot());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('superadmin/harga_kg', $data);
    }

    public function harga_per_km($offset = 0)
    {
        $data = [
            'title' => 'Harga per Kilometer',
            'user' => $this->user,
            'list_harga' => $this->Superadmin_Model->kelompok_harga_jarak("", $this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/harga-jarak');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->kelompok_harga_jarak());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('superadmin/harga_km', $data);
    }

    public function kategori_view($offset = 0)
    {
        $data = [
            'title' => 'Kategori Paket',
            'user' => $this->user,
            'list_kategori' => $this->Superadmin_Model->kategori($this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/harga-kategori');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->kategori());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('superadmin/kategori', $data);
    }

    public function kelola_armada_view($offset = 0)
    {
        $data = [
            'title' => 'Kelola Armada',
            'user' => $this->user,
            'list_armada' => $this->Superadmin_Model->all_armada($this->per_page, $offset),
            'list_jenis' => $this->Superadmin_Model->all_jenis(),
            'list_sopir' => $this->Superadmin_Model->sopir('1'),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/kelola-armada');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->all_armada());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->form_validation->set_rules('nopol', 'License Plate', 'required|trim|is_unique[armada.plat_nomor]');
        $this->form_validation->set_rules('jenis', 'Type', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load_template('superadmin/armada', $data);
        } else {
            $this->_tambah_armada();
        }
    }

    private function _tambah_armada()
    {
        $plat_nomor = $this->input->post('nopol');
        $jenis = $this->input->post('jenis');
        $sopir = $this->input->post('sopir');
        $keterangan = $this->input->post('keterangan');

        $data_insert = [
            'plat_nomor' => $plat_nomor,
            'jenis_ID' => $jenis,
            'sopir_ID' => $sopir,
            'keterangan' => $keterangan,
        ];

        $this->db->insert('armada', $data_insert);

        if ($this->General_Model->aff_row() != 0) {
            redirect('superadmin/kelola-armada');
        } else {
            $this->session->set_flashdata('message', 'Gagal simpan');
            redirect('superadmin/kelola-armada');
        }
    }

    public function lacak_armada_view($plat_nomor = "")
    {
        if (empty($plat_nomor)) {
            redirect('superadmin/kelola-armada');
        }

        $data_armada = $this->Superadmin_Model->armada($plat_nomor);

        $data = [
            'title' => 'Lacak Lokasi Armada',
            'user' => $this->user,
            'armada' => $data_armada,
            'is_peta' => true,
        ];

        $this->load_template('superadmin/peta', $data);
    }

    public function harga_per_volume($offset = 0)
    {
        $data = [
            'title' => 'Harga per Kubik',
            'user' => $this->user,
            'list_harga' => $this->Superadmin_Model->kelompok_harga_volume("", $this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/harga-volume');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->kelompok_harga_volume());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('superadmin/harga_volume', $data);
    }

    public function tambah_harga_kg()
    {
        # rules
        $this->form_validation->set_rules('range_low', 'Batas Bawah', 'required|trim');
        $this->form_validation->set_rules('range_high', 'Batas Atas', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'Lengkapi data.');
            redirect('superadmin/harga-bobot');
        } else {
            $low = $this->input->post('range_low');
            $high = $this->input->post('range_high');
            $harga = $this->input->post('harga');

            $user = $this->session->userdata('user');

            $data_insert = [
                'range_low' => $low,
                'range_high' => $high,
                'harga' => $harga,
                'created_at' => date("Y-m-d"),
                'created_by' => $user['email'], # `email` adalah PK dari superadmin
                'is_deactive' => 0,
            ];

            $this->db->insert('golongan_bobot', $data_insert);

            if ($this->General_Model->aff_row() > 0) {
                redirect('superadmin/harga-bobot');
            } else {
                $this->session->set_flashdata('message', 'Gagal simpan data.');
                redirect('superadmin/harga-bobot');
            }
        }
    }

    public function tambah_harga_volume()
    {
        # rules
        $this->form_validation->set_rules('range_low', 'Batas Bawah', 'required|trim');
        $this->form_validation->set_rules('range_high', 'Batas Atas', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'Lengkapi data.');
            redirect('superadmin/harga-volume');
        } else {
            $low = $this->input->post('range_low');
            $high = $this->input->post('range_high');
            $harga = $this->input->post('harga');

            $user = $this->session->userdata('user');

            $data_insert = [
                'range_low' => $low,
                'range_high' => $high,
                'harga' => $harga,
                'created_at' => date("Y-m-d"),
                'created_by' => $user['email'], # `email` adalah PK dari superadmin
                'is_deactive' => 0,
            ];

            $this->db->insert('golongan_volume', $data_insert);

            if ($this->General_Model->aff_row() > 0) {
                redirect('superadmin/harga-volume');
            } else {
                $this->session->set_flashdata('message', 'Gagal simpan data.');
                redirect('superadmin/harga-volume');
            }
        }
    }

    public function tambah_harga_km()
    {
        # rules
        $this->form_validation->set_rules('range_low', 'Batas Bawah', 'required|trim');
        $this->form_validation->set_rules('range_high', 'Batas Atas', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'Lengkapi data.');
            redirect('superadmin/harga-jarak');
        } else {
            $low = $this->input->post('range_low');
            $high = $this->input->post('range_high');
            $harga = $this->input->post('harga');

            $user = $this->session->userdata('user');

            $data_insert = [
                'range_low' => $low,
                'range_high' => $high,
                'harga' => $harga,
                'created_at' => date("Y-m-d"),
                'created_by' => $user['email'], # `email` adalah PK dari superadmin
                'is_deactive' => 0,
            ];

            $this->db->insert('golongan_jarak', $data_insert);

            if ($this->General_Model->aff_row() > 0) {
                redirect('superadmin/harga-jarak');
            } else {
                $this->session->set_flashdata('message', 'Gagal simpan data.');
                redirect('superadmin/harga-jarak');
            }
        }
    }

    public function tambah_kategori()
    {
        $this->form_validation->set_rules('kategori', 'Category', 'required|trim|is_unique[kategori_paket.Nama]');
        $this->form_validation->set_rules('harga', 'Price', 'trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'Lengkapi Data.');
            redirect('harga-kategori');
        } else {
            $Nama = $this->input->post('kategori');
            $harga = $this->input->post('harga');

            $user = $this->session->userdata('user');

            $data_insert = [
                'Nama' => $Nama,
                'harga' => $harga,
                'created_at' => date("Y-m-d"),
                'created_by' => $user['email'],
                'is_deactivate' => 0,
            ];

            $this->db->insert('kategori_paket', $data_insert);

            if ($this->General_Model->aff_row() > 0) {
                redirect('superadmin/harga-kategori');
            } else {
                $this->session->set_flashdata('message', 'Gagal simpan data.');
                redirect('superadmin/harga-kategori');
            }
        }
    }

    public function kontrak_sopir_view($offset = 0)
    {
        $data = [
            'title' => 'Data Kontrak Sopir',
            'user' => $this->user,
            'list_sopir' => $this->Superadmin_Model->sopir('', $this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/kontrak-sopir');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->sopir());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('superadmin/kontrak-sopir', $data);
    }

    public function tambah_sopir()
    {
        $this->form_validation->set_rules('NIK', 'NIK', 'is_unique[sopir.ID]|trim');
        $this->form_validation->set_rules('NamaLengkap', 'Full Name', 'trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'NIK sudah digunakan');
        } else {

            $NIK = $this->input->post('NIK');
            $NamaLengkap = $this->input->post('NamaLengkap');

            if (!empty($_FILES['foto_sim']['name'])) {
                // Konfigurasi upload
                $extension = pathinfo($_FILES['foto_sim']['name'], PATHINFO_EXTENSION);
                $config['upload_path']   = './assets/img/SIM/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp|pdf';
                $config['max_size']      = 10240; // 10MB
                $config['file_name']     = $NIK . "." . $extension;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto_sim')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];

                    // Simpan ke database
                    $data_insert = [
                        'ID' => $NIK,
                        'NamaLengkap' => $NamaLengkap,
                        'hire_date' => date("Y-m-d"),
                        'is_active' => 0,
                        'foto_SIM' => $file_name,
                    ];
                }
            } else {
                $data_insert = [
                    'ID' => $NIK,
                    'NamaLengkap' => $NamaLengkap,
                    'hire_date' => date("Y-m-d"),
                    'is_active' => 0,
                ];
            }

            $this->db->insert('sopir', $data_insert);

            if ($this->General_Model->aff_row() == 0) {
                $this->session->set_flashdata('message', 'Gagal');
                redirect('superadmin/kontrak-sopir');
            } else {
                redirect('superadmin/kontrak-sopir');
            }
        }
    }

    public function kontrak_sopir_edit_view($ID = '')
    {
        $data = [
            'title' => 'Edit Sopir',
            'user' => $this->user,
            'sopir' => $this->Superadmin_Model->sopir_by_ID_md5($ID),
        ];

        $this->load_template('superadmin/kontrak-sopir-edit', $data);
        // var_dump($data['sopir']);
    }

    public function kontrak_sopir_detail_view($ID = "")
    {
        $data = [
            'title' => 'Detail Kontrak Sopir',
            'user' => $this->user,
            'sopir' => $this->Superadmin_Model->sopir_by_ID_md5($ID),
            'contracts' => $this->Superadmin_Model->kontrak_by_ID_md5($ID),
        ];

        $this->load_template('superadmin/daftar-dokumen-kontrak', $data);
    }

    public function tambah_kontrak_sopir()
    {
        $this->form_validation->set_rules('NIK', 'NIK', 'trim|required');
        $this->form_validation->set_rules('NoKontrak', 'Contract Number', 'trim|required');

        $NIK = $this->input->post('NIK');

        if ($this->form_validation->run() === false && empty($_FILES['file_kontrak']['name'])) {
            $this->session->set_flashdata('message', 'Lengkapi data.');
            redirect('superadmin/kontrak-sopir/edit/' . md5($NIK));
        } else {
            $NoKontrak = $this->input->post('NoKontrak');
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');

            // Konfigurasi upload
            $extension = pathinfo($_FILES['file_kontrak']['name'], PATHINFO_EXTENSION);
            $config['upload_path']   = './assets/docs/kontrak_sopir/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|pdf';
            $config['max_size']      = 10240; // 10MB
            $config['file_name']     = md5($NIK) . "." . $extension;

            $this->upload->initialize($config);

            $is_valid = 0;

            if (strtotime(date('Y-m-d', strtotime($end))) >= strtotime(date('Y-m-d'))) {
                $is_valid = 1;
                $this->db->update('sopir', ['kontrak_sopir' => '1'], ['ID' => $NIK]);
            }

            if ($this->upload->do_upload('file_kontrak')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];

                // Simpan ke database
                $data_insert = [
                    'ID' => $NoKontrak,
                    'sopir_ID' => $NIK,
                    'file_kontrak' => $file_name,
                    'tanggal_mulai' => date("Y-m-d", strtotime($start)),
                    'tanggal_akhir' => date("Y-m-d", strtotime($end)),
                    'is_valid' => $is_valid,
                ];
            }

            $this->db->insert('kontrak_sopir', $data_insert);
            redirect('superadmin/kontrak-sopir/daftar/' . md5($NIK));
        }
    }

    public function edit_data_sopir()
    {
        $this->form_validation->set_rules('NIK', 'NIK', 'required|trim');
        $this->form_validation->set_rules('NamaLengkap', 'Full Name', 'required|trim');

        $NIK = $this->input->post('NIK');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'Lengkapi data');
            redirect('superadmin/kontrak-sopir/edit/' . md5($NIK));
        } else {
            $NamaLengkap = $this->input->post('NamaLengkap');
            $is_active = $this->input->post('is_active');

            (empty($is_active)) ? $is_active = '0' : $is_active = '1';

            if (!empty($_FILES['foto_sim']['name'])) {
                // Konfigurasi upload
                $extension = pathinfo($_FILES['foto_sim']['name'], PATHINFO_EXTENSION);
                $config['upload_path']   = './assets/img/SIM/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp|pdf';
                $config['max_size']      = 10240; // 10MB
                $config['file_name']     = $NIK . "." . $extension;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto_sim')) {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];

                    // Simpan ke database
                    $data_insert = [
                        'NamaLengkap' => $NamaLengkap,
                        'is_active' => $is_active,
                        'foto_SIM' => $file_name,
                    ];
                }
            } else {
                $data_insert = [
                    'NamaLengkap' => $NamaLengkap,
                    'is_active' => $is_active,
                ];
            }

            $where = ['ID' => $NIK];
            $this->db->update('sopir', $data_insert, $where);

            if ($this->General_Model->aff_row() == 0) {
                $this->session->set_flashdata('message', 'Gagal');
                redirect('superadmin/kontrak-sopir#' . $NIK);
            } else {
                redirect('superadmin/kontrak-sopir#' . $NIK);
            }
        }
    }

    public function pilih_sopir()
    {
        $plat_nomor = $this->input->get('nopol');
        $sopir_ID = $this->input->post('sopir');

        $data_insert = ['sopir_ID' => $sopir_ID];
        $where = ['plat_nomor' => $plat_nomor];

        $this->db->update('armada', $data_insert, $where);

        if ($this->General_Model->aff_row() == 0) {
            $this->session->set_flashdata('message', 'Gagal');
            redirect('superadmin/kelola-armada');
        } else {
            redirect('superadmin/kelola-armada');
        }
    }

    public function prosesKirim_pArmada($offset = 0)
    {
        $data = [
            'title' => 'Proses Kirim - Pilih Armada',
            'list_armada' => $this->Superadmin_Model->all_armada($this->per_page, $offset),
            // 'tujuam_armada' => 
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/proses-kirim');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->all_armada());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('admin/pilih_armada', $data);
    }

    public function muatKargo($id_armada_md5 = "", $offset = 0)
    {
        $sort_kota_tujuan = $this->input->get('sort_kota');

        $data = [
            'title' => 'Muat Kargo',
            'list_kargo_termuat' => $this->Superadmin_Model->get_kargo($id_armada_md5, '', $this->per_page, $offset),
            'list_kargo_tersedia' => $this->Superadmin_Model->get_kargo('', $sort_kota_tujuan, $this->per_page, $offset),
            'armada' => $this->Superadmin_Model->armada_md5($id_armada_md5),
            'id_armada_md5' => $id_armada_md5,
            'kota_tersedia' => $this->General_Model->kota_terdaftar(),
        ];

        $armada_id = $data['armada']['armada_ID'];

        // var_dump($data['list_kargo_tersedia']);
        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/proses-kirim/load/' . $id_armada_md5);
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->get_kargo("", $sort_kota_tujuan));

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        // muat kargo
        $this->form_validation->set_rules('ID_pengiriman', 'Resi Number', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load_template('admin/muat_kargo', $data);
        } else {
            $id_pengiriman = $this->input->post('ID_pengiriman');

            if ($this->Superadmin_Model->update_armada_kirim($id_pengiriman, $armada_id)) redirect('superadmin/proses-kirim/load/' . $id_armada_md5);
            else $this->session->set_flashdata('error', 'Gagal tambah');
        }
    }

    public function kelola_tipe_kurir($offset = 0)
    {
        $data = [
            'title' => 'Kelola Tipe Kurir',
            'list_tipekurir' => $this->Superadmin_Model->get_tipekurir($this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('superadmin/kelola-tipe-kurir');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Superadmin_Model->get_tipekurir());

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('superadmin/tipe_kurir_view', $data);
    }

    public function tambah_kurir()
    {
        $this->form_validation->set_rules('tipe', 'Type', 'required|trim');
        $this->form_validation->set_rules('durasi', 'Duration', 'required|trim');
        $this->form_validation->set_rules('harga', 'Price', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('message', 'Lengkapi data');
            redirect('superadmin/kelola-tipe-kurir');
        } else {
            $tipe = $this->input->post('tipe');
            $durasi = $this->input->post('durasi');
            $harga = $this->input->post('harga');

            $data_insert = [
                'tipe' => $tipe,
                'durasi_hari' => $durasi,
                'biaya' => $harga,
            ];

            $this->db->insert('tipe_kurir', $data_insert);

            if ($this->General_Model->aff_row() > 0) {
                redirect('superadmin/kelola-tipe-kurir');
            } else {
                $this->session->set_flashdata('message', 'Lengkapi data');
                redirect('superadmin/kelola-tipe-kurir');
            }
        }
    }

    public function bayar_view()
    {
        $data = [
            'title' => 'Pembayaran',
            'data_kirim' => $this->Superadmin_Model->get_kargo_all('1'),
            'metode_bayar' => $this->Superadmin_Model->get_metode_bayar(),
        ];

        $this->form_validation->set_rules('id_pengiriman', 'Resi', 'required|trim');
        $this->form_validation->set_rules('total_bayar', 'Bayar', 'required|trim');
        $this->form_validation->set_rules('metode_bayar', 'Method', 'required|trim');
        $this->form_validation->set_rules('atas_nama_bayar', 'Nama Kwitansi', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load_template('admin/pembayaran', $data);
        } else {
            $id_pengiriman = $this->input->post('id_pengiriman');
            $total_bayar = $this->input->post('total_bayar');
            $metode_bayar_all = $this->input->post('metode_bayar');
            $atas_nama_bayar = $this->input->post('atas_nama_bayar');

            $explode_metode_bayar = explode('.', $metode_bayar_all);
            $ID_metode_bayar = $explode_metode_bayar[0];
            $isCard_metode_bayar = $explode_metode_bayar[1];

            $sisa_tunggakan = $this->input->post('kembalian');

            if ($isCard_metode_bayar == '1') {
                $nomor_kartu = $this->input->post('nomor_kartu');
            } else {
                $nomor_kartu = null;
            }

            $ID = 'BAYAR' . ((int) $this->General_Model->hitung_row('pembayaran') + 1);

            $data_insert = [
                'ID' => $ID,
                'ID_pengiriman' => $id_pengiriman,
                'jumlah_bayar' => $total_bayar,
                'sisa_tunggakan' => $sisa_tunggakan,
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'metode_bayar' => $ID_metode_bayar,
                'nomor_kartu' => $nomor_kartu,
                'atas_nama_bayar' => $atas_nama_bayar,
            ];

            $this->db->insert('pembayaran', $data_insert);
            redirect('superadmin/bayar/cetak/' . $ID);
        }
    }

    public function cetak_invoice($id_bayar)
    {
        $data = [
            'title' => 'Invoice - ' . $id_bayar,
            'data_bayar' => $this->Customer_Model->data_pembayaran($id_bayar),
        ];

        $this->load_template('admin/cetak_invoice', $data);
    }

    public function get_data_pengiriman()
    {
        $no_resi = $this->input->post('id_pengiriman');
        $data = $this->Superadmin_Model->get_kargo_specific_by_id($no_resi);

        echo json_encode($data);
    }

    public function metode_bayar_view()
    {
        $data = [
            'title' => 'Kelola Metode Pembayaran',
            'metode_bayar' => $this->Superadmin_Model->get_metode_bayar(),
        ];

        $this->load_template('superadmin/metode_bayar', $data);
    }

    public function tambah_metode_bayar()
    {
        $metode_bayar = $this->input->post('metode_bayar');
        $nama_bank = $this->input->post('nama_bank');
        $is_card = $this->input->post('is_card');

        $data_insert = [
            'metode' => $metode_bayar,
            'bank' => $nama_bank,
            'is_card' => $is_card,
        ];

        $this->db->insert('metode_pembayaran', $data_insert);

        if ($this->General_Model->aff_row() > 0) {
            redirect('superadmin/kelola-metode-bayar');
        } else {
            $this->session->set_flashdata('message', 'Gagal simpan');
            redirect('superadmin/kelola-metode-bayar');
        }
    }

    public function monthly_report()
    {
        $data = [
            'title' => 'Monthly Report',
            'reports' => $this->Superadmin_Model->get_report(),
        ];

        $this->load_template('superadmin/monthly_report', $data);
    }
}
