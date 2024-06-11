<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{$page->url}}" role="form" class="form-horizontal" id="form-master">
    @csrf
    {!! ($is_edit)? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>
    

                    <div class="form-group required row mb-3">
                        <label for="dosen_pengampu_id" class="col-sm-2 control-label col-form-label">Nama Dosen</label>
                        <div class="col-sm-8">
                            @foreach ($data as $d )
                            <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                            @endforeach
                            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" id="dosen_pengampu_id" name="dosen_pengampu_id[]">
                                @foreach ($pengampu as $dosen)
                                    <option value="{{ $dosen->dosen_id }}"
                                        @foreach ($pengampuview as $d)
                                            @if ($d->dosen_pengampu_id == $dosen->dosen_id) selected @endif
                                        @endforeach
                                    >{{ $dosen->nama_dosen }}</option>
                                @endforeach
                                  </select>
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


$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

$(document).ready(function () {
    unblockUI();
    $('.select2_combobox').select2();

    var elementsPengampu = [];

    $('#dosen_pengampu_id').on('select2:unselect', function(e) {
        var dosenId = e.params.data.id;
        elementsPengampu.push(dosenId);
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            dosen_pengampu_id: { required: true },
        },
        submitHandler: function (form) {

            elementsPengampu.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_pengampu[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
                $(form).ajaxSubmit({
                    url: "{{ route('kelola_master.updatePengampu', $id) }}", // Ensure this URL is correct
                    type: 'POST', // Ensure the request is POST
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