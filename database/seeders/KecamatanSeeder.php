<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `kecamatans` (`id`, `kabupaten_id`, `nama`, `alt_name`, `lat`, `long`) VALUES
(1501010, 1501, 'GUNUNG RAYA', 'GUNUNG RAYA', 0, 0),
(1501011, 1501, 'BUKIT KERMAN', 'BUKIT KERMAN', 0, 0),
(1501020, 1501, 'BATANG MERANGIN', 'Batang Merangin, Kerinci Regency, Jambi, Indonesia', -2.13929, 101.66129),
(1501030, 1501, 'KELILING DANAU', 'Keliling Danau, Kabupaten Kerinci, Jambi, Indonesia', -2.23766, 101.4112),
(1501040, 1501, 'DANAU KERINCI', 'Danau, Gunung Tujuh, Kerinci Regency, Jambi, Indonesia', -1.70489, 101.41688),
(1501050, 1501, 'SITINJAU LAUT', 'Sitinjau Laut, Kerinci Regency, Jambi, Indonesia', -2.05397, 101.49071),
(1501070, 1501, 'AIR HANGAT', 'Air Hangat, Kerinci Regency, Jambi, Indonesia', -1.89044, 101.54754),
(1501071, 1501, 'AIR HANGAT TIMUR', 'East Air Hangat, Kerinci Regency, Jambi, Indonesia', -2.00616, 101.45663),
(1501072, 1501, 'DEPATI VII', 'Depati VII, Kerinci Regency, Jambi, Indonesia', -2.02134, 101.34878),
(1501073, 1501, 'AIR HANGAT BARAT', 'Air Hangat Bar., Kabupaten Kerinci, Jambi, Indonesia', -1.98815, 101.37218),
(1501080, 1501, 'GUNUNG KERINCI', 'Mount Kerinci, South Lubuk Gadang, Sangir, South Solok Regency, West Sumatra, Indonesia', -1.69667, 101.26417),
(1501081, 1501, 'SIULAK', 'Siulak, Kerinci Regency, Jambi, Indonesia', -1.97854, 101.28639),
(1501082, 1501, 'SIULAK MUKAI', 'Siulak Mukai, Kabupaten Kerinci, Jambi, Indonesia', -1.85275, 101.45663),
(1501090, 1501, 'KAYU ARO', 'Kayu Aro, Kerinci Regency, Jambi, Indonesia', -1.78673, 101.30907),
(1501091, 1501, 'GUNUNG TUJUH', 'Gunung Tujuh, Kerinci Regency, Jambi, Indonesia', -1.7386, 101.3658),
(1501092, 1501, 'KAYU ARO BARAT', 'Kayu Aro Bar., Kabupaten Kerinci, Jambi, Indonesia', -1.77794, 101.18439),
(1502010, 1502, 'JANGKAT', 'Jangkat, Merangin Regency, Jambi, Indonesia', -2.52525, 101.75239),
(1502011, 1502, 'SUNGAI TENANG', 'Tenang River, Merangin Regency, Jambi, Indonesia', -2.52271, 102.02613),
(1502020, 1502, 'MUARA SIAU', 'Muara Siau, Merangin Regency, Jambi, Indonesia', -2.28976, 102.11754),
(1502021, 1502, 'LEMBAH MASURAI', 'Lembah Masurai, Merangin Regency, Jambi, Indonesia', -2.38814, 101.91199),
(1502022, 1502, 'TIANG PUMPUNG', 'Tiang Pumpung, Merangin Regency, Jambi, Indonesia', -2.30807, 102.2319),
(1502030, 1502, 'PAMENANG', 'Pamenang, Pemenang Tim., Pemenang, Kabupaten Lombok Utara, Nusa Tenggara Bar., Indonesia', -8.409, 116.1079),
(1502031, 1502, 'PAMENANG BARAT', 'West Pamenang, Merangin Regency, Jambi, Indonesia', -2.07573, 102.41513),
(1502032, 1502, 'RENAH PAMENANG', 'Renah Pamenang, Merangin Regency, Jambi, Indonesia', -2.16239, 102.38076),
(1502033, 1502, 'PAMENANG SELATAN', 'South Pamenang, Merangin Regency, Jambi, Indonesia', -2.26832, 102.3693),
(1502040, 1502, 'BANGKO', 'Bangko, Pematang Kandis, Bangko, Kabupaten Merangin, Jambi, Indonesia', -2.07356, 102.275),
(1502041, 1502, 'BANGKO BARAT', 'West Bangko, Merangin Regency, Jambi, Indonesia', -2.19247, 102.2319),
(1502042, 1502, 'NALO TANTAN', 'Nalo Tantan, Merangin Regency, Jambi, Indonesia', -2.00083, 102.18614),
(1502043, 1502, 'BATANG MASUMAI', 'Batang Masumai, Merangin Regency, Jambi, Indonesia', -2.07754, 102.18614),
(1502050, 1502, 'SUNGAI MANAU', 'Manau River, Merangin Regency, Jambi, Indonesia', -2.04125, 101.91199),
(1502051, 1502, 'RENAH PEMBARAP', 'Renah Pembarap, Merangin Regency, Jambi, Indonesia', -2.11703, 102.04898),
(1502052, 1502, 'PANGKALAN JAMBU', 'Pangkalan Jambu, Merangin Regency, Jambi, Indonesia', -2.11881, 101.82076),
(1502060, 1502, 'TABIR', 'Tabir, Merangin Regency, Jambi, Indonesia', -1.80903, 102.27768),
(1502061, 1502, 'TABIR ULU', 'Tabir Ulu, Merangin Regency, Jambi, Indonesia', -1.92426, 102.18614),
(1502062, 1502, 'TABIR SELATAN', 'South Tabir, Merangin Regency, Jambi, Indonesia', -1.96082, 102.41513),
(1502063, 1502, 'TABIR ILIR', 'Tabir Ilir, Merangin Regency, Jambi, Indonesia', -1.73222, 102.3693),
(1502064, 1502, 'TABIR TIMUR', 'East Tabir, Merangin Regency, Jambi, Indonesia', -1.70301, 102.47245),
(1502065, 1502, 'TABIR LINTAS', 'Tabir Lintas, Merangin Regency, Jambi, Indonesia', -1.93307, 102.28913),
(1502066, 1502, 'MARGO TABIR', 'Margo Tabir, Merangin Regency, Jambi, Indonesia', -1.88471, 102.3693),
(1502067, 1502, 'TABIR BARAT', 'West Tabir, Merangin Regency, Jambi, Indonesia', -1.90756, 101.84356),
(1503010, 1503, 'BATANG ASAI', 'Batang Asai, Sarolangun Regency, Jambi, Indonesia', -2.52099, 102.20902),
(1503020, 1503, 'LIMUN', 'Limun, Sarolangun Regency, Jambi, Indonesia', -2.59587, 102.48392),
(1503021, 1503, 'CERMIN NAN GEDANG', 'CERMIN NAN GEDANG', 0, 0),
(1503030, 1503, 'PELAWAN', 'Pelawan, Pelawan Jaya, Pelawan, Kabupaten Sarolangun, Jambi, Indonesia', -2.38028, 102.6973),
(1503031, 1503, 'SINGKUT', 'Singkut, Sarolangun Regency, Jambi, Indonesia', -2.53567, 102.69053),
(1503040, 1503, 'SAROLANGUN', 'Sarolangun Regency, Jambi, Indonesia', -2.32304, 102.71351),
(1503041, 1503, 'BATHIN VIII', 'Batin VIII, Sarolangun Regency, Jambi, Indonesia', -2.26671, 102.55275),
(1503050, 1503, 'PAUH', 'Pauh, Kabupaten Sarolangun, Jambi, Indonesia', -2.14121, 102.8202),
(1503051, 1503, 'AIR HITAM', 'Air Hitam, Samarinda Ulu, Samarinda City, East Kalimantan, Indonesia', -0.44695, 117.12059),
(1503060, 1503, 'MANDIANGIN', 'Mandiangin, Mandi Angin, Rawas Ilir, Kabupaten Musi Rawas, Sumatera Selatan, Indonesia', -2.66667, 103.06667),
(1504010, 1504, 'MERSAM', 'Mersam, Batang Hari Regency, Jambi, Indonesia', -1.52, 102.94355),
(1504011, 1504, 'MARO SEBO ULU', 'Maro Sebo Ulu, Batang Hari Regency, Jambi, Indonesia', -1.72943, 102.78248),
(1504020, 1504, 'BATIN XXIV', 'Batin XXIV, Batang Hari Regency, Jambi, Indonesia', -1.89954, 102.94355),
(1504030, 1504, 'MUARA TEMBESI', 'Muara Tembesi, Batang Hari Regency, Jambi, Indonesia', -1.7272, 103.10484),
(1504040, 1504, 'MUARA BULIAN', 'Muara Bulian, Batang Hari Regency, Jambi, Indonesia', -1.65967, 103.27789),
(1504041, 1504, 'BAJUBANG', 'Bajubang, Batang Hari Regency, Jambi, Indonesia', -2.04922, 103.31253),
(1504042, 1504, 'MARO SEBO ILIR', 'Maro Sebo Ilir, Batang Hari Regency, Jambi, Indonesia', -1.5751, 103.19711),
(1504050, 1504, 'PEMAYUNG', 'Pemayung, Batang Hari Regency, Jambi, Indonesia', -1.51772, 103.31253),
(1505010, 1505, 'MESTONG', 'Mestong, Muaro Jambi Regency, Jambi, Indonesia', -1.81922, 103.49743),
(1505011, 1505, 'SUNGAI BAHAR', 'Bahar River, Muaro Jambi Regency, Jambi, Indonesia', -1.99062, 103.4743),
(1505012, 1505, 'BAHAR SELATAN', 'South Bahar, Muaro Jambi Regency, Jambi, Indonesia', -2.10514, 103.4743),
(1505013, 1505, 'BAHAR UTARA', 'North Bahar, Muaro Jambi Regency, Jambi, Indonesia', -1.91517, 103.38183),
(1505020, 1505, 'KUMPEH ULU', 'Kumpeh Ulu, Muaro Jambi Regency, Jambi, Indonesia', -1.60885, 103.79844),
(1505021, 1505, 'SUNGAI GELAM', 'Gelam River, Muaro Jambi Regency, Jambi, Indonesia', -1.74131, 103.77526),
(1505030, 1505, 'KUMPEH', 'Kumpeh, Muaro Jambi Regency, Jambi, Indonesia', -1.55089, 104.00723),
(1505040, 1505, 'MARO SEBO', 'Maro Sebo, Muaro Jambi Regency, Jambi, Indonesia', -1.42173, 103.61312),
(1505041, 1505, 'TAMAN RAJO', 'Taman Rajo, Muaro Jambi Regency, Jambi, Indonesia', -1.42089, 103.75209),
(1505050, 1505, 'JAMBI LUAR KOTA', 'Jambi Luar Kota, Muaro Jambi Regency, Jambi, Indonesia', -1.64887, 103.4743),
(1505060, 1505, 'SEKERNAN', 'Sekernan, Muaro Jambi Regency, Jambi, Indonesia', -1.36657, 103.40494),
(1506010, 1506, 'MENDAHARA', 'Mendahara Ulu, East Tanjung Jabung Regency, Jambi, Indonesia', -1.21607, 103.49743),
(1506011, 1506, 'MENDAHARA ULU', 'Mendahara Ulu, East Tanjung Jabung Regency, Jambi, Indonesia', -1.21607, 103.49743),
(1506012, 1506, 'GERAGAI', 'Geragai, East Tanjung Jabung Regency, Jambi, Indonesia', -1.2337, 103.70575),
(1506020, 1506, 'DENDANG', 'Dendang, Muara Gerunggang, Pemahan, Kabupaten Ketapang, Kalimantan Barat, Indonesia', -1.70278, 110.4341),
(1506031, 1506, 'MUARA SABAK BARAT', 'Jalan Jambi, Geragai, Kabupaten Tanjung Jabung Timur, Jambi 36764, Indonesia', -1.27479, 103.70729),
(1506032, 1506, 'MUARA SABAK TIMUR', 'East Muara Sabak, East Tanjung Jabung Regency, Jambi, Indonesia', -1.06455, 103.96081),
(1506033, 1506, 'KUALA JAMBI', 'Kuala Jambi, East Tanjung Jabung Regency, Jambi, Indonesia', -1.05603, 103.78685),
(1506040, 1506, 'RANTAU RASAU', 'Rantau Rasau, East Tanjung Jabung Regency, Jambi, Indonesia', -1.1571, 104.0769),
(1506041, 1506, 'BERBAK', 'Berbak, East Tanjung Jabung Regency, Jambi, Indonesia', -1.26883, 104.12337),
(1506050, 1506, 'NIPAH PANJANG', 'Nipah Panjang, East Tanjung Jabung Regency, Jambi, Indonesia', -1.08217, 104.16985),
(1506060, 1506, 'SADU', 'Pulau Sadu, Indonesia', 0.42944, 121.49139),
(1507010, 1507, 'TUNGKAL ULU', 'Tungkal Ulu, West Tanjung Jabung Regency, Jambi, Indonesia', -1.16185, 103.10484),
(1507011, 1507, 'MERLUNG', 'Merlung, Kabupaten Tanjung Jabung Barat, Jambi, Indonesia', -1.26681, 103.043),
(1507012, 1507, 'BATANG ASAM', 'Batang Asam, West Tanjung Jabung Regency, Jambi, Indonesia', -1.10667, 102.89751),
(1507013, 1507, 'TEBING TINGGI', 'Tebing Tinggi, Serdang Bedagai Regency, North Sumatra, Indonesia', 3.38053, 99.20827),
(1507014, 1507, 'RENAH MENDALUH', 'Renah Mendaluh, West Tanjung Jabung Regency, Jambi, Indonesia', -1.2944, 102.85148),
(1507015, 1507, 'MUARA PAPALIK', 'Muara Papalik, West Tanjung Jabung Regency, Jambi, Indonesia', -1.31161, 103.15097),
(1507020, 1507, 'PENGABUAN', 'Pengabuan, West Tanjung Jabung Regency, Jambi, Indonesia', -0.90016, 103.24326),
(1507021, 1507, 'SENYERANG', 'Senyerang, West Tanjung Jabung Regency, Jambi, Indonesia', -0.82651, 103.05874),
(1507030, 1507, 'TUNGKAL ILIR', 'Tungkal Ilir, West Tanjung Jabung Regency, Jambi, Indonesia', -0.83433, 103.48586),
(1507031, 1507, 'BRAM ITAM', 'Bram Itam, West Tanjung Jabung Regency, Jambi, Indonesia', -0.97438, 103.28944),
(1507032, 1507, 'SEBERANG KOTA', 'Seberang Kota, West Tanjung Jabung Regency, Jambi, Indonesia', -0.81611, 103.39339),
(1507040, 1507, 'BETARA', 'Betara, West Tanjung Jabung Regency, Jambi, Indonesia', -0.99253, 103.40494),
(1507041, 1507, 'KUALA BETARA', 'Kuala Betara, West Tanjung Jabung Regency, Jambi, Indonesia', -0.93627, 103.52056),
(1508010, 1508, 'TEBO ILIR', 'Tebo Ilir, Tebo Regency, Jambi, Indonesia', -1.54017, 102.7365),
(1508011, 1508, 'MUARA TABIR', 'Muara Tabir, Tebo Regency, Jambi, Indonesia', -1.74986, 102.5757),
(1508020, 1508, 'TEBO TENGAH', 'Central Tebo, Tebo Regency, Jambi, Indonesia', -1.52275, 102.48392),
(1508021, 1508, 'SUMAY', 'Sumay, Tebo Regency, Jambi, Indonesia', -1.14596, 102.48392),
(1508022, 1508, 'TENGAH ILIR', 'Tengah Ilir, Tebo Regency, Jambi, Indonesia', -1.38937, 102.69053),
(1508030, 1508, 'RIMBO BUJANG', 'Rimbo Bujang, Tebo Regency, Jambi, Indonesia', -1.31681, 102.1404),
(1508031, 1508, 'RIMBO ULU', 'Rimbo Ulu, Tebo Regency, Jambi, Indonesia', -1.27977, 102.0033),
(1508032, 1508, 'RIMBO ILIR', 'Rimbo Ilir, Tebo Regency, Jambi, Indonesia', -1.39158, 102.27768),
(1508040, 1508, 'TEBO ULU', 'Tebo Ulu, Tebo Regency, Jambi, Indonesia', -1.28793, 102.26624),
(1508041, 1508, 'VII KOTO', 'VII Koto, Tebo Regency, Jambi, Indonesia', -1.07287, 102.02613),
(1508042, 1508, 'SERAI SERUMPUN', 'Serai Serumpun, Tebo Regency, Jambi, Indonesia', -1.16564, 102.27768),
(1508043, 1508, 'VII KOTO ILIR', 'Vii Koto Ilir, Tebo Regency, Jambi, Indonesia', -1.01622, 102.1404),
(1509010, 1509, 'PELEPAT', 'Pelepat, Bungo Regency, Jambi, Indonesia', -1.82983, 102.02613),
(1509011, 1509, 'PELEPAT ILIR', 'Pelepat Ilir, Bungo Regency, Jambi, Indonesia', -1.6182, 102.3693),
(1509021, 1509, 'BATHIN II BABEKO', 'Bathin II Babeko, Bungo Regency, Jambi, Indonesia', -1.50528, 102.2319),
(1509022, 1509, 'RIMBO TENGAH', 'Central Rimbo, Bungo Regency, Jambi, Indonesia', -1.55325, 102.12897),
(1509023, 1509, 'BUNGO DANI', 'Bungo Dani, Bungo Regency, Jambi, Indonesia', -1.49665, 102.08325),
(1509024, 1509, 'PASAR MUARA BUNGO', 'Pasar Muara Bungo, Bungo Regency, Jambi, Indonesia', -1.49163, 102.13469),
(1509025, 1509, 'BATHIN III', 'Bathin III Ulu, Bungo Regency, Jambi, Indonesia', -1.69766, 101.82076),
(1509030, 1509, 'RANTAU PANDAN', 'Rantau Pandan, Bungo Regency, Jambi, Indonesia', -1.65874, 101.95763),
(1509031, 1509, 'MUKO-MUKO BATHIN VII', 'MUKO-MUKO BATHIN VII', 0, 0),
(1509032, 1509, 'BATHIN III ULU', 'Bathin III Ulu, Bungo Regency, Jambi, Indonesia', -1.69766, 101.82076),
(1509040, 1509, 'TANAH SEPENGGAL', 'Tanah Sepenggal, Bungo Regency, Jambi, Indonesia', -1.44048, 101.96905),
(1509041, 1509, 'TANAH SEPENGGAL LINTAS', 'Tanah Sepenggal Lintas, Kabupaten Bungo, Jambi, Indonesia', -1.38386, 101.94622),
(1509050, 1509, 'TANAH TUMBUH', 'Tanah Tumbuh, Bungo Regency, Jambi, Indonesia', -1.50733, 101.86636),
(1509051, 1509, 'LIMBUR LUBUK MENGKUANG', 'Limbur Lubuk Mengkuang, Bungo Regency, Jambi, Indonesia', -1.67958, 101.66129),
(1509052, 1509, 'BATHIN II PELAYANG', 'Bathin II Pelayang, Bungo Regency, Jambi, Indonesia', -1.4318, 101.82076),
(1509060, 1509, 'JUJUHAN', 'Jujuhan, Bungo Regency, Jambi, Indonesia', -1.31859, 101.77517),
(1509061, 1509, 'JUJUHAN ILIR', 'Jujuhan Ilir, Bungo Regency, Jambi, Indonesia', -1.20485, 101.91199),
(1571010, 1571, 'KOTA BARU', 'Baru City Regency, South Kalimantan, Indonesia', -3.00298, 115.9468),
(1571020, 1571, 'JAMBI SELATAN', 'South Jambi, Jambi City, Jambi, Indonesia', -1.63353, 103.64206),
(1571030, 1571, 'JELUTUNG', 'Jelutung, Jambi City, Jambi, Indonesia', -1.61718, 103.61601),
(1571040, 1571, 'PASAR JAMBI', 'Pasar Jambi, Jambi City, Jambi, Indonesia', -1.59477, 103.61457),
(1571050, 1571, 'TELANAIPURA', 'Telanaipura, Jambi City, Jambi, Indonesia', -1.60092, 103.5784),
(1571060, 1571, 'DANAU TELUK', 'Danau Teluk, Jambi City, Jambi, Indonesia', -1.56777, 103.59576),
(1571070, 1571, 'PELAYANGAN', 'Pelayangan, Jambi City, Jambi, Indonesia', -1.56762, 103.61891),
(1571080, 1571, 'JAMBI TIMUR', 'East Jambi, Jambi City, Jambi, Indonesia', -1.58633, 103.64206),
(1572010, 1572, 'TANAH KAMPUNG', 'Tanah Kampung, Sungai Penuh City, Jambi, Indonesia', -2.07839, 101.43959),
(1572020, 1572, 'KUMUN DEBAI', 'Kumun Debai, Sungai Penuh City, Jambi, Indonesia', -2.16116, 101.32042),
(1572030, 1572, 'SUNGAI PENUH', 'Sungai Penuh, Sungai Penuh City, Jambi, Indonesia', -2.06893, 101.41688),
(1572031, 1572, 'PONDOK TINGGGI', 'Pd. Tinggi, Kota Sungai Penuh, Jambi, Indonesia', -2.11254, 101.37715),
(1572032, 1572, 'SUNGAI BUNGKAL', 'Sungai Bungkal, Kota Sungai Penuh, Jambi, Indonesia', -2.05528, 101.30907),
(1572040, 1572, 'HAMPARAN RAWANG', 'Hamparan Rawang, Sungai Penuh City, Jambi, Indonesia', -2.0497, 101.41688),
(1572050, 1572, 'PESISIR BUKIT', 'Pesisir Bukit, Sungai Penuh City, Jambi, Indonesia', -2.04041, 101.37147),
(1572051, 1572, 'KOTO BARU', 'Koto Baru, Dharmasraya Regency, West Sumatra, Indonesia', -1.13058, 101.68406);

        ");
    }
}