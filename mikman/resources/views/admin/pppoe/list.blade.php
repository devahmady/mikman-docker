@extends('admin.layouts.main')
@section('body')
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
      Isolir User Static ( Masih Deplopment )
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
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address List</th>
                            <th>Time </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($list) > 0)
                            @foreach ($list as $no => $data)
                                <tr>
                                    <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                    <td class="text-muted">{{ $no + 1 }}</td>
                                    <td>{{ $data['list'] }}</td>
                                    <td>{{ $data['address'] ?? '' }}</td>
                                    <td>{{ $data['creation-time'] }}</td>
                                    {{-- <td>
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
                                    </td> --}}
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
  </div>
    {{-- <div class="modal modal-blur fade" id="modal-list" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Isolir Static</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('list.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">List</label>
                                            <select name="lis" id="lis" class="form-select">
                                                @foreach ($list as $data)
                                                    <option value="{{ $data['list'] }}">{{ $data['list'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="adr" name="adr" placeholder="Enter address">
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
    </div> --}}
@endsection