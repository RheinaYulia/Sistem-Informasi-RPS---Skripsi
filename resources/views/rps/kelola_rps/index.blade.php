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
                        <style>
                            a.disabled {
                                pointer-events: none;
                                opacity: 0.6;
                            }
                        </style>
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
                                    <th>Mata Kuliah</th>
                                    <th> Detail RPS </th>
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
    $(document).on('click', 'a.disabled', function(e) {
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
                        "sWidth": "8%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function(data, type, row, meta) {
                            return ''
                                @if($allowAccess->update) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/" class="ajax_modal btn btn-xs btn-info tooltips text-light text-xs" data-placement="left" data-original-title="RPS" ><i class="fa fa-th"></i> Detail</a> ` @endif
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
                                +`<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/edit" class="ajax_modal btn btn-xs btn-warning tooltips text-secondary ${disabledClass}" data-placement="left" data-original-title="Edit Data" ${disabledAttr} ><i class="fa fa-edit"></i></a> ` @endif
                                @if($allowAccess->delete) 
                                + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/delete" class="ajax_modal btn btn-xs btn-danger tooltips text-light ${disabledClass}" data-placement="left" data-original-title="Hapus Data"${disabledAttr} ><i class="fa fa-trash"></i></a> ` @endif
                                
                                ;
                        }
                    },
                    
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
