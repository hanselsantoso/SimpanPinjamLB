@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="container">
                <div class="content">
                    <table id="tabelSHU" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama Pemegang SHU</th>
                            <th>Persentase</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($shu as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <input type="hidden" value="{{$item["id_pemegang_shu"]}}">
                                    <input type="hidden" value="{{$item["nama_pemegang_shu"]}}">
                                    <input type="hidden" value="{{$item["persentase_pemegang_shu"]}}">
                                    <td>{{$item["nama_pemegang_shu"]}}</td>
                                    <td>{{$item["persentase_pemegang_shu"]}}%</td>
                                    <td>
                                        @if ($item["status_pemegang_shu"] == 0)
                                            Non - Aktif
                                        @else
                                            Aktif
                                        @endif

                                    </td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateSHU" class="buttonEdit btn btn-warning" style="text-justify: center">
                                        <span>Ubah</span>
                                        </button>
                                        @if ($item["status_pemegang_shu"] == 0)
                                                <form action="/admin/aktifSHU" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id_pemegang_shu"]}}">
                                                    <button class="btn btn-success" style="text-justify: center">
                                                        <span>Aktifkan</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="/admin/deleteSHU" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id_pemegang_shu"]}}">
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

    <div class="modal fade" id="updateSHU">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Aturan Cicilan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/updateSHU" method="post">
                    @csrf
                    <input type="hidden" id="idUserSHU" name="idUserSHU" value="
                    ">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Persentase:</label>
                                <input type="number" class="form-control" name="persentase" id="persentaseUpdate" >
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
        var table = $('#tabelSHU').DataTable({
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
            let persentase = data[2];
            $("#persentaseUpdate").val(persentase);
            $('#idUserSHU').val(id)
        });
    });

</script>
@endsection
