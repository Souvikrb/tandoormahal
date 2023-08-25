<!-- Support file

====Excel file support format======
.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel

====Other File support format======
.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document 

-->

<div class="input-group">
    <div class="custom-file">
    <input type="file" name="{{$name}}" accept="{{$accept}}" {{$required}} class="custom-file-input" id="fileu">
    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
    </div>
    <div class="input-group-append">
    <span class="input-group-text">Upload</span>
    </div>
</div>
<div class="mt-3">
    <div class="p-badge" style="display:none"><span class="badge badge-dark">Preview</span>
    <small class="p-text"></small>
    </div>
    <img class="demo-img" id="previewImg" src="{{url('dist/img/default/default-file.png')}}" alt="your image" />
</div> 


<!--Start Js section -->
<script>
        $(function () {
            
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
        });
        fileu.onchange = evt => {
            var file = $("input[type=file]").get(0).files[0];
            var filename = $("input[type=file]").get(0).files[0].name;
            let f = filename.split(".");
            let type = f[f.length - 1];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    if(type != 'jpg' && type != 'png' && type != 'svg'){
                        src = 'dist/img/default/upload-file.png';
                    }else{
                        src = reader.result;
                    }

                    $("#previewImg").attr("src", src);
                    $('.p-badge').show();
                    $('.p-text').html(filename);
                }
                
    
                reader.readAsDataURL(file);
            }
        }
</script>
<!--End Js section -->