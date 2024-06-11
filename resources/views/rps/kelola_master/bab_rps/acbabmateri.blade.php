<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{$page->url}}/bab_rps" role="form" class="form-horizontal" id="form-master" enctype="multipart/form-data">
    @csrf
    {!! ($is_edit) ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>

                        <input type="hidden" class="form-control form-control-sm" id="bab_id" name="bab_id" value="{{ isset($data->bab_id) ? $data->bab_id : '' }}" readonly />

                <div class="form-group required row mb-2">
                    <label class="col-sm-2 control-label col-form-label">Judul Materi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="judul_materi" name="judul_materi" value="{{ isset($data->judul_materi) ? $data->judul_materi : '' }}" />
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-2 control-label col-form-label">File</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_url" name="file_url"/>
                                <label class="custom-file-label" for="file_url">
                                    {{ isset($data->file_url) ? basename($data->file_url) : 'Choose file' }}
                                </label>
                            </div>
                        </div>
                        @if(isset($data->file_url))
                            <a href="{{ asset('storage/' . $data->file_url) }}" target="_blank">{{ basename($data->file_url) }}</a>
                        @endif
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
                bab_id: {
                    required: true,
                },
                judul_materi: {
                    required: true,
                },
                file_url: {
                    required: false, // Tidak wajib diisi
                },
            },
            submitHandler: function (form) {
                $('.form-message').html('');
                blockUI(form);
                $(form).ajaxSubmit({
                    url: "{{ route('kelola_master.updateBabMateri', $id) }}",
                    type: 'POST',
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

        // Update label file input dengan nama file yang diunggah
        $('#file_url').on('change', function() {
            // Get the file name
            var fileName = $(this).val().split('\\').pop();
            // Replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
