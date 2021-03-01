@extends('admin.layout')


@section('css_custom')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý người dùng</h1>
    <!-- Button trigger modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Để lại lời nhắn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('/quantri/quanlyuser')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="comment" class="col-form-label">Nội dung:</label>
                            <input type="text" class="form-control" id="comment" name="comment">
                            <input type="hidden" class="form-control" id="username" name="username" value="">
                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="loinhan">Save</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th>Lời nhắn của tôi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $student)


                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->username}}</td>
                            <td>{{$student->fullname}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->comment}}</td>
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

    $('#dataTable tbody').on('click', 'tr', function () {
        $("#comment").val(table.row(this).data()[4])
        $("#username").val(table.row(this).data()[0])
        $('#exampleModal').modal('show');
        console.log(table.row(this).data());
    });
});
</script>
@endsection
