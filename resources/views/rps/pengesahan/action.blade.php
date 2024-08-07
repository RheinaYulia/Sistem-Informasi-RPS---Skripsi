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

                @if ($data->pengesahan == 1)
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <style>
                        #badge1 {
                                    font-size: 18px; /* Sesuaikan ukuran teks sesuai kebutuhan */
                                }
                    </style>
                        <span class="badge badge-success col-sm-3 " style="font-size: 15px">Sudah di Sahkan</span>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Oke</button>
                </div>
                @else

                <div class="form-group required row mb-2">
                    <input type="hidden" id="pengesahan" name="pengesahan" value="1">
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-10 col-form-label" >Apakah Anda Yakin Ingin Mengesahkan RPS {{ $kurikulumkId->mk_nama }} ini ? </label>
                        
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

        $("#form-master").validate({
            rules: {
                pengesahan:{
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
