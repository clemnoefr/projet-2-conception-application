@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div id="cercle_temp">
                        <div id="temperature">
                            <?php echo "17º"; ?>
                        </div>
                    </div>
                    <div id="cercle_humi">
                        <div id="humiditer">
                            <?php
                            echo "43%";
                            ?>
                        </div>
                    </div>
                    <canvas id="myChart" width="50%" height="50%"></canvas>
                    
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection

@section('JS')
<script src="{{asset('js/test.js')}}"></script>
@endsection