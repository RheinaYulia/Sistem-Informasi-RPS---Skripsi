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
                       
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-full-width" id="table_master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Kuliah</th>
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
                            return  ''
                                    @if($allowAccess->update) 
                                    + '<a href="{{ $page->url }}/bab_rps/kelola-data' + '/' + data + '" class="btn btn-xs btn-info tooltips text-light" data-placement="left" data-original-title="Kelola Data"><i class="fa fa-cogs"></i></a>' @endif
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
