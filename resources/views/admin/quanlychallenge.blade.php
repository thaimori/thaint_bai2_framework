@extends('admin.layout')


@section('css_custom')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Challenge</h1>
        @if (Auth::user()->role == 1)
        <a id="themmoibaitap" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50"></i> Thêm challenge</a>
        @endif
    </div>

    <div class="modal fade" id="modaldapan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaldapan">Đáp án là gì ???</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('/quantri/quanlychallenge')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="comment" class="col-form-label">Đáp án:</label>
                            <input type="text" class="form-control" id="comment" name="dapan">
                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="action" value="submitdapan">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới challenge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('/quantri/quanlychallenge')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tenchallenge" class="col-form-label">Tên challenge:</label>
                            <input type="text" class="form-control" id="tenchallenge" name="tenchallenge">
                        </div>
                        <div class="form-group">
                            <label for="goiy" class="col-form-label">Gợi ý:</label>
                            <input type="text" class="form-control" id="goiy" name="goiy">
                        </div>
                        <div class="form-group">
                            <label for="fileToUpload" class="col-form-label">Chọn file:</label>


                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="challenge" id="challenge">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>


                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="submitThemBai" name="action" value="themchallenge">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @if(isset($content))
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Đáp án</h6>
        </div>
        <div class="card-body">
            {{$content}}
        </div>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Challenge</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên challenge</th>
                            <th>Gợi ý</th>
                            <th>Giải đố</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($challenge as $chl)


                        <tr>
                            <td>{{$chl->id}}</td>
                            <td>{{$chl->tenchallenge}}</td>
                            <td>{{$chl->goiy}}</td>
                            <td></td>
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
        $("#username").val(table.row(this).data()[0])
        $('#modaldapan').modal('show');
        console.log(table.row(this).data());
        });
        @if (Auth::check())
        @if (Auth::user() -> role == 1)
        $('#themmoibaitap').on('click', function(){
        $('#modalthemmoibaitap').modal('show');
        });
        @endif
        @endif

        $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
});




</script>
@endsection
