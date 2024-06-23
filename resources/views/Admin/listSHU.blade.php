@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="header">
                <div class="row">
                <div class="col-8">
                    <h4>Log SHU</h4>
                </div>
                <div class="col-4" style="text-align: right">
                    <form action="/admin/hitungshu" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Tambah SHU
                        </button>
                    </form>
                </div>
                </div>
                <br>
            </div>
            <table class="nested-table table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Pemegang SHU</th>
                        <th>SHU</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shu as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->getTanggal($item['tanggal']) }}</td>
                            <td>{{ $item->pemegangShu['nama_pemegang_shu'] }}</td>
                            <td>{{ format_idr($item['shu']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.tabelPinjaman').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });

</script>
@endsection
