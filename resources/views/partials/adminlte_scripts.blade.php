<!-- REQUIRED SCRIPTS -->
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/dist/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
<!-- Sweet Alert script -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--Fontawesome script -->
{{ Html::script('fontawesome5/js/fontawesome.min.js') }}
<!--Bootstrap script -->
{{ Html::script('bootstrap5/js/bootstrap.min.js') }} 
<!--Bootstrap 5.0.2 CDN script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- Share on social media script -->
{{ Html::script('js/share.js') }} 
<!-- CKEditor Scripts -->
{{ Html::script('ckeditor/ckeditor.js') }}

{{ Html::script('ckeditor/adapters/jquery.js') }}
<script>
    if(document.getElementById("summary-ckeditor")){
        CKEDITOR.replace( 'summary-ckeditor',{
        filebrowserUploadUrl: "{{route('author.upload',['_token'=>csrf_token()])}}",
        filebrowserUploadMethod: 'form'
        });
    }
</script>
<!-- Toster scripts -->
@jquery
@toastr_js
@toastr_render
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
