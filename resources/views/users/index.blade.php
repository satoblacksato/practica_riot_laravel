@extends('layouts.app')

@section('content')
{!! csrf_field(); !!}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>
              <div class="form-group col-md-7">
                <button type="button" id="btnCrear" class="btn btn-primary btn-xs" onclick="createOrUpdate(0)">Crear</button>
              </div>
              <div class="form-group col-md-5">
                <label class="form-label">Busqueda:</label>
                <input type="text"  id="scope" placeholder="Nombre" class="form-control" />
                <button class="btn btn-primary btn-xs" id="btnBuscar">Buscar</button>
              </div>
                <div class="panel-body" id="divTable">
                    @component('users.table')
                        @slot('users',$users)
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>

<user-form></user-form>

@endsection

@section('js')
<script src="{{ asset('js/riot/riot.min.js') }}"></script>
<script src="{{ asset('js/riot/riot-compiler.min.js') }}"></script>
<script src="/components/userform.tag" type="riot/tag"></script>
   <script src="{{ asset('js/users.js') }}"></script>


@endsection