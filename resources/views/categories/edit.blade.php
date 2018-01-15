<!--
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 09/11/2017
 * Time: 19:22
 */
-->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar categoria</h3>

            {!! Form::model($category, ['route' => ['categories', 'category' => $category->id], 'class' => 'form', 'method' => 'PUT']) !!}

                @include('categories._form')

                {!! Html::openFormGroup('name', $errors) !!}
                    {{--{!! Form::submit('Salvar categoria', ['class' => 'btn btn-primary']) !!}--}}
                    {!! Button::primary('Salvar categoria')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection