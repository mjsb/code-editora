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
        </div>
        <div class="row">
            {!! Button::primary('Novo livro')->asLinkTo(route('livros.create'))->addAttributes(['class' => 'pull-right']) !!}
            {!! Form::model([], ['class' => 'form-inline', 'method' => 'GET']) !!}
                {{--{!! Form::label('search', 'Busca:  ', ['class' => 'control-label']) !!}--}}
                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Buscar por...']) !!}

                {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($livros->items())->striped()
                ->callback('Ações', function ($field, $livro){
                    $linkEdit = route('livros.edit', ['livro' => $livro->id]);
                    $linkDestroy = route('livros.destroy', ['livro' => $livro->id]);
                    $deleteForm = "delete-form-{$livro->id}";
                    $form = Form::open(['route' => ['livros.destroy', 'livro' => $livro->id], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'disply:none']).Form::close();
                    $anchorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"]);
                    return "<ul class=\"list-inline\">".
                                "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".
                                "<li>|</li>".
                                "<li>".$anchorDestroy."</li>".
                            "</ul>".
                            $form;
                });
            !!}
            {{ $livros->links() }}
        </div>
    </div>
@endsection