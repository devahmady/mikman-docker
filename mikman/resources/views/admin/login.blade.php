<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mikman</title>
    <!-- CSS files -->
    <link href="{{ asset('mikman') }}/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="{{ asset('mikman') }}/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
    <link href="{{ asset('mikman') }}/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
    <link href="{{ asset('mikman') }}/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
    <link href="{{ asset('mikman') }}/css/demo.min.css?1684106062" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('mikman') }}/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark"></a>
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4"><img src="{{ asset('mikman') }}/img/mikman.png"
                                        height="36" alt="mikman"></h2>
                                <form action="{{ route('login.page') }}" method="post" autocomplete="off">
                                  @csrf
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-prompt" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <polyline points="5 7 10 12 5 17"></polyline>
                                                    <line x1="13" y1="17" x2="19" y2="17">
                                                    </line>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Small"
                                            aria-describedby="inputGroup-sizing-sm" name="ip" 
                                            placeholder="IP Router" required>
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-user-circle" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="12" cy="12" r="9"></circle>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                    <path
                                                        d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Small"
                                            aria-describedby="inputGroup-sizing-sm" name="user" 
                                            placeholder="Username">
                                    </div>
                                    <div class="input-group input-group-flat">
                                        <input type="password" class="form-control" placeholder="Your password"
                                            autocomplete="off" name="password" >
                                        <span class="input-group-text">
                                            <a href="#" class="link-secondary" data-bs-toggle="tooltip"
                                                aria-label="Show password"
                                                data-bs-original-title="Show password">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                    </path>
                                                </svg>
                                            </a>
                                        </span>
                                    </div>

                                    <div class="form-footer">
                                      <button type="submit" id="submitBtnLogin" class="btn btn-primary w-100" onclick="showLoading()">Login</button>
                                      <div id="loadinglogin" class="d-none text-center mt-3">
                                          <div class="spinner-border text-primary" role="status">
                                          </div>
                                          <span class="visually-hidden">Loading...</span>
                                      </div>
                                  </div>
                                  <script>
                                      function showLoading() {
                                          document.getElementById('submitBtnLogin').style.display = 'none';
                                          document.getElementById('loadinglogin').classList.remove('d-none');
                                      }
                                  </script>
                                </form>
                            </div>
                            <div class="hr-text">Follow Me</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><a href="https://www.facebook.com/bale.hotspot" class="btn w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-brand-facebook" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                            </svg>
                                            Balehotspot
                                        </a></div>
                                    <div class="col"><a href="https://github.com/devahmady" class="btn w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-brand-github" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                                            </svg>
                                            Github
                                        </a></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-muted mt-3">
                          Do you want to buy a VPN remote? <a href="https://wa.me/6287864014990" tabindex="-1">Contact me</a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <script src="{{ asset('mikman') }}/js/tabler.min.js?1684106062" defer></script>
    <script src="{{ asset('mikman') }}/js/demo.min.js?1684106062" defer></script>
</body>

</html>
