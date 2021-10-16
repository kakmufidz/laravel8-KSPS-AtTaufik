@section('style')
<style>
    .containerup {
      padding: 50px 10%;
    }
    
    .boxup {
      position: relative;
      background: #ffffff;
      width: 100%;
    }
    
    .box-headerup {
      color: #444;
      display: block;
      padding: 10px;
      position: relative;
      border-bottom: 1px solid #f4f4f4;
      margin-bottom: 10px;
    }
    
    .box-toolsrup {
      position: absolute;
      right: 10px;
      top: 5px;
    }
    
    .dropzone-wrapperup {
      border: 2px dashed #91b0b3;
      color: #92b0b3;
      position: relative;
      height: 150px;
    }
    
    .dropzone-descup {
      position: absolute;
      margin: 0 auto;
      left: 0;
      right: 0;
      text-align: center;
      width: 40%;
      top: 50px;
      font-size: 16px;
    }
    
    .dropzoneup,
    .dropzoneup:focus {
      position: absolute;
      outline: none !important;
      width: 100%;
      height: 150px;
      cursor: pointer;
      opacity: 0;
    }
    
    .dropzone-wrapperup:hover,
    .dropzone-wrapperup.dragoverup {
      background: #ecf0f5;
    }
    
    .preview-zoneup {
      text-align: center;
    }
    
    .preview-zoneup .boxup {
      box-shadow: none;
      border-radius: 0;
      margin-bottom: 0;
    }
</style>
@endsection
@section('konten')
<div class="modal fade" id="modal-surat-kredit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload file surat perjanjian kredit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/upload/suratkredit/{{$kredits->id_kredit}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="containerup">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Upload file dalam bentuk PDF</label>
                  <div class="preview-zoneup hidden">
                    <div class="boxup box-solid">
                      <div class="box-headerup with-border">
                        <div class="box-toolsrup pull-right">
                          <button type="button" class="btn btn-danger btn-xs remove-preview">
                            <i class="fa fa-times"></i> Reset file
                          </button>
                        </div>
                      </div>
                      <div class="box-body"></div>
                    </div>
                  </div>
                  <div class="dropzone-wrapperup">
                    <div class="dropzone-descup">
                      <i class="fa fa-upload"></i>
                      <p>Pilih atau drag file disini</p>
                    </div>
                    <input type="file" name="file_suratkredit" class="dropzoneup">
                  </div>
                </div>
              </div>
            </div>
        
            <div class="row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">Upload</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('js')
<script>
    
    // Code By Webdevtrick ( https://webdevtrick.com )
    function readFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var htmlPreview =
            '<img width="200" src="' + e.target.result + '" />' +
            '<p>' + input.files[0].name + '</p>';
          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zoneup');
          var boxZone = $(input).parent().parent().find('.preview-zoneup').find('.boxup').find('.box-body');

          wrapperZone.removeClass('dragoverup');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function reset(e) {
      e.wrap('<form>').closest('form').get(0).reset();
      e.unwrap();
    }

    $(".dropzoneup").change(function() {
      readFile(this);
    });

    $('.dropzone-wrapperup').on('dragoverup', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).addClass('dragoverup');
    });

    $('.dropzone-wrapperup').on('dragleave', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).removeClass('dragoverup');
    });

    $('.remove-preview').on('click', function() {
      var boxZone = $(this).parents('.preview-zoneup').find('.box-body');
      var previewZone = $(this).parents('.preview-zoneup');
      var dropzoneup = $(this).parents('.form-group').find('.dropzoneup');
      boxZone.empty();
      previewZone.addClass('hidden');
      reset(dropzoneup);
    });
    // Code By Webdevtrick ( https://webdevtrick.com )
    function readFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function(e) {
          var htmlPreview =
            '<img width="200" src="' + e.target.result + '" />' +
            '<p>' + input.files[0].name + '</p>';
          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zoneup');
          var boxZone = $(input).parent().parent().find('.preview-zoneup').find('.boxup').find('.box-body');
    
          wrapperZone.removeClass('dragoverup');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
        };
    
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    function reset(e) {
      e.wrap('<form>').closest('form').get(0).reset();
      e.unwrap();
    }
    
    $(".dropzoneup").change(function() {
      readFile(this);
    });
    
    $('.dropzone-wrapperup').on('dragoverup', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).addClass('dragoverup');
    });
    
    $('.dropzone-wrapperup').on('dragleave', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).removeClass('dragoverup');
    });
    
    $('.remove-preview').on('click', function() {
      var boxZone = $(this).parents('.preview-zoneup').find('.box-body');
      var previewZone = $(this).parents('.preview-zoneup');
      var dropzoneup = $(this).parents('.form-group').find('.dropzoneup');
      boxZone.empty();
      previewZone.addClass('hidden');
      reset(dropzoneup);
    });
</script>
@endsection