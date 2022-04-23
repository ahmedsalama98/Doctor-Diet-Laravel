@extends('admin.layouts.master')

@section('content')


    <div class="container-fluid">


        <div class="row g-4 mb-4" >

            {{-- users --}}

            <div class="col-6 col-lg-4">

                    <div class="app-card app-card-stat shadow-sm h-100 ">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">{{ __('site.total') .' '.__('site.users') }}</h4>
                            <div class="stats-figure">{{  number_format($users_count )}}</div>

                        </div>
                        <a class="app-card-link-mask" href="{{ route('admin.users.index') }}"></a>
                    </div>
            </div>
           {{-- users --}}


             {{-- admins --}}

            <div class="col-6 col-lg-4">

                    <div class="app-card app-card-stat shadow-sm h-100 ">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">{{ __('site.total') .' '.__('site.admins') }}</h4>
                            <div class="stats-figure">{{  number_format($admins_count )}}</div>

                        </div>
                        <a class="app-card-link-mask" href="{{ route('admin.admins.index') }}"></a>
                    </div>
            </div>
           {{-- admins --}}

            {{-- food_categories --}}

            <div class="col-6 col-lg-4">

                    <div class="app-card app-card-stat shadow-sm h-100 ">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">{{ __('site.total') .' '.__('site.food_categories') }}</h4>
                            <div class="stats-figure">{{  number_format($food_categories_count )}}</div>

                        </div>
                        <a class="app-card-link-mask" href="{{ route('admin.food_categories.index') }}"></a>
                    </div>
            </div>
           {{-- food_categories --}}


            {{-- foods --}}

            <div class="col-6 col-lg-4">

                    <div class="app-card app-card-stat shadow-sm h-100 ">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">{{ __('site.total') .' '.__('site.foods') }}</h4>
                            <div class="stats-figure">{{  number_format($foods_count )}}</div>

                        </div>
                        <a class="app-card-link-mask" href="{{ route('admin.foods.index') }}"></a>
                    </div>
            </div>
           {{-- foods --}}

          {{-- meal_categories --}}

            <div class="col-6 col-lg-4">

                    <div class="app-card app-card-stat shadow-sm h-100 ">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">{{ __('site.total') .' '.__('site.meal_categories') }}</h4>
                            <div class="stats-figure">{{  number_format($meal_categories_count )}}</div>

                        </div>
                        <a class="app-card-link-mask" href="{{ route('admin.meal_categories.index') }}"></a>
                    </div>
            </div>
           {{-- meal_categories --}}

           {{-- contacts --}}

            <div class="col-6 col-lg-4">

                    <div class="app-card app-card-stat shadow-sm h-100 ">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">{{ __('site.total') .' '.__('site.contacts') }}</h4>
                            <div class="stats-figure">{{  number_format($contacts_count )}}</div>

                        </div>
                        <a class="app-card-link-mask" href="{{ route('admin.contacts.index') }}"></a>
                    </div>
            </div>
           {{-- contacts --}}


        </div>




        <div class="row">
            <div class="col-12">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3 border-0">
                        <h4 class="app-card-title">{{ __('site.new_user_chart') }}</h4>
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <div class="chart-container">
                            <canvas id="myAreaChart" style="height: 220px" ></canvas>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div>


    </div>
@endsection

@push('script')

  <!-- Charts JS -->
  <script src="{{ asset('dashbaord_files/js/chart.min.js') }}"></script>
  <script src="{{ asset('dashbaord_files/js/index-charts.js') }}"></script>

  <script>
       let ctx = document.getElementById("myAreaChart");
    let r =Math.round(Math.random()* 255);
    let g =Math.round(Math.random()* 255);
    let b =Math.round(Math.random()* 255);
    let rgb = `rgb(${r} , ${g} ,${b})`;
let myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
        @foreach ($users_chart_labels as $label)
            "{{ $label }}",
        @endforeach
    ],
    datasets: [{
      label: "Users Count ",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: rgb,
      pointRadius: 3,
      pointBackgroundColor: rgb,
      pointBorderColor: rgb,
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [
        @foreach ($users_chart_data as $data)
            "{{ $data }}",
        @endforeach
      ],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 10
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 10,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            // return '$' + number_format(value);
            return value;
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,

    }
  }
});
  </script>
@endpush
