
<footer class="main-footer" style="    background-color:#6c757d;
color: #fff;">

    <strong>Copyright &copy; 2023 <a href="https://github.com/RafyMrX" target='_blank' style="color: #e1bc00;">Ahmad Rafi Akbar Putra Hamzah</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->

<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dist/js/demo.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ url('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ url('/plugins/jszip/jszip.min.js') }}"></script> --}}
<script src="{{ url('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ url('dist/js/select2.min.js') }}"></script>
<script>

// preview image 
// function previewImgSoal(){
// const gambar_soal = document.querySelector('#gambar_soal');
// const previewimgsoal = document.querySelector('.previewimgsoal'); 
// previewimgsoal.style.display='block';
// const oFReader = new FileReader();
// oFReader.readAsDataURL(gambar_soal.files[0]);
// oFReader.onload = function(oFREvent){
// previewimgsoal.src = oFREvent.target.result;
// }
// }


$(function() {
$("#example1").DataTable({
"responsive": true,
"autoWidth": true,
     "ordering": true,
});
$('#example2').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true,
"responsive": true,
});

});



</script>
@stack('scripts')
</body>

</html>
