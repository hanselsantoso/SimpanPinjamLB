@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container row m-auto" >
            <h2>{{$user["name"]}}</h2>
            <div class="container col-6">
            <div class="header">
                <div class="row">
                <div class="col-8">
                    <h2>Total Simpanan - {{format_idr($user->simpanan["total_simpanan"] ?? 0)}}</h2>
                    <h5>Bunga Simpanan / bulan - {{$info['interestRate']}}%</h5>
                    {{-- <h3>Bunga - {{format_idr($totalSimpanan)}}</h3> --}}
                </div>
                <div class="col-4" style="text-align: right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSimpanan">
                    Tambah Simpanan
                    </button>
                </div>
                </div>
                <br>
            </div>
            <div class="content">
                <table id="tabelSimpan" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($user->simpanan->simpanans as $item)
                        <tr>
                            <input type="hidden" id="idSimpanan" value="{{$item["id"]}}">
                            <input type="hidden" id="tanggalSimpanan" value="{{$item->getTanggal($item["tanggal"])}}">
                            <input type="hidden" id="nominalSimpanan" value="{{$item["nominal"]}}">
                            <input type="hidden" id="statusSimpanan" value="{{$item["status"]}}">
                            <td>{{$item->getTanggal($item["tanggal"])}}</td>
                            <td>{{ format_idr($item["nominal"])}}</td>
                            <td>{{$item->getStatusSimpanan($item["status"])}}</td>
                            <td>
                                <button data-toggle="modal" data-target="#updateSimpanan" class="buttonEdit btn btn-warning" style="text-justify: center">
                                <span>Ubah</span>
                                </button>
                                <form action="/admin/deleteSimpanan" method="post">
                                    @csrf
                                    <input type="hidden" name="idSimpanan" value="{{$item["id"]}}">
                                    <button class="btn btn-danger" style="text-justify: center">
                                    <span>Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                  </table>
            </div>
            </div>

            <div class="container col-6">
            <div class="header">
                <div class="row">
                <div class="col-8">
                    <h2>Total Pinjaman - {{format_idr($user->pinjaman["total_pinjaman"] ?? 0)}}</h2>
                    <h5>Maximal Pinjaman - {{$info['aturanPinjam']}}% - {{format_idr($info['jumlahPinjaman'])}}</h5>
                </div>
                <div class="col-4" style="text-align: right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPinjaman">
                    Tambah Pinjaman
                    </button>
                </div>
                </div>
                <br>
            </div>
            <div class="content">
                <table id="tabelPinjaman" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Nominal</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        {{-- @foreach ($user->pinjaman->pinjamans ?? [] as $item)
                            <tr>
                                <input type="hidden" id="idSimpanan" value="{{$item["id_pinjaman_d"]}}">
                                <input type="hidden" id="tanggalSimpanan" value="{{$item->getTanggal($item["tanggal"])}}">
                                <input type="hidden" id="nominalSimpanan" value="{{$item["pinjaman"]}}">
                                <input type="hidden" id="statusSimpanan" value="{{$item["status_pinjaman_d"]}}">
                                <td>{{$item->getTanggal($item["tanggal"])}}</td>
                                <td>{{ format_idr($item["pinjaman"])}}</td>
                                <td>{{$item->getStatusSimpanan($item["status_pinjaman_d"])}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#updateSimpanan" class="buttonEdit btn btn-warning" style="text-justify: center">
                                    <span>Ubah</span>
                                    </button>
                                    <form action="/admin/deletePinjaman" method="post">
                                        @csrf
                                        <input type="hidden" name="idPinjaman" value="{{$item["id_pinjaman_d"]}}">
                                        <button class="btn btn-danger" style="text-justify: center">
                                        <span>Hapus</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                      </tbody>
                  </table>
            </div>
            </div>
        </div>


    </div>

    {{-- SIMPANAN --}}
    <div class="modal fade" id="createSimpanan">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/createSimpanan" method="post">
                    @csrf
                    <input type="hidden" id="idUserSimpanan" name="idUser" value="{{$user["id"]}}">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="datepicker">Pilih tanggal:</label>
                                <input type="text" class="form-control" id="tglSimpanan" name="tgl">
                            </div>
                            <div class="form-group">
                                <label for="name">Nominal:</label>
                                <input type="number" class="form-control" name="nominal" id="nominalSimpanan">
                            </div>
                            <div class="form-group">
                                <label for="type">Type:</label>
                                <select class="form-control" name="status" id="statusSimpanan">
                                    <option value="0">Simpanan Pokok</option>
                                    <option value="1">Simpanan Bulanan</option>
                                    <option value="2">Bunga Simpanan</option>
                                </select>
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
                    <h4 class="modal-title">Ubah Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/updateSimpanan" method="post">
                    @csrf
                    <input type="hidden" name="idUser" value="{{$user["id"]}}">
                    <input type="hidden" name="idSimpanan" id="idSimpananUpdate" value="">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="datepicker">Pilih tanggal:</label>
                                <input type="text" class="form-control" id="tglSimpananUpdate" name="tgl">
                            </div>
                            <div class="form-group">
                                <label for="name">Nominal:</label>
                                <input type="number" class="form-control" name="nominal" id="nominalSimpananUpdate">
                            </div>
                            <div class="form-group">
                                <label for="type">Type:</label>
                                <select class="form-control" name="status" id="statusSimpananUpdate">
                                    <option value="0">Simpanan Pokok</option>
                                    <option value="1">Simpanan Bulanan</option>
                                    <option value="2">Bunga Simpanan</option>
                                </select>
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

    {{-- PINJAMAN --}}
    <div class="modal fade" id="createPinjaman">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pinjaman</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/createPinjaman" method="post">
                    @csrf
                    <input type="hidden" id="idUserPinjaman" name="idUser" value="{{$user["id"]}}">
                    <input type="hidden" name="bungaPinjaman" value="{{$info["bungaPinjaman"]}}">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="datepicker">Pilih tanggal:</label>
                                <input type="text" class="form-control" id="tglPinjaman" name="tgl">
                            </div>
                            <div class="form-group">
                                <label for="name">Pinjaman:</label>
                                <input type="number" class="form-control" name="nominal" id="nominalPinjaman">
                            </div>


                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btnCreatePinjaman" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#tglSimpanan').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $('#tglPinjaman').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        today = dd + '-' + mm + '-' + yyyy;

        // Set the default value property to today's date
        $("#tglSimpanan").val(today);
        $('#tglSimpananUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $("#tglPinjaman").val(today);
        $('#tglPinjamanUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });
        var table = $('#tabelSimpan').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        var table = $('#tabelPinjaman').DataTable({
            "paging": true,
            "pageLength": 10,
        });
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            var data = row.find('input[type="hidden"]').map(function() {
            return $(this).val();
            }).get();
            console.log(data);

            let id = data[0];
            let tgl = data[1];
            let nominal = data[2];
            let status = data[3];
            $('#idSimpananUpdate').val(id)
            $("#tglSimpananUpdate").datepicker("setDate", tgl);
            // console.log(id)
            $('#nominalSimpananUpdate').val(nominal)

            $('#statusSimpananUpdate').val(status).change();
        });

        $('#btnCreatePinjaman').on('click', function() {
            var nominalPinjaman = parseInt($('#nominalPinjaman').val());
            var maximalPinjam = parseInt("{{$info['jumlahPinjaman']}}");
            if (nominalPinjaman > maximalPinjam) {
                alert("Nominal pinjaman melebihi batas maksimal pinjaman");
                return false;
            }
        });
    });

</script>
@endsection
