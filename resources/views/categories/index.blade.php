<!--
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 09/11/2017
 * Time: 15:41
 */
-->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de categorias</h3>
            {!! Button::primary('Nova categoria')->asLinkTo(route('categories')) !!}
            {{--<a href="{{ route('categorcategorias') }}" class="btn btn-primary">Nova categoria</a>--}}
        </div>
        <div class="row">
            {!!
                Table::withContents($categories->items())->striped()
                ->callback('Ações', function ($field, $category){
                    $linkEdit = route('categories', ['category' => $category->id]);
                    $linkDestroy = route('categories', ['category' => $category->id]);
                    $deleteForm = "delete-form-{$category->id}";
                    $form = Form::open(['route' => ['categories', 'category' => $category->id], 'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'disply:none']).Form::close();
                    $anchorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"]);
                    return "<ul class=\"list-inline\">".
                                "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".
                                "<li>|</li>".
                                "<li>".$anchorDestroy."</li>".
                            "</ul>".
                            $form;
                });
            !!}

            {{ $categories->links() }}
        </div>
    </div>
@endsection