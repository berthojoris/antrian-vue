@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create Antrian Pesanan</div>
                
                <div class="card-body">
                    @include('flash::message')
                    <form action="{{ url('create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tableID">Table ID</label>
                            <input autocomplete="off" type="text" class="form-control" id="table_id" placeholder="Enter table id" name="table_id">
                        </div>
                        <div class="form-group">
                            <label for="tableID">Table Menu</label><hr>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="menu[]" value="NASI">
                                <label class="form-check-label">NASI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="menu[]" value="CUMI TEPUNG">
                                <label class="form-check-label">CUMI TEPUNG</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="menu[]" value="IKAN BAKAR">
                                <label class="form-check-label">IKAN BAKAR</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="menu[]" value="ES TEH MANIS">
                                <label class="form-check-label">ES TEH MANIS</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
