<div class="navbar">
    <div class="container-xl">
        <ul class="navbar-nav">
         
            <li class="nav-item nav-item ">
                <a class="nav-link" href="/dashboard">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Dashboard
                    </span>
                </a>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-router"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="3" y="13" width="18" height="8" rx="2"></rect>
                            <line x1="17" y1="17" x2="17" y2="17.01"></line>
                            <line x1="13" y1="17" x2="13" y2="17.01"></line>
                            <line x1="15" y1="13" x2="15" y2="11"></line>
                            <path d="M11.75 8.75a4 4 0 0 1 6.5 0"></path>
                            <path d="M8.5 6.5a8 8 0 0 1 13 0"></path>
                        </svg>
                    </span>
                    <span class="nav-link ">
                        PPPoE
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('pppoe.server') }}">
                                Add Server
                            </a>
                            <a class="dropdown-item" href="{{ route('secret.pppoe') }}">
                                Secret
                            </a>
                            <a class="dropdown-item" href="{{ route('pppoe.profile') }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('active.pppoe') }}">
                                Active
                            </a>
                           


                        </div>
                    </div>
                </div>
            </li>
          
            <li class="nav-item dropdown ">
                <a class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        </svg>
                    </span>
                    <span class="nav-link ">
                        Isolir Client
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                            <a class="dropdown-item" href="{{ route('isolir.pppoe') }}">
                                PPPoE
                            </a>
                            <a class="dropdown-item" href="{{ route('list.address') }}">
                                Static
                            </a>
                        </div>
                    </div>
                </div>
            </li>

        </ul>

    </div>
</div>
