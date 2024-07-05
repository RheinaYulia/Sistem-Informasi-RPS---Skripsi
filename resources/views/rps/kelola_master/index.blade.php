@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <div class="card card-outline card-{{ $theme->card_outline }}">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-angle-double-right text-md text-{{ $theme->card_outline }} mr-1"></i>
                            {!! $page->title !!}
                        </h3>

                {{-- <style>
                   .btn-app-small {
                    margin-top: 7px;
                    padding-top: 5px !important;
                    font-size: 5px !important;
                    width: auto !important;
                    height: 30px !important;
                    line-height: 1.0 !important;
                    }

                    .btn-app-small i {
                        font-size: 12px !important; /* Sesuaikan ukuran ikon */
                    }

                    .btn-app-small .btn-text {
                        font-size: 5px !important; /* Sesuaikan ukuran teks */
                    }

                    .btn-app-small .badge {
                        font-size: 10px !important; /* Sesuaikan ukuran font dalam span */
                        padding: 2px 3px !important; /* Sesuaikan padding dalam span */
                    }

                    .custom-btn-container {
                        display: inline-block; /* Pastikan div mengikuti ukuran konten di dalamnya */
                    }

                    .custom-btn-container .btn-app {
                        height: 50px !important; /* Ubah tinggi tombol */
                        width: 30px !important;  /* Ubah lebar tombol */
                        font-size: 12px !important; /* Ubah ukuran teks tombol */
                        line-height: 1.5 !important; /* Sesuaikan tinggi garis jika diperlukan */
                    } 

                    .custom-btn-container .btn-app i {
                        font-size: 12px !important; /* Ubah ukuran ikon */
                    }
                </style> --}}
            <style>
                a.disabled {
                    pointer-events: none;
                    opacity: 0.6;
                }

                a.disabled, .btn.disabled, .dropdown-item.disabled {
                    pointer-events: none;
                    opacity: 0.6;
                }

            </style>
                
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-full-width" id="table_master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Kuliah</th>
                                    <th>Edit Dosen RPS</th>
                                    <th> Edit Bab </th>
                                    <th>Edit RPS</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('content-js')
    <script>

            $(document).ready(function() {
                // Initialize tooltips
                $('[data-toggle="tooltip"]').tooltip();

                // Prevent default action for disabled elements
                $(document).on('click', 'a.disabled, .dropdown-item.disabled, .btn.disabled', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                });
            });

        $(document).ready(function() {

            $('.filter_combobox').select2();

            var v = 0;
            dataMaster = $('#table_master').DataTable({
                "bServerSide": true,
                "bAutoWidth": false,
                "ajax": {
                    "url": "{{ $page->url }}/list",
                    "dataType": "json",
                    "type": "POST"
                },
                "aoColumns": [{
                        "mData": "no",
                        "sClass": "text-center",
                        "sWidth": "5%",
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "mData": "mk_nama",
                        "sClass": "",
                        "sWidth": "20%",
                        "bSortable": true,
                        "bSearchable": true,
                        "mRender": function(data, type, row, meta) {
                            return data;
                        }
                        
                    },
                    {
                        "mData": "rps_id",
                        "sClass": "text-center pr-2",
                        "sWidth": "10%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function(data, type, row, meta) {
                            let disabledClass = '';
                            let disabledAttr = '';

                            // Periksa jika verifikasi bernilai 1 atau 2, dan pengesahan bernilai 0 atau 1
                            if ((row.verifikasi == 1 || row.verifikasi == 2) && (row.pengesahan == 0 || row.pengesahan == 1)) {
                                disabledClass = 'disabled';
                                disabledAttr = 'disabled';
                            }

                            return ''
                                @if($allowAccess->update)
                                + `<a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/edit1" class="ajax_modal btn btn-xs btn-primary tooltips text-white ${disabledClass}" data-placement="left" data-original-title="Edit Data" ${disabledAttr}><i class="fas fa-users"></i></a>` 
                                @endif
                                ;
                        }
                    },

                    {
                        "mData": "rps_id",
                        "sClass": "text-center pr-2",
                        "sWidth": "10%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function(data, type, row, meta) {
                            let disabledClass = '';
                            let disabledAttr = '';

                            // Periksa jika verifikasi bernilai 1 atau 2, dan pengesahan bernilai 0 atau 1
                            if ((row.verifikasi == 1 || row.verifikasi == 2) && (row.pengesahan == 0 || row.pengesahan == 1)) {
                                disabledClass = 'disabled';
                                disabledAttr = 'disabled';
                            }

                            return ''
                            @if($allowAccess->update) 
                            + '<a href="{{ $page->url }}/bab_rps/kelola-data/' + data + '" class="btn btn-xs btn-info tooltips text-light ' + disabledClass + '" data-placement="left" data-original-title="Kelola Data" ' + disabledAttr + '><i class="fa fa-cogs"></i></a>' 
                            @endif
                            ;
                        }
                    },

                    {
                    "mData": "rps_id",
                    "sClass": "text-center pr-2",
                    "sWidth": "10%",
                    "bSortable": false,
                    "bSearchable": false,
                    "mRender": function(data, type, row, meta) {
                        let disabled = '';
                        let disabledClass = '';

                        // Periksa jika verifikasi bernilai 1 atau 2, dan pengesahan bernilai 0 atau 1
                        if ((row.verifikasi == 1 || row.verifikasi == 2) && (row.pengesahan == 0 || row.pengesahan == 1)) {
                            disabled = 'disabled';
                            disabledClass = 'disabled';
                        }

                        return ''
                            @if($allowAccess->update)
                            + `<div class="btn-group">
                                    <button type="button" class="btn btn-warning ${disabledClass}">Edit RPS</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon ${disabledClass}" data-toggle="dropdown" ${disabled}>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editCplProdi" class="dropdown-item ajax_modal ${disabledClass}" data-original-title="CPL Prodi">CPL Prodi</a>
                                        <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editCPMK" class="dropdown-item ajax_modal ${disabledClass}" data-original-title="CPMK">CPMK</a>
                                        <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editBk" class="dropdown-item ajax_modal ${disabledClass}" data-original-title="Pokok Bahasan">Pokok Bahasan</a>
                                        <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editMedia" class="dropdown-item ajax_modal ${disabledClass}" data-original-title="Media">Media</a>
                                        <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editPustaka" class="dropdown-item ajax_modal ${disabledClass}" data-original-title="Pustaka">Pustaka</a>
                                        <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editMkSyarat" class="dropdown-item ajax_modal ${disabledClass}" data-original-title="Matkul Syarat">Matkul Syarat</a>
                                    </div>
                                </div>` 
                            @endif
                            ;
                    }
                }

                ],
                "fnDrawCallback": function ( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $( 'a', this.fnGetNodes() ).tooltip();
                }
            });

            $('.dataTables_filter input').unbind().bind('keyup', function(e) {
                if (e.keyCode == 13) {
                    dataMaster.search($(this).val()).draw();
                }
            });
        });

    </script>

@endpush
