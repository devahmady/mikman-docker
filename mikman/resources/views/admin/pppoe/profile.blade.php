@extends('admin.layouts.main')
@section('body')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                PPPoE Profile
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="d-flex">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a>ppp</a></li>
                    <li class="breadcrumb-item"><a>profile</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-12">
        <form class="card" method="post" action="{{ route('add.profile.pppoe') }}">
            @csrf
            <div class="card-body">
                <h3 class="card-title">Add Profile</h3>
                <div class="row row-cards d-flex justify-content-center ">
                    <div class="col-sm-3 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Local Address</label>
                            <select name="local" class="form-control" required>
                                <option>none</option>
                                <option>{{ $data['name'] }}</option>
                                @foreach ($pool as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Remote Address</label>
                            <select name="remote" class="form-control" required>
                                <option>none</option>
                                <option>{{ $data['name'] }}</option>
                                @foreach ($pool as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Parent Queue</label>
                            <select name="parentqq" id="parentqq" class="form-select">
                                <option>none</option>
                                @foreach ($parent as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Rite Limit (rx/tx)</label>
                            <input type="text" class="form-control" id="ratelimit" name="ratelimit">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Isolir Mode</label>
                            <select name="isolirmode" id="isolirmode" class="form-select">
                                <option>none</option>
                                <option value="isolir">Auto Isolir</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Expired</label>
                            <input type="text" class="form-control" id="validity" name="validity">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <div class="mt-1">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Local Address</th>
                                    <th>Remote Address </th>
                                    <th>parent queue</th>
                                    <th>Rite Limit (rx/tx)</th>
                                    <th>Isolirmode</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($profile) > 0)
                                    @foreach ($profile as $key => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td>{{ $data['name'] }}</td>
                                            <td>{{ $data['local-address'] ?? 'none' }}</td>
                                            <td>{{ $data['remote-address'] }}</td>
                                            <td>{{ $data['parent-queue'] ?? 'none' }}</td>
                                            <td>{{ $data['rate-limit'] }}</td>
                                            <td>
                                                @if (isset($detail[$key]))
                                                    {{ $detail[$key]['isolirmode'] }}
                                                @else
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('dellprofile', ['id' => $data['.id']]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-trash" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="4" y1="7" x2="20" y2="7">
                                                        </line>
                                                        <line x1="10" y1="11" x2="10" y2="17">
                                                        </line>
                                                        <line x1="14" y1="11" x2="14" y2="17">
                                                        </line>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">profile not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
