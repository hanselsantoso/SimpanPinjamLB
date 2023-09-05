@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="container">
                <div class="header">
                    <h4>Penyimpanan - {{$user["name"]}}</h4>
                </div>
                <div class="content">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>No. Telp</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td> {{$item["name"] }}</td>
                                    <td> {{$item["email"] }}</td>
                                    <td> {{$item["telp"] }}</td>
                                    <td>
                                        <form action="" method="get">
                                            <input value="{{$item["id"]}}" type="hidden" name="idUser">
                                            <button class="btn btn-primary" style="text-justify: center">
                                                <span>View</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}

                        </tbody>
                      </table>
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Open Modal
            </button>
            <!-- Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Form Modal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- Your form goes here -->
                <form>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <!-- Add more form fields as needed -->
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
@endsection
