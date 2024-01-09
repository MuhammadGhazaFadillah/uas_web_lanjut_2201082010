<?php

namespace Database\Seeders;

use App\Models\Mine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TambangSeeder extends Seeder
{
    public function run(): void
    {
        $mines =  [
            [
                'id' => 'T01082010',
                'nama' => 'Nikel',
                'sinopsis' => 'Amerika, Inggris, dan negara-negara Eropa menggunakan nikel sebagai koin. Nikel bersifat magnetis pada suhu kamar dan sepenuhnya dapat didaur ulang. Nikel merupakan unsur paling berlimpah kedua di bumi setelah besi.',
                'tahun' => 1751,
                'category_id' => 1,
                'penemu' => 'Baron Axel fredrik Cronstedt',
                'foto_sampul' => 'nikel.jpeg',
            ],
            [
                'id' => 'T01082011',
                'nama' => 'Emas',
                'sinopsis' => 'Penemu emas pertama di dunia sendiri tidak diketahui. Namun, pertambangan emas sendiri diperkirakan sudah ada sejak tahun 4.000 SM, bahkan jauh sebelumnya.',
                'tahun' => 400,
                'category_id' => 1,
                'penemu' => 'Tidak Diketahui',
                'foto_sampul' => 'emas.jpeg',
            ],
            [
                'id' => 'T01082012',
                'nama' => 'Tembaga',
                'sinopsis' => 'Tembaga adalah salah satu dari sedikit logam yang dapat terjadi di alam dalam bentuk logam yang dapat digunakan secara langsung (logam asli). Hal ini menyebabkan penggunaan tembaga oleh manusia sangat awal di beberapa daerah, dari ca.8000 SM. Ribuan tahun kemudian, ia adalah logam pertama yang dilebur dari bijih sulfida, ca.5000 SM; logam pertama yang dicetak menjadi sebuah bentuk dalam cetakan, ca. 4000 SM; dan logam pertama yang sengaja dipadukan dengan logam lain, timah, untuk membuat perunggu, ca.500 SM',
                'tahun' => 8000,
                'category_id' => 2,
                'penemu' => 'Tidak Diketahui',
                'foto_sampul' => 'tembaga.jpeg',
            ],
            [
                'id' => 'T01082013',
                'nama' => 'Bauksit',
                'sinopsis' => 'Bauksit merupakan material dasar untuk memproduksi alumina. Bauksit pertama kali ditemukan pada tahun 1924 di Kijang, pulau Bintan, di provinsi Kepulauan Riau. Bauksit yang berasal dari Bintan telah ditambang dan diekspor sejak tahun 1935.',
                'tahun' => 1924,
                'category_id' => 2,
                'penemu' => 'Kijang, pulau Bintan, prov. Kepri',
                'foto_sampul' => 'bauksit.jpeg',
            ],
            [
                'id' => 'T01082014',
                'nama' => 'Timah',
                'sinopsis' => 'Pulau Bangka Belitung merupakan penghasil timah terbesar di Indonesia. Pulau Bangka disebut-sebut sebagai kawasan sabuk timah Asia Tenggara yang menyebar dari daratan Thailand, Malaysia, Kepulauan Riau hingga ke Pulau Bangka dan Belitung.',
                'tahun' => 1823,
                'category_id' => 1,
                'penemu' => 'JP. De La Motte',
                'foto_sampul' => 'timah.jpeg',
            ],
        ];
        foreach ($mines as $mine) {
            Mine::create([
                'id' => $mine['id'],
                'nama' => $mine['nama'],
                'sinopsis' => $mine['sinopsis'],
                'tahun' => $mine['tahun'],
                'category_id' => $mine['category_id'],
                'penemu' => $mine['penemu'],
                'foto_sampul' => $mine['foto_sampul'],
            ]);
        }

    }
}
