@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>User List</h2>
                </div>
                <div class="col-md-6">
                    <a href="" class="btn btn-primary">Hitung Bunga Seluruh Nasabah</a>
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
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item["name"] }}</td>
                            <td> {{$item["email"] }}</td>
                            <td> {{$item["telp"] }}</td>
                            <td> {{ format_idr($item->simpanan["total_simpanan"] ?? 0) }}</td>
                            <td>
                                <a href="{{ route('detailUser', ['id' => $item["id"]]) }}" class="btn btn-primary">View</a>

                                {{-- <button class="btn btn-primary" style="text-justify: center">
                                    <input value="{{$item["id"]}}" type="hidden" name="idUser">
                                    <span>View</span>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
    </div>
@endsection
@section('script')
<script>

    $('#tabelUser').DataTable({
        "paging": true,
        "pageLength": 10,
    });
</script>
@endsection
