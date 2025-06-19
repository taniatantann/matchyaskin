<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ingredient;
use App\Models\Product;

class BaumannController extends Controller
{
    protected $questions = [
    1 => [
        'question' => 'Setelah mencuci wajah Anda, jangan gunakan pelembab, sunscreen, toner, bedak, atau produk lainnya. Dua hingga tiga jam kemudian, lihat di cermin dengan pencahayaan terang. Kening dan pipi Anda terasa/terlihat:',
        'options' => [
            'Sangat kasar, bersisik, atau pucat' => 1,
            'Kencang' => 2,
            'Terhidrasi dengan baik dan tidak ada pantulan lampu' => 3,
            'Bersinar dengan pantulan lampu' => 4,
        ]
    ],
    2 => [
        'question' => 'Di foto, wajah Anda terlihat bersinar:',
        'options' => [
            'Tidak pernah atau tidak sadar ada cahaya' => 1,
            'Kadang-kadang' => 2,
            'Sering' => 3,
            'Selalu' => 4,
        ]
    ],
    3 => [
        'question' => 'Dua atau tiga jam setelah mengaplikasikan foundation (atau base) makeup namun tanpa bedak, makeup Anda terlihat:',
        'options' => [
            'Bersisik atau lapuk pada keriput' => 1,
            'Halus' => 2,
            'Bersinar' => 3,
            'Bergaris-garis dan bersinar' => 4,
            'Saya tidak menggunakan foundation wajah' => 2.5,
        ]
    ],
    4 => [
        'question' => 'Ketika berada di lingkungan dengan kelembaban rendah, jika Anda tidak menggunakan pelembab atau sunscreen, kulit wajah Anda:',
        'options' => [
            'Terasa sangat kering atau retak' => 1,
            'Terasa kering' => 2,
            'Terasa normal' => 3,
            'Terlihat bersinar, atau saya tidak pernah merasa memerlukan pelembab' => 4,
            'Tidak tahu' => 2.5,
        ]
    ],
    5 => [
        'question' => 'Lihat pada kaca pembesar. Berapa banyak komedo besar, seukuran ujung peniti atau lebih besar, yang Anda miliki?',
        'options' => [
            'Tidak ada' => 1,
            'Sedikit di area T-zone (kening dan hidung) saja' => 2,
            'Banyak' => 3,
            'Sangat banyak' => 4,
            'Tidak tahu' => 2.5,
        ]
    ],
    6 => [
        'question' => 'Anda akan mengkategorikan kulit wajah Anda sebagai:',
        'options' => [
            'Kering' => 1,
            'Normal' => 2,
            'Kombinasi' => 3,
            'Berminyak' => 4,
        ]
    ],
    7 => [
        'question' => 'Ketika menggunakan sabun yang berbusa dengan kuat, kulit wajah Anda:',
        'options' => [
            'Terasa kering atau retak' => 1,
            'Terasa agak kering tetapi tidak retak' => 2,
            'Terasa normal' => 3,
            'Terasa berminyak' => 4,
            'Saya tidak menggunakan sabun pencuci wajah (Jika ini karena wajah Anda terasa kering, pilih opsi 1)' => 2.5,
        ]
    ],
    8 => [
        'question' => 'Apabila tidak diberi pelembab, wajah Anda terasa kencang:',
        'options' => [
            'Selalu' => 1,
            'Kadang-kadang' => 2,
            'Jarang' => 3,
            'Tidak pernah' => 4,
        ]
    ],
    9 => [
        'question' => 'Anda mempunyai pori-pori tersumbat (komedo hitam atau komedo putih):',
        'options' => [
            'Tidak pernah' => 1,
            'Jarang' => 2,
            'Kadang-kadang' => 3,
            'Selalu' => 4,
        ]
    ],
    10 => [
        'question' => 'Wajah Anda berminyak di area T-zone (kening dan hidung):',
        'options' => [
            'Tidak pernah' => 1,
            'Kadang-kadang' => 2,
            'Sering' => 3,
            'Selalu' => 4,
        ]
    ],
        11 => [
            'question' => 'Dua atau tiga jam setelah mengaplikasikan pelembab, pipi Anda:',
            'options' => [
                'Sangat kasar, bersisik, atau pucat' => 1,
                'Halus' => 2,
                'Sedikit bersinar' => 3,
                'Bersinar dan licin, atau saya tidak menggunakan pelembab' => 4,
            ]
        ],
        12 => [
            'question' => 'Anda mempunyai jerawat merah di wajah Anda:',
            'options' => [
                'Tidak pernah' => 1,
                'Jarang' => 2,
                'Setidaknya sebulan sekali' => 3,
                'Setidaknya seminggu sekali' => 4,
            ]
        ],
        13 => [
            'question' => 'Produk skincare (termasuk pembersih, pelembab, toner, dan makeup) menyebabkan wajah Anda break out, gatal, ruam, atau perih:',
            'options' => [
                'Tidak pernah' => 1,
                'Jarang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak menggunakan produk apapun di wajah saya' => 2.5,
            ]
        ],
        14 => [
            'question' => 'Pernahkah Anda didiagnosa dengan jerawat atau rosacea?',
            'options' => [
                'Tidak' => 1,
                'Teman dan kenalan saya berkata saya memilikinya' => 2,
                'Ya' => 3,
                'Ya, kasusnya parah' => 4,
                'Tidak yakin' => 2.5,
            ]
        ],
        15 => [
            'question' => 'Jika Anda menggunakan perhiasan yang bukan emas 14-carat, seberapa sering Anda mendapatkan ruam?',
            'options' => [
                'Tidak pernah' => 1,
                'Jarang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Tidak yakin' => 2.5,
            ]
        ],
        16 => [
            'question' => 'Sunscreen membuat kulit Anda gatal, panas, break out, atau merah:',
            'options' => [
                'Tidak pernah' => 1,
                'Jarang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak pernah menggunakan sunscreen' => 2.5,
            ]
        ],
        17 => [
            'question' => 'Apakah Anda pernah didiagnosa dengan atopic dermatitis, eczema, atau contact dermatitis (ruam kulit karena alergi)?',
            'options' => [
                'Tidak' => 1,
                'Teman saya berkata saya memilikinya' => 2,
                'Ya' => 3,
                'Ya, kasusnya parah' => 4,
                'Tidak yakin' => 2.5,
            ]
        ],
        18 => [
            'question' => 'Seberapa sering Anda mendapat ruam di bawah cincin Anda?',
            'options' => [
                'Tidak pernah' => 1,
                'Jarang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak menggunakan cincin' => 2.5,
            ]
        ],
        19 => [
            'question' => 'Sabun dengan wangi tambahan, minyak pijat, atau body lotion membuat kulit Anda break out, gatal, atau kering:',
            'options' => [
                'Tidak pernah' => 1,
                'Jarang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak pernah menggunakan produk tersebut (Jika produk tidak digunakan karena memberikan masalah di atas, pilih Selalu)' => 2.5,
            ]
        ],
        20 => [
            'question' => 'Bisakah Anda menggunakan sabun yang disediakan hotel pada badan dan wajah Anda tanpa menimbulkan masalah?',
            'options' => [
                'Ya' => 1,
                'Seringnya tidak ada masalah' => 2,
                'Tidak, kulit saya menjadi gatal, merah, atau break out' => 3,
                'Saya tidak akan menggunakannya. Karena terlalu banyak masalah dulu!' => 4,
                'Saya selalu membawa sabun sendiri, jadi saya tidak yakin' => 2.5,
            ]
        ],
        21 => [
            'question' => 'Pernahkah seseorang dalam keluarga Anda didiagnosa atopic dermatitis, eczema, asthma, dan/atau alergi?',
            'options' => [
                'Tidak' => 1,
                'Satu member keluarga yang saya tahu' => 2,
                'Beberapa member keluarga' => 3,
                'Banyak member keluarga saya memiliki dermatitis, eczema, asthma, dan/atau alergi' => 4,
                'Tidak yakin' => 2.5,
            ]
        ],
        22 => [
            'question' => 'Apa yang terjadi jika Anda menggunakan deterjen laundry beraroma atau lembar kontrol statis di pengering baju?',
            'options' => [
                'Kulit saya baik-baik saja' => 1,
                'Kulit saya terasa sedikit kering' => 2,
                'Kulit saya gatal' => 3,
                'Kulit saya gatal dan muncul ruam' => 4,
                'Tidak yakin, atau saya tidak pernah menggunakannya' => 2.5,
            ]
        ],
        23 => [
            'question' => 'Seberapa sering wajah Anda dan/atau leher menjadi merah setelah olahraga sedang, dan/atau ketika stress atau memiliki emosi kuat seperti kemarahan?',
            'options' => [
                'Tidak pernah' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
            ]
        ],
        24 => [
            'question' => 'Seberapa sering kulit Anda memerah setelah mengonsumsi alkohol?',
            'options' => [
                'Tidak pernah' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu, atau saya tidak minum karena masalah ini' => 4,
                'Saya tidak pernah meminum alkohol' => 2.5,
            ]
        ],
        25 => [
            'question' => 'Seberapa sering kulit Anda memerah setelah mengonsumsi makanan/minuman yang pedas atau bersuhu panas?',
            'options' => [
                'Tidak pernah' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak pernah makan makanan pedas (Jika karena muka memerah, pilih Selalu)' => 2.5,
            ]
        ],
        26 => [
            'question' => 'Berapa banyak pembuluh darah yang rusak yang berwarna merah atau biru (Jika Anda memilikinya sebelum melakukan suatu treatment) pada wajah dan hidung Anda?',
            'options' => [
                'Tidak ada' => 1,
                'Sedikit (1-3 di seluruh wajah, termasuk hidung)' => 2,
                'Beberapa (4-6 di seluruh wajah, termasuk hidung)' => 3,
                'Banyak (lebih dari tujuh di seluruh wajah, termasuk hidung)' => 4,
            ]
        ],
        27 => [
            'question' => 'Wajah Anda terlihat merah di foto:',
            'options' => [
                'Tidak pernah, atau saya tidak pernah menyadarinya' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
            ]
        ],
        28 => [
            'question' => 'Orang-orang bertanya apakah kulit Anda terbakar sinar matahari, bahkan ketika Anda tidak:',
            'options' => [
                'Tidak pernah' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya selalu terbakar matahari' => 2.5,
            ]
        ],
        29 => [
            'question' => 'Kulit Anda menjadi kemerahan, gatal, atau bengkak ketika menggunakan makeup, sunscreen, atau produk skincare:',
            'options' => [
                'Tidak pernah' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak menggunakan produk tersebut (Jika tidak digunakan karena keluhan di atas, pilih Selalu)' => 2.5,
            ]
        ],
        30 => [
            'question' => 'Setelah Anda mempunyai jerawat atau ingrown hair, terdapat bekas berwarna cokelat tua/hitam:',
            'options' => [
                'Tidak pernah atau saya tidak menyadarinya' => 1,
                'Kadang-kadang' => 2,
                'Sering' => 3,
                'Selalu' => 4,
                'Saya tidak mempunyai jerawat atau ingrown hair' => 2.5,
            ]
        ],
        31 => [
            'question' => 'Setelah kulit Anda tergores, berapa lamakah tanda cokelat (bukan merahnya) bertahan?',
            'options' => [
                'Saya tidak mempunyai tanda cokelat atau saya tidak menyadarinya' => 1,
                'Satu minggu' => 2,
                'Beberapa minggu' => 3,
                'Berbulan-bulan' => 4,
            ]
        ],
        32 => [
            'question' => 'Berapa banyak bercak hitam yang muncul di wajah Anda saat hamil, mengonsumsi pil KB, atau menjalani terapi penggantian hormon (HRT)?',
            'options' => [
                'Tidak ada' => 1,
                'Satu' => 2,
                'Sedikit' => 3,
                'Banyak' => 4,
                'Pertanyaan ini tidak berlaku bagi saya (Saya pria, atau tidak pernah hamil/menggunakan pil KB/HRT, atau saya tidak yakin apakah saya mempunyai bercak hitam atau tidak' => 2.5,
            ]
        ],
        33 => [
            'question' => 'Apakah Anda mempunyai bercak hitam di bibir atas atau pipi? Atau pernahkah Anda memilikinya dulu dan sudah Anda hilangkan sekarang?',
            'options' => [
                'Tidak' => 1,
                'Tidak yakin' => 2,
                'Ya, mereka agak terlihat' => 3,
                'Ya, mereka sangat terlihat' => 4,
            ]
        ],
        34 => [
            'question' => 'Apakah bercak hitam di wajah Anda menjadi lebih parah ketika terpapar sinar matahari?',
            'options' => [
                'Saya tidak mempunyai bercak hitam' => 1,
                'Tidak yakin' => 2,
                'Sedikit lebih parah' => 3,
                'Menjadi sangat parah' => 4,
                'Saya menggunakan sunscreen setiap hari dan tidak terkena matahari (Jika Anda menggunakannya karena takut mendapat bercak hitam, pilih pilihan 4)' => 2.5,
            ]
        ],
        35 => [
            'question' => 'Pernahkah Anda didiagnosa dengan melasma, atau bercak berwarna cokelat muda, tua atau abu di wajah?',
            'options' => [
                'Tidak' => 1,
                'Ya, tetapi bercaknya sudah hilang' => 2,
                'Ya, dan saya memilikinya sekarang' => 3,
                'Ya, saya memilikinya dan kasusnya parah' => 4,
                'Tidak yakin' => 2.5,
            ]
        ],
        36 => [
            'question' => 'Apakah Anda memiliki, atau pernah memiliki, bercak kecil cokelat (flek atau bercak matahari) pada wajah, dada, punggung, atau lengan Anda?',
            'options' => [
                'Tidak' => 1,
                'Ya, sedikit (1 hingga 5)' => 2,
                'Ya, banyak (6 hingga 15)' => 3,
                'Ya, sangat banyak (16 atau lebih)' => 4,
            ]
        ],
        37 => [
            'question' => 'Ketika terpapar matahari untuk pertama kalinya dalam beberapa bulan, kulit Anda:',
            'options' => [
                'Hanya terbakar' => 1,
                'Terbakar, lalu menggelap' => 2,
                'Menggelap' => 3,
                'Kulit saya sudah gelap sehingga sulit untuk melihat perubahannya' => 4,
            ]
        ],
        38 => [
            'question' => 'Apa yang terjadi setelah Anda selama beberapa hari berturut-turut terpapar matahari:',
            'options' => [
                'Kulit saya terbakar dan melepuh, tetapi tidak berubah warna' => 1,
                'Kulit saya menjadi sedikit lebih gelap' => 2,
                'Kulit saya menjadi jauh lebih gelap' => 3,
                'Kulit saya sudah gelap, sehingga sulit untuk melihat perubahannya' => 4,
                'Tidak yakin' => 2.5,
            ]
        ],
        39 => [
            'question' => 'Apa warna rambut alami Anda? (Jika beruban, pilih warna sebelum berubah menjadi uban)',
            'options' => [
                'Pirang' => 1,
                'Cokelat' => 2,
                'Hitam' => 3,
                'Merah' => 4,
            ]
        ],
        40 => [
            'question' => 'Apakah Anda memiliki bintik hitam di kulit daerah yang terkena paparan matahari?',
            'options' => [
                'Ya' => 5,
                'Tidak' => 0,
            ]
        ],
        41 => [
            'question' => 'Apakah Anda mempunyai keriput di wajah?',
            'options' => [
                'Tidak, bahkan ketika melakukan gerakan seperti tersenyum, cemberut, atau menaikkan alis' => 1,
                'Hanya ketika melakukan gerakan, seperti tersenyum, cemberut, atau menaikkan alis' => 2,
                'Ya, dengan gerakan dan sedikit ketika wajah beristirahat (tanpa gerakan)' => 3,
                'Keriput terlihat bahkan ketika sedang tidak tersenyum, cemberut, atau menaikkan alis' => 4,
            ]
        ],
        42 => [
            'question' => 'Seberapa tua kulit wajah Ibu Anda terlihat?',
            'options' => [
                '5-10 tahun lebih muda dari umurnya' => 1,
                'Seperti umurnya' => 2,
                '5-10 tahun lebih tua dari umurnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umurnya' => 4,
                'Tidak berlaku; Saya diadopsi atau tidak ingat' => 2.5,
            ]
        ],
        43 => [
            'question' => 'Seberapa tua kulit wajah Ayah Anda terlihat?',
            'options' => [
                '5-10 tahun lebih muda dari umurnya' => 1,
                'Seperti umurnya' => 2,
                '5-10 tahun lebih tua dari umurnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umurnya' => 4,
                'Tidak berlaku; Saya diadopsi atau tidak ingat' => 2.5,
            ]
        ],
        44 => [
            'question' => 'Seberapa tua kulit wajah nenek kandung dari Ibu Anda terlihat?',
            'options' => [
                '5-10 tahun lebih muda dari umurnya' => 1,
                'Seperti umurnya' => 2,
                '5-10 tahun lebih tua dari umurnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umurnya' => 4,
                'Tidak berlaku; Saya diadopsi, tidak kenal, atau tidak ingat' => 2.5,
            ]
        ],
        45 => [
            'question' => 'Seberapa tua kulit wajah kakek kandung dari Ibu Anda terlihat?',
            'options' => [
                '5-10 tahun lebih muda dari umurnya' => 1,
                'Seperti umurnya' => 2,
                '5-10 tahun lebih tua dari umurnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umurnya' => 4,
                'Tidak berlaku; Saya diadopsi, tidak kenal, atau tidak ingat' => 2.5,
            ]
        ],
        46 => [
            'question' => 'Seberapa tua kulit wajah nenek kandung dari Ayah Anda terlihat?',
            'options' => [
                '5-10 tahun lebih muda dari umurnya' => 1,
                'Seperti umurnya' => 2,
                '5-10 tahun lebih tua dari umurnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umurnya' => 4,
                'Tidak berlaku; Saya diadopsi, tidak kenal, atau tidak ingat' => 2.5,
            ]
        ],
        47 => [
            'question' => 'Seberapa tua kulit wajah kakek kandung dari Ayah Anda terlihat?',
            'options' => [
                '5-10 tahun lebih muda dari umurnya' => 1,
                'Seperti umurnya' => 2,
                '5-10 tahun lebih tua dari umurnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umurnya' => 4,
                'Tidak berlaku; Saya diadopsi, tidak kenal, atau tidak ingat' => 2.5,
            ]
        ],
        48 => [
            'question' => 'Pernahkah Anda sengaja menggelapkan kulit Anda secara terus-menerus selama lebih dari 2 minggu per tahun? Jika pernah, berapa tahun Anda melakukannya? Mohon termasukkan tanning dari pantai, bermain tennis, memancing, main golf, ski, atau aktivitas di luar lainnya.',
            'options' => [
                'Tidak pernah' => 1,
                '1 hingga 5 tahun' => 2,
                '5 hingga 10 tahun' => 3,
                'Lebih dari 10 tahun' => 4,
            ]
        ],
        49 => [
            'question' => 'Pernahkah Anda melakukan tanning musiman selama 2 minggu per tahun atau kurang? (Termasuk liburan musim panas). Jika pernah, seberapa sering?',
            'options' => [
                'Tidak pernah' => 1,
                '1 hingga 5 tahun' => 2,
                '5 hingga 10 tahun' => 3,
                'Lebih dari 10 tahun' => 4,
            ]
        ],
        50 => [
            'question' => 'Berdasarkan tempat yang pernah Anda tinggali, berapa banyak paparan sinar matahari yang Anda dapatkan setiap hari dalam hidup Anda?',
            'options' => [
                'Sedikit; saya kebanyakan tinggal di tempat yang mendung' => 1,
                'Beberapa; saya tinggal di daerah yang tidak selalu cerah, tetapi juga di tempat yang lebih ada matahari' => 2,
                'Cukup; saya tinggal di tempat dengan paparan matahari yang cukup' => 3,
                'Banyak; saya tinggal di daerah tropis, Selatan, atau daerah lokal yang sangat cerah' => 4,
            ]
        ],
        51 => [
            'question' => 'Menurut Anda, berapa umur Anda berdasarkan penampilan?',
            'options' => [
                'Satu hingga 5 tahun lebih tua dari umur sebenarnya' => 1,
                'Seperti umur Anda yang sebenarnya' => 2,
                'Lima tahun lebih tua dari umur sebenarnya' => 3,
                'Lebih dari 5 tahun lebih tua dari umur sebenarnya' => 4,
            ]
        ],
        52 => [
            'question' => 'Selama 5 tahun terakhir, seberapa sering Anda membiarkan kulit anda tan entah sengaja atau tidak melalui olahraga outdoor atau aktivitas lainnya?',
            'options' => [
                'Tidak pernah' => 1,
                'Sebulan sekali' => 2,
                'Seminggu sekali' => 3,
                'Setiap hari' => 4,
            ]
        ],
        53 => [
            'question' => 'Seberapa sering, atau pernahkah, Anda menjalankan tanning bed?',
            'options' => [
                'Tidak pernah' => 1,
                'Satu hingga 5 kali' => 2,
                'Lima hingga 10 kali' => 3,
                'Sering kali' => 4,
            ]
        ],
        54 => [
            'question' => 'Dalam seumur hidup Anda, seberapa sering Anda pernah merokok (atau tereskpos asap rokok)?',
            'options' => [
                'Tidak pernah' => 1,
                'Sedikit bungkus' => 2,
                'Beberapa hingga banyak bungkus' => 3,
                'Saya merokok setiap hari' => 4,
                'Saya tidak pernah merokok tetapi saya tinggal dengan, dibesarkan oleh, atau bekerja dengan orang-orang yang merokok rutin di dekat saya' => 2.5,
            ]
        ],
        55 => [
            'question' => 'Mohon deskripsikan polusi udara di daerah tempat Anda tinggal:',
            'options' => [
                'Udaranya bersih dan segar' => 1,
                'Pada saat-saat tertentu di dalam tahun, tetapi tidak sepanjang tahun, saya tinggal di daerah dengan udara bersih' => 2,
                'Udaranya agak berpolusi' => 3,
                'Udaranya sangat berpolusi' => 4,
            ]
        ],
        56 => [
            'question' => 'Mohon deskripsikan berapa lama Anda menggunakan krim wajah retinoid seperti retinol, Renova, Retin-A, Tazorac, Differin, atau Avage:',
            'options' => [
                'Bertahun-tahun' => 1,
                'Kadang-kadang' => 2,
                'Sekali, untuk jerawat ketika saya masih muda' => 3,
                'Tidak pernah' => 4,
            ]
        ],
        57 => [
            'question' => 'Seberapa sering Anda akhir-akhir ini mengonsumsi buah dan sayuran?',
            'options' => [
                'Setiap saya makan' => 1,
                'Sekali sehari' => 2,
                'Kadang-kadang' => 3,
                'Tidak pernah' => 4,
            ]
        ],
        58 => [
            'question' => 'Dalam hidup Anda, berapa persentase makanan Anda yang terdiri dari buah dan sayuran? (Jangan masukkan jus kecuali mereka diperas dengan segar)',
            'options' => [
                '75-100 persen' => 1,
                '25-75 persen' => 2,
                '10-25 persen' => 3,
                '0-10 persen' => 4,
            ]
        ],
        59 => [
            'question' => 'Apa warna alami kulit Anda? (Tanpa tanning atau tanning sendiri)',
            'options' => [
                'Gelap' => 1,
                'Sedang' => 2,
                'Terang' => 3,
                'Sangat terang' => 4,
            ]
        ],
        60 => [
            'question' => 'Apa etnis Anda?',
            'options' => [
                'Afrika Amerika/Karibia/Hitam' => 1,
                'Asia/India/Mediterania/Lainnya' => 2,
                'Amerika Latin/Hispanik' => 3,
                'Kaukasia' => 4,
            ]
        ],
        61 => [
            'question' => 'Apakah Anda berumur 65 tahun atau lebih?',
            'options' => [
                'Ya' => 5,
                'Tidak' => 0,
            ]
        ],
    ];

    private function getIngredientData()
    {
        return [
            'fitzpatrick' => [
                'Type 1' => [
                    'traits' => 'Kulit selalu terbakar, tidak pernah kecokelatan (tan), sensitif terhadap paparan sinar UV.',
                    'description' => 'Menggunakan sunscreen dengan SPF 30 atau lebih, pakaian dengan rating UPF 30 atau lebih, sebaiknya tidak berjemur, dan perlu melakukan pengecekan kulit secara rutin setiap bulan.',
                    'ingredients_cocok' => 'SPF 50+, Vitamin C, Ceramide, Hyaluronic Acid, Aloe Vera, Panthenol',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol,  AHA>= 5-10%, Retinoid, Retinol, Retinaldehyde, Retioic Acid, LAA, FD&C, D&C, Colorant, dye, Hydroquinone'
                ],
                'Type 2' => [
                    'traits' => 'Kulit mudah terbakar, hanya sedikit kecokelatan (tan).',
                    'description' => 'Menggunakan sunscreen dengan SPF 30 atau lebih, pakaian dengan rating UPF 30 atau lebih, sebaiknya tidak berjemur, dan perlu melakukan pengecekan kulit secara rutin setiap bulan.',
                    'ingredients_cocok' => 'SPF 30+, Niacinamide, Collagen Booster, Water, Dicaprylyl Carbonate, Glycerin, Panthenol',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol,  AHA>= 5-10%, Retinoid, Retinol, Retinaldehyde, Retioic Acid, LAA, FD&C, D&C, Colorant, dye, Hydroquinone'
                ],
                'Type 3' => [
                    'traits' => 'Kulit terbakar sedang, secara bertahap dapat menjadi cokelat muda.',
                    'description' => 'Menggunakan sunscreen dengan SPF 15 atau lebih setiap hari dan SPF 30 apabila beraktivitas di luar, pakaian dengan perlindungan matahari, dan mengecek kulit rutin setiap bulan.',
                    'ingredients_cocok' => 'SPF 30+, AHA Gentle Exfoliant, Niacinamide, Hyaluronic Acid, Vitamin C',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate,  AHA/BHA>= 5-10%, Hydroquinone >=4%'
                ],
                'Type 4' => [
                    'traits' => 'Kulit sedikit terbakar, selalu dapat berubah kecokelatan (tan) dengan baik hingga cokelat sedang.',
                    'description' => 'Menggunakan sunscreen dengan SPF 15 atau lebih setiap hari dan SPF 30 apabila beraktivitas di luar, pakaian dengan perlindungan matahari, dan mengecek kulit rutin setiap bulan.',
                    'ingredients_cocok' => 'SPF 30, Hyaluronic Acid, Vitamin C, Vitamin E, Niacinamide',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate,  AHA/BHA>= 5-10%, Hydroquinone >=4%'
                ],
                'Type 5' => [
                    'traits' => 'Kulit jarang terbakar, dapat berubah sangat kecokelatan (tan) hingga gelap.',
                    'description' => 'Menggunakan sunscreen dengan SPF 15 atau lebih setiap hari dan SPF 30 apabila beraktivitas di luar, pakaian dengan perlindungan matahari, dan mengecek kulit rutin setiap bulan.',
                    'ingredients_cocok' => 'SPF 30, Jojoba, Squalane, AHA/BHA, Vitamin C',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol,  AHA/BHA>= 5-10%, Hydroquinone >=4%, Coconut Oil, Olive Oil, Petroleum Jelly'
                ],
                'Type 6' => [
                    'traits' => 'Kulit tidak pernah terbakar, sangat terpigmentasi, tidak terlalu sensitif.',
                    'description' => 'Menggunakan sunscreen dengan SPF 15 atau lebih setiap hari dan SPF 30 atau lebih ketika beraktivitas outdoor, berteduh pada jam 10 pagi sampai jam 4 sore, dan mengecek kulit rutin setiap bulan.',
                    'ingredients_cocok' => 'SPF 30, Shea Butter, Vitamin E, Niacinamide, Vitamin C',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol,  AHA/BHA>= 5-10%, Hydroquinone >=4%, Coconut Oil, Olive Oil, Petroleum Jelly'
                ],
            ],
            'baumann' => [
                'DRPT' => [
                    'traits' => 'Dry • Resistant • Pigmented • Tight',
                    'description' => 'Kulit kering yang tahan iritasi tetapi mudah mengalami hiperpigmentasi. Membutuhkan pelembab intensif dan bahan pencerah yang lembut.',
                    'ingredients_cocok' => 'Hyaluronic Acid, Glycerin, Ceramide, Vitamin C, Vitamin E, Panthenol, Aloe Vera, Tranexamic Acid',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA, Hydroquinone >=4%'
                ],
                'DRNT' => [
                    'traits' => 'Dry • Resistant • Non-Pigmented • Tight',
                    'description' => 'Kulit kering yang tahan terhadap iritasi dan tidak mudah mengalami perubahan warna. Fokus pada pelembab dan perlindungan.',
                    'ingredients_cocok' => 'Hyaluronic Acid, Glycerin, Ceramide, Vitamin C, Vitamin E, Panthenol, Aloe Vera',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA'
                ],
                'DRPW' => [
                    'traits' => 'Dry • Resistant • Pigmented • Wrinkled',
                    'description' => 'Kulit kering dengan tanda penuaan dan hiperpigmentasi. Membutuhkan anti-aging dan brightening yang intensif.',
                    'ingredients_cocok' => 'Hyaluronic Acid, Glycerin, Ceramide, Vitamin C, Vitamin E, Panthenol, Aloe Vera, Tranexamic Acid, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA, Hydroquinone >=4%'
                ],
                'DRNW' => [
                    'traits' => 'Dry • Resistant • Non-Pigmented • Wrinkled',
                    'description' => 'Kulit kering dengan tanda penuaan tetapi tidak mudah mengalami hiperpigmentasi. Fokus pada anti-aging dan pelembab.',
                    'ingredients_cocok' => 'Hyaluronic Acid, Glycerin, Ceramide, Vitamin C, Vitamin E, Panthenol, Aloe Vera, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA'
                ],
                'DSPT' => [
                    'traits' => 'Dry • Sensitive • Pigmented • Tight',
                    'description' => 'Kulit kering dan sensitif dengan kecenderungan hiperpigmentasi. Membutuhkan produk yang sangat lembut dan menenangkan.',
                    'ingredients_cocok' => 'Ceramide, Shea Butter, Licorice, Centella Asiatica, Niacinamide, Panthenol, Tranexamic Acid',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA, Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil'
                ],
                'DSNT' => [
                    'traits' => 'Dry • Sensitive • Non-Pigmented • Tight',
                    'description' => 'Kulit kering dan sensitif tanpa masalah pigmentasi. Membutuhkan produk yang sangat lembut dengan minimal bahan aktif.',
                    'ingredients_cocok' => 'Ceramide, Shea Butter, Licorice, Centella Asiatica, Niacinamide, Panthenol',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA, Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil'
                ],
                'DSPW' => [
                    'traits' => 'Dry • Sensitive • Pigmented • Wrinkled',
                    'description' => 'Kulit kering, sensitif dengan tanda penuaan dan hiperpigmentasi. Membutuhkan perawatan yang sangat hati-hati dan bertahap.',
                    'ingredients_cocok' => 'Ceramide, Shea Butter, Licorice, Centella Asiatica, Niacinamide, Panthenol, Tranexamic Acid, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA, Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil, Hydroquinone >=4%'
                ],
                'DSNW' => [
                    'traits' => 'Dry • Sensitive • Non-Pigmented • Wrinkled',
                    'description' => 'Kulit kering, sensitif dengan tanda penuaan tetapi tidak mudah mengalami hiperpigmentasi. Fokus pada anti-aging yang lembut.',
                    'ingredients_cocok' => 'Ceramide, Shea Butter, Licorice, Centella Asiatica, Niacinamide, Panthenol, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, AHA/BHA>= 5-10%, Clay Mask, Sodium Laureth Sulfate, Sodium Lauryl Sulfate, Ammonium Lauryl Sulfate, Cocamide MEA, Cocamide DEA, Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil'
                ],
                'ORPT' => [
                    'traits' => 'Oily • Resistant • Pigmented • Tight',
                    'description' => 'Kulit berminyak yang tahan iritasi dengan kecenderungan hiperpigmentasi. Dapat menggunakan bahan aktif yang lebih kuat untuk kontrol minyak dan brightening.',
                    'ingredients_cocok' => 'Salicylic Acid, Kaolin Clay, Zinc, Vitamin C, Kojic Acid, Retinol, Retinaldehyde, Retioic Acid, Tranexamic Acid',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum'
                ],
                'ORNT' => [
                    'traits' => 'Oily • Resistant • Non-Pigmented • Tight',
                    'description' => 'Kulit berminyak yang tahan iritasi tanpa masalah pigmentasi. Dapat menggunakan produk oil control yang kuat dan aktif.',
                    'ingredients_cocok' => 'Salicylic Acid, Kaolin Clay, Zinc, Vitamin C, Kojic Acid, Retinol, Retinaldehyde, Retioic Acid',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum'
                ],
                'ORPW' => [
                    'traits' => 'Oily • Resistant • Pigmented • Wrinkled',
                    'description' => 'Kulit berminyak dengan tanda penuaan dan hiperpigmentasi. Membutuhkan kombinasi oil control, anti-aging, dan brightening.',
                    'ingredients_cocok' => 'Salicylic Acid, Kaolin Clay, Zinc, Vitamin C, Kojic Acid, Retinol, Retinaldehyde, Retioic Acid, Tranexamic Acid, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum, Hydroquinone >=4%'
                ],
                'ORNW' => [
                    'traits' => 'Oily • Resistant • Non-Pigmented • Wrinkled',
                    'description' => 'Kulit berminyak dengan tanda penuaan tetapi tidak mudah mengalami hiperpigmentasi. Fokus pada oil control dan anti-aging.',
                    'ingredients_cocok' => 'Salicylic Acid, Kaolin Clay, Zinc, Vitamin C, Kojic Acid, Retinol, Retinaldehyde, Retioic Acid, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum'
                ],
                'OSPT' => [
                    'traits' => 'Oily • Sensitive • Pigmented • Tight',
                    'description' => 'Kulit berminyak dan sensitif dengan kecenderungan hiperpigmentasi. Membutuhkan oil control yang lembut dan brightening yang tidak iritatif.',
                    'ingredients_cocok' => 'Salicylic Acid, Niacinamide, Retinol,  Ascorbic Acid, Azelaic Acid, Hyaluronic Acid, Licorice Extract, Benzoyl Peroxide, Panthenol, Tranexamic Acid',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum, Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, AHA/BHA>= 5-10%, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene,  Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil'
                ],
                'OSNT' => [
                    'traits' => 'Oily • Sensitive • Non-Pigmented • Tight',
                    'description' => 'Kulit berminyak dan sensitif tanpa masalah pigmentasi. Membutuhkan oil control yang lembut dengan bahan menenangkan.',
                    'ingredients_cocok' => 'Salicylic Acid, Niacinamide, Retinol,  Ascorbic Acid, Azelaic Acid, Hyaluronic Acid, Licorice Extract, Benzoyl Peroxide, Panthenol',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum, Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, AHA/BHA>= 5-10%, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene, Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil'
                ],
                'OSPW' => [
                    'traits' => 'Oily • Sensitive • Pigmented • Wrinkled',
                    'description' => 'Kulit berminyak, sensitif dengan tanda penuaan dan hiperpigmentasi. Membutuhkan perawatan multi-target yang sangat hati-hati.',
                    'ingredients_cocok' => 'Salicylic Acid, Niacinamide, Retinol,  Ascorbic Acid, Azelaic Acid, Hyaluronic Acid, Licorice Extract, Benzoyl Peroxide, Panthenol, Tranexamic Acid, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum, Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, AHA/BHA>= 5-10%, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene,  Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil, Hydroquinone >=4%'
                ],
                'OSNW' => [
                    'traits' => 'Oily • Sensitive • Non-Pigmented • Wrinkled',
                    'description' => 'Kulit berminyak, sensitif dengan tanda penuaan tetapi tidak mudah mengalami hiperpigmentasi. Fokus pada oil control dan anti-aging yang lembut.',
                    'ingredients_cocok' => 'Salicylic Acid, Niacinamide, Retinol,  Ascorbic Acid, Azelaic Acid, Hyaluronic Acid, Licorice Extract, Panthenol, Coenzyme Q10',
                    'ingredients_tidak_cocok' => 'Bergamot oil, Lemon Extract, Mineral oil, Coconut oil, Shea Butter, Olive oil, Avocado oil, Evening primrose oil, Isopropyl myristate, petrolatum, Alcohol, Parfum, Fragrance, Alcohol denat, SD Alcohol, denatured alcohol, ethanol, AHA/BHA>= 5-10%, Benzoyl Peroxide, SLS, SLES, Sulphate, Sulfate, Tretinoin, Tazarotene,  Retinol, Retinaldehyde, Retioic Acid, L-ascorbic Acid, LAA, FD&C, D&C, Colorant, dye, Paraben, methylparaben, propylparaben, butylparaben, isobutylparaben, isopropylparaben, ethylparaben, citrus essential oil, peppermint essential oil'
                ],
            ]
        ];
    }

