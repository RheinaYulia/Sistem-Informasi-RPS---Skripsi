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
                            <label for="subcpmk_id" class="col-sm-2 control-label col-form-label">Sub CPMK</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control form-control-sm select2_combobox" id="subcpmk_id" name="cpmk_detail_id[]">
                                    <option value="">-</option>
                                    @foreach ($subcpmk as $s)
                                        <option value="{{ $s->cpmk_detail_id }}" data-uraian="{{ $s->uraian_sub_cpmk }}"
                                            @foreach ($subcpmkrps as $d)
                                                @if ($d->cpmk_detail_id == $s->cpmk_detail_id) selected @endif
                                            @endforeach>
                                            {{ $s->sub_cpmk_kode }} - {{ $s->uraian_sub_cpmk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label"></label>
                            <div class="col-sm-9">
                                <textarea id="summernote1" name="sub_cpmk[]">{{ isset($data->sub_cpmk) ? $data->sub_cpmk : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group required row mb-2">
                            <label for="materi" class="col-sm-2 control-label col-form-label">Materi Pembelajaran</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control form-control-sm select2_combobox" id="bk_id" name="unused_select">
                                    <option value="">-</option>
                                    @foreach ($materi as $s)
                                        <option value="" data-uraian="{{ $s->bk_deskripsi }}">
                                            {{ $s->bk_kode }} - {{ $s->bk_deskripsi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label"></label>
                            <div class="col-sm-9">
                                <textarea id="summernote2" name="materi[]">{{ isset($data->materi) ? $data->materi : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Pengalaman Belajar</label>
                            <div class="col-sm-9">
                                <textarea id="summernote3" name="pengalaman_belajar[]">{{ isset($data->pengalaman_belajar) ? $data->pengalaman_belajar : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Indikator Penilaian</label>
                            <div class="col-sm-9">
                                <textarea id="summernote4" name="indikator_penilaian[]">{{ isset($data->indikator_penilaian) ? $data->indikator_penilaian : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Bentuk Pembelajaran</label>
                            <div class="col-sm-9">
                                <textarea id="summernote5" name="bentuk_pembelajaran[]">{{ isset($data->bentuk_pembelajaran) ? $data->bentuk_pembelajaran : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Metode Pembelajaran</label>
                            <div class="col-sm-9">
                                <textarea id="summernote6" name="metode_pembelajaran[]">{{ isset($data->metode_pembelajaran) ? $data->metode_pembelajaran : '' }}</textarea>
                            </div>
                        </div> 
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Kriteria Penilaian</label>
                            <div class="col-sm-9">
                                <textarea id="summernote7" name="kriteria_penilaian[]">{{ isset($data->kriteria_penilaian) ? $data->kriteria_penilaian : '' }}</textarea>
                            </div>
                        </div>    

                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Bentuk Penilaian</label>
                            <div class="col-sm-9">
                                <textarea id="summernote8" name="bentuk_penilaian[]">{{ isset($data->bentuk_penilaian) ? $data->bentuk_penilaian : '' }}</textarea>
                            </div>
                        </div>    
                            
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Estimasi Waktu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="estimasi_waktu" name="estimasi_waktu[]" value="{{ isset($data->estimasi_waktu) ? $data->estimasi_waktu : '' }}"/>
                            </div>
                        </div>
                        
                        <div class="form-group required row mb-2">
                            <label class="col-sm-2 control-label col-form-label">Bobot Penilaian</label>
                            <div class="col-sm-9">
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

$(document).ready(function() {
            // Initialize Select2
            $('.select2_combobox').select2();

            // Initialize Summernote
            $('#summernote1').summernote({
                height: 300, // set the height of the editor
                callbacks: {
                    onInit: function() {
                        console.log('Summernote is launched');
                    }
                }
            });

            // Handle change event
            $('#subcpmk_id').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var uraianSubCpmk = selectedOption.data('uraian');
                console.log(uraianSubCpmk); // Log untuk memastikan nilai benar
                $('#summernote1').summernote('code', uraianSubCpmk); // Set nilai Summernote
            });

            $('#summernote2').summernote({
                height: 300, // set the height of the editor
                callbacks: {
                    onInit: function() {
                        console.log('Summernote is launched');
                    }
                }
            });

            // Handle change event
            $('#bk_id').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var uraianSubCpmk = selectedOption.data('uraian');
                console.log(uraianSubCpmk); // Log untuk memastikan nilai benar
                $('#summernote2').summernote('code', uraianSubCpmk); // Set nilai Summernote
            });
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

                },
                cpmk_detail_id: {
                    required: true
                },
                kriteria_penilaian: {
                    
                },
                bentuk_penilaian: {

                },
            },
            submitHandler: function (form) {
                $('.form-message').html('');
                blockUI(form);
                $(form).ajaxSubmit({
                    url: "{{ route('kelola_master.updateBab', $id) }}", // Ensure this URL is correct
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
