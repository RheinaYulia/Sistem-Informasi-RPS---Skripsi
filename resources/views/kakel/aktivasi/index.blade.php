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
                    {{-- <div class="card-tools">
                        @if($allowAccess->create)
                        <button type="button" data-block="body"
                            class="btn btn-sm btn-{{ $theme->button }} mt-1 ajax_modal"
                            data-url="{{ $page->url }}/create"><i class="fas fa-plus"></i> Tambah</button>
                        @endif
                    </div> --}}
                </div>
                <div class="card-body p-0">

                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-full-width" id="table_master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>KaPokJar</th>                         
                                    <th>Dosen</th>    
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

            dataMaster = $('#table_master').DataTable({
                "bServerSide": true,
                "bAutoWidth": false,
                "ajax": {
                    "url": "{{ $page->url }}/list",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.filter_group = $('.filter_group').val();
                    },
                },
                "aoColumns": [{
                        "mData": "no",
                        "sClass": "text-center",
                        "sWidth": "5%",
                        "bSortable": false,
                        "bSearchable": false
                    },
                    {
                        "mData": "jabatan",
                        "sClass": "",
                        "sWidth": "30%",
                        "bSortable": true,
                        "bSearchable": true
                    },
                    {
                        "mData": "nama_dosen",
                        "sClass": "",
                        "sWidth": "40%",
                        "bSortable": true,
                        "bSearchable": true
                    },
                    {
                        "mData": "m_kakel_id",
                        "sClass": "text-center pr-2",
                        "sWidth": "15%",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function(data, type, row, meta) {
                            return  ''
                                    @if($allowAccess->update) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/edit" class="ajax_modal btn btn-sm btn-primary tooltips text-white" data-placement="left" data-original-title="Edit Kapokjar" > Edit KaPokJar </a> ` @endif
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

            $('.filter_group, .filter_wilayah').change(function (){
                dataMaster.draw();
            });
        });

</script>

@endpush