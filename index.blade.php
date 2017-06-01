@extends ('layouts.app')

@section ('content')
<div id="panel" class="m-t-50">
  <!-- Nav tabs <div id="rootwizard" class="m-t-50"> -->
  <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm">
    <li class="active">
      <a data-toggle="tab" href="#tab1"><i class="fa fa-user"></i> <span>Details</span></a>
    </li>
    <li class="">
      <a data-toggle="tab" href="#tab2"><i class="fa fa-picture-o"></i> <span>Logo</span></a>
    </li>
    <li class="">
      <a data-toggle="tab" href="#tab3"><i class="fa fa-clock-o"></i> <span>Opening Times</span></a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    @include ('app.profile.details')

    @include ('app.profile.logo')

    @include ('app.profile.opening_times')
  </div>
</div>
@endsection

@section ('scripts')
<script src="{{ asset('assets/plugins/classie/classie.js') }}"></script>
<script src="{{ asset('assets/plugins/switchery/js/switchery.min.js') }}"></script>
<script src="{{ asset('pages/js/pages.min.js') }}"></script>
<script>
  var maxImageWidth = 500,
      maxImageHeight = 500;

  Dropzone.options.addLogoForm = {
    paramName: 'logo',
    method: 'post',
    url: this.action,
    maxFiles: 1,
    maxFilesize: 1,
    acceptedFiles: "image/jpeg, image/jpg, image/png",
    uploadMultiple: false,
    init() {
      this.on("addedfile", function () {
        if (this.files[1] != null){
          this.removeFile(this.files[0]);
        }
      });

      this.on("thumbnail", function (file) {
        if (file.width > maxImageWidth || file.height > maxImageHeight) {
          file.rejectDimensions()
        } else {
          file.acceptDimensions();
        }
      });
    },

    accept: function (file, done) {
      file.acceptDimensions = done;

      file.rejectDimensions = function () {
          done("Invalid dimension.");

          alert('Max file size is 500x500.');
      };
    }
  };
</script>
@endsection