@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Antrian Pesanan</div>
                
                <div class="card-body">
                    @include('flash::message')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID Meja</th>
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->table_id }}</td>
                                    <td>{{ Str::limit($data->table_name, 10, '...')}}</td>
                                    <td>
                                        <a href="{{ url('editstatus/'.$data->id.'/status/siap') }}" class="btn btn-warning">SIAP</a>
                                        <a href="{{ url('editstatus/'.$data->id.'/status/selesai') }}" class="btn btn-success">SELESAI</a>
                                        <a href="{{ url('delete/'.$data->id) }}" class="btn btn-danger">DELETE</a>
                                    </td>
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
