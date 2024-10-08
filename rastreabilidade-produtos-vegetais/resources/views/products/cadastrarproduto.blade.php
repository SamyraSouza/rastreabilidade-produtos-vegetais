@extends('layouts.main')

@section('title', 'Cadastrar Produto')

@section('page', 'Produtos')

@section('content')

<div class="container-fluid py-4 mt-5">
    <form action="/products" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center justify-content-center mt-1">
              <h2>Cadastre Seu Produto</h2>
                </div>
            </div>

            <div class="card-body">

            <div class="d-flex align-items-center justify-content-center mb-2">
              <p class="text-uppercase text-sm">Informações</p>
            </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-control-label">Nome</label>
                    <input required class="form-control" type="text" name="name" id="name" placeholder="Nome">
                  </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                     <label class="mt-3" for="code">Código</label>
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="code" id="codeproduct" placeholder="XXX-00000">
                        <button onCLick="aleatorio()" class="btn btn-secondary mb-0" type="button" id="button-addon2"><img src="/img/produto-de-codigo-de-barras.png"></button>
                    </div>
                </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="comertial_name" class="form-control-label">Nome Comercial</label>
                    <input class="form-control" type="text" name="comertial_name" id="comertial_name" placeholder="Nome Comercial">
                  </div>
                </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="mr-2" for="quantity">Quantidade / Unidade de Medida</label>

                <div class="form-group d-flex">

                <input class="form-control" type="number" name="quantity" id="quantity">

                 <select name="units_id" id="units_id" class="btn btn-secondary mb-0">
                    @foreach($units as $unit)
                         <option value="{{$unit->id}}">{{$unit->title}} - {{$unit->description}}</option>
                     @endforeach
                </select>    
                    </div>
            </div>
</div>
         
            <div class="col-md-6">
                <div class="form-group">
                 <label class="mt-3" for="status">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>      
                </div>
             </div>

        <div class="col-md-6">
        <div class="form-group">
            <label class="mt-3" for="variedade_cultivar">O produto é variedade cultivar?</label>
           <select name="variedade_cultivar" id="variedade_cultivar" class="form-control">
            <option value="1">Sim</option>
            <option value="0">Não</option>
           </select>      
        </div>
        </div>

        <div class="form-group">
            <label class="mt-3" for="description">Descrição:</label>
            <textarea class="form-control" name="description" id="description" placeholder="Descrição do produto"></textarea>
        </div>

        <div class="row d-flex justify-content-start mt-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="image" class="form-control-label">Imagem do Produto</label>
                <input type="file" name="image" id="image" class="form-control-file">
              </div>
            </div>
            </div>

            <div id="bot">
            <div class="d-flex justify-content-center">
             <input type="submit" class="btn btn-success mt-3 mb-5 d-flex" value="Criar Produto"> 
            </div>
          </div>
              </div>
            </div>
          </div>
        </form>
        </div>       


@endsection