<!DOCTYPE html>
<html>
<head>
    <title>Rencana Pembelajaran Semester (RPS)</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        font-size: 12px;
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
    .element{
        background-color: #E0F7FA;
    }

    .element1{
        background-color: lightgray;
    }

    .element2{
        background-color: #D5E8D4;
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

    .rps-section td {
        background-color: #E0F7FA;
    }

    .element-rps1 th {
        background-color: lightgray;
    }
    .element-rps2 th {
        background-color: #D5E8D4;
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
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="{{ route('rps.shows', ['id' => $id]) }}" target="_blank" class="btn btn-default"><i class="fas fa-download"></i> Print</a>
                <table class="main-table">
                    <div class="rps-section">
                    <tr>
                        <td class="element" rowspan="3" colspan="2" style="text-align: center; vertical-align: middle;">
                            <img src="{{ asset('images/logopolinema.png') }}" alt="Logo" style="width: 100px; height: auto;">
                        </td>
                        <td class="element" colspan="6"> <h5 style="font-weight: bold;">POLITEKNIK NEGERI MALANG</h5> </td>
                    </tr>
                    <tr>
                        <td class="element" colspan="6"> <h6 style="font-weight: bold;">JURUSAN TEKNOLOGI INFORMASI</h6> </td>
                    </tr>
                    <tr>
                        <td class="element" colspan="6"> <h6 style="font-weight: bold;">PROGRAM STUDI: D4 {{ strtoupper($data->nama_prodi) }}</h6> </td>
                    </tr>
                    <tr>
                        <td class="element" colspan="9"> <h4 style="text-align: center; font-weight: bold;">RENCANA PEMBELAJARAN SEMESTER (RPS) </h4> </td>
                    </tr>
                    </div>
                    <div class="element-rps1">
                        <tr>
                            <th class="element1" colspan="2">Mata Kuliah</th>
                            <th class="element1">Kode</th>
                            <th class="element1" colspan="2">Rumpun Mata Kuliah</th>
                            <th class="element1">Bobot (SKS)/jam</th>
                            <th class="element1">Semester</th>
                            <th class="element1" colspan="2">Tgl. Penyusunan</th>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $data->mk_nama}}</td>
                            <td>{{ $data->kode_mk}}</td>
                            <td colspan="2">{{ $data->rumpun_mk}}</td>
                            <td>{{ $data->sks }} SKS / {{ $data->jumlah_jam }} Jam</td>
                            <td>{{ $data->semester }}</td>
                            <td colspan="2">{{ $data->tanggal_penyusunan }}</td>
                        </tr>
                        <tr>
                            <th colspan="2"> Otorisasi </th>
                            <th class="element1" colspan="2">Dosen Pengembang RPS</th>
                            <th class="element1">Koordinator RMK</th>
                            <th class="element1" colspan="4">Ka PRODI</th>
                            
                        </tr>
                        <tr>
                            <td colspan="2"> </td>
                            <td colspan="2">
                                @foreach ($pengembang as $p )
                                {{ $p->nama_dosen }} <br>
                                @endforeach
                                        
                            </td>
                            <td> </td>
                            <td colspan="4">{{ $data->nama_dosen }}</td>
                        </tr>
                            <tr>
                                <th rowspan="4" colspan="2">Capaian Pembelajaran (CP)</th>
                                <th class="element1" colspan="6">Capaian Pembelajaran Lulusan Program Studi (CPL-Prodi)</th>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <ul>
                                        @foreach ($cplprodi as $cpl )
                                        <li> {{ $cpl->cpl_prodi_kode}} : {{ $cpl->cpl_prodi_deskripsi }}</li>
                                        @endforeach
                                        
                                    </ul>
                                </td>
                            </tr>
                    <tr>
                        <th class="element1" colspan="6">Capaian Pembelajaran Lulusan yang dibebankan pada mata kuliah (CPL-MK)</th>
                    </tr>
                    <tr>
                    <td colspan="6">
                        <ul>
                            @foreach ($cpmkview as $cpmk )
                            <li> {{ $cpmk->cpmk_kode}} : {{ $cpmk->cpmk_deskripsi }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                        
                            <tr>
                                <th colspan="2">Diskripsi Singkat <br>Mata Kuliah</th>
                                <td colspan="6">{{ $data->deskripsi_rps }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Materi Pembelajaran / Pokok Bahasan</th>
                                <td colspan="6">
                                    <ol>
                                        @foreach ($bkview as $bk )
                                        <li> {{ $bk->bk_kode}} : {{ $bk->bk_deskripsi }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <th rowspan="4" colspan="2">Pustaka</th>
                                <th class="element1"> Utama</th>
                                <th colspan="6" > </th>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <ul>
                                    @foreach ($pustaka as $utm)
                                        @if ($utm->jenis_pustaka == 1)
                                            <li> {{ $utm->referensi }}</li>
                                        @endif
                                    @endforeach 
                                    </ul>         
                                </td>
                            </tr>
                            <tr>
                                <th class="element1"> Pendukung</th>
                                <th colspan="6" > </th>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <ul>
                                        @foreach ($pustaka as $utm)
                                            @if ($utm->jenis_pustaka == 0)
                                                <li> {{ $utm->referensi }}</li>
                                            @endif
                                        @endforeach 
                                        </ul>    
                                </td>
                            </tr>
                            <tr>
                                <th rowspan="2" colspan="2">Media Pembelajaran</th>
                                <th class="element1">Software</th>
                                <th class="element1" colspan="5">Hardware</th>
                            </tr>
                            <tr>
                                        <td>
                                            @foreach ($mediaview as $media )
                                                @if ($media->jenis_media == 1)
                                                        {{ $media->nama_media }},
                                                @endif
                                            @endforeach
                                        </td>
                                        <td colspan="5">@foreach ($mediaview as $media )
                                            @if ($media->jenis_media == 0)
                                                    {{ $media->nama_media }},
                                            @endif
                                        @endforeach</td>
                            </tr>
                            <tr>
                                <th colspan="2">Nama Dosen Pengampu</th>
                                <td colspan="6">
                                    <ol>
                                        @foreach ($pengampuview as $pengampu )
                                        <li>
                                            {{ $pengampu->nama_dosen }}
                                        </li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                      
                    </div>
                    </table>
                    <table class="main-table">
                        <div class="element-rps2">
                            <tr>
                                <th class="element2">Minggu <br>Ke</th>
                                <th class="element2">Kemampuan Akhir 
                                <br>Yang Direncakan (Sub-CP-MK)</th>
                                <th class="element2">Bahan Kajian (Materi Pembelajaran)</th>
                                <th class="element2">Bentuk dan Metode Pembelajaran</th>
                                <th class="element2">Estimasi Waktu</th>
                                <th class="element2">Pengalaman Belajar Mahasiswa</th>
                                <th class="element2">Kriteria & Bentuk Penilaian</th>
                                <th class="element2">Indikator Penilaian</th>
                                <th class="element2">Bobot Penilaian (%)</th>
                            </tr>
                        </div>
                            @foreach ($bab as $b)
                            <tr>
                                <td width="15px">{{ $b->rps_bab }}</td>
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
                                <td>Kriteria: <br> {!! $b->kriteria_penilaian !!} 
                                    
                                    <br> 
                                    
                                    Bentuk penilaian:<br> {!! $b->bentuk_penilaian !!}</td>
                                <td>{!! $b->indikator_penilaian !!}</td>
                                <td>{!! $b->bobot_penilaian !!}%</td>
                            </tr>
                            @endforeach
                            <!-- Tambahkan baris sesuai kebutuhan -->
                        </table>
                        <p> Keterangan : {{ $data->keterangan_rps ? $data->keterangan_rps : '...............................................' }}</p>
                </div>
                
            </div>
        </div>
    </div>
    
</body>
</html>
