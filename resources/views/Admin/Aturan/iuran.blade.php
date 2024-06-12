@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="container">
                <div class="header">
                    <div class="row">
                        <div class="col-8">
                            {{-- <h5>{{$user["name"]}} - {{$user["total_simpanan"]}}</h5> --}}
                        </div>
                        <div class="col-4" style="text-align: right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createIuran">
                                Tambah Aturan Iuran
                            </button>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="content">
                    <table id="tabelIuran" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Iuran (Bulan)</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($iuran as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <input type="hidden" value="{{$item["id_iuran"]}}">
                                    <input type="hidden" value="{{$item["iuran"]}}">
                                    <td>{{ format_idr($item["iuran"])}}</td>
                                    <td>
                                        @if ($item["status_iuran"] == 0)
                                            Non - Aktif
                                        @else
                                            Aktif
                                        @endif

                                    </td>
                                    <td>
                                            <button data-toggle="modal" data-target="#updateIuran" class="buttonEdit btn btn-warning" style="text-justify: center">
                                                <span>Ubah</span>
                                            </button>
                                            @if ($item["status_iuran"] == 0)
                                                <form action="/admin/aktifIuran" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id_iuran"]}}">
                                                    <button class="btn btn-success" style="text-justify: center">
                                                        <span>Aktifkan</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="/admin/deleteIuran" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id_iuran"]}}">
                                                    <button class="btn btn-danger" style="text-justify: center">
                                                        <span>Non-Aktifkan</span>
                                                    </button>
                                                </form>
                                            @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>


    </div>

    <div class="modal fade" id="createIuran">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Aturan Iuran</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/createIuran" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Iuran:</label>
                            <input type="number" class="form-control" name="iuran" id="iuran">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateIuran">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Aturan Iuran</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/updateIuran" method="post">
                    @csrf
                    <input type="hidden" id="idUserIuran" name="idUserIuran" value="
                    ">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Iuran:</label>
                                <input type="number" class="form-control" name="iuran" id="iuranUpdate" >
                            </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script>
    $(document).ready(function () {
        var table = $('#tabelIuran').DataTable({
            "paging": true,
            "pageLength": 10,
        });
        $('.buttonEdit').on('click', function() {

            var row = $(this).closest('tr');
            var hiddenInputs = row.find('input[type="hidden"]');
            var data = [];
            hiddenInputs.each(function() {
                var value = $(this).val();
                data.push(value);
            });
            var row = $(this).closest('tr');
            let id = data[0];
            let iuran = data[1];
            $("#iuranUpdate").val(iuran);
            $('#idUserIuran').val(id)
        });
    });

</script>
@endsection
