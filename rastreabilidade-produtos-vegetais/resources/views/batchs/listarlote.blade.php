@extends('layouts.main')

@section('title', 'Listar Lotes')

@section('page', 'Lotes')

@section('content')


<!-- BARRA DE BUSCAS -->

    <div class="input-group mb-3 d-flex justify-content-center">
    <form class="d-flex justify-content-center wid mt-4" action="/batchs" method="GET">
        <input type="text" class="form-control" name="search" placeholder="Procurar por código do lote">
        <button class="btn btn-outline-success mb-0" type="submit" id="button-addon2">Buscar</button>
    </form>
    </div>


<div class="container-fluid py-4 mt-7">
@if(session('msg'))
<div class="alert alert-success" role="alert">
   <span class="light">{{session('msg')}}</span> 
</div>
 @endif


  @if(count($batchs)==0 && $search)

  <div class="alert alert-danger" role="alert" style="z-index:0;"><div class="light">
  Não foi possível encontrar nenhum lote no código de: {{$search}}. Veja os lotes diponíveis <a class="forte" href="/batchs">Aqui</a></div>
</div>

  @elseif(count($batchs)==0)

<div class="alert alert-danger" role="alert" style="z-index:0;">
  <div class="light">Não há lotes disponíveis.</div>
</div>
 
@else

@if(count($batchs)!=0 && $search)
<div class="alert alert-light" role="alert" style="z-index:0;">
   <span>Buscando por: {{$search}}</span> 
</div>
@endif

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Tabela de Lotes</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome Produto</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Código Produto</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Código Lote</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>


                  <tbody>
                  @foreach($batchs as $batch) 

                   @if($batch->status == "1")
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">   
                            @foreach($products as $product)
                            @if($product->id == $batch->products_id)
                            {{$product->name}}
                            @endif
                            @endforeach
                          </h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          @foreach($products as $product)
                            @if($product->id == $batch->products_id)
                            {{$product->code}}
                            @endif
                            @endforeach
                        </p>
                      </td>
                      <td class="align-middle text-center text-sm">

                     
                    <span class="badge badge-sm bg-gradient-success">Ativo</span>
                     
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$batch->code}}</span>
                      </td>
                      <td class="align-middle text-center">      
                        @if($user->id == $batch->people_id || session('adm') == true)                                                    
                        <a class="marg text-info" href="/batch/edit/{{$batch->id}}"><i class="fa fa-edit"></i><a> 
                                                                                                         
                      <a class="text-secondary text-xs font-weight-bold text-cente text-success marg" href="/movement/create/{{$batch->id}}">Cadastrar Movimentação<a>
                       
                        <a type="button" href="/batchs/inativar/{{$batch->id}}" class="text-secondary text-xs font-weight-bold text-cente text-danger marg">Inativar</a> 
                        @endif 
                      </td>
                      <td class="align-middle">  
                      <a class="marg" href="/batch/{{$batch->id}}"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr> 
                    @endif
                    @endforeach

                    @foreach($batchs as $batch)
                   
                   @if($batch->status != "1")
                   <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                            @foreach($products as $product)
                            @if($product->id == $batch->products_id)
                            {{$product->name}}
                            @endif
                            @endforeach</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          @foreach($products as $product)
                            @if($product->id == $batch->products_id)
                            {{$product->code}}
                            @endif
                            @endforeach
                        </p>
                      </td>
                      <td class="align-middle text-center text-sm">

                     
                    <span class="badge badge-sm bg-gradient-danger">Inativo</span>
                     
                      </td>
                      <td class="align-middle text-center">
                        
                        <span class="text-secondary text-xs font-weight-bold">{{$batch->code}}</span>
                      </td>
                      <td class="align-middle text-center">
                        @if($user->id == $batch->people_id || session('adm') == true)                                                    

                         @foreach($products as $product)
                         @if($product->id == $batch->products_id && $product->status == "0")
                         <a type="button" onclick="ativar({{$batch->id}})" class="text-secondary text-xs font-weight-bold text-cente text-success marg">Ativar Lote</a>    
                         @elseif($product->id == $batch->products_id && $product->status == "1")
                        <a href="/batchs/ativar/{{$batch->id}}"  class="text-secondary text-xs font-weight-bold text-cente text-success marg">Ativar Lote</a>  
                         @endif                                                             
                         @endforeach 
                     @endif
                        
                      </td>
                      <td class="align-middle">
                      <a class="marg" href="/batch/{{$batch->id}}"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr> 
                    @endif
                    
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div> 
          </div>{{ $batchs->links() }}
        </div>
      </div>

@endif
@endsection