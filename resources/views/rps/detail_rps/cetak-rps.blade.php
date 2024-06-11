<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak RPS</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1cm;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #rps-content, #rps-content * {
                visibility: visible;
            }
            #rps-content {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            background-color: #2F4F4F;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header h1, .header h2, .header h3 {
            margin: 5px;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .main-table th, .main-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        .section-title {
            background-color: #C0C0C0;
            text-align: center;
            font-weight: bold;
        }
        .cpl, .cpl-mk, .additional-sections {
            background-color: #f4f4f4;
            border: 1px solid black;
            margin-bottom: 20px;
        }
        .cpl ul, .cpl-mk ul, .additional-sections ul {
            list-style-type: none;
            padding-left: 20px;
        }
        .additional-sections th {
            background-color: #C0C0C0;
        }
        .highlight {
            color: red;
        }
        .extended-table {
            width: 100%;
            border-collapse: collapse;
        }
        .extended-table th, .extended-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        .extended-table th {
            background-color: #C0C0C0;
        }
    </style>
</head>
<body>
    <div id="rps-content">
        <div class="header">
            <img src="path/to/logo.png" alt="Politeknik Negeri Malang" style="float: left; width: 80px; height: auto;">
            <h1>POLITEKNIK NEGERI MALANG</h1>
            <h2>JURUSAN TEKNOLOGI INFORMASI</h2>
            <h2>PROGRAM STUDI: D4 SISTEM INFORMASI BISNIS</h2>
            <h3>RENCANA PEMBELAJARAN SEMESTER (RPS)</h3>
        </div>
    
        <table class="main-table">
            <tr>
                <th>Mata Kuliah</th>
                <th>Kode</th>
                <th>Rumpun Mata Kuliah</th>
                <th>Bobot (SKS)/jam</th>
                <th>Semester</th>
                <th>Tgl. Penyusunan</th>
            </tr>
            <tr>
                <td>{{ $data->mk_nama}}</td>
                <td>{{ $data->kode_mk}}</td>
                <td>{{ $data->rumpun_mk}}</td>
                <td>{{ $data->sks }} SKS / {{ $data->jumlah_jam }} Jam</td>
                <td>{{ $data->semester }}</td>
                <td>{{ $data->tanggal_penyusunan }}</td>
            </tr>
            <tr>
                <th> Otorisasi </th>
                <th colspan="2">Dosen Pengembang RPS</th>
                
                <th>Koordinator RMK</th>
                <th colspan="2">Ka PRODI</th>
                
            </tr>
            <tr>
                <td> </td>
                <td colspan="2">
                    Farid Angga Pribadi. S.Kom. M.Kom. <br>
                    Indra Dharma Wijaya ST.M.MT.
                </td>
                <td> </td>
                <td colspan="2">Hendra Pradibta SE. M.Sc</td>
            </tr>
        
    
            
                <tr>
                    <th rowspan="4">Capaian Pembelajaran (CP)</th>
                    <th colspan="5">Capaian Pembelajaran Lulusan Program Studi (CPL-Prodi)</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <ul>
                            <li>S8: Memiliki pengetahuan sesuai dengan capaian pembelajaran program studi D4 Sistem Informasi Bisnis.</li>
                            <li>S9: Menunjukkan sikap bertanggung jawab atas pekerjaan di bidang keahliannya secara mandiri.</li>
                            <li>PP2: Menguasai metode pengembangan produk TIK untuk memberikan solusi yang tepat melalui satu atau lebih domain aplikasi.</li>
                            <li>KK1: Mampu mengembangkan teori dan konsep terhadap Tata Kelola TI.</li>
                            <li>KU1: Mampu menerapkan pemikiran logis, kritis, inovatif, bermutu, dan terukur dalam melakukan pekerjaan yang spesifik di bidang keahliannya serta sesuai dengan standar kompetensi kerja bidang yang bersangkutan.</li>
                            <li>KU2: Mampu menunjukkan kinerja mandiri bermutu dan terukur.</li>
                        </ul>
                    </td>
                </tr>

        <tr>
            <th colspan="5">Capaian Pembelajaran Lulusan yang dibebankan pada mata kuliah (CPL-MK)</th>
        </tr>
        <tr>
        <td colspan="6">
            <ul>
                <li>Memahami konsep tata kelola Teknologi informasi</li>
                <li>Memahami Pondasi Tata Kelola Teknologi Informasi</li>
                <li>Memahami Elemen dan Tujuan Tata Kelola Teknologi Informasi</li>
                <li>Memahami Kerangka Kerja dan Standard Tata Kelola</li>
                <li>Memahami COBIT and the IT Governance Institute</li>
                <li>Memahami ITIL and IT Service Management Guidance</li>
                <li>Memahami IT Governance Standards: ISO 9001, 27002, dan 38500</li>
                <li>Mampu menerapkan penggunaan Framework</li>
            </ul>
        </td>
    </tr>
    

        <div class="additional-sections">
            
                <tr>
                    <th class="section-title" >Diskripsi Singkat <br>Mata Kuliah</th>
                    <td colspan="5">Mata kuliah ini memberikan wawasan kepada mahasiswa tentang peran, fungsi dan tata cara dalam melakukan Tata Kelola Teknologi Informasi serta penerapan tata kelola teknologi informasi dalam sebuah organisasi sesuai standar maupun kerangka kerja internasional.</td>
                </tr>
                <tr>
                    <th class="section-title">Materi Pembelajaran / Pokok Bahasan</th>
                    <td colspan="5">
                        <ol>
                            <li>Konsep Tata Kelola Teknologi Informasi</li>
                            <li>Pondasi Tata Kelola Teknologi Informasi</li>
                            <li>Elemen dan Tujuan Tata Kelola Teknologi Informasi</li>
                            <li>Kerangka Kerja dan Standard Tata Kelola</li>
                            <li>COBIT and the IT Governance Institute</li>
                            <li>ITIL and IT Service Management Guidance</li>
                            <li>IT Governance Standards: ISO 9001, 27002, dan 38500</li>
                            <li>Memahami dan menetapkan kerangka kerja Tata Kelola Teknologi Informasi</li>
                            <li>Penerapan Framework Tata kelola Teknologi Informasi</li>
                        </ol>
                    </td>
                </tr>
                <tr>
                    <th class="section-title" rowspan="4">Pustaka</th>
                    <th class="section-title"> Utama</th>
                    <th colspan="4" > </th>
                </tr>
                <tr>
                    <td colspan="5">
                        <p>Utama:</p>
                        <ul>
                            <li>Information Technology Governance and Service Management: Framework and Adaptations, Aileen Cater Steel, 2009</li>
                        </ul>
                        
                    </td>
                </tr>
                <tr>
                    <th class="section-title"> Pendukung</th>
                    <th colspan="4" > </th>
                </tr>
                <tr>
                    <td colspan="5">
                        <p>Pendukung:</p>
                        <ul>
                            <li>Moeller, Robert R (2013). Executive’s Guide to IT Governance Improving System Processes with Service Management, COBIT and ITIL. Canada: John Wiley & Sons Inc</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th class="section-title" rowspan="2">Media Pembelajaran</th>
                    <th class="section-title">Software</th>
                    <th class="section-title" colspan="5">Hardware</th>
                </tr>
                <tr>
                            <td>
                                @foreach ($mediaview as $media )
                                    @if ($media->jenis_media == 0)
                                            {{ $media->nama_media }}
                                    @endif
                                @endforeach
                            </td>
                            <td colspan="5">Hardware: PC/Laptop</td>
                </tr>
                <tr>
                    <th class="section-title">Nama Dosen Pengampu</th>
                    <td colspan="6">
                        <ol>
                            <li>Farid Angga Pribadi, S.Kom., M.Kom.</li>
                            <li>Indra Dharma Wijaya, ST., M.MT.</li>
                            <li>Dimas Wahyu Wibowo, S.T., M.T.</li>
                            <li>Meyti Eka Apriyani, S.T., M.T.</li>
                            <li>Hendra Pradipta, SE., M.Sc.</li>
                        </ol>
                    </td>
                </tr>
            </table>

        <div class="extended-table">
            <table>
                <tr>
                    <th>Minggu Ke</th>
                    <th>Kemampuan Akhir Yang Diharapkan (Sub-CP-MK)</th>
                    <th>Bahan Kajian (Materi Pembelajaran)</th>
                    <th>Bentuk dan Metode Pembelajaran</th>
                    <th>Estimasi Waktu</th>
                    <th>Pengalaman Belajar Mahasiswa</th>
                    <th>Kriteria & Bentuk Penilaian</th>
                    <th>Indikator Penilaian</th>
                    <th>Bobot Penilaian (%)</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Mahasiswa mampu menjelaskan Konsep tata kelola Teknologi informasi</td>
                    <td>Mempelajari Konsep tata kelola Teknologi informasi</td>
                    <td>
                        Bentuk: <br> 
                        @foreach ($bab as $b)
                            @if ($b->bab_id == 2)
                                {!! $b->bentuk_pembelajaran !!}
                            @endif
                        @endforeach
                        <br>
                        Metode Pembelajaran: Contextual Teaching and Learning (CTL) <br> Penugasan: Pembentukan grup
                    </td>
                    <td>4 X 50”</td>
                    <td>Dengan mempelajari konsep tata kelola Teknologi informasi mahasiswa dapat memahami konsep tata kelola Teknologi informasi</td>
                    <td>Kriteria: Ketepatan dan penguasaan <br> Bentuk penilaian: Presentasi, Keaktifan diskusi kelompok meliputi bertanya dan menjawab (afektif)</td>
                    <td>Mampu memahami konsep tata kelola Teknologi informasi</td>
                    <td>2,86%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mahasiswa mampu menjelaskan Pondasi Tata Kelola Teknologi Informasi</td>
                    <td>Mempelajari Pondasi Tata Kelola Teknologi Informasi</td>
                    <td>
                        Bentuk: <br> a. Kuliah Luring (2x50’) Penyampaian materi dan diskusi. <br> b. Penugasan terstruktur (2x50’)
                        <br><br>
                        Metode Pembelajaran: Contextual Teaching and Learning (CTL) <br> Penugasan:
                    </td>
                    <td>4 X 50”</td>
                    <td>Dengan mempelajari Pondasi Tata Kelola Teknologi Informasi mahasiswa dapat memahami Pondasi Tata Kelola Teknologi Informasi</td>
                    <td>Kriteria: Ketepatan dan penguasaan <br> Bentuk penilaian: Presentasi, Keaktifan diskusi kelompok meliputi bertanya dan menjawab (afektif)</td>
                    <td>Mampu memahami Pondasi Tata Kelola Teknologi Informasi</td>
                    <td>2,86%</td>
                </tr>
                <!-- Tambahkan baris sesuai kebutuhan -->
            </table>
        </div>
    </div>
</div>

    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>
</html>
