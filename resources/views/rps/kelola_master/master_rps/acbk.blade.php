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
                                </div>
                                <div class="form-group required row mb-10">
                                    <div style="display: flex; justify-content: center; width: 100%;">
                                    <table border="1" style="border-collapse: collapse; width: 80%;">
                                        <tr>
                                            <th style="width: 45px;"></th>
                                            <th style="text-align: center; width: 60px;">Kode</th>
                                            <th style="text-align: center;">Deskripsi</th>
                                        </tr>
                                        @foreach ($bk as $bks)
                                        <tr>
                                            <td style="text-align: center;">
                                            @php
                                                // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                                $isSelected = $selectBk->firstWhere('mk_bk_id', $bks->mk_bk_id);
                                                // Tentukan apakah checkbox harus dicentang
                                                $isChecked = $isSelected && $isSelected->is_selected;
                                            @endphp
                                        <div class="icheck-success mb-9">
                                            <input type="checkbox" id="checkbox2{{ $bks->mk_bk_id }}" name="mk_bk_id[]" value="{{ $bks->mk_bk_id }}"
                                            @if ($isChecked) checked @endif>
                                                <label for="checkbox2{{ $bks->mk_bk_id }}"></label>
                                    </div>
                                </td>
                                <td style="padding-left: 10px;">
                                    <label for="checkbox2{{ $bks->mk_bk_id }}"></label>
                                        {{ $bks->bk_kode }}
                                    </label>
                                </td>
                                <td style="padding-left: 10px;">
                                    <label for="checkbox2{{ $bks->mk_bk_id }}"></label>
                                        {{ $bks->bk_deskripsi }}
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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