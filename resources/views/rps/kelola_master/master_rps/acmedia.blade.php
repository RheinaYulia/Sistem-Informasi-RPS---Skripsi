<?php
    $is_edit = isset($data) && !$data->isEmpty();
?>

<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="form-master">
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

                @foreach ($data as $d)
                <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                @endforeach

                <div class="form-group required row mb-3">
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Software</label>
                    <div class="col-sm-10">
                        <select class="select2" multiple="multiple" data-placeholder="Pilih Referensi Utama" style="width: 100%;" id="software" name="software[]">
                            @foreach ($media->where('jenis_media', 1) as $p)
                                <option value="{{ $p->media_id }}"
                                    @foreach ($mediaview as $d)
                                        @if ($d->media_id == $p->media_id) selected @endif
                                    @endforeach
                                >{{ $p->nama_media }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required row mb-3 mt-5">
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Hardware</label>
                    <div class="col-sm-10">
                        <select class="select2" multiple="multiple" data-placeholder="Pilih Referensi Pendukung" style="width: 100%;" id="hardware" name="hardware[]">
                            @foreach ($media->where('jenis_media', 0) as $p)
                                <option value="{{ $p->media_id }}"
                                    @foreach ($mediaview as $d)
                                        @if ($d->media_id == $p->media_id) selected @endif
                                    @endforeach
                                >{{ $p->nama_media }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required row mb-3 mt-5">
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Referensi</label>
                    <div class="col-sm-10">
                        <table>
                            <th>
                                @foreach ($mediaview->unique('media_id') as $d)
                            <ul>
                                <li>{{ $d->nama_media }}</li>
                            </ul>
                            @endforeach
                            </th>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
});

$(document).ready(function () {
    unblockUI();

    $('.select2_combobox').select2();

    var elementsMedia = [];

    $('#software, #hardware').on('select2:unselect', function(e) {
        var mediaId = e.params.data.id;
        elementsMedia.push(mediaId);
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            'software[]': {  },
            'hardware[]': {  },
        },
        submitHandler: function (form) {
            elementsMedia.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_media[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
            $(form).ajaxSubmit({
                url: "{{ route('kelola_master.updateMedia', $id) }}",
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
});
</script>
