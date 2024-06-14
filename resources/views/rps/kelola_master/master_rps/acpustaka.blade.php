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
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Referensi Utama</label>
                    <div class="col-sm-10">
                        <select class="select2" multiple="multiple" data-placeholder="Pilih Referensi Utama" style="width: 100%;" id="pustaka_utama_id" name="pustaka_utama_id[]">
                            @foreach ($pustaka->where('jenis_pustaka', 1) as $p)
                                <option value="{{ $p->pustaka_id }}"
                                    @foreach ($pustakaview as $d)
                                        @if ($d->pustaka_id == $p->pustaka_id) selected @endif
                                    @endforeach
                                >{{ $p->referensi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required row mb-3 mt-5">
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Referensi Pendukung</label>
                    <div class="col-sm-10">
                        <select class="select2" multiple="multiple" data-placeholder="Pilih Referensi Pendukung" style="width: 100%;" id="pustaka_pendukung_id" name="pustaka_pendukung_id[]">
                            @foreach ($pustaka->where('jenis_pustaka', 0) as $p)
                                <option value="{{ $p->pustaka_id }}"
                                    @foreach ($pustakaview as $d)
                                        @if ($d->pustaka_id == $p->pustaka_id) selected @endif
                                    @endforeach
                                >{{ $p->referensi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required row mb-3 mt-5">
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Utama</label>
                    <div class="col-sm-10">
                        <table>
                            <th>
                                @foreach ($pustakaview->where('jenis_pustaka', 1)->unique('pustaka_id')->unique('referensi') as $d)
                                    <ul>
                                        <li>{{ $d->referensi }}</li>
                                    </ul>
                                @endforeach
                            </th>
                            
                        </table>
                    </div>
                </div>

                <div class="form-group required row mb-3 mt-5">
                    <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Pendukung</label>
                    <div class="col-sm-10">
                        <table>
                            <th>
                                @foreach ($pustakaview->where('jenis_pustaka', 0)->unique('pustaka_id')->unique('referensi') as $d)
                                    <ul>
                                        <li>{{ $d->referensi }}</li>
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

    var elementsPustaka = [];

    $('#pustaka_utama_id, #pustaka_pendukung_id').on('select2:unselect', function(e) {
        var pustakaId = e.params.data.id;
        elementsPustaka.push(pustakaId);
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            'pustaka_utama_id[]': {  },
            'pustaka_pendukung_id[]': {  },
        },
        submitHandler: function (form) {
            elementsPustaka.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_pustaka[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
            $(form).ajaxSubmit({
                url: "{{ route('kelola_master.updatePustaka', $id) }}",
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
