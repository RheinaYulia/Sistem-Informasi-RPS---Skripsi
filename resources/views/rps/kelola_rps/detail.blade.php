<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{ url('kelola_rps/' . $id . '/menu_save') }}" role="form" class="form-horizontal" id="form-master">
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
                
                <div class="row">
                    <div class="col-5 col-sm-3">
                      <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-home" aria-selected="true" onclick="showContent(1)">Informasi RPS</a>
                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-profile" aria-selected="false" onclick="showContent(2)">Media</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(3)">Pengampu</a>

                      </div>
                    </div>
                

                <div id="content1">
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Rps Id</label>
                    <div class="col-sm-9">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ isset($d->rps_id) ? $d->rps_id : '' }}"/>
                        @endforeach
                    </div>
                </div>
                </div>
                <div id="content2" style="display: none;">
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Jenis Media</label>
                    <div class="col-sm-9">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="jenis_media" name="jenis_media" value="{{ isset($d->jenis_media) ? $d->jenis_media : '' }}"/>
                        @endforeach
                    </div>
                </div>
                
                
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama Media</label>
                    <div class="col-sm-9">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="nama_media" name="nama_media" value="{{ isset($d->nama_media) ? $d->nama_media : '' }}"/>
                        @endforeach
                    </div>
                </div>
            </div>
                <div id="content3" style="display: none;">
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Dosen Id</label>
                    <div class="col-sm-9">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="dosen_id" name="dosen_id" value="{{ isset($d->dosen_id) ? $d->dosen_id : '' }}"/>
                        @endforeach
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

    function showContent(linkNumber) {
            if (linkNumber === 1) {
                document.getElementById("content1").style.display = "block";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "none";
            } else if (linkNumber === 2) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "block";
                document.getElementById("content3").style.display = "none";
            } else if (linkNumber === 3) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "block";
            }
        }
    $(document).ready(function () {
        unblockUI();

        $("#form-master").validate({
            rules: {
                rps_id: {
                    required: true,
                },
                jenis_media: {
                    required: true,
                   
                },
                nama_media: {
                    required: true,
                    maxlength: 50,
                },
                dosen_id: {
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