    //tampilin pertanyaan di tahap tertentu
    public function showStep($step)
    {
        if (!array_key_exists($step, $this->questions)) {
            return redirect()->route('user.baumann.result');
        }

        $data = $this->questions[$step];

        return view('user.baumann.step', [
            'step' => $step,
            'question' => $data['question'],
            'options' => array_keys($data['options'])
        ]);
    }

    //simpan jawaban user dan lanjut ke tahap selanjutnya
    public function storeStep(Request $request, $step)
    {
        $request->validate([                      
            'answer' => 'required|string',          
        ]);

        Session::put("baumann.step_$step", $request->input('answer'));

        $nextStep = $step + 1;
        if (!array_key_exists($nextStep, $this->questions)) {
            return redirect()->route('user.baumann.result');
        }

        return redirect()->route('user.baumann.step', ['step' => $nextStep]);
    }

    public function showResult()
    {
        $user = auth()->user();
        $fitzType = $user->fitzpatrick_type;
        $baumannType = $user->baumann_type;
        

        $ingredientData = $this->getIngredientData();
        $fitzData = $ingredientData['fitzpatrick'][$fitzType] ?? [];
        $baumannData = $ingredientData['baumann'][$baumannType] ?? [];

        $answers = [];
        foreach ($this->questions as $q => $data) {
            $answer = Session::get("baumann.step_$q");
            $score = $data['options'][$answer] ?? 0;
            $answers[$q] = $score;
        }

        // hitung nilai per kategori
        $oilyDryQuestions = range(1, 11);
        $oilyDryScore = array_sum(array_intersect_key($answers, array_flip($oilyDryQuestions)));

        $sensResQuestions = range(12, 29);
        $sensResScore = array_sum(array_intersect_key($answers, array_flip($sensResQuestions)));

        $pigmentQuestions = range(30, 40);
        $pigmentScore = array_sum(array_intersect_key($answers, array_flip($pigmentQuestions)));

        $wrinkleQuestions = range(41, 61);
        $wrinkleScore = array_sum(array_intersect_key($answers, array_flip($wrinkleQuestions)));
        
        // oily vs dry
        if ($oilyDryScore !== 0 && $sensResScore !== 0 && $pigmentScore !== 0 && $wrinkleScore !== 0) {
            $type = '';

            if ($oilyDryScore >= 27) {
                $type .= 'O';
            } else {
                $type .= 'D';
            }

            // SENSITIVE vs RESISTANT (soal 12-29)
            if ($sensResScore >= 30) {
                $type .= 'S';
            } else {
                $type .= 'R';
            }

            // PIGMENTED vs NON-PIGMENTED (soal 27-40)
            if ($pigmentScore >= 31) {
                $type .= 'P';
            } else {
                $type .= 'N';
            }

            // WRINKLED vs TIGHT (soal 41-61)
            if ($wrinkleScore >= 41) {
                $type .= 'W';
            } else {
                $type .= 'T';
            }
        }

        $fitzType = $fitzType ?? session('fitzType');
        $baumannType = $type ?? session('baumannType');

        // simpan hasil di db user
        if (auth()->check()) {
            auth()->user()->update([
                'fitz_type' => $fitzType,
                'baumann_type' => $baumannType,
            ]);
        }

        // ambil data baumann dari hasil perhitungan
        $baumannData = $ingredientData['baumann'][$baumannType] ?? [
            'traits' => 'Type belum terdefinisi',
            'description' => 'Silakan konsultasi dengan ahli kulit.',
            'ingredients_cocok' => '',
            'ingredients_tidak_cocok' => ''
        ];

        if (!$fitzType || !$baumannType) {
            return redirect()->route('user.test')->with('error', 'Please complete the skin test first.');
        }

        try {
            // cari ingredients yg cocok sm tipe kulit user
            $recommendedIngredients = Ingredient::where(function($query) use ($fitzType, $baumannType) {
                $query->whereJsonContains('suitable_for', $fitzType)
                      ->orWhereJsonContains('suitable_for', $baumannType);
            })->get();

            // ambil produk yg mengandung ingredients yg cocoj
            $products = Product::where(function($query) use ($recommendedIngredients) {
                foreach ($recommendedIngredients as $ingredient) {
                    $query->orWhere('ingredients', 'like', "%$ingredient->name%");
                }
            })
            ->paginate(12);

            session(['fitzType' => $fitzType]);
            session(['baumannType' => $baumannType]);

            return view('user.baumann.result', [
                'fitzType' => $fitzType,
                'baumannType' => $baumannType,
                'fitzData' => $fitzData,
                'baumannData' => $baumannData,
                'products' => $products,
                'scores' => [
                    'oily_dry' => $oilyDryScore,
                    'sens_res' => $sensResScore,
                    'pigment' => $pigmentScore,
                    'wrinkle' => $wrinkleScore
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in showResult: ' . $e->getMessage());
            return redirect()->route('user.test')->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}