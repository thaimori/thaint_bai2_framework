@extends('admin.layout')


@section('css_custom')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý bài tập</h1>
        @if (Auth::user()->role == 1)
        <a id="themmoibaitap" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50"></i> Thêm bài tập</a>
        @endif
    </div>
    
    <!-- Button trigger modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tải lên bài làm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('/quantri/quanlybaitap')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fileToUpload" class="col-form-label">Chọn file:</label>


                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="filenop" id="filenop">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="hidden" class="form-control" id="username" name="username" value="">
                            </div>


                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="action" value="nopbai" >Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Button trigger modal -->
    <div class="modal fade" id="modalthemmoibaitap" tabindex="-1" role="dialog" aria-labelledby="modalthemmoibaitap" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới bài tập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('/quantri/quanlybaitap')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tenbaitap" class="col-form-label">Tên bài tập:</label>
                            <input type="text" class="form-control" id="tenbaitap" name="tenbaitap">
                        </div>
                        <div class="form-group">
                            <label for="fileToUpload" class="col-form-label">Chọn file:</label>


                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="bailam" id="bailam">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>


                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="submitThemBai" name="action" value="thembai">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách bài tập</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên bài tập</th>
                            <th>Nội dung bài tập</th>
                            <th>Nộp bài tập</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($baitap as $bt)


                        <tr>
                            <td>{{$bt->id}}</td>
                            <td>{{$bt->tenbaitap}}</td>
                            <td><a href="{{URL::to('/view/baitap/'.$bt->filename)}}">{{$bt->filename}}</a></td>

                            <td><a href="{{URL::to('/view/bailam/'.$bt->filebailam)}}">{{$bt->filebailam}}</a></td>
                            <td><button type="button" class="btn btn-primary" id="btnnopbai" name="btnnopbai">Nộp bài</button></td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
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

//    $('#dataTable tbody').on('click', 'button', function () {
//        $("#username").val(table.row(this).data()[0])
//        $('#exampleModal').modal('show');
//        console.log(table.row(this).data());
//    });

$('#dataTable tbody').on( 'click', 'button', function () {
////        $("#username").val(table.row(this).data()[0])
//        $('#exampleModal').modal('show');
//        console.log(table.row(this).data());
        var data = table.row( $(this).parents('tr') ).data();
        $("#username").val(data[0])
        $('#exampleModal').modal('show')

    } );

//
//    $('#dataTable tbody').on('click', 'tr', function () {
//    $('#btnnopbai').on('click', function () {
//        //$("#username").val(table.row(this).data()[0])
//        $('#exampleModal').modal('show');
//        console.log(table.row(this).data());
//    });
//    });




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
