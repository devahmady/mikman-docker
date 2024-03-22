@extends('admin.layouts.main')
@section('body')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Ping Dns
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <h4>
                            Check Dns
                        </h4>
                        <div>
                            <!-- Tambahkan formulir untuk memasukkan DNS -->
                            <form method="post" action="{{ route('ping') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="dns" name="dns" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-1">Ping</button>
                            </form>
                        </div>
                    </div>
                    @if (isset($ping_result))
                        <div class="card-footer">
                            <h4>Ping Tester:</h4>
                            <pre>{{ $ping_result }}</pre>
                        </div>
                        <div class="card-footer">
                            <h4>Dns Info:</h4>
                            <pre>{{ $nslookup_result }}</pre>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
