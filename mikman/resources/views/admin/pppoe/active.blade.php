@extends('admin.layouts.main')
@section('body')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Client Active PPPoE
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="d-flex">
                <a href="{{ route('secret.pppoe') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                    New user
                </a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>service</th>
                            <th>Remote Address </th>
                            <th>Uptime </th>
                            <th>Caller id </th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($active) > 0)
                            @foreach ($active as $no => $data)
                                <tr>
                                    <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                    <td class="text-muted">{{ $no + 1 }}</td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['service'] }}</td>
                                    <td>{{ $data['address'] ?? 'none' }}</td>
                                    <td>{{ $data['uptime'] }}</td>
                                    <td>{{ $data['caller-id'] }}</td>
                                    <td>
                                        <a href="{{ route('dellactive', ['id' => $data['.id']]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">User Online not found</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
