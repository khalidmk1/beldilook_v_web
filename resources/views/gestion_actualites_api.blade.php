
<div style="display: flex ; justify-content: space-between">
    @if(App::getlocale()=="ar")
    <h1  style="padding: 20px;color:#263066;text-align:end;display:inline-block">Mes blogs</h1>
    @else
    <h1  style="padding: 20px;color:#263066;text-align:start;display:inline-block">Mes blogs</h1>
    @endif
    
    <div style="text-align: end;cursor: pointer;position: relative;
    text-align: end;
    cursor: pointer;
    top: 35px;
    right:20px;
    "><img src="{{asset('storage/add.png')}}" onclick="ajout_blog()" height="35px" width="35px" alt=""></div>
    </div>
    <div class="container items">
        <div class="row">
            
            @forelse ($actualites as $actualite)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="padding-bottom: 20px;display:flex;justify-content:center;align-items:center">
        
            <div class="card card2" >
                <div class="imgprod">          
                        <img class="card-img-top" src={{ $actualite['Image']}} alt="Card image cap" height="200" width="200" style="border-radius: 8px;object-fit: contain;">
              
            </div>
                <div class="card-body">
                  <p style="font-size: 17px;text-align: center" class="card-title text" data-toggle="{{$actualite['Type']}}">{{$actualite['Type']}} </p>
                 </div>
              </div>
        
        </div> 
           @empty
    <p class="col-12" style="text-align: center;padding-top: 80px;">Aucune actualité</p>
           @endforelse
          
        </div>
    </div>
    
    <br>
    <div style="text-align: center;padding-bottom:50px">
        @if ($page==1 or $page=='')
        @if(count($actualites)>0)
        <a class="paginationa" href="">❮</a>
        <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => 2]) }}>❯</a>
        @endif
        @else
        <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page-1]) }}>❮</a>
        <a class="paginationa" href={{$request->fullUrlWithQuery(['page' => $page+1]) }}>❯</a>
        @endif
    
    
    
    
    
      </div>