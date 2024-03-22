@extends('admin.layouts.main')
@section('body')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Profile : {{ $user['profile'] }}
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="d-flex">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a>User</a></li>
                    <li class="breadcrumb-item"><a>Secret</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a>{{ $user['name'] ?? '' }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row row-cards">
            <div class="col-12">
                <form class="card" action="{{ route('secret.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h3 class="card-title">Update Secret</h3>
                        <div class="row row-cards">
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="hidden" value="{{ $user['.id'] }}" name="id">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $user['name'] ?? '' }}" id="name" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="pass" class="form-control"
                                        value="{{ $user['password'] ?? '' }}" id="pass" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="servicee">Service</label>
                                    <select name="servicee" class="form-control" required>
                                        <option selected>{{ $user['service'] }}</option>
                                        <option value="any">any</option>
                                        <option value="pppoe">pppoe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="profilee">Profile</label>
                                    <select name="profilee" id="profilee" class="form-control">
                                        <option selected>{{ $user['profile'] }}</option>
                                        @foreach ($profile as $data)
                                            <option>{{ $data['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label for="comment">Remote Address</label>
                                    <input type="text" name="remote" class="form-control"
                                        value="{{ $user['remote-address'] ?? '' }}" id="remote">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label for="comment">Comment</label>
                                    <input type="text" name="comment" id="comment" class="form-control" value="{{ $user['comment'] }}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class=" text-center">
                            <div class="row row-cards">
                                <button type="submit" class="btn btn-primary mt-3">Update Secret</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>

    </div>
    </div>
@endsection
