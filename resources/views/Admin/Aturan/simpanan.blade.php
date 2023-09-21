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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSimpanan">
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
                            <th>Minimal Tabungan</th>
                            <th>Pinjaman</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($aturan as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <input type="hidden" value="{{$item["id"]}}">
                                    <td>{{$item["minimal_tabungan"]}}</td>
                                    <td>{{$item["pinjaman"]}}</td>
                                    <td>
                                        @if ($item["status"] == 0)
                                            Non - Aktif
                                        @else
                                            Aktif
                                        @endif

                                    </td>
                                    <td>
                                            <button data-toggle="modal" data-target="#updateSimpanan" class="buttonEdit btn btn-warning" style="text-justify: center">
                                                <span>Ubah</span>
                                            </button>
                                            <button class="btn btn-danger" style="text-justify: center">
                                                <span>Hapus</span>
                                            </button>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>


    </div>

    <div class="modal fade" id="createSimpanan">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Aturan Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/createAturan" method="post">
                    @csrf
                    {{-- <input type="hidden" id="idUserSimpanan" name="idUser" value="{{$user["id"]}}"> --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Minimal Simpanan:</label>
                            <input type="number" class="form-control" name="minimalSimpanan" id="minimalSimpanan">
                        </div>
                        <div class="form-group">
                            <label for="name">Pinjaman:</label>
                            <input type="number" class="form-control" name="pinjaman" id="pinjaman">
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
    <div class="modal fade" id="updateSimpanan">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Aturan Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/updateAturan" method="post">
                    @csrf
                    <input type="hidden" id="idUserSimpanan" name="idUserSimpanan" value="
                    ">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Minimal Simpanan:</label>
                                <input type="number" class="form-control" name="minimalSimpanan" id="minimalSimpananUpdate">
                            </div>
                            <div class="form-group">
                                <label for="name">Pinjaman:</label>
                                <input type="number" class="form-control" name="pinjaman" id="pinjamanUpdate">
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
            let minimalTabungan = row.find('td:eq(1)').text();1
            let pinjaman = row.find('td:eq(2)').text();
            let id = row.find('input[type="hidden"]').val();
            $("#minimalSimpananUpdate").val(minimalTabungan);
            $('#pinjamanUpdate').val(pinjaman)
            $('#idUserSimpanan').val(id)
        });
    });

</script>
@endsection
