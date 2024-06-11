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

                        <div class="card-tools">
    @if($allowAccess->create || $allowAccess->update)
    
        <button type="button" data-block="body" class="btn btn-sm btn-{{ $theme->button }} mt-1 ajax_modal" data-url="{{ $page->url }}/create"><i class="fas fa-plus"></i> Tambah</button>
    @endif
</div>
                       
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-full-width" id="table_master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertemuan</th>
                                    <th>#</th>
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

            $('.filter_combobox').select2();

            var v = 0;
            dataMaster = $('#table_master').DataTable({
                "bServerSide": true,
                "bAutoWidth": false,
                "ajax": {
                    "url": "{{ route('kelola_master.listbab', ['id' => $id]) }}",
                    "dataType": "json",
                    "type": "POST",
                    
                },
                "aoColumns": [{
                        "mData": "no",
                        "sClass": "text-center",
                        "sWidth": "5%",
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "mData": "rps_bab",
                        "sClass": "",
                        "sWidth": "20%",
                        "bSortable": true,
                        "bSearchable": true,
                        "mRender": function(data, type, row, meta) {
                            return 'Pertemuan '+ data;
                        }
                        
                    },
                    {
                        "mData": "bab_id",
                        "sClass": "text-center pr-2",
                        "sWidth": "10%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function(data, type, row, meta) {
                            return  ''
                                    @if($allowAccess->update) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/edit" class="ajax_modal btn btn-xs btn-warning tooltips text-secondary" data-placement="left" data-original-title="Edit Data" ><i class="fa fa-edit"></i></a> ` @endif
                                    @if($allowAccess->delete) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/delete" class="ajax_modal btn btn-xs btn-danger tooltips text-light" data-placement="left" data-original-title="Hapus Data" ><i class="fa fa-trash"></i></a> ` @endif
                                    + '<a href="{{ $page->url }}/master_rps/kelola-data' + '/' + data + '" class="btn btn-xs btn-primary tooltips text-light" data-placement="left" data-original-title="Kelola Data"><i class="fa fa-cogs"></i></a>'
                                    @if($allowAccess->update)
                                    + `<div class="btn-group">
                                            <button type="button" class="btn btn-warning">Edit Master</button>
                                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                            <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/edit1" class="dropdown-item ajax_modal" data-original-title="Dosen Pengembang">Dosen Pengembang</a>
                                            <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editCplProdi" class="dropdown-item ajax_modal" data-original-title="CPL Prodi">CPL Prodi</a>
                                            <a href="#" data-block="body" data-url="{{ $page->url }}/master_rps/${data}/editCPMK" class="dropdown-item ajax_modal" data-original-title="CPMK">CPMK</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>` @endif
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
