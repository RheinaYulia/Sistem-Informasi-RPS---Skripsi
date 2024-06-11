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
                        <label class="col-sm-2  control-label col-form-label" id="deskripsi_rps">{{ $rpsDescription->deskripsi_rps }}</label>
                        {{-- <textarea class="form-control form-control-sm" id="deskripsi_rps" name="deskripsi_rps" readonly>{{ $rpsDescription->deskripsi_rps }}</textarea> --}}
                        @foreach ($data as $d )
                        <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ $d->rps_id }}">
                        @endforeach
                    </div>
                </div>
                </div>

                <div id="content2" class=" col-sm-9" style="display: none;">
                    <h4>Dosen Pengembang</h4>
                    <div class="form-group required row mb-2">
                        <label for="dosen_pengembang_id" class="col-sm-2 control-label col-form-label">Nama Dosen</label>
                        <div class="col-sm-10">
                            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" id="dosen_pengembang_id" name="dosen_pengembang_id[]">
                                @foreach ($pengampu as $dosen)
                                    <option value="{{ $dosen->dosen_id }}"
                                        @foreach ($pengembangview as $d)
                                            @if ($d->dosen_pengembang_id == $dosen->dosen_id) selected @endif
                                        @endforeach
                                    >{{ $dosen->nama_dosen }}</option>
                                @endforeach
                                  </select>
                        </div>
                        </div>
                    </div>

                    <div id="content3" class="col-sm-9" style="display: none;">
                        <h4>CPL Prodi</h4>
                        <div class="form-group required row mb-2">
                            <label class="col-sm-3 control-label col-form-label">CPL Prodi</label>
                            <div class="form-group clearfix">
                                @foreach ($cpl as $c)
                                    @php
                                        // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                        $isSelected = $selectCpl->firstWhere('cpl_prodi_id', $c->cpl_prodi_id);
                                        // Tentukan apakah checkbox harus dicentang
                                        $isChecked = $isSelected && $isSelected->is_selected;
                                    @endphp
                                <div class="icheck-success d-inline col-sm-9">
                                    <input type="checkbox" id="checkbox{{ $c->cpl_prodi_id }}" name="cpl_prodi_id[]" value="{{ $c->cpl_prodi_id }}" 
                                        @if ($isChecked) checked @endif>
                                    <label for="checkbox{{ $c->cpl_prodi_id }}">
                                        {{ $c->cpl_prodi_kategori }}
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    
    

                        <div id="content4" class=" col-sm-9" style="display: none;">
                            <h4>CPMK</h4>
                            <div class="form-group required row mb-2">
                                <label class="col-sm-3 control-label col-form-label">CPMK</label>
                                <div class="form-group clearfix">
                                    @foreach ($cpmk as $kode)
                                            @php
                                                // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                                $isSelected = $selectCpmk->firstWhere('cpl_cpmk_id', $kode->cpl_cpmk_id);
                                                // Tentukan apakah checkbox harus dicentang
                                                $isChecked = $isSelected && $isSelected->is_selected;
                                            @endphp
                                        <div class="icheck-success d-inline col-sm-9">
                                            <input type="checkbox" id="checkbox1{{ $kode->cpl_cpmk_id }}" name="cpl_cpmk_id[]" value="{{ $kode->cpl_cpmk_id }}"
                                            @if ($isChecked) checked @endif>
                                                <label for="checkbox1{{ $kode->cpl_cpmk_id }}">
                                            {{ $kode->cpmk_kode }}
                                        </label>
                                        </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                    
                            <div id="content5" class=" col-sm-9" style="display: none;">
                                <h4>Materi Pembelajaran</h4>
                                <div class="form-group required row mb-2">
                                    <label class="col-sm-3 control-label col-form-label">Materi Pembelajaran</label>
                                    <div class="form-group clearfix">
                                        @foreach ($bk as $bks)
                                            @php
                                                // Cek apakah cpl_prodi_id ada di dalam selectCpl
                                                $isSelected = $selectBk->firstWhere('mk_bk_id', $bks->mk_bk_id);
                                                // Tentukan apakah checkbox harus dicentang
                                                $isChecked = $isSelected && $isSelected->is_selected;
                                            @endphp
                                        <div class="icheck-success d-inline col-sm-9">
                                            <input type="checkbox" id="checkbox2{{ $bks->mk_bk_id }}" name="mk_bk_id[]" value="{{ $bks->mk_bk_id }}"
                                            @if ($isChecked) checked @endif>
                                                <label for="checkbox2{{ $bks->mk_bk_id }}">
                                            {{ $bks->bk_deskripsi }}
                                        </label>
                                        </div>
                                    @endforeach
                                    </div>
                                    </div>
                                </div>

                                <div id="content6" class="col-sm-9" style="display: none;">
                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" onclick="showContentpus(1)">Utama</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" onclick="showContentpus(2)">Pendukung</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="tab-content mt-3" id="custom-tabs-three-tabContent">
                                        <div id="contentpus1">
                                            <button type="button" class="btn btn-primary" onclick="addMorepus('contentpus1', 0)">Tambah</button>
                                            <button type="button" class="btn btn-secondary" id="undoButtonpus1" onclick="undoRemovepus('contentpus1')">Undo Remove</button>
                                            @foreach ($pustakaview as $key => $d)
                                                @if ($d->jenis_pustaka == 0)
                                                    <div id="pustaka{{ $key }}" class="pustaka-form mt-3">
                                                        {{-- <div class="form-group required row mb-2"> --}}
                                                            {{-- <label for="jenis_pustaka{{ $key }}" class="col-sm-2 control-label col-form-label">Jenis Pustaka</label>
                                                            <div class="col-sm-10"> --}}
                                                                <input type="hidden" class="form-control form-control-sm" id="jenis_pustaka{{ $key }}" name="jenis_pustaka[]" value="0" readonly />
                                                            {{-- </div>
                                                        </div> --}}
                                                        <div class="form-group required row mb-2">
                                                            <label for="referensi{{ $key }}" class="col-sm-2 control-label col-form-label">Referensi</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control form-control-sm" id="referensi{{ $key }}" name="referensi[]" value="{{ $d->referensi }}"/>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="pustaka_ids[]" value="{{ $d->rps_pustaka_id }}" hidden/>
                                                        <button type="button" class="btn btn-danger" onclick="removePustaka('pustaka{{ $key }}', '{{ $d->rps_pustaka_id }}', 'contentpus1')">Hapus Data</button>
                                                        <button type="button" class="btn btn-warning" style="display: none;" onclick="undoRemovepus('pustaka{{ $key }}', 'contentpus1')">Undo</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="contentpus2" style="display: none;">
                                            <button type="button" class="btn btn-primary" onclick="addMorepus('contentpus2', 1)">Tambah</button>
                                            <button type="button" class="btn btn-secondary" id="undoButtonpus2" onclick="undoRemovepus('contentpus2')">Undo Remove</button>
                                            @foreach ($pustakaview as $key1 => $d)
                                                @if ($d->jenis_pustaka == 1)
                                                    <div id="pustaka_1{{ $key1 }}" class="pustaka-form mt-3">
                                                        {{-- <div class="form-group required row mb-2">
                                                            <label for="jenis_pustaka{{ $key1 }}" class="col-sm-2 control-label col-form-label">Jenis Pustaka</label>
                                                            <div class="col-sm-10"> --}}
                                                                <input type="hidden" class="form-control form-control-sm" id="jenis_pustaka{{ $key1 }}" name="jenis_pustaka[]" value="1" readonly/>
                                                            {{-- </div>
                                                        </div> --}}
                                                        <div class="form-group required row mb-2">
                                                            <label for="referensi{{ $key1 }}" class="col-sm-2 control-label col-form-label">Referensi</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control form-control-sm" id="referensi{{ $key1 }}" name="referensi[]" value="{{ $d->referensi }}"/>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="pustaka_ids[]" value="{{ $d->rps_pustaka_id }}" />
                                                        <button type="button" class="btn btn-danger" onclick="removePustaka('pustaka_1{{ $key1 }}', '{{ $d->rps_pustaka_id }}', 'contentpus2')">Hapus Data</button>
                                                        <button type="button" class="btn btn-warning" style="display: none;" onclick="undoRemovepus('pustaka_1{{ $key1 }}', 'contentpus2')">Undo</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                
                                <div id="content7" class="col-sm-9" style="display: none;">
                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" onclick="showContents(1)">Software</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" onclick="showContents(2)">Hardware</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content mt-3" id="custom-tabs-three-tabContent">
                                        <div id="contents1">
                                            <button type="button" class="btn btn-primary" onclick="addMore('contents1', 0)">Tambah</button>
                                            <button type="button" class="btn btn-secondary" id="undoButton1" onclick="undoRemove('contents1')">Undo Remove</button>
                                            @foreach ($mediaview as $key => $d)
                                                @if ($d->jenis_media == 0)
                                                    <div id="media{{ $key }}" class="media-form mt-3">
                                                        {{-- <div class="form-group required row mb-2"> --}}
                                                            {{-- <label for="jenis_media{{ $key }}" class="col-sm-2 control-label col-form-label">Jenis Media</label>
                                                            <div class="col-sm-10"> --}}
                                                                <input type="hidden" class="form-control form-control-sm" id="jenis_media{{ $key }}" name="jenis_media[]" value="0" readonly />
                                                            {{-- </div>
                                                        </div> --}}
                                                        <div class="form-group required row mb-2">
                                                            <label for="nama_media{{ $key }}" class="col-sm-2 control-label col-form-label">Nama Media</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control form-control-sm" id="nama_media{{ $key }}" name="nama_media[]" value="{{ $d->nama_media }}"/>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="media_ids[]" value="{{ $d->rps_media_id }}" hidden/>
                                                        <button type="button" class="btn btn-danger" onclick="removeMedia('media{{ $key }}', '{{ $d->rps_media_id }}', 'contents1')">Hapus Data</button>
                                                        <button type="button" class="btn btn-warning" style="display: none;" onclick="undoRemove('media{{ $key }}', 'contents1')">Undo</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="contents2" style="display: none;">
                                            <button type="button" class="btn btn-primary" onclick="addMore('contents2', 1)">Tambah</button>
                                            <button type="button" class="btn btn-secondary" id="undoButton2" onclick="undoRemove('contents2')">Undo Remove</button>
                                            @foreach ($mediaview as $key1 => $d)
                                                @if ($d->jenis_media == 1)
                                                    <div id="media_1{{ $key1 }}" class="media-form mt-3">
                                                        {{-- <div class="form-group required row mb-2">
                                                            <label for="jenis_media{{ $key1 }}" class="col-sm-2 control-label col-form-label">Jenis Media</label>
                                                            <div class="col-sm-10"> --}}
                                                                <input type="hidden" class="form-control form-control-sm" id="jenis_media{{ $key1 }}" name="jenis_media[]" value="1" readonly/>
                                                            {{-- </div>
                                                        </div> --}}
                                                        <div class="form-group required row mb-2">
                                                            <label for="nama_media{{ $key1 }}" class="col-sm-2 control-label col-form-label">Nama Media</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control form-control-sm" id="nama_media{{ $key1 }}" name="nama_media[]" value="{{ $d->nama_media }}"/>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="media_ids[]" value="{{ $d->rps_media_id }}" />
                                                        <button type="button" class="btn btn-danger" onclick="removeMedia('media_1{{ $key1 }}', '{{ $d->rps_media_id }}', 'contents2')">Hapus Data</button>
                                                        <button type="button" class="btn btn-warning" style="display: none;" onclick="undoRemove('media_1{{ $key1 }}', 'contents2')">Undo</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                

                <div id="content8" class=" col-sm-9" style="display: none;">
                    <h4>Dosen Pengampu</h4>
                    <div class="form-group required row mb-2">
                        <label for="dosen_pengampu_id" class="col-sm-2 control-label col-form-label">Nama Dosen</label>
                        <div class="col-sm-10">
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
var count ={{ $mediaview->max('rps_media_id')  }} + 1;
var removedElements = [];
var elementsToRemove = [];

