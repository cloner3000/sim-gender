@extends('layouts.master')

@section('title')
    <title>Kependudukan : Sistem Informasi Statistik Kabupaten Tangerang</title>
    <script type="text/javascript" src="{{ asset('/') }}chartjs/Chart.bundle.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}chartjs/util.js"></script>
    <style>
        .left-margin-for-header {
            margin-left: 27px;
        }
    </style>
@endsection

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="content-group">
                <div class="page-header page-header-default" style="border: 1px solid #ddd; border-bottom: 0;">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h5>
                                <i class="icon-arrow-left52 position-left"></i>
                                <span class="text-semibold">Subyek: {{ $kategori->subyek->nama_subyek }}</span><br> 
                                <span class="left-margin-for-header">{{ $kategori->judul }} Tahun {{ $tahun }}</span>
                            </h5>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                    </div>
                    
                    <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('subyek.index', $kategori->subyek->nama_subyek) }}"><<&nbsp; Kembali</a></li>
                        </ul>

                            <ul class="breadcrumb-elements">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown">
                                        <i class="icon-calendar position-left"></i>
                                        Tahun {{ $tahun }}
                                        <span class="caret"></span>
                                    </a>
                                    
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if ($tahun_tersedia->count()!=0)
                                            @foreach ($tahun_tersedia as $item)
                                                <li><a href="{{ route('politik-umur.index', [$kategori->id, $item]) }}">{{ $item }}</a></li>
                                            @endforeach
                                        @else
                                            <li><a href="{{ route('politik-umur.index', [$kategori->id, date('Y')]) }}">{{ date('Y') }}</a></li>
                                        @endif
                                    </ul>
                                </li>
                        @if (Auth::check())

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown">
                                        <i class="icon-cog5 position-left"></i>
                                        Aksi
                                        <span class="caret"></span>
                                    </a>
                                    
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('politik-umur.create', [$kategori->id, $tahun]) }}">Tambah Data Baru</a></li>
                                        <li><a href="{{ route('politik-umur.edit', [$kategori->id, $tahun]) }}">Ubah Data {{ $tahun }}</a></li>
                                    </ul>
                                </li>
                                @endif
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Grafik</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
    
            <div class="panel-body">
                <div class="chart-container">
                    <div id="container" style="width: 100%; height:auto;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-flat">
            @php
                $umur_17 = 0;
                $umur_24 = 0;
                $umur_59 = 0;
                $umur_60 = 0;
            @endphp
            @foreach ($data as $key => $item)
                @php
                    $umur_17 += $item->umur_17;
                    $umur_24 += $item->umur_24;
                    $umur_59 += $item->umur_59;
                    $umur_60 += $item->umur_60;
                @endphp
            @endforeach

            <div style="margin:20px 0 0 20px;">
                <h6>Total Jumlah Umur 0-17 : &nbsp;&nbsp;<strong>{{ $umur_17 }}</strong></h6>
                <h6>Total Jumlah Umur 18-25 : &nbsp;&nbsp;<strong>{{ $umur_24 }}</strong></h6>
                <h6>Total Jumlah Umur 26-59 : &nbsp;&nbsp;<strong>{{ $umur_59 }}</strong></h6>
                <h6>Total Jumlah Umur 60++ : &nbsp;&nbsp;<strong>{{ $umur_60 }}</strong></h6>
            </div>

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th style="width:30px;">#</th>
                        <th>Jenis Kelamin</th>
                        <th>Umur 0-17</th>
                        <th>Umur 18-25</th>
                        <th>Umur 26-59</th>
                        <th>Umur 60++</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key = $key + 1 }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->umur_17 }}</td>
                            <td>{{ $item->umur_24 }}</td>
                            <td>{{ $item->umur_59 }}</td>
                            <td>{{ $item->umur_60 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /basic datatable -->
    </div>
@endsection

@section('footscript')
    <script>
        $('.datatable-basic').DataTable({
            autoWidth: false,
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });
    </script>

    <script>
		var color = Chart.helpers.color;
		var horizontalBarChartData = {
			labels: [
                @foreach($chart_jk as $item)
                    '{{ $item }}',
                @endforeach
            ],
			datasets: [{
				label: 'Umur 0-17',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
					@foreach($chart_17 as $item)
                        {{ $item }},
                    @endforeach
				]
			}, {
				label: 'Umur 18-25',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					@foreach($chart_25 as $item)
                        {{ $item }},
                    @endforeach
				]
			}, {
				label: 'Umur 26-59',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
					@foreach($chart_59 as $item)
                        {{ $item }},
                    @endforeach
				]
			}, {
				label: 'Umur 60++',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					@foreach($chart_60 as $item)
                        {{ $item }},
                    @endforeach
				]
			}]
		};

		window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
			window.myHorizontalBar = new Chart(ctx, {
				type: 'horizontalBar',
				data: horizontalBarChartData,
				options: {
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Grafik {{ $kategori->judul }}'
                    },
                    maintainAspectRatio: false,
				}
			});

		};
	</script>
@endsection