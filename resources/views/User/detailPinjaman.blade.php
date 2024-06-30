@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <h1>Detail Pinjaman</h1>
            <h2>{{$pinjaman->user["name"]}} - {{format_idr($pinjaman->getTotalPinjamanD())}}</h2>
            <h2>Total Terbayar - {{format_idr($pinjaman->getTotalTerbayar())}}</h2>
            <table class="nested-table table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Jatuh Tempo</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjaman->pinjamans as $nestedItem)
                        <tr>
                            <td>{{ $nestedItem->getTanggal($nestedItem->tanggal) }}</td>
                            <td>{{ format_idr($nestedItem->pinjaman) }}</td>
                            @if ($nestedItem->status_pinjaman_d == 0)
                                <td>Belum Lunas</td>
                            @else
                                <td> Lunas</td>

                            @endif
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
        $('#tglBayarPinjaman').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });
        // $( row.child() ).DataTable();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        today = dd + '-' + mm + '-' + yyyy;

        $("#tglPinjaman").val(today);
        $('#tglPinjamanUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $("#tglBayarPinjaman").val(today);
        $('#tglBayarPinjamanUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });


        $('.tabelPinjaman').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
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
            var nominalPinjaman = parseInt($('#txtNominalPinjaman').val());

            console.log(nominalPinjaman);
            console.log(maximalPinjam);
            console.log(totalTerbayar);
            console.log(totalPinjaman);
            var maxTerbayar = 0.8 * totalPinjaman; // 80% of total_pinjaman

            if (nominalPinjaman + totalPinjaman > maximalPinjam) {
                alert("Nominal pinjaman melebihi batas maksimal pinjaman");
                return false;
            }

            if (totalTerbayar > maxTerbayar) {
                alert("Total terbayar melebihi 80% dari total pinjaman");
                return false;
            }
        });

        $('.buttonBayar').on('click', function() {
            var row = $(this).closest('tr');
            var data = row.find('input[type="hidden"]').map(function() {
                return $(this).val();
            }).get();
            console.log(data);
            let id = data[0];
            let totalPinjamanH = data[2];
            $('#idByarPinjaman').val(id)
            $('#totalByarPinjaman').val(totalPinjamanH)
        });

        $('#btnBayarPinjaman').on('click', function() {
            var nominalBayarPinjaman = parseInt($('#nominalBayarPinjaman').val());
            var totalPinjaman = parseInt($("#totalByarPinjaman").val());
            if (nominalBayarPinjaman > totalPinjaman && nominalBayarPinjaman > 0) {
                alert("Cicilan pinjaman tidak boleh lebih dari total pinjaman");
                return false;
            }
        });
    });

</script>
@endsection
