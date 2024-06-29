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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBunga">
                                Tambah Aturan
                            </button>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="content">
                    <table id="tabelSimpan" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Besar Bunga Pinjaman (%)</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($bunga as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <input type="hidden" value="{{$item["id"]}}">
                                    <td>{{$item["bunga_pinjaman"]}}</td>
                                    <td>
                                        @if ($item["status"] == 0)
                                            Non - Aktif
                                        @else
                                            Aktif
                                        @endif

                                    </td>
                                    <td>
                                            <button data-toggle="modal" data-target="#updateBungaPinjaman" class="buttonEdit btn btn-warning" style="text-justify: center">
                                                <span>Ubah</span>
                                            </button>
                                            @if ($item["status"] == 0)
                                                <form action="/admin/aktifBungaPinjaman" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id"]}}">
                                                    <button class="btn btn-success" style="text-justify: center">
                                                        <span>Aktifkan</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="/admin/deleteBungaPinjaman" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id"]}}">
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

    <div class="modal fade" id="createBunga">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Aturan Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/createPinjaman" method="post">
                    @csrf
                    {{-- <input type="hidden" id="idUserSimpanan" name="idUser" value="{{$user["id"]}}"> --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Bunga Pinjaman :</label>
                            <input type="number" step="0.01" class="form-control" name="bunga" id="bunga">
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
    <div class="modal fade" id="updateBungaPinjaman">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Aturan Bunga Pinjaman</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/updateBungaPinjaman" method="post">
                    @csrf
                    <input type="hidden" id="idUserBunga" name="idUserBunga" value="
                    ">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Bunga:</label>
                            <input type="number" step="0.01" class="form-control" name="bunga" id="bungaUpdate">
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
        var table = $('#tabelSimpan').DataTable({
            "paging": true,
            "pageLength": 10,
        });
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            let bunga = row.find('td:eq(1)').text();
            let id = row.find('input[type="hidden"]').val();
            $('#bungaUpdate').val(bunga)
            $('#idUserBunga').val(id)
        });
    });

</script>
@endsection
