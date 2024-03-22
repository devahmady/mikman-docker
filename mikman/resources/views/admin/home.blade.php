@extends('admin.layouts.main',['menu' => 'dashboard'])
@section('title', 'Dashboard')
@section('body')
    <div class="page-header d-print-none">
        <div class="container">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <span class="status-indicator status-green status-indicator-animated">
                        <span class="status-indicator-circle"></span>
                        <span class="status-indicator-circle"></span>
                        <span class="status-indicator-circle"></span>
                    </span>
                </div>
                <div class="col mt-1">
                    <h2 class="page-title">
                        {{ $name }}
                    </h2>
                    <div class="text-muted">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><span class="text-green">Up</span></li>
                            <li class="list-inline-item">{{ $when ??''}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        @if (session('alert'))
                            <div class="alert alert-warning">
                                {{ session('alert') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('reset') }}">
                            @csrf
                            <button type="button" class="btn" id="reset">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                                Reset
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('reboot') }}">
                            @csrf
                            <button type="submit" class="btn" id="reboot">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                                    </path>
                                    <path
                                        d="M14 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z">
                                    </path>
                                </svg>
                                Reboot
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-deck row-cards mt-1">
        <div class="col-lg ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader"> <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-rotate-clockwise" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                            </svg> system date & time</div>
                    </div>



                    <div class=" mb-1">
                        <div>Time & date : {{ $date }} {{ $time }} </div>
                        <span>Uptime : {{ $uptime }} </span>
                        <div>Time Zone : {{ $zone }} </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader"> <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-info-circle" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                            </svg> Info</div>
                    </div>
                    <div class=" mb-1">
                        <div>Name : {{ $platform }} </div>
                        <div>Model : {{ $model }} </div>
                        <div>Router OS : {{ $version }} </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 ">
            <div class="row row-cards">
                <div class="col-sm-3 ">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-twitter text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wifi"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                            <path d="M9.172 15.172a4 4 0 0 1 5.656 0"></path>
                                            <path d="M6.343 12.343a8 8 0 0 1 11.314 0"></path>
                                            <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium" id="hsup">
                                        {{ $hotspot_active }}
                                    </div>
                                    <div class="text-muted">
                                        Hotspot Active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-facebook text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium" id="hsuser">
                                        {{ $hotspot_user }}
                                    </div>
                                    <div class="text-muted">
                                        Users Hotspot
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-twitter text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-network" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 9a6 6 0 1 0 12 0a6 6 0 0 0 -12 0" />
                                            <path d="M12 3c1.333 .333 2 2.333 2 6s-.667 5.667 -2 6" />
                                            <path d="M12 3c-1.333 .333 -2 2.333 -2 6s.667 5.667 2 6" />
                                            <path d="M6 9h12" />
                                            <path d="M3 20h7" />
                                            <path d="M14 20h7" />
                                            <path d="M10 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium" id="hsup">
                                        {{ $ppp_active }}
                                    </div>
                                    <div class="text-muted">
                                        PPPoE Active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-facebook text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-password-user" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 17v4" />
                                            <path d="M10 20l4 -2" />
                                            <path d="M10 18l4 2" />
                                            <path d="M5 17v4" />
                                            <path d="M3 20l4 -2" />
                                            <path d="M3 18l4 2" />
                                            <path d="M19 17v4" />
                                            <path d="M17 20l4 -2" />
                                            <path d="M17 18l4 2" />
                                            <path d="M9 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path d="M7 14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium" id="hsuser">
                                        {{ $ppp_user }}
                                    </div>
                                    <div class="text-muted">
                                        Users PPPoE
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <p class="mb-3">Total Storage : <strong> {{ \App\Routers\Bytes::bytes($total_hdd, 2) }} </strong>
                        <div class="progress progress-separated mb-3">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $cpu_load }}%"
                                aria-label="cpu">{{ $cpu_load }}% - {{ $frequency }} MHz</div>
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ \App\Routers\Bytes::bytes3($free_memory, 2) }}%;" aria-label="memory">
                                {{ \App\Routers\Bytes::bytes($free_memory, 2) }}</div>
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ \App\Routers\Bytes::bytes($free_hdd, 2) }}" aria-label="hdd">
                                {{ \App\Routers\Bytes::bytes($free_hdd, 2) }}</div>
                        </div>
                    <div class="row">
                        <div class="col-auto d-flex align-items-center pe-2">
                            <span class="legend me-2 bg-primary"></span>
                            <span>Cpu Load</span>
                            <span
                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ $cpu_load }}%</span>
                        </div>
                        <div class="col-auto d-flex align-items-center px-2">
                            <span class="legend me-2 bg-info"></span>
                            <span>Free Memory</span>
                            <span
                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ \App\Routers\Bytes::bytes($free_memory, 2) }}</span>
                        </div>
                        <div class="col-auto d-flex align-items-center px-2">
                            <span class="legend me-2 bg-success"></span>
                            <span>Free Hdd</span>
                            <span
                                class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ \App\Routers\Bytes::bytes($free_hdd, 2) }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="card">
                <div class="card-body">
                    <select name="interface" id="interface" onchange="requestData()">
                        @foreach ($ether1 as $item)
                            <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <div id="graph" style="min-height: 300px;"></div>
                </div>
            </div>
            <input type="hidden" id="nilaiRX" value="{{ \App\Routers\Bytes::bytes($rx, 2) }}">
            <input type="hidden" id="nilaiTX" value="{{ \App\Routers\Bytes::bytes($tx, 2) }}">
        </div>

        <div class="col-lg-6 ">
            <div class="card" style="height: 28rem">
                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                    {{-- @dd($loghs) --}}
                    <h3 class="card-title">Log Hotspot</h3>
                    @foreach ($loghs as $data)
                        <ul class="steps steps-vertical">
                            <li class="step-item">
                                <div class="h4 m-0">{{ $data['iphotspot'] }} -> {{ $data['time'] }}</div>
                                <div class="text-muted">{{ $data['message'] }}</div>
                            </li>

                        </ul>
                    @endforeach

                </div>
                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                    <h3 class="card-title">Log PPPoE</h3>
                    @foreach ($logppp as $data)
                        <ul class="steps steps-vertical">
                            <li class="step-item">
                                <div class="h4 m-0">{{ $data['userpppp'] }} -> {{ $data['time'] }}</div>
                                <div class="text-muted">{{ $data['message'] }}</div>
                            </li>

                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
