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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>

                            <div class="form-group required row mb-2">
                                <label class="col-sm-3 control-label col-form-label">CPMK</label>
                                @foreach ($data as $d )
                                    <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                                @endforeach
                                <div class="form-group clearfix">
                                    @foreach ($cpmk as $kode)
                                            @php
                                                // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                                $isSelected = $selectCpmk->firstWhere('cpl_cpmk_id', $kode->cpl_cpmk_id);
                                                // Tentukan apakah checkbox harus dicentang
                                                $isChecked = $isSelected && $isSelected->is_selected;
                                            @endphp
                                        <div class="icheck-success d-inline col-sm-9">
                                            <input type="checkbox" id="checkbox1{{ $kode->cpl_cpmk_id }}" name="cpl_cpmk_id[]" value="{{ $kode->cpl_cpmk_id }}"
                                            @if ($isChecked) checked @endif>
                                                <label for="checkbox1{{ $kode->cpl_cpmk_id }}">
                                            {{ $kode->cpmk_kode }}
                                        </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
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