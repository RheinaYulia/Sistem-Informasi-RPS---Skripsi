<?php
    $is_edit = isset($data);
?>
<form method="post" action="{{$page->url}}" role="form" class="form-horizontal" id="form-master">
    @csrf
    {!! ($is_edit)? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>
                <input type="hidden" name="periode_id" value="{{ $periode->periode_id }}">

                <div class="form-group required row mb-10">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="dosen_id">Nama Dosen</label>
                            <select name="dosen_id" class="form-control select2" id="dosen_id">
                                <option value="">-</option>
                                @foreach ($allDosen as $dosen)
                                    <option value="{{ $dosen->dosen_id }}" {{ $dosen->dosen_id == $data->dosen_id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center">
                        <div class="table-responsive" style="width: 80%;">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-wrapper" style="height: 400px; overflow-y: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 45px;">No</th>
                                            <th style="text-align: center;">Mata Kuliah</th>
                                            <th style="text-align: center;">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        @foreach ($allMataKuliah as $mk)
                                        @php
                                            $isSelected = $selectedMataKuliah->firstWhere('kurikulum_mk_id', $mk->kurikulum_mk_id) && $selectedMataKuliah->firstWhere('kurikulum_mk_id', $mk->kurikulum_mk_id)->is_selected;
                                        @endphp
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td style="padding-left: 10px;">
                                                <label for="checkbox_mk{{ $mk->kurikulum_mk_id }}">
                                                    {{ $mk->mk_nama }}
                                                </label>
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="checkbox_mk{{ $mk->kurikulum_mk_id }}" name="kurikulum_mk_id[]" value="{{ $mk->kurikulum_mk_id }}" @if ($isSelected) checked @endif>
                                                    <label for="checkbox_mk{{ $mk->kurikulum_mk_id }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    // Pencarian
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var tableBody = document.getElementById('tableBody');
        var rows = tableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;

            for (var j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(searchValue) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    unblockUI();

    $('.select2_combobox').select2();

    var elementskakel1 = [];

    $('input[type="checkbox"][name="kurikulum_mk_id[]"]').on('change', function() {
        var kurikulumMkId = $(this).val();
        if (!$(this).is(':checked')) {
            elementskakel1.push(kurikulumMkId);
        }
    });

    $("#form-master").validate({
        rules: {
            dosen_id: { required: true },
            'kurikulum_mk_id[]': {  },
        },
        submitHandler: function (form) {
            elementskakel1.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_kakel1[]',
                    value: id
                }).appendTo(form);
            });

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

<style>
.table-wrapper {
    position: relative;
}

.table-wrapper thead th {
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 2;
}
</style>
