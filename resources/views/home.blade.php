@extends('adminlte::page')
@section('title','Home')
@section('content')
<div class="content">
    
    <!--
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
        -->
        <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('flash'))
            {{session('flash')}}
            @endif
        </div>
        <div class="col-md-8">
         
           @if(session('id_compania')>0)
           @foreach ($companias as $compania)
                @if($compania->gUC_cveCia==session('id_compania'))
                compania asignada:{{ $compania->gOC_nombre }}
                @endif
         
           @endforeach
               
           @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Asignación de compañias') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('home.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Seleccionar Compañia') }}</label>

                            <div class="col-md-6">
                                <select id="compania" name="compania" class="form-control">
                                @foreach ($companias as $compania)
                                {{auth()->user()->id}}
                                {{$compania->gUC_usuario}}
                                    @if(auth()->user()->id==$compania->gUC_usuario)
                                     <option value="{{ $compania->gUC_cveCia }}">{{ $compania->gOC_nombre }}</option>
                                     @endif
                                     @endforeach
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Fecha') }}</label>

                            <div class="col-md-6">

                                <input id="fecha" type="date" class="form-control" name="fecha" value="{{$now }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Asignar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
<!-- Accediendo a un elemento-->
{{ auth()->user()->email }}<br>
{{ auth()->user() }}<br>

Mostrando roles 

@foreach ($companias as $compania)

@endforeach
</div>
@endsection
