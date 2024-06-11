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
                                    <label class="col-sm-3 control-label col-form-label">Materi Pembelajaran</label>
                                    @foreach ($data as $d )
                                    <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                                    @endforeach
                                    <div class="form-group clearfix">
                                        @foreach ($bk as $bks)
                                            @php
                                                // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                                $isSelected = $selectBk->firstWhere('mk_bk_id', $bks->mk_bk_id);
                                                // Tentukan apakah checkbox harus dicentang
                                                $isChecked = $isSelected && $isSelected->is_selected;
                                            @endphp
                                        <div class="icheck-success d-inline col-sm-9">
                                            <input type="checkbox" id="checkbox2{{ $bks->mk_bk_id }}" name="mk_bk_id[]" value="{{ $bks->mk_bk_id }}"
                                            @if ($isChecked) checked @endif>
                                                <label for="checkbox2{{ $bks->mk_bk_id }}">
                                            {{ $bks->bk_deskripsi }}
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

    var elementsBk = [];

    $('input[type="checkbox"][name="mk_bk_id[]"]').on('change', function() {
        var bkId = $(this).val();
        if (!$(this).is(':checked')) {
            elementsBk.push(bkId);
        }
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            mk_bk_id : { required: true },
        },
        submitHandler: function (form) {

            elementsBk.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_bk[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
                $(form).ajaxSubmit({
                    url: "{{ route('kelola_master.updateBk', $id) }}", // Ensure this URL is correct
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