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
            
                @if ($data->verifikasi == 1)
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Status</label>
                        <label class="col-sm-3 col-form-label">Sedang Diajukan</label>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Oke</button>
                </div>

                @elseif ($data->verifikasi == 2)
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <style>
                        #badge1 {
                                    font-size: 18px; /* Sesuaikan ukuran teks sesuai kebutuhan */
                                }
                    </style>
                        <span class="badge badge-success col-sm-3 " style="font-size: 15px">Sudah di Verifikasi</span>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Oke</button>
                </div>
                @else
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Status</label>
                <div class="col-sm-9 mt-2">
                <div class="icheck-success d-inline mr-3">
                    <input type="radio" id="radioActive" name="verifikasi" value="0" <?php echo isset($data->verifikasi)? (($data->verifikasi == 0)? 'checked' : '') : 'checked' ?>>
                    <label for="radioActive">Draft </label>
                </div>
                <div class="icheck-danger d-inline mr-3">
                    <input type="radio" id="radioFailed" name="verifikasi" value="1" <?php echo isset($data->verifikasi)? (($data->verifikasi == 1)? 'checked' : '') : '' ?>>
                    <label for="radioFailed">Ajukan</label>
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
                @endif
                    
       
           
        </div>
    </div>
</form>

<script>
     $(document).ready(function() {
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.locale('id')
});
    });
</script>

<script>


    $(document).ready(function () {
        unblockUI();

        @if($is_edit)
            $('#jurusan_id').val('{{ $data->jurusan_id }}').trigger('change');
        @endif

        $("#form-master").validate({
            rules: {
                verifikasi: {
                    required: true
                }
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
