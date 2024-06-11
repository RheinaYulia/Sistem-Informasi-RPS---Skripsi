<div class="form-group required row mb-2">
    {{-- <label class="col-sm-2 control-label col-form-label">Rps id</label> --}}
    <div class="col-sm-10">
        <input type="hidden" class="form-control form-control-sm" id="rps_id" name="rps_id" value="{{ isset($d->rps_id) ? $d->rps_id : '' }}" readonly/>
    </div>
</div>
<div class="form-group required row mb-2">
    {{-- <label class="col-sm-2 control-label col-form-label">Bab id</label> --}}
    <div class="col-sm-10">
        <input type="hidden" class="form-control form-control-sm" id="bab_id" name="bab_id[]" value="{{ isset($d->bab_id) ? $d->bab_id : '' }}" readonly/>
    </div>
</div>
<div class="form-group required row mb-2">
    {{-- <label class="col-sm-2 control-label col-form-label">Rps Bab</label> --}}
    <div class="col-sm-10">
        <input type="hidden" class="form-control form-control-sm" id="rps_bab" name="rps_bab[]" value="{{ isset($d->rps_bab) ? $d->rps_bab : '' }}" readonly/>
    </div>
</div>

@php
    $summernoteIds = ['sub_cpmk', 'materi', 'pengalaman_belajar', 'indikator_penilaian', 'bentuk_pembelajaran', 'metode_pembelajaran'];
@endphp

@foreach ($summernoteIds as $field)
    <div class="form-group required row mb-2">
        <label class="col-sm-2 control-label col-form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
        <div class="col-sm-10">
            <textarea id="summernote{{ $summernoteIndex }}" name="{{ $field }}[]" value="">
                {{ isset($d->$field) ? $d->$field : '' }}
            </textarea>
        </div>
    </div>
    @php $summernoteIndex++; @endphp
@endforeach


<div class="form-group required row mb-2">
    <label class="col-sm-2 control-label col-form-label">Estimasi Waktu</label>
    <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="estimasi_waktu" name="estimasi_waktu[]" value="{{ isset($d->estimasi_waktu) ? $d->estimasi_waktu : '' }}"/>
    </div>
</div>

<div class="form-group required row mb-2">
    <label class="col-sm-2 control-label col-form-label">Bobot Penilaian</label>
    <div class="col-sm-10">
        <input type="number" class="form-control form-control-sm" id="bobot_penilaian" step="any" name="bobot_penilaian[]" value="{{ isset($d->bobot_penilaian) ? $d->bobot_penilaian : '' }}"/>
    </div>
</div>


<script>
     $('[id^=summernote]').each(function() {
        $(this).summernote({
            height:200
        });
    });

</script>