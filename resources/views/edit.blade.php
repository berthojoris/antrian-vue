@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Antrian Pesanan</div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID Meja</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->table_id }}</td>
                                    <td><a href="{{ url('editstatus/'.$data->id.'/status/packing') }}" class="btn btn-warning">PACKING</a></td>
                                    <td><a href="{{ url('editstatus/'.$data->id.'/status/selesai') }}" class="btn btn-success">SELESAI</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
