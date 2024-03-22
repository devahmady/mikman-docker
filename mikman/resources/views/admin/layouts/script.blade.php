<script src="{{ asset('mikman') }}/js/tabler.min.js?1668287865" defer></script>
<script src="{{ asset('mikman') }}/js/demo-theme.min.js?1684106062"></script>
<script src="{{ asset('mikman') }}/js/apexcharts.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        document.getElementById('reset').addEventListener('click', function() {
            Swal.fire({
                title: "Choose options for reset:",
                input: 'select',
                inputOptions: {
                    'caps-mode': 'CAPS Mode',
                    'keep-users': 'Keep Users',
                    'run-after-reset': 'Run After Reset',
                    'skip-backup': 'Skip Backup',
                    'force-v6-to-v7-configuration-upgrade': 'Force Upgrade',
                    'no-defaults': 'No Defaults',
                    'shutdown': 'Shutdown'
                },
                inputPlaceholder: 'Select an option',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, reset it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var selectedOption = result.value;
                    resetSystem(selectedOption);
                }
            });
        });

        function resetSystem(selectedOption) {
            $.ajax({
                url: '{{ route('reset') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    option: selectedOption
                },
                success: function(response) {
                    Swal.fire({
                        title: "Reset!",
                        text: "Your system has been Reset.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = '/';
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to reset the system. Please try again.",
                        icon: "error"
                    });
                }
            });
        }


        $(document).on('click', '#reboot', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Sure Reboot the mikrotik routerboard!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, reboot it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('reboot') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Rebooted!",
                                text: "Your system has been rebooted.",
                                icon: "success"
                            }).then(() => {
                                window.location.href = '/';
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to reboot the system. Please try again.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '#logout', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Sure logout the mikrotik routerboard!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, logout it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('logout') }}',
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Logged out!",
                                text: "Your system has been logged out.",
                                icon: "success"
                            }).then(() => {
                                window.location.href =
                                    '{{ route('home') }}';
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to logout the system. Please try again.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });




    });
</script>

<script>
    function convertToReadableFormat(bytes) {
        var sizes = ['Bytes', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (!bytes) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }

    $(document).ready(function() {

        var options = {
            series: [{
                name: 'Mikman Traffic TX',
                data: []
            }, {
                name: 'Mikman Traffic RX',
                data: []
            }],
            chart: {
                height: 350,
                type: 'area',
                animations: {
                    enabled: true, // Aktifkan animasi
                    easing: 'linear', // Gunakan jenis easing yang diinginkan (opsi: linear, easein, easeout, easeinout)
                    speed: 200, // Atur kecepatan animasi (dalam milidetik)
                    animateGradually: {
                        enabled: true,
                        delay: 150 // Tunda animasi untuk setiap data baru (dalam milidetik)
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 200 // Atur kecepatan animasi dinamis
                    }
                },
                events: {
                    mounted: function(chartContext, config) {
                        setInterval(function() {
                            requestData();
                        }, 3000);
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(value) {
                    return convertToReadableFormat(value);
                }
            },
            stroke: {
                curve: 'smooth'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return convertToReadableFormat(value);
                    }
                }
            },
            xaxis: {
                type: 'datetime',
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#graph"), options);
        chart.render();

        $(document).ready(function() {
            $('#interface').on('change', function() {
                requestData();
            });
        });

        function requestData() {
            var selectedInterface = $("#interface").val();
            var rx = parseInt(document.getElementById('nilaiRX').value);
            var tx = parseInt(document.getElementById('nilaiTX').value);

            $.ajax({
                url: "{{ url('graf') }}/" + selectedInterface,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        var TX = parseInt(data[0].data[0]);
                        var RX = parseInt(data[1].data[0]);
                        var x = new Date().getTime();
                        if (chart.w.config.series[0].data.length > 10) {
                            chart.w.config.series.forEach(series => {
                                series.data
                                    .shift(); 
                            });
                        }
                        chart.appendData([{
                            data: [{
                                x: x,
                                y: TX
                            }]
                        }, {
                            data: [{
                                x: x,
                                y: RX
                            }]
                        }]);

                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                    console.error("Error: " + errorThrown);
                }
            });
        }

    });
</script>

<script>
    $(document).ready(function() {
        $('.btn-toggle').click(function() {
            var button = $(this);
            var id = button.data('id');
            var status = button.data('status');
            if (status === 'disable') {
                status = 'enable';
                button.text('Enable');
            } else {
                status = 'disable';
                button.text('Disable');
            }
            button.data('status', status);
            $.ajax({
                type: "POST",
                url: "{{ route('pppoe.secret.toggle') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    action: status,
                    secret_ids: [id]
                },
                success: function(response) {
                    var button = $('.btn-toggle[data-id="' + id + '"]');
                    var status = button.data('status');
                    var newStatus = (status === 'enable') ? 'enable' : 'enable';
                    button.text((newStatus === 'enable') ? 'Enable' : 'Disable');
                    button.data('status', newStatus);
                    $('#status' + id).text((newStatus === 'enable') ? 'Enable' : 'Disable');
                    Swal.fire(
                        'Berhasil!',
                        'PPPoE Secret berhasil ' + newStatus + 'd.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
