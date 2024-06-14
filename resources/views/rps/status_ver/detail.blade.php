<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="form-master">
    <div id="modal-master" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group required row mb-2">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <style>
                        #badge1 {
                                    font-size: 18px; /* Sesuaikan ukuran teks sesuai kebutuhan */
                                }
                    </style>
                        <span class="badge badge-danger col-sm-3 " style="font-size: 15px">Ditolak Admin</span>
                    </div> 
                <div class="form-group required row mb-2">
                    <div style="display: flex; justify-content: center; width: 100%;">
                        <table style="border-collapse: collapse; width: 80%; ">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <th style="padding: 10px; padding-top: 5px;  text-align: left;"> 
                            <span>{{ $data->keterangan_ditolak }}</span>
                        </th>
                    </table>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    
                </div>

        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary">Batal</button>
        </div>
               
           
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
