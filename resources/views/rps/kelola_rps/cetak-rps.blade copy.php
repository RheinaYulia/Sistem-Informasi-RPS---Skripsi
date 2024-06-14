<!DOCTYPE html>
<html>
<head>
    <title>Rencana Pembelajaran Semester (RPS)</title>
    <style>
        @page {
            size: landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px; /* Ukuran font yang lebih besar */
        }
        .page-break {
            page-break-after: always;
        }
        .header {
            background-color: #2F4F4F;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .header h1, .header h2, .header h3 {
            margin: 5px;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .main-table th, .main-table td {
            border: 1px solid black;
            padding: 8px;
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
            margin-bottom: 10px;
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
            padding: 8px;
            text-align: center;
        }
        .extended-table th {
            background-color: #C0C0C0;
        }
        .nested-table {
            width: 100%;
            border-collapse: collapse;
        }
        .nested-table th, .nested-table td {
            border: none;
            padding: 5px;
            text-align: left;
        }
        img.invoice-logo {
            width: 80px;
            height: auto;
        }
        .baris th {
            width: 10px;
        }
    </style>
</head>
<body>
    
    <table class="main-table">
        <tr>
            <td rowspan="3" colspan="2" style="text-align: center; vertical-align: middle;">
                <img alt="Logo" class="invoice-logo" src="{{ public_path('images/logopolinema.png') }}">
            </td>
            <td colspan="6"> <span style="font-size: 18px; font-weight: bold ">POLITEKNIK NEGERI MALANG</span> </td>
        </tr>
        <tr>
            <td colspan="6"> <span style="font-size: 15px; font-weight: bold">JURUSAN TEKNOLOGI INFORMASI</span> </td>
        </tr>
        <tr>
            <td colspan="7"> <span style="font-size: 15px; font-weight: bold">PROGRAM STUDI: D4 SISTEM INFORMASI BISNIS</span> </td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center"> <span style="font-size: 20px; font-weight: bold">RENCANA PEMBELAJARAN SEMESTER (RPS)</span> </td>
        </tr>
        <tr>
            <th colspan="2">Mata Kuliah</th>
            <th>Kode</th>
            <th colspan="2">Rumpun Mata Kuliah</th>
            <th>Bobot (SKS)/jam</th>
            <th>Semester</th>
            <th colspan="2">Tgl. Penyusunan</th>
        </tr>
        <tr>
            <td colspan="2">{{ $data->mk_nama }}</td>
            <td>{{ $data->kode_mk }}</td>
            <td colspan="2">{{ $data->rumpun_mk }}</td>
            <td>{{ $data->sks }} SKS / {{ $data->jumlah_jam }} Jam</td>
            <td>{{ $data->semester }}</td>
            <td colspan="2">{{ $data->tanggal_penyusunan }}</td>
        </tr>
        <tr>
            <th colspan="2">Otorisasi</th>
            <th colspan="2">Dosen Pengembang RPS</th>
            <th>Koordinator RMK</th>
            <th colspan="4">Ka PRODI</th>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">
                @foreach ($pengembang as $p)
                    {{ $p->nama_dosen }} <br>
                @endforeach
            </td>
            <td></td>
            <td colspan="4">{{ $data->nama_dosen }}</td>
        </tr>
        <tr>
            <th class="section-title" rowspan="4" colspan="2">Capaian Pembelajaran (CP)</th>
            <th colspan="6">Capaian Pembelajaran Lulusan Program Studi (CPL-Prodi)</th>
        </tr>
        <tr>
            <td colspan="6">
                <ul>
                    @foreach ($cplprodi as $cpl)
                        <li>{{ $cpl->cpl_prodi_kode }} : {{ $cpl->cpl_prodi_deskripsi }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th colspan="6">Capaian Pembelajaran Lulusan yang dibebankan pada mata kuliah (CPL-MK)</th>
        </tr>
        <tr>
            <td colspan="6">
                <ul>
                    @foreach ($cpmkview as $cpmk)
                        <li>{{ $cpmk->cpmk_kode }} : {{ $cpmk->cpmk_deskripsi }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th class="section-title" colspan="2">Diskripsi Singkat Mata Kuliah</th>
            <td colspan="6">{{ $data->deskripsi_rps }}</td>
        </tr>
        <tr>
            <th class="section-title" colspan="2">Materi Pembelajaran / Pokok Bahasan</th>
            <td colspan="6">
                <ol>
                    @foreach ($bkview as $bk)
                        <li>{{ $bk->bk_kode }} : {{ $bk->bk_deskripsi }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
        <div class="page-break"></div>
        <tr>
            <th class="section-title" rowspan="4" colspan="2">Pustaka</th>
            <th class="section-title">Utama</th>
            <th colspan="6"></th>
        </tr>
        <tr>
            <td colspan="6">
                <ul>
                    @foreach ($pustaka as $utm)
                        @if ($utm->jenis_pustaka == 1)
                            <li>{{ $utm->referensi }}</li>
                        @endif
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th class="section-title">Pendukung</th>
            <th colspan="6"></th>
        </tr>
        <tr>
            <td colspan="6">
                <ul>
                    @foreach ($pustaka as $utm)
                        @if ($utm->jenis_pustaka == 0)
                            <li>{{ $utm->referensi }}</li>
                        @endif
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th class="section-title" rowspan="2" colspan="2">Media Pembelajaran</th>
            <th class="section-title">Software</th>
            <th class="section-title" colspan="5">Hardware</th>
        </tr>
        <tr>
            <td>
                @foreach ($mediaview as $media)
                    @if ($media->jenis_media == 1)
                        {{ $media->nama_media }},
                    @endif
                @endforeach
            </td>
            <td colspan="5">
                @foreach ($mediaview as $media)
                    @if ($media->jenis_media == 0)
                        {{ $media->nama_media }},
                    @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <th class="section-title" colspan="2">Nama Dosen Pengampu</th>
            <td colspan="6">
                <ol>
                    @foreach ($pengampuview as $pengampu)
                        <li>{{ $pengampu->nama_dosen }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
    </table>

    <table class="main-table">
        <tr>
            <th class="baris">Minggu Ke</th>
            <th>Kemampuan Akhir Yang Direncanakan (Sub-CP-MK)</th>
            <th>Bahan Kajian (Materi Pembelajaran)</th>
            <th>Bentuk dan Metode Pembelajaran</th>
            <th>Estimasi Waktu</th>
            <th>Pengalaman Belajar Mahasiswa</th>
            <th>Kriteria & Bentuk Penilaian</th>
            <th>Indikator Penilaian</th>
            <th>Bobot Penilaian (%)</th>
        </tr>
        @foreach ($bab as $index => $b)
            @if ($index % 5 == 0 && $index != 0)
                <div class="page-break"></div>
            @endif
            <tr>
                <td>{{ $b->rps_bab }}</td>
                <td>{!! $b->sub_cpmk !!}</td>
                <td>{!! $b->materi !!}</td>
                <td>
                    Bentuk: <br>
                    {!! $b->bentuk_pembelajaran !!}
                    <br>
                    Metode Pembelajaran: <br>
                    {!! $b->metode_pembelajaran !!}
                </td>
                <td>{!! $b->estimasi_waktu !!}</td>
                <td>{!! $b->pengalaman_belajar !!}</td>
                <td>Kriteria: {!! $b->kriteria_penilaian !!} <br> Bentuk penilaian: {!! $b->bentuk_penilaian !!}</td>
                <td>{!! $b->indikator_penilaian !!}</td>
                <td>{!! $b->bobot_penilaian !!}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>

