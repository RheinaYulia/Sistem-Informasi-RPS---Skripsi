<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="form-master">
    @csrf
    {!! ($is_edit)? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Jenis Pustaka</label>
                    <div class="col-sm-9 mt-2">
                        <div class="icheck-success d-inline mr-3">
                            <input type="radio" id="radioActive" name="jenis_pustaka" value="1" <?php echo isset($data->jenis_pustaka)? (($data->jenis_pustaka == 1)? 'checked' : '') : 'checked' ?>>
                            <label for="radioActive">Utama </label>
                        </div>
                        <div class="icheck-success d-inline mr-3">
                            <input type="radio" id="radioFailed" name="jenis_pustaka" value="0" <?php echo isset($data->jenis_pustaka)? (($data->jenis_pustaka == 0)? 'checked' : '') : '' ?>>
                            <label for="radioFailed">Pendukung</label>
                        </div>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Referensi</label>
                    <div class="col-sm-9">
                        {{-- <input type="text" class="form-control form-control-sm" id="referensi" name="referensi" value="{{ isset($data->referensi) ? $data->referensi : '' }}"/> --}}
                        <textarea class="form-control form-control-sm" rows="3" name="referensi" id="referensi">{{ isset($data->referensi) ? $data->referensi : '' }}</textarea>
                    </div>
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
    $(document).ready(function () {
        unblockUI();

        $("#form-master").validate({
            rules: {
                jenis_pustaka: {
                    required: true
                },
                referensi: {
                    required: true,
                    maxlength: 255
                },
            },
            submitHandler: function (form) {
                $('.form-message').html('');
                blockUI(form);
                $(form).ajaxSubmit({
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
