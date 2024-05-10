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
                    <label for="kaprodi_id" class="col-sm-3 control-label col-form-label">Kaprodi</label>
                    <div class="col-sm-9">
                        <select select type="text" id="kaprodi_id" name="kaprodi_id" class="form-control form-control-sm select2_combobox">
                            <option value=""> -</option>
                            @foreach ($kaprodi as $r)
                                <option value="{{ $r->kaprodi_id }}">{{ $r->prodi_id}} - {{$r->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label for="kurikulum_mk_id" class="col-sm-3 control-label col-form-label">Kurikulum MK</label>
                    <div class="col-sm-9">
                        <select type="text" class="form-control form-control-sm select2_combobox" id="kurikulum_mk_id" name="kurikulum_mk_id">
                            <option value="">-</option>
                            @foreach ($kurikulumk as $k)
                                <option value="{{ $k->kurikulum_mk_id }}">{{ $k->kurikulum_mk_id }} - {{ $k->mk_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Deskripsi Rps</label>
                    <div class="col-sm-9">
                        <input type="textarea" class="form-control form-control-sm" id="deskripsi_rps" name="deskripsi_rps" value="{{ isset($data->deskripsi_rps) ? $data->deskripsi_rps : '' }}"/>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <!-- Date -->
                    <label class="col-sm-3 control-label col-form-label">Tanggal Penyusunan</label>
                    <div class="col-sm-9">
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" name="tanggal_penyusunan" id="tanggal_penyusunan" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ isset($data->tanggal_penyusunan) ? $data->tanggal_penyusunan : '' }}"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
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
                kaprodi_id: {
                    required: true,
                },
                kurikulum_mk_id: {
                    required: true,
                    digits: true
                },
                deskripsi_rps: {
                    required: true
                },
                tanggal_penyusunan: {
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
