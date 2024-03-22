@extends('admin.layouts.main')
@section('body')
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
      PPPoE Server
      </h2>
    </div>
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
      <div class="d-flex">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
          <li class="breadcrumb-item"><a>ppp</a></li>
          <li class="breadcrumb-item"><a>server</a></li>
        </ol>
      </div>
    </div>
  </div>
    <div class="col-lg-12">
        <div class="row row-cards">
            <div class="col-12">
                <form class="card" method="post" action="{{ route('add.server') }}">
                    @csrf
                    <div class="card-body">
                        <h3 class="card-title">Add Server</h3>
                        <div class="row row-cards">
                            <div class="col-sm-6 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Serive Name</label>
                                    <input type="text" class="form-control" id="service" name="service">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Interface</label>
                                    <select class="form-control form-select" id="name" name="name">
                                        @foreach ($interface as $data)
                                            <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div style="padding: 10px;">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-12 mt-1">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Service Name</th>
                                    <th>Interface</th>
                                    <th>Default profile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($server) > 0)
                                    @foreach ($server as $no => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $data['service-name'] }}</td>
                                            <td class="text-muted">{{ $data['interface'] }}
                                            <td>{{ $data['default-profile'] }}</td>
                                            <td>
                                                <a href="{{ route('delserver', ['id' => $data['.id']]) }}">
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
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">server not found</td>
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
