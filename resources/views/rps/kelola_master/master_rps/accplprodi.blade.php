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
                
                <div class="form-group required row mb-1">
                    <label class="col-sm-3 control-label col-form-label">CPL Prodi</label>
                    @foreach ($data as $d)
                        <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                    @endforeach
                    <div class="col-sm-8">
                        @foreach ($cpl as $c)
                            @php
                                // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                $isSelected = $selectCpl->firstWhere('cpl_prodi_id', $c->cpl_prodi_id);
                                // Tentukan apakah checkbox harus dicentang
                                $isChecked = $isSelected && $isSelected->is_selected;
                            @endphp
                            <div class="icheck-success mb-3">
                                <input type="checkbox" id="checkbox{{ $c->cpl_prodi_id }}" name="cpl_prodi_id[]" value="{{ $c->cpl_prodi_id }}" 
                                    @if ($isChecked) checked @endif>
                                <label for="checkbox{{ $c->cpl_prodi_id }}">
                                    {{ $c->cpl_prodi_deskripsi }}
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

    var elementsCplProdi = [];
    
    $('input[type="checkbox"][name="cpl_prodi_id[]"]').on('change', function() {
        var cplProdiId = $(this).val();
        if (!$(this).is(':checked')) {
            elementsCplProdi.push(cplProdiId);
        }
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            cpl_prodi_id: { required: true },
        },
        submitHandler: function (form) {
           
            elementsCplProdi.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_cpl_prodi[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
                $(form).ajaxSubmit({
                    url: "{{ route('kelola_master.updateCplProdi', $id) }}", // Ensure this URL is correct
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