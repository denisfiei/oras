@extends('layouts.horizontal')

@section('content')
    @if ($aviso)
    <div class="modal fade" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body pd-20 pd-sm-40">
                    <a href="#" role="button" class="close pos-absolute t-15 r-15" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="aviso_img">
                                <img class="img-fluid" src="{{asset('storage/'.$aviso->imagen)}}" alt="Imagen">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="popup_content">
                                <div class="popup-text">
                                    <div class="heading_s1">
                                        <h4>{{$aviso->titulo}}</h4>
                                    </div>
                                    <p>{{$aviso->descripcion}}</p>
                                </div>
                                @if ($aviso->boton)
                                    <div class="mt-3">
                                        <a href="{{$aviso->link}}" class="btn btn-outline-primary btn-block text-uppercase rounded-0">{{$aviso->boton}}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('js')
    @if ($aviso)
        <script>
            $(window).on('load',function(){
                setTimeout(function() {
                    $("#onload-popup").modal('show', {}, 500);
                }, 1000);
            });
            
        </script>
    @endif
@endsection