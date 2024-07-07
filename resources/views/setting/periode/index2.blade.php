@extends('layouts.template')

@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card card-{{ $theme->card_outline }} card-outline card-tabs">
         <div class="card-header">
             <h3 class="card-title mt-1">
                 <i class="fas fa-angle-double-right text-md text-{{ $theme->card_outline }} mr-1"></i>
                 Form Edit Periode
             </h3>
         </div>
         <div class="card-body">
              <form method="post" action="{{ route('periode.update') }}" role="form" class="form-horizontal" id="form-submit">
                 <div class="form-message-submit text-center"></div>
                 @csrf
                 <div class="form-group row mb-1">
                    <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                    <div class="col-sm-9">
                       <select class="form-control form-control-sm select2" id="periode" name="periode_id">
                          @foreach($periodes as $periode)
                              <option value="{{ $periode->periode_id }}" {{ $periode->is_active ? 'selected' : '' }}>
                                  {{ $periode->periode_name }} - {{ $periode->periode_semester }}
                              </option>
                          @endforeach
                       </select>
                    </div>
                 </div>
                 <div class="row">
                    <label class="col-sm-3"></label>
                    <div class="col-sm-9">
                       <button type="submit" class="btn btn-{{ $theme->button }}">Submit</button>
                    </div>
                 </div>
              </form>
         </div>
      </div>
   </div>
</div>
@endsection

@push('content-js')
<script>
   $(document).ready(function() {
      // Initialize Select2 Elements
      $('.select2').select2({
          theme: 'bootstrap4'
      });

      $("#form-submit").validate({
         rules: {
            periode_id: {
               required: true
            }
         },
         submitHandler: function(form) {
            $('.form-message-submit').html('');
            $(form).ajaxSubmit({
               dataType: 'json',
               success: function(data) {
                  setFormMessage('.form-message-submit', data);
                  if (data.stat) {
                      setTimeout(function(){
                          location.reload();
                      }, 2000);
                  }
               }
            });
         },
         validClass: "valid-feedback",
         errorElement: "div",
         errorClass: 'invalid-feedback',
         errorPlacement: function(error, element) {
             error.addClass('invalid-feedback');
             element.closest('.form-group').append(error);
         },
         highlight: function(element, errorClass, validClass) {
             $(element).addClass('is-invalid').removeClass('is-valid');
         },
         unhighlight: function(element, errorClass, validClass) {
             $(element).addClass('is-valid').removeClass('is-invalid');
         }
      });
  });
</script>
@endpush
