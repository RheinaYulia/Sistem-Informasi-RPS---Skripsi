<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{$page->url}}" role="form" class="form-horizontal" id="form-master">
    @csrf
    {!! ($is_edit)? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">CPMK</label>
                    @foreach ($data as $d )
                        <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                    @endforeach
                </div>
                
                <div class="form-group required row mb-10">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="table-responsive" style="width: 80%;">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-wrapper" style="height: 400px; overflow-y: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 45px;">#</th>
                                            <th style="text-align: center; width: 60px;">Kode</th>
                                            <th style="text-align: center;">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        @foreach ($cpmk as $kode)
                                        <tr>
                                            <td style="text-align: center;">
                                                @php
                                                    // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                                    $isSelected = $selectCpmk->firstWhere('cpl_cpmk_id', $kode->cpl_cpmk_id);
                                                    // Tentukan apakah checkbox harus dicentang
                                                    $isChecked = $isSelected && $isSelected->is_selected;
                                                @endphp
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="checkbox1{{ $kode->cpl_cpmk_id }}" name="cpl_cpmk_id[]" value="{{ $kode->cpl_cpmk_id }}" @if ($isChecked) checked @endif>
                                                    <label for="checkbox1{{ $kode->cpl_cpmk_id }}"></label>
                                                </div>
                                            </td>
                                            <td style="padding-left: 10px;">
                                                <label for="checkbox1{{ $kode->cpl_cpmk_id }}">
                                                    {{ $kode->cpmk_kode }}
                                                </label>
                                            </td>
                                            <td style="padding-left: 10px;">
                                                <label for="checkbox1{{ $kode->cpl_cpmk_id }}">
                                                    {{ $kode->cpmk_deskripsi }}
                                                </label>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

$(document).ready(function () {
    unblockUI();
    $('.select2_combobox').select2();

    var elementsCpmk = [];

    $('input[type="checkbox"][name="cpl_cpmk_id[]"]').on('change', function() {
        var cpmkId = $(this).val();
        if (!$(this).is(':checked')) {
            elementsCpmk.push(cpmkId);
        }
    });

    // Pencarian
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var tableBody = document.getElementById('tableBody');
        var rows = tableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;

            for (var j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(searchValue) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            cpl_cpmk_id : { required: true },
        },
        submitHandler: function (form) {
            elementsCpmk.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_cpmk[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
            $(form).ajaxSubmit({
                url: "{{ route('kelola_master.updateCPMK', $id) }}", // Ensure this URL is correct
                type: 'POST', // Ensure the request is POST
                dataType: 'json',
                success: function (data) {
                    unblockUI(form);
                    setFormMessage('.form-message', data);
                    if (data.stat) {
                        resetForm('#form-master');
                        dataMaster.draw(false);
                    }
                    closeModal($modal, data);
                }
            });
        },
        validClass: "valid-feedback",
        errorElement: "div",
        errorClass: 'invalid-feedback',
        errorPlacement: erp,
        highlight: hl,
        unhighlight: uhl,
        success: sc
    });
});
</script>

<style>
.table-wrapper {
    position: relative;
}

.table-wrapper thead th {
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 2;
}
</style>
