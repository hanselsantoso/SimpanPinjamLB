@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Daftar Nasabah</h2>
                </div>
                <div class="col-md-3">
                    <form action="/admin/hitungDanSimpanBunga" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Hitung Bunga Seluruh Nasabah</button>
                    </form>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNasabah">
                        Tambah Nasabah
                    </button>
                </div>
            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Total Simpanan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($user as $item)
                        <tr>
                            <input type="hidden" name="idUser" value="{{$item["id"] }}">
                            <input type="hidden" name="nik" value="{{$item["nik"] }}">
                            <input type="hidden" name="nama" value="{{$item["name"] }}">
                            <input type="hidden" name="alamat" value="{{$item["alamat"] }}">
                            <input type="hidden" name="email" value="{{$item["email"] }}">
                            <input type="hidden" name="tempatLahir" value="{{$item["tempat_lahir"] }}">
                            <input type="hidden" name="tanggalLahir" value="{{$item->getTanggal($item["tanggal_lahir"])}}">
                            <input type="hidden" name="telp" value="{{$item["telp"] }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item["name"] }}</td>
                            <td> {{$item["email"] }}</td>
                            <td> {{$item["telp"] }}</td>
                            <td> {{ format_idr($item->simpanan["total_simpanan"] ?? 0) }}</td>
                            <td>
                                <a href="{{ route('detailUser', ['id' => $item["id"]]) }}" class="btn btn-primary">View</a>

                                <a href="#" class="btn btn-warning buttonEdit" data-toggle="modal" data-target="#updateNasabah">Update</a>

                                @if ($item->status == 1)
                                    <form action="{{ route('suspendUser', ['id' => $item["id"]]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                    </form>
                                @else
                                    <form action="{{ route('unSuspendUser', ['id' => $item["id"]]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Aktifkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
    </div>


    <div class="modal fade" id="createNasabah">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Aturan Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/tambahNasabah" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nik">NIK:</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}">
                                @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="email">Tempat lahir :</label>
                                <input type="tempatLahir" class="form-control" id="tempatLahir" name="tempatLahir" value="{{ old('tempatLahir') }}">
                                @error('tempatLahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tglLahir">Tanggal lahir :</label>
                                <input type="text" class="form-control" id="tglLahir" name="tglLahir">
                            </div>
                            <div class="form-group">
                                <label for="telp">Nomor Telepon:</label>
                                <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}">
                                @error('telp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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

    <div class="modal fade" id="updateNasabah">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Aturan Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/ubahNasabah" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <input type="hidden" name="idUser" value="">
                            <div class="form-group">
                                <label for="nik">NIK:</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}">
                                @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="email">Tempat lahir :</label>
                                <input type="tempatLahir" class="form-control" id="tempatLahir" name="tempatLahir" value="{{ old('tempatLahir') }}">
                                @error('tempatLahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tglLahir">Tanggal lahir :</label>
                                <input type="text" class="form-control" id="tglLahirUpdate" name="tglLahirUpdate">
                            </div>
                            <div class="form-group">
                                <label for="telp">Nomor Telepon:</label>
                                <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}">
                                @error('telp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + mm + '-' + yyyy;

    // Set the default value property to today's date
    $('#tglLahir').datepicker({
        // format: 'yyyy-mm-dd', // You can change the date format
        format: 'dd-mm-yyyy', // You can change the date format
        autoclose: true
    });
    $("#tglLahir").val(today);
    $('#tglLahirUpdate').datepicker({
        // format: 'yyyy-mm-dd', // You can change the date format
        format: 'dd-mm-yyyy', // You can change the date format
        autoclose: true
    });
    $('#tabelUser').DataTable({
        "paging": true,
        "pageLength": 10,
    });


    $(document).ready(function () {
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            var hiddenInputs = row.find('input[type="hidden"]');
            var data = [];
            hiddenInputs.each(function() {
                var value = $(this).val();
                data.push(value);
            });
            console.log(data);
            var row = $(this).closest('tr');
            let id = data[0];
            let nik = data[1];
            let nama = data[2];
            let alamat = data[3];
            let email = data[4];
            let tempatLahir = data[5];
            let tanggalLahir = data[6];
            let telp = data[7];

            $('#updateNasabah').find('input[name="idUser"]').val(id);
            $('#updateNasabah').find('input[name="nik"]').val(nik);
            $('#updateNasabah').find('input[name="name"]').val(nama);
            $('#updateNasabah').find('input[name="alamat"]').val(alamat);
            $('#updateNasabah').find('input[name="email"]').val(email);
            $('#updateNasabah').find('input[name="tempatLahir"]').val(tempatLahir);
            $('#updateNasabah').find('input[name="tglLahirUpdate"]').datepicker('setDate', tanggalLahir);

            $("#tglLahirUpdate").datepicker("setDate", tanggalLahir);
            $('#updateNasabah').find('input[name="telp"]').val(telp);
        });
    });

</script>
@endsection
