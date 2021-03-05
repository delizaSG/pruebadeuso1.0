@extends('adminlte::page')
@section('title','Home')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12" style="color:red">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                           
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
Asignacion de companias a usuarios
Compania
                            {{   $value = session('id_compania')}}

</div>
@endsection