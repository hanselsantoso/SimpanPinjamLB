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
                            <th>Maximal Tabungan</th>
                            <th>Bunga Simpanan(%)</th>
                            <th>Bunga Pinjaman(%)</th>
                            <th>Cicilan (kali)</th>
                            <th>Pinjaman (%)</th>
                            <th>Iuran Wajib</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($aturan as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <input type="hidden" value="{{$item["id"]}}">
                                    <input type="hidden" value="{{$item["minimal_tabungan"]}}">
                                    <input type="hidden" value="{{$item["maximal_tabungan"]}}">
                                    <input type="hidden" value="{{$item["id_bunga"]}}">
                                    <input type="hidden" value="{{$item["id_pinjaman"]}}">
                                    <input type="hidden" value="{{$item["id_iuran"]}}">
                                    <input type="hidden" value="{{$item["id_cicilan"]}}">
                                    <input type="hidden" value="{{$item["id_bunga_pinjaman"]}}">
                                    <td>{{format_idr($item["minimal_tabungan"])}}</td>
                                    <td>{{format_idr($item["maximal_tabungan"])}}</td>
                                    <td>{{$item->bunga["bunga"]}}</td>
                                    <td>{{$item->bungaPinjaman["bunga_pinjaman"]}}</td>
                                    <td>{{$item->cicilan["cicilan"]}}</td>
                                    <td>{{$item->pinjaman["pinjaman"]}}</td>
                                    <td>{{ format_idr( $item->iuran["iuran"])}}</td>
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
                                            @if ($item["status"] == 0)
                                                <form action="/admin/aktifAturan" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item["id"]}}">
                                                    <button class="btn btn-success" style="text-justify: center">
                                                        <span>Aktifkan</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="/admin/deleteAturan" method="post">
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
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Minimal Simpanan:</label>
                                <input type="number" class="form-control" name="minimalSimpanan" id="minimalSimpanan">
                            </div>

                            <div class="col-6">
                                <label for="name">Maximal Simpanan:</label>
                                <input type="number" class="form-control" name="maximalSimpanan" id="maximalSimpanan">
                            </div>


                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Besar Bunga Simpanan(%):</label>
                                <select class="form-control" name="bunga" id="bunga">
                                    @foreach ($bunga as $item)
                                        <option value="{{$item["id"]}}">{{$item["bunga"]}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="name">Besar Bunga Pinjaman(%):</label>
                                <select class="form-control" name="bungaPinjaman" id="bungaPinjaman">
                                    @foreach ($bungaPinjaman as $item)
                                        <option value="{{$item["id"]}}">{{$item["bunga_pinjaman"]}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Besar Pinjaman (%):</label>
                                <select class="form-control" name="pinjaman" id="pinjaman">
                                    @foreach ($pinjaman as $item)
                                        <option value="{{$item["id_pinjaman"]}}">{{$item["pinjaman"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="name">Lama cicilan:</label>
                                <select class="form-control" name="cicilan" id="cicilan">
                                    @foreach ($cicilan as $item)
                                        <option value="{{$item["id_cicilan"]}}">{{$item["cicilan"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="name">Besar Iuran Bulanan:</label>
                            <select class="form-control" name="iuran" id="iuran">
                                @foreach ($iuran as $item)
                                    <option value="{{$item["id_iuran"]}}">{{$item["iuran"]}}</option>
                                @endforeach
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
                    <h4 class="modal-title">Ubah Aturan Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin/updateAturan" method="post">
                    @csrf
                    <input type="hidden" id="idUserSimpanan" name="idUserSimpanan" value="
                    ">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Minimal Simpanan:</label>
                                <input type="number" class="form-control" name="minimalSimpanan" id="minimalSimpananUpdate">
                            </div>

                            <div class="col-6">
                                <label for="name">Maximal Simpanan:</label>
                                <input type="number" class="form-control" name="maximalSimpanan" id="maximalSimpananUpdate">
                            </div>


                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Besar Bunga Simpanan(%):</label>
                                <select class="form-control" id="bungaUpdate" name="bunga">
                                    @foreach ($bunga as $item)
                                        <option value="{{$item["id"]}}">{{$item["bunga"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="name">Besar Bunga Pinjaman(%):</label>
                                <select class="form-control" name="bungaPinjaman" id="bungaPinjamanUpdate">
                                    @foreach ($bungaPinjaman as $item)
                                        <option value="{{$item["id"]}}">{{$item["bunga_pinjaman"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Besar Pinjaman (%):</label>
                                <select class="form-control" id="pinjamanUpdate" name="pinjaman">
                                    @foreach ($pinjaman as $item)
                                        <option value="{{$item["id_pinjaman"]}}">{{$item["pinjaman"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="name">Lama cicilan:</label>
                                <select class="form-control" id="cicilanUpdate" name="cicilan">
                                    @foreach ($cicilan as $item)
                                        <option value="{{$item["id_cicilan"]}}">{{$item["cicilan"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="name">Besar Iuran Bulanan:</label>
                            <select class="form-control" id="iuranUpdate" name="iuran">
                                @foreach ($iuran as $item)
                                    <option value="{{$item["id_iuran"]}}">{{$item["iuran"]}}</option>
                                @endforeach
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
            var hiddenInputs = row.find('input[type="hidden"]');
            var data = [];
            hiddenInputs.each(function() {
                var value = $(this).val();
                data.push(value);
            });
            console.log(data);
            let id = data[0];
            let minimalTabungan = data[1];
            let maximalTabungan = data[2];
            let bunga = data[3];
            let pinjaman = data[4];
            let iuran = data[5];
            let cicilan = data[6];
            let bungaPinjaman = data[7];
            $('#idUserSimpanan').val(id).change();
            $("#minimalSimpananUpdate").val(minimalTabungan);
            $("#maximalSimpananUpdate").val(maximalTabungan);
            $('#bungaUpdate').val(bunga).change();
            $('#pinjamanUpdate').val(pinjaman).change();
            $('#iuranUpdate').val(iuran).change();
            $('#cicilanUpdate').val(cicilan).change();
            $('#bungaPinjamanUpdate').val(bungaPinjaman).change();
        });
    });

</script>
@endsection