function addMore(containerId, jenisMedia) {
        var html = `
            <div id="media${count}" class="media-form mt-3">
                {{-- <div class="form-group required row mb-2"> --}}
                    {{-- <label for="jenis_media${count}" class="col-sm-2 control-label col-form-label">Jenis Media</label>--}}
                    {{--<div class="col-sm-10">--}}
                        <input type="hidden" class="form-control form-control-sm" id="jenis_media${count}" name="jenis_media[]" value="${jenisMedia}" readonly />
                        {{-- </div>--}}
                            {{--</div>--}}
                <div class="form-group required row mb-2">
                    <label for="nama_media${count}" class="col-sm-2 control-label col-form-label">Nama Media</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="nama_media${count}" name="nama_media[]" value=""/>
                    </div>
                </div>
                <input type="hidden" name="media_ids[]" value="${count}" />
                <button type="button" class="btn btn-danger" onclick="removeMedia('media${count}', '${containerId}')">Remove</button>
                <button type="button" class="btn btn-warning" style="display: none;" onclick="undoRemove('media${count}','${containerId}')">Undo</button>
            </div>
        `;
        $('#' + containerId).append(html);
        count++;
    }
    function removeMedia(id, elementId, containerId) {
        var element = $('#' + id).clone();
        removedElements.push(element);
        elementsToRemove.push(elementId);
        $('#' + id).find('button.btn-warning').show(); // Show Undo button inside the element
        $('#' + id).remove();
        if (containerId === 'contents1') {
            $('#undoButton1').show();
        } else {
            $('#undoButton2').show();
        }
    }

    function undoRemove(containerId) {
        if (removedElements.length > 0) {
            var element = removedElements.pop();
            var elementId = elementsToRemove.pop();
            $('#' + containerId).append(element);
            $('#' + elementId).find('button.btn-warning').hide(); // Hide Undo button inside the element
        }
        if (removedElements.length === 0) {
            $('#undoButton1, #undoButton2').hide();
        }
    }

var count ={{ $pustakaview->max('rps_pustaka_id')  }} + 1;
var removedElementspus = [];
var elementsToRemovepus = [];

function addMorepus(containerIdpus, jenisPustaka) {
        var html = `
            <div id="pustaka${count}" class="pustaka-form mt-3">
                {{-- <div class="form-group required row mb-2"> --}}
                    {{-- <label for="jenis_pustaka${count}" class="col-sm-2 control-label col-form-label">Jenis Pustaka </label>--}}
                    {{--<div class="col-sm-10">--}}
                        <input type="hidden" class="form-control form-control-sm" id="jenis_pustaka${count}" name="jenis_pustaka[]" value="${jenisPustaka}" readonly />
                        {{-- </div>--}}
                            {{--</div>--}}
                <div class="form-group required row mb-2">
                    <label for="referensi${count}" class="col-sm-2 control-label col-form-label">Referensi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="referensi${count}" name="referensi[]" value=""/>
                    </div>
                </div>
                <input type="hidden" name="pustaka_ids[]" value="${count}" />
                <button type="button" class="btn btn-danger" onclick="removePustaka('pustaka${count}', '${containerIdpus}')">Remove</button>
                <button type="button" class="btn btn-warning" style="display: none;" onclick="undoRemove('pustaka${count}','${containerIdpus}')">Undo</button>
            </div>
        `;
        $('#' + containerIdpus).append(html);
        count++;
    }
    function removePustaka(id, elementIdpus, containerIdpus) {
        var elementpus = $('#' + id).clone();
        removedElementspus.push(elementpus);
        elementsToRemovepus.push(elementIdpus);
        $('#' + id).find('button.btn-warning').show(); // Show Undo button inside the element
        $('#' + id).remove();
        if (containerIdpus === 'contentpus1') {
            $('#undoButtonpus1').show();
        } else {
            $('#undoButtonpus2').show();
        }
    }

    function undoRemovepus(containerIdpus) {
        if (removedElementspus.length > 0) {
            var elementpus = removedElementspus.pop();
            var elementIdpus = elementsToRemovepus.pop();
            $('#' + containerIdpus).append(elementpus);
            $('#' + elementIdpus).find('button.btn-warning').hide(); // Hide Undo button inside the element
        }
        if (removedElementspus.length === 0) {
            $('#undoButtonpus1, #undoButtonpus2').hide();
        }
    }


