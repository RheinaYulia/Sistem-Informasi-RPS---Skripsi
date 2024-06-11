<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="form-master">
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
                <table class="table table-striped table-hover table-full-width table-sm" id="table_group_menu">
                    <thead>
                    <tr>
                        <th class="col-md-5">Nama Dosen</th>
                        <th class="col-md-1 text-center">Pengembang</th>
                    </tr>
                    @foreach ($dosen as $d)
                    <tr>
                        <td>
                            <span class="tree-ml-{{ $d->nama_dosen }}">{{ $d->nama_dosen }}</span>
                        </td>
                                <td class="text-center pr-2">
                                    <input type="hidden" name="dosen_id[]" value="{{ $d->dosen_id }}">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" id="checkboxd{{ $d->dosen_id }}" name="is_pengembang[{{ $d->dosen_id }}]" value="1" {{ $d->is_pengembang == 1 ? 'checked' : '' }}>
                                        <label for="checkboxd{{ $d->dosen_id }}" class="ml-1"></label>
                                    </div>
                                </td>
                    </tr>
                    @endforeach   
                </table>

                
                
                
       
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

        $("#form-master").validate({
            rules: {
                dosen_id: {
                    required: true,
                },
                is_pengembang: {
                    required: true,
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
