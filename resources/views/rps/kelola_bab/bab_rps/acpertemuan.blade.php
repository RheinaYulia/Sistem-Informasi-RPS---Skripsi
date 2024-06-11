<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{$page->url}}/bab_rps" role="form" class="form-horizontal" id="form-master">
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

                        {{-- <div class="form-group required row mb-2">
                            <label class="col-sm-2  control-label col-form-label">Rps Id</label>
                            <div class="col-sm-10">
                                <label class="col-sm-2  control-label col-form-label">{{ $data->rps_id}}</label>
                                
                            </div>
                        </div> --}}

                        {{-- <div class="form-group required row mb-2">
                            <label class="col-sm-2  control-label col-form-label">Rps Bab</label>
                            <div class="col-sm-10">
                                <label class="col-sm-2  control-label col-form-label">{{ $data->rps_bab}}</label>
                                
                            </div>
                        </div> --}}

                        <div class="form-group required row mb-2">
                            {{-- <label class="col-sm-2 control-label col-form-label">Rps id</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ isset($data->rps_id) ? $data->rps_id : '' }}" readonly/>
                            </div>
                        </div>
                        <div class="form-group required row mb-2">
                            {{-- <label class="col-sm-2 control-label col-form-label">Bab id</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control form-control-sm" id="bab_id" name="bab_id[]" value="{{ isset($data->bab_id) ? $data->bab_id : '' }}" readonly/>
                            </div>
                        </div>
                        <div class="form-group required row mb-2">
                            {{-- <label class="col-sm-2 control-label col-form-label">Rps Bab</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control form-control-sm" id="rps_bab" name="rps_bab[]" value="{{ isset($data->rps_bab) ? $data->rps_bab : '' }}" readonly/>
                            </div>
                        </div>

                        {{-- @php
                            $summernoteIds = ['sub_cpmk', 'materi', 'pengalaman_belajar', 'indikator_penilaian', 'bentuk_pembelajaran', 'metode_pembelajaran'];
                        @endphp --}}
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Sub Cpmk</label>
                            <div class="col-sm-10">
                                <textarea id="summernote1" name="sub_cpmk[]">{{ isset($data->sub_cpmk) ? $data->sub_cpmk : '' }}</textarea>
                            </div>
                        </div> 
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Materi</label>
                            <div class="col-sm-10">
                                <textarea id="summernote2" name="materi[]">{{ isset($data->materi) ? $data->materi : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Pengalaman Belajar</label>
                            <div class="col-sm-10">
                                <textarea id="summernote3" name="pengalaman_belajar[]">{{ isset($data->pengalaman_belajar) ? $data->pengalaman_belajar : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Indikator Penilaian</label>
                            <div class="col-sm-10">
                                <textarea id="summernote4" name="indikator_penilaian[]">{{ isset($data->indikator_penilaian) ? $data->indikator_penilaian : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Bentuk Pembelajaran</label>
                            <div class="col-sm-10">
                                <textarea id="summernote5" name="bentuk_pembelajaran[]">{{ isset($data->bentuk_pembelajaran) ? $data->bentuk_pembelajaran : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Metode Pembelajaran</label>
                            <div class="col-sm-10">
                                <textarea id="summernote6" name="metode_pembelajaran[]">{{ isset($data->metode_pembelajaran) ? $data->metode_pembelajaran : '' }}</textarea>
                            </div>
                        </div>    
                            
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Estimasi Waktu</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="estimasi_waktu" name="estimasi_waktu[]" value="{{ isset($data->estimasi_waktu) ? $data->estimasi_waktu : '' }}"/>
                            </div>
                        </div>
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Bobot Penilaian</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-sm" id="bobot_penilaian" step="any" name="bobot_penilaian[]" value="{{ isset($data->bobot_penilaian) ? $data->bobot_penilaian : '' }}"/>
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
  // Loop through summernote elements
  for (var i = 0; i <= 10; i++) {
      $('#summernote' + i).summernote({
          height: 200,
      });
  }
  
  // CodeMirror
  var codeMirrorElements = document.getElementsByClassName("codeMirrorDemo");
  for (var i = 0; i < codeMirrorElements.length; i++) {
      CodeMirror.fromTextArea(codeMirrorElements[i], {
          mode: "htmlmixed",
          theme: "monokai"
      });
  }
});
       
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
                    url: "{{ route('kelola_bab.updateBab', $id) }}", // Ensure this URL is correct
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