$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});


function showContent(linkNumber) {
    // Loop through contents
    for (var i = 1; i <= 8; i++) {
        var contentId = "content" + i;
        var displayStyle = (i === linkNumber) ? "block" : "none";
        document.getElementById(contentId).style.display = displayStyle;
    }
}

function showContents(linkNumber) {
    // Loop through contents
    for (var i = 1; i <= 2; i++) {
        var contentId = "contents" + i;
        var displayStyle = (i === linkNumber) ? "block" : "none";
        document.getElementById(contentId).style.display = displayStyle;
    }
}

function showContentpus(linkNumber) {
    // Loop through contents
    for (var i = 1; i <= 2; i++) {
        var contentId = "contentpus" + i;
        var displayStyle = (i === linkNumber) ? "block" : "none";
        document.getElementById(contentId).style.display = displayStyle;
    }
}

$(document).ready(function () {
    unblockUI();
    $('.select2_combobox').select2();

    var elementsPengampu = [];
    var elementsPengembang = [];
    var elementsCplProdi = [];
    var elementsCpmk = [];
    var elementsBk = [];

    $('#dosen_pengampu_id').on('select2:unselect', function(e) {
        var dosenId = e.params.data.id;
        elementsPengampu.push(dosenId);
    });

    $('#dosen_pengembang_id').on('select2:unselect', function(e) {
        var dosenId = e.params.data.id;
        elementsPengembang.push(dosenId);
    });
    
    $('input[type="checkbox"][name="cpl_prodi_id[]"]').on('change', function() {
        var cplProdiId = $(this).val();
        if (!$(this).is(':checked')) {
            elementsCplProdi.push(cplProdiId);
        }
    });

    $('input[type="checkbox"][name="cpl_cpmk_id[]"]').on('change', function() {
        var cpmkId = $(this).val();
        if (!$(this).is(':checked')) {
            elementsCpmk.push(cpmkId);
        }
    });

    $('input[type="checkbox"][name="mk_bk_id[]"]').on('change', function() {
        var bkId = $(this).val();
        if (!$(this).is(':checked')) {
            elementsBk.push(bkId);
        }
    });

    $("#form-master").validate({
        rules: {
            rps_id: { required: true },
            jenis_media: {},
            nama_media: { maxlength: 50 },
            dosen_pengampu_id: { required: true },
            cpl_prodi_id: { required: true },
            cpl_cpmk_id : { required: true },
            mk_bk_id : { required: true },
            dosen_pengembang_id: { required: true },
            jenis_pustaka: {},
            referensi: {},
        },
        submitHandler: function (form) {
            $('.form-message').html('');
            elementsToRemove.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_to_remove[]',
                    value: id
                }).appendTo(form);
            });

            $('.form-message').html('');
            elementsToRemovepus.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_pustaka[]',
                    value: id
                }).appendTo(form);
            });

            elementsPengampu.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_pengampu[]',
                    value: id
                }).appendTo(form);
            });

            elementsPengembang.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_pengembang[]',
                    value: id
                }).appendTo(form);
            });

            elementsCplProdi.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_cpl_prodi[]',
                    value: id
                }).appendTo(form);
            });

            elementsCpmk.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_cpmk[]',
                    value: id
                }).appendTo(form);
            });

            elementsBk.forEach(function(id) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'elements_bk[]',
                    value: id
                }).appendTo(form);
            });

            blockUI(form);
                $(form).ajaxSubmit({
                    url: "{{ route('kelola_master.update1', $id) }}", // Ensure this URL is correct
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