@extends('admin.layouts.main')
@section('body')
<div class="row g-2 align-items-center">
    <div class="col">
        <h2 class="page-title">
           List Users Isolir
        </h2>
    </div>
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
        <div class="d-flex">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item"><a>Secret</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Isolir</a></li>
            </ol>
        </div>
    </div>
</div>
    <div class="mt-2">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('pppoe.secret.toggle') }}">
                            @csrf
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Password</th>
                                        <th>Remote Address </th>
                                        <th>Profile </th>
                                        <th>service </th>
                                        {{-- <th>Mode</th>
                                        <th>status</th> --}}
                                        <th>Comment</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($secret) > 0)
                                        @foreach ($secret as $data)
                                            <tr>
                                                <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                                <td>{{ $data['name'] }}</td>
                                                <td>{{ $data['password'] }}</td>
                                                <td>{{ $data['remote-address'] ?? 'none' }}</td>
                                                <td>{{ $data['profile'] }}</td>
                                                <td>{{ $data['service'] }}</td>
                                                {{-- <td>
                                                    <button type="button" class="btn btn-sm btn-toggle"
                                                        data-id="{{ $data['.id'] }}"
                                                        data-status="{{ $data['disabled'] == 'true' ? 'disable' : 'enable' }}">
                                                        {{ $data['disabled'] == 'true' ? 'Disable' : 'Enable' }}
                                                    </button>
                                                </td>
                                                <td id="status{{ $no }}">
                                                    {{ $data['disabled'] == 'false' ? 'Enable' : 'Disable' }}</td> --}}
                                                <td>{{ $data['comment'] }}</td>
                                                <td>
                                                    <a href="{{ route('dellsecret', ['id' => $data['.id']]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-trash" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </a>
                                                    <a href="/update/secret/edit/{{ $id  }}" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                            <path d="M16 5l3 3" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Secret not found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- edit --}}
    <div class="modal modal-blur fade" id="modal-profile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Secret</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/update/isolir/{{ $data['.id'] }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <select name="profilee" id="profilee" class="form-select">
                                                    @foreach ($profile as $data)
                                                        <option value="{{ $data['name'] }}">
                                                            {{ $data['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Comment </label>
                                            <input type="text" class="form-control" id="comment" name="comment" value="{{ $secret[0]['comment'] }}">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    @endsection
