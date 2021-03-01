@extends('admin.layout')


@section('css_custom')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Đáp án</h1>
    </div>
    <div>
        {{$content}}
</div>

</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->







@endsection

@section('scripts')
<!-- Bootstrap core JavaScript-->
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
<script type="text/javascript">

$(document).ready(function () {
    var table = $('#dataTable').DataTable();

    $('#dataTable tbody').on('click', 'tr', function () {
        $("#username").val(table.row(this).data()[0])
        $('#modaldapan').modal('show');
        console.log(table.row(this).data());
    });
@if (Auth::user()->role == 1)    
    $('#themmoibaitap').on('click', function(){
        $('#modalthemmoibaitap').modal('show');
    });
@endif
});

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});



</script>
@endsection
