<?php
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
                    <label class="col-sm-3 control-label col-form-label">Status</label>
                    <div class="col-sm-9 mt-2">
                        <div class="icheck-success d-inline mr-3">
                            <input type="radio" id="radioActive" name="verifikasi" value="2" 
                                   <?php echo isset($data->verifikasi) ? (($data->verifikasi == 2) ? 'checked' : '') : 'checked' ?>>
                            <label for="radioActive">Verifikasi</label>
                        </div>
                        <div class="icheck-danger d-inline mr-3">
                            <input type="radio" id="radioFailed" name="verifikasi" value="3" 
                                   <?php echo isset($data->verifikasi) ? (($data->verifikasi == 3) ? 'checked' : '') : '' ?>>
                            <label for="radioFailed">Ditolak</label>
                        </div>
                    </div>
                </div>
                <div class="form-group required row mb-2" id="keterangan-container">
                    <label class="col-sm-3 control-label col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control form-control-sm" rows="3" name="keterangan_ditolak" 
                                  id="keterangan_ditolak">{{ isset($data->keterangan_ditolak) ? $data->keterangan_ditolak : '' }}</textarea>
                    </div>
                </div>

                <!-- Hidden input for pengesahan -->
                <input type="hidden" id="pengesahan" name="pengesahan" value="<?php echo isset($data->pengesahan) ? $data->pengesahan : '' ?>">

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
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

        function toggleKeterangan() {
            if ($('#radioFailed').is(':checked')) {
                $('#keterangan-container').show();
            } else {
                $('#keterangan-container').hide();
            }
        }

        // Inisialisasi visibilitas berdasarkan status awal
        toggleKeterangan();

        // Tambahkan event listener untuk perubahan status radiobutton
        $('input[name="verifikasi"]').change(function() {
            toggleKeterangan();
        });
    });


    $(document).ready(function () {
        unblockUI();

        @if($is_edit)
            $('#jurusan_id').val('{{ $data->jurusan_id }}').trigger('change');
        @endif

        $("#form-master").validate({
            rules: {
                verifikasi: {
                    required: true
                },
                pengesahan: {
                    
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
