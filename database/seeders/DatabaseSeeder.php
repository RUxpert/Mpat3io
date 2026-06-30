<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed data dari CI3 (3io.sql) ke schema Laravel.
     *
     * Mapping:
     *   CI3 mitra   → users (role=mitra)
     *   CI3 penyewa → users (role=penyewa)
     *   CI3 villa   → villas  (id_mitra → user_id via $mitraMap)
     *   CI3 pesanan → orders  (id_penyewa/id_mitra/id_villa di-remap)
     */
    public function run(): void
    {
        // ----------------------------------------------------------------
        // 1. USERS — merge mitra + penyewa ke satu tabel
        // ----------------------------------------------------------------

        // Mitra dari CI3
        // $mitraMap[ci3_id_mitra] = new_user_id
        $mitraMap = [];

        $mitraRows = [
            // ['id_mitra', 'email_mitra', 'username', 'nama_mitra', 'alamat', 'password']
            // Password plain text di CI3 (id=1) sengaja di-hash ulang,
            // yang sudah bcrypt dibiarkan apa adanya.
            [1, 'test@test.com',    'aku_ngetes_mitra',      'Aku Mitra',              'dekat tambak boyo',    Hash::make('123123')],
            [2, 'admin@admin.com',  'admin_ganteng',         'Admin Mitra Ganteng',    'dekat rumah admin',    '$2y$10$GgFGzo0LZhQFREeIhe.mUOzuwI1BFuErmMEAFsV9mXGCaVcqX7m0K'],
            [3, 'asd@gmail.com',    'mitra_asd',             'Mitra 123',              'dekat kampus amikom',  '$2y$10$7t8jYASudFA2kYxZ/9G2X.uQLBKI1RWblzQcSgLLEbxmsTO55J4si'],
            [8, 'adj@amikom.ac.id', 'adj_mitra',             'Adj Mitra',              'amikom',               '$2y$10$eFw6oDyWpn/2njoXz9Vkce/ZPIOuHGM7VZCZLYQIeUTEV/65xweCu'],
            [9, 'adj@adminn.com',   'admin_mitra',           'Admin',                  'qwerty',               '$2y$10$e21qriCdGM/cQX/p8tSBtuylR46.MCdSbrKLa/bcO1BUHIJnIlcZm'],
            [10,'darman@amikom.ac.id','darman_mitra',        'Darman Mitra',           'amikom',               '$2y$10$oxtNfumZLWNoREWzySsx3ehYna6GL3JX/dV1HtUbsPYS5jwAlvzJO'],
        ];

        foreach ($mitraRows as [$oldId, $email, $username, $name, $alamat, $password]) {
            $newId = DB::table('users')->insertGetId([
                'name'       => $name,
                'email'      => $email,
                'username'   => $username,
                'role'       => 'mitra',
                'alamat'     => $alamat,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $mitraMap[$oldId] = $newId;
        }

        // Penyewa dari CI3
        // $penyewaMap[ci3_id_penyewa] = new_user_id
        $penyewaMap = [];

        $penyewaRows = [
            // ['id_penyewa', 'email_penyewa', 'nama_penyewa', 'no_telp', 'password']
            [1, 'test@penyewa.com',     'Aku Nyoba Nyewa',  '082122212121', '$2y$10$.ArWt6XZQ.HDrdwbJj/DUOe15ICDui3tpEVfcWhiB1VAsUGwiQp7q'],
            [3, 'penyewa.admin@admin.com','Admin Penyewa',  '123321',       '$2y$10$gTMgJgpQDodBr4rrPtaQr.J9chHRUKJKOIzBoaOnILFFRKJFvSEaW'],
            [4, 'penyewa.test@test.com', 'WWW Penyewa',     '222',          '$2y$10$.ArWt6XZQ.HDrdwbJj/DUOe15ICDui3tpEVfcWhiB1VAsUGwiQp7q'],
            [5, 'adj@adj.com',           'Adj Penyewa',     '123321',       '$2y$10$M8NnrdUfrng4XJ7cFrFBNOh7WEg1mHKYVLPoDn/fzoO92uVgWcWCO'],
            [6, 'adjriel@amikom.ac.id',  'Adjriel Ibra',    '08999999999',  '$2y$10$99cm0GQyRxlcPJAzfKM.0e/chbnAdESdYAKzc568VrqNxgDundhba'],
            [7, 'penyewa.adj@amikom.ac.id','Adj Ganteng',   '123321',       '$2y$10$1uNVPE5zd4i0n99wQ2YoBe6qva/6Bmm2efv8yUSUFaLGzJOaJZNE.'],
            [8, 'penyewa.darman@amikom.ac.id','Darman Penyewa','082222222', '$2y$10$v5s7jmWwBmkNFVpiJ1tFxOD8CUI0g6c62muXFns/KnjJozfnIkp4K'],
        ];

        foreach ($penyewaRows as [$oldId, $email, $name, $noTelp, $password]) {
            $newId = DB::table('users')->insertGetId([
                'name'       => $name,
                'email'      => $email,
                'username'   => null,
                'role'       => 'penyewa',
                'no_telp'    => $noTelp,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $penyewaMap[$oldId] = $newId;
        }

        // ----------------------------------------------------------------
        // 2. VILLAS — remap id_mitra → user_id (pakai $mitraMap)
        // ----------------------------------------------------------------

        // $villaMap[ci3_id_villa] = new_villa_id
        $villaMap = [];

        $villaRows = [
            // ['id_villa', 'id_mitra', 'harga', 'nama_villa', 'deskripsi', 'gambar', 'status_villa']
            [1,  1, 100000.00,  'Villa Ganteng',    'Tempat nongkrong orang ganteng', 'asset/Uploads/dummy_villa.png',                        'booked'],
            [4,  1, 213312.00,  'Villa Fast',       'Tempat fast banget',             'asset/Uploads/dummy_villa.png',                        'tersedia'],
            [5,  1, 213312.00,  '23 Villa',         '23 villa buat anak 23',          'asset/Uploads/dummy_villa.png',                        'tersedia'],
            [11, 2, 777777.00,  'Test Gambar',      'Test gambar semoga bisa',        'asset/Uploads/pngegg.png',                             'booked'],
            [12, 2, 2222222.00, 'Test Gambar Ke 2', 'Dah lah',                        'asset/Uploads/pngegg.png',                             'tersedia'],
            [14, 2, 123123.00,  'Admin Villa',      'qweqweq',                        'asset/Uploads/9ce5279b649ac178cc4f4965c861f06b.png',   'tersedia'],
            [15, 2, 1231231.00, '123131 Villa',     'qqweqeqeqw',                     'asset/Uploads/b075c60afef81af1b226cf8ab38ddf6f.png',   'tersedia'],
        ];

        foreach ($villaRows as [$oldId, $oldMitraId, $harga, $nama, $deskripsi, $gambar, $status]) {
            $newId = DB::table('villas')->insertGetId([
                'user_id'      => $mitraMap[$oldMitraId],
                'harga'        => $harga,
                'nama_villa'   => $nama,
                'deskripsi'    => $deskripsi,
                'gambar'       => $gambar,
                'status_villa' => $status,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
            $villaMap[$oldId] = $newId;
        }

        // ----------------------------------------------------------------
        // 3. ORDERS — remap id_penyewa, id_mitra, id_villa
        //    CI3 typo 'expitred' → Laravel 'expired'
        // ----------------------------------------------------------------

        $pesananRows = [
            // ['id_pesanan', 'id_penyewa', 'id_villa', 'id_mitra', 'total_harga', 'tgl_check_in', 'tgl_check_out', 'tgl_pesanan', 'status_pesanan']
            [1, 3, 1,  1, 2100000.00, '2025-11-30 14:48:02', '2025-11-30 14:48:02', '2025-11-30 14:48:02', 'cancelled'],
            [2, 3, 5,  1, 2200000.00, '2025-12-09 15:48:40', '2025-12-09 15:48:40', '2025-12-09 15:48:40', 'checkin'],
            [3, 3, 11, 2, 2100000.00, '2025-12-17 16:48:02', '2025-12-17 16:48:02', '2025-12-17 16:48:02', 'pending'],
        ];

        foreach ($pesananRows as [$oldId, $oldPenyewaId, $oldVillaId, $oldMitraId, $totalHarga, $tglIn, $tglOut, $tglPesan, $status]) {
            // Normalisasi typo dari CI3
            $status = $status === 'expitred' ? 'expired' : $status;

            DB::table('orders')->insert([
                'tenant_id'      => $penyewaMap[$oldPenyewaId],
                'villa_id'       => $villaMap[$oldVillaId],
                'host_id'        => $mitraMap[$oldMitraId],
                'total_harga'    => $totalHarga,
                'tgl_check_in'   => $tglIn,
                'tgl_check_out'  => $tglOut,
                'tgl_pesanan'    => $tglPesan,
                'status_pesanan' => $status,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        $this->command->info('✓ ' . count($mitraMap)   . ' mitra  di-import sebagai users (role=mitra)');
        $this->command->info('✓ ' . count($penyewaMap) . ' penyewa di-import sebagai users (role=penyewa)');
        $this->command->info('✓ ' . count($villaMap)   . ' villa   di-import ke tabel villas');
        $this->command->info('✓ ' . count($pesananRows)  . ' pesanan di-import ke tabel orders');
    }
}
