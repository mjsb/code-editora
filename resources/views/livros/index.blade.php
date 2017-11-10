<!--
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 10/11/2017
 * Time: 11:30
 */
-->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de livros</h3>
            <a href="{{ route('livros.create') }}" class="btn btn-primary">Novo livro</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Subtitulo</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($livros as $livro)
                    <tr>
                        <td>{{ $livro->id }}</td>
                        <td>{{ $livro->title }}</td>
                        <td>{{ $livro->subtitle }}</td>
                        <td>{{ $livro->price }}</td>
                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="{{route('livros.edit', ['livro' => $livro->id])}}">Editar</a>
                                </li>
                                <li>|</li>
                                <li>
                                    <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                    <a href="{{route('livros.destroy', ['livro' => $livro->id])}}" onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit();">Excluir</a>
                                    {!! Form::open(['route' => ['livros.destroy', 'livro' => $livro->id], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $livros->links() }}
        </div>
    </div>
@endsection