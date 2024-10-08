@extends('layouts.main')

@section('title', 'Produtos')

@section('page', 'Produtos')

@section('content')

<!-- BARRA DE BUSCAS -->

    <div class="input-group mb-3 d-flex justify-content-center">
    <form class="d-flex justify-content-center wid mt-4" action="/products" method="GET">
        <input type="text" class="form-control" name="search" placeholder="Procurar por produto">
        <button class="btn btn-outline-success mb-0" type="submit" id="button-addon2">Buscar</button>
    </form>
    </div>


<div class="container-fluid py-4 mt-7">
@if(session('msg'))
<div class="alert alert-success" role="alert" style="z-index:0;">
   <span class="light">{{session('msg')}}</span> 
</div>
  @endif



  @if(count($products)==0 && $search)

  <div class="alert alert-danger" role="alert"><div class="light" style="z-index:0;">
  Não foi possível encontrar nenhum produto no nome ou código de: {{$search}}. Veja os produtos diponíveis <a class="forte" href="/products">Aqui</a></div>
</div>

  @elseif(count($products)==0)

<div class="alert alert-danger" role="alert" style="z-index:0;">
  <div class="light">Não há produtos disponíveis.</div>
</div>
 
@else

@if(count($products)!=0 && $search)
<div class="alert alert-light" role="alert">
   <span>Buscando por: {{$search}}</span> 
</div>
@endif

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tabela de Produtos</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Código</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descrição</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produtor</th>
                      
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>


                  <tbody>
                  @foreach($products as $product)
                   @if($product->status == "1")
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$product->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$product->code}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">

                     
                        <span class="badge badge-sm bg-gradient-success">Ativo</span>
                     
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$product->description}}</span>
                      </td>

                      <td class="text-center">
                        <span class="text-secondary text-xs font-weight-bold">@foreach($pessoa as $produtor)@if($produtor->id == $product->people_id){{ $produtor->nome }}@endif @endforeach</span>
                      </td>

                     
                      <td class="align-middle text-center">
                         @if($user->id == $product->people_id || session('adm') == true)                                                    
                         <a class="marg text-info" href="/products/edit/{{$product->id}}"><i class="fa fa-edit"></i><a>                                                                    
                          <a href="/batch/create/{{$product->id}}"  class="text-secondary text-xs font-weight-bold text-cente text-success marg">Cadastrar Lote</a>
  
                          @if($product->status == "1")
                          <a type="button" onclick="inativar({{$product->id}})" id="inativar" class="text-secondary text-xs font-weight-bold text-cente text-danger marg">Inativar</a>
                            @endif
                      @endif

                      </td>
                      <td class="align-middle"> 
                         <a class="marg" href="/products/{{$product->id}}"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr> 
                    @endif
                    @endforeach

                  @foreach($products as $product)
                   @if($product->status != "1")
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$product->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$product->code}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">

                     
                        <span class="badge badge-sm bg-gradient-danger">Inativo</span>
                     
                      </td>
                      
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$product->description}}</span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold text-center">@foreach($pessoa as $produtor)@if($produtor->id == $product->people_id){{ $produtor->nome }}@endif @endforeach</span>
                      </td>
                     
                      <td class="align-middle text-center">    
                       @if($product->people_id == $user->id  || session('adm') == true)           
                      <a href="/products/ativar/{{$product->id}}" class="text-secondary text-xs font-weight-bold text-center text-success">Ativar Produto</a> @endif            
                      </td>   
                        
                      <td class="align-middle"> 
                      <a class="marg" href="/products/{{$product->id}}"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr> 
                    @endif
                    @endforeach
                
                  </tbody>
                </table>
              </div>
            </div>
          </div>    {{ $products->links() }}
        </div>
      </div>

@endif
@endsection