@extends('layouts.app')

@section('content')
    <div class="content container">
        <?php
            if(Auth::user()->id == 1){
                $title = "Todas compras";
            } else {
                $title = "Minhas compras";
            }
        ?>
        <h2>{{$title}}</h2>
        <table class="table table-bordered">
            <thead>
                <th>#</th>
                <th>Livro</th>
                <th>Preço</th>
                <th>Ação</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->orderable->title}}</td>
                        <td>{{$order->orderable->price}}</td>
                        <td>
                            <a href="{{route('livros.download-common',['id'=>$order->orderable->id])}}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection