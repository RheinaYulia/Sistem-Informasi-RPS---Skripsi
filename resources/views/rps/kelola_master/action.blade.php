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
                
                <div class="row">
                    <div class=" col-sm-2">
                      <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-home" aria-selected="true" onclick="showContent(1)">Informasi RPS</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(2)">Dosen Pengembang</a>
                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-profile" aria-selected="false" onclick="showContent(3)">CPL Prodi</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(4)">CPMK</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(5)">Materi Pembelajaran</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(6)">Pustaka</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(7)">Media</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"onclick="showContent(8)">Pengampu</a>
                      </div>
                    </div>
                    <style>
                        h4 {
                            margin-top: 5px;
                            margin-left: 25px; /* Menambahkan jarak 20px di sebelah kanan */
                            margin-bottom: 15px;
                        }
                    </style>

                <div id="content1" class=" col-sm-9">
                    <h4>Informasi RPS</h4>
                <div class="form-group required row mb-2">
                    
                    <label class="col-sm-2  control-label col-form-label">Rps Id</label>
                    <div class="col-sm-10">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ isset($d->rps_id) ? $d->rps_id : '' }}"/>
                        @endforeach
                    </div>
                </div>
                </div>

                <div id="content2" class=" col-sm-9" style="display: none;">
                    <h4>Dosen Pengembang</h4>
                    <div class="form-group required row mb-2">
                        <label class="col-sm-2 control-label col-form-label">Nama Dosen</label>
                        <div class="col-sm-10">
                            <select type="text" class="form-control form-control-sm select2_combobox" id="dosen_id" name="dosen_id">
                                <option value="">-</option>
                                @foreach ($dosen as $d)
                                    <option value="{{ $d->dosen_id }}">{{ $d->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>

                    <div id="content3" class=" col-sm-9" style="display: none;">
                        <h4>CPL Prodi</h4>
                        <div class="form-group required row mb-2">
                            <label class="col-sm-3 control-label col-form-label">CPL Prodi</label>
                            <div class="form-group clearfix">
                            <div class="icheck-success d-inline col-sm-9">
                                <input type="checkbox" id="checkboxSuccess1">
                                <label for="checkboxSuccess1">
                                    Haloo
                                </label>
                              </div>
                            </div>
                            </div>
                        </div>
    

                        <div id="content4" class=" col-sm-9" style="display: none;">
                            <h4>CPMK</h4>
                            <div class="form-group required row mb-2">
                                <label class="col-sm-3 control-label col-form-label">CPMK</label>
                                <div class="form-group clearfix">
                                <div class="icheck-success d-inline col-sm-9">
                                    <input type="checkbox" id="checkboxSuccess2">
                                    <label for="checkboxSuccess2">
                                        Haloo
                                    </label>
                                  </div>
                                </div>
                                </div>
                            </div>
                    
                            <div id="content5" class=" col-sm-9" style="display: none;">
                                <h4>Materi Pembelajaran</h4>
                                <div class="form-group required row mb-2">
                                    <label class="col-sm-3 control-label col-form-label">Materi Pembelajaran</label>
                                    <div class="form-group clearfix">
                                    <div class="icheck-success d-inline col-sm-9">
                                        <input type="checkbox" id="checkboxSuccess3">
                                        <label for="checkboxSuccess3">
                                            Haloo
                                        </label>
                                      </div>
                                    </div>
                                    </div>
                                </div>

                                <div id="content6" class=" col-sm-9" style="display: none;">
                                    <h4>Pustaka</h4>
                                    <div class="form-group required row mb-2">
                                        <label class="col-sm-2 control-label col-form-label">Utama</label>
                                        <div class="col-sm-10">
                                            
                                            <input type="text" class="form-control form-control-sm" id="jenis_media" name="jenis_media"/>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group required row mb-2">
                                        <label class="col-sm-2 control-label col-form-label">Pendukung</label>
                                        <div class="col-sm-10">
                                            
                                            <input type="text" class="form-control form-control-sm" id="nama_media" name="nama_media" />
                                            
                                        </div>
                                    </div>
                                </div>
                
                <div id="content7" class=" col-sm-9" style="display: none;">
                    <h4>Media</h4>
                <div class="form-group required row mb-2">
                    <label class="col-sm-2 control-label col-form-label">Jenis Media</label>
                    <div class="col-sm-10">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="jenis_media" name="jenis_media" value="{{ isset($d->jenis_media) ? $d->jenis_media : '' }}"/>
                        @endforeach
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-2 control-label col-form-label">Nama Media</label>
                    <div class="col-sm-10">
                        @foreach ($data as $d )
                        <input type="text" class="form-control form-control-sm" id="nama_media" name="nama_media" value="{{ isset($d->nama_media) ? $d->nama_media : '' }}"/>
                        @endforeach
                    </div>
                </div>
            </div>

                <div id="content8" class=" col-sm-9" style="display: none;">
                    <h4>Dosen Pengampu</h4>
                    <div class="form-group required row mb-2">
                        <label class="col-sm-2 control-label col-form-label">Nama Dosen</label>
                        <div class="col-sm-10">
                            <select type="text" class="form-control form-control-sm select2_combobox" id="dosen_id" name="dosen_id">
                                <option value="">-</option>
                                @foreach ($dosen as $d)
                                    <option value="{{ $d->dosen_id }}">{{ $d->nama_dosen }}</option>
                                @endforeach
                            </select>
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
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "none";
            } else if (linkNumber === 2) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "block";
                document.getElementById("content3").style.display = "none";
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "none";
            } else if (linkNumber === 3) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "block";
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "none";
            }
            else if (linkNumber === 4) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "none";
                document.getElementById("content4").style.display = "block";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "none";
            }else if (linkNumber === 5) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "none";
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "block";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "none";
            }else if (linkNumber === 6) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "none";
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "block";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "none";
            }else if (linkNumber === 7) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "none";
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "block";
                document.getElementById("content8").style.display = "none";
            }else if (linkNumber === 8) {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "none";
                document.getElementById("content3").style.display = "none";
                document.getElementById("content4").style.display = "none";
                document.getElementById("content5").style.display = "none";
                document.getElementById("content6").style.display = "none";
                document.getElementById("content7").style.display = "none";
                document.getElementById("content8").style.display = "block";
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
