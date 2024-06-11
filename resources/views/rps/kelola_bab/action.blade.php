<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<script src="{{ asset('assets/rps/rps.js') }}"></script>

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
                      @include('rps.kelola_bab.layoutss.menulink')
                    </div>
                    <style>
                        h4 {
                            margin-top: 5px;
                            margin-left: 25px; /* Menambahkan jarak 20px di sebelah kanan */
                            margin-bottom: 15px;
                        }
                    </style>

                        <div class=" col-sm-9" id="content1">
                            <h4>Informasi RPS</h4>
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2  control-label col-form-label">Rps Id</label>
                            <div class="col-sm-10">
                                @foreach ( $data as $d )
                                <label class="col-sm-2  control-label col-form-label">{{ $d->deskripsi_rps }}</label>
                                @endforeach
                                
                            </div>
                        </div>
                        </div>

                        
@php $summernoteIndex = 1; @endphp

<div class="col-sm-9" id="content2" style="display: none;">
    <h4>Pertemuan 1</h4>
    @foreach ($data as $d)
        @if ($d->rps_bab == 1)
            @include('rps.kelola_bab.layoutss.tes')
        @endif
    @endforeach
</div>

<div class="col-sm-9" id="content3" style="display: none;">
    <h4>Pertemuan 2</h4>
    @foreach ($data as $d)
        @if ($d->rps_bab == 2)
            @include('rps.kelola_bab.layoutss.tes')
        @endif
    @endforeach
</div>

                    
                <div class=" col-sm-9" id="content4" style="display: none;">
                        <h4>Pertemuan 3</h4>
                        @foreach ($data as $d)
                        @if ($d->rps_bab == 3)
                        @include('rps.kelola_bab.layoutss.tes')
                    @endif
                    @endforeach
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
    // Loop melalui semua elemen dengan id yang dimulai dengan "content"
    for (var i = 1; i <= 5; i++) {
        var content = document.getElementById("content" + i);
        // Menampilkan elemen jika nomor tautan sesuai dengan nomor konten
        if (i === linkNumber) {
            content.style.display = "block";
        } else {
            content.style.display = "none"; // Menyembunyikan elemen yang lain
        }
    }
}
       
    $(document).ready(function () {
        unblockUI();

        $("#form-master").validate({
            rules: {
                rps_id: {
                    required: true,
                },
                rps_bab: {
                    required: true,
                   
                },
                sub_cpmk: {
                    
                },
                materi: {
                    
                },
                estimasi_waktu: {
                    
                },
                pengalaman_balajar: {
                    
                },
                indikator_penilaian: {
                    
                },
                bobot_penilaian: {
                    
                },
                bentuk_pembelajaran: {
                    
                },
                metode_pembelajaran: {

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
