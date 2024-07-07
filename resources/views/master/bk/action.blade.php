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
                    <label class="col-sm-3 control-label col-form-label">Nama Prodi</label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-sm select2" id="prodi_id" name="prodi_id">
                            <option value="">-</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->prodi_id }}" {{ isset($data->prodi_id) && $data->prodi_id == $p->prodi_id ? 'selected' : '' }}>
                                    {{ $p->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama Mata Kuliah</label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-sm select2" id="mk_id" name="mk_id">
                            <option value="">-</option>
                            @foreach ($mk as $m)
                                <option value="{{ $m->mk_id }}" {{ isset($data->mk_id) && $data->mk_id == $m->mk_id ? 'selected' : '' }}>
                                    {{ $m->mk_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3  col-form-label">Kode Bahan Kajian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="bk_kode" name="bk_kode" value="{{ isset($data->bk_kode) ? $data->bk_kode : '' }}"/>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Deskripsi Bahan Kajian</label>
                    <div class="col-sm-9">
                        <textarea class="form-control form-control-sm" id="bk_deskripsi" name="bk_deskripsi">{{ isset($data->bk_deskripsi) ? $data->bk_deskripsi : '' }}</textarea>
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

        $('.select2').select2();

        $("#form-master").validate({
            rules: {
                prodi_id: {
                    required: true
                },
                mk_id: {
                    required: true
                },
                bk_kode: {
                    required: true,
                    maxlength: 100
                },
                bk_deskripsi: {
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
