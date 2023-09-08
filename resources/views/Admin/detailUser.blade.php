@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="container">
                <div class="header">
                    <div class="row">
                        <div class="col-8">
                            <h5>{{$user["name"]}} - {{$user["total_simpanan"]}}</h5>
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
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($simpanan as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->getTanggal($item["tanggal"])}}</td>
                                    <td>{{$item["nominal"]}}</td>
                                    <td>{{$item->getStatusSimpanan($item["status"])}}</td>
                                    <td>
                                        @if ($item["status"] == 0)

                                        @else
                                            <button data-toggle="modal" data-target="#updateSimpanan" class="buttonEdit btn btn-warning" style="text-justify: center">
                                                <span>Ubah</span>
                                            </button>
                                            <button class="btn btn-danger" style="text-justify: center">
                                                <span>Hapus</span>
                                            </button>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                      </table>
                </div>
            </div>

            <div class="container">
                <div class="header">
                    <div class="row">
                        <div class="col-8">
                            <h5>Batas Peminjaman - {{$user["total_pinjaman"]}}</h5>
                        </div>
                        <div class="col-4" style="text-align: right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Pinjaman
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
                            <th>Tanggal</th>
                            <th>Pinjaman</th>
                            <th>Bunga</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>23-08-2023</td>
                                <td>1.000.000</td>
                                <td>300.000</td>
                                <td>1.300.000</td>
                                <td>Pinjaman</td>
                                <td>
                                    <button class="btn btn-warning" style="text-justify: center">
                                        <span>Ubah</span>
                                    </button>
                                    <button class="btn btn-danger" style="text-justify: center">
                                        <span>Hapus</span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>23-08-2023</td>
                                <td>1.000.000</td>
                                <td>300.000</td>
                                <td>1.300.000</td>
                                <td>Angsuran</td>
                                <td>
                                    <button class="btn btn-warning" style="text-justify: center">
                                        <span>Ubah</span>
                                    </button>
                                    <button class="btn btn-danger" style="text-justify: center">
                                        <span>Hapus</span>
                                    </button>
                                </td>
                            </tr>


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
                    <h4 class="modal-title">Form Modal</h4>
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
                                <input type="number" class="form-control" name="nominalSimpanan" id="nominal">
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
                    <h4 class="modal-title">Form Modal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/createSimpanan" method="post">
                    @csrf
                    <input type="hidden" name="idUser" value="{{$user["id"]}}">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="datepicker">Pilih tanggal:</label>
                                <input type="text" class="form-control" id="tglSimpananUpdate" name="tgl">
                            </div>
                            <div class="form-group">
                                <label for="name">Nominal:</label>
                                <input type="number" class="form-control" name="nominal" id="nominalSimpananUpdate">
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
        $('#tglSimpanan').datepicker({
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
        var table = $('#tabelSimpan').DataTable({
            "paging": true,
            "pageLength": 10,
        });
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            let tgl = row.find('td:eq(1)').text();
            let nominal = row.find('td:eq(2)').text();
            let id = row.find('.hidden-value').val();
            $("#tglSimpananUpdate").datepicker("setDate", tgl);
            $('#nominalSimpananUpdate').val(nominal)
            $('#idUserSimpanan').val(id)
        });
    });

</script>
@endsection
