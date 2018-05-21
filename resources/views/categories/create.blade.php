@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Ajouter une catégorie')
        @endslot
        <form method="POST" action="{{ route('category.store') }}">
            {{ csrf_field() }}
            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'name',
                'placeholder'=>__('Ajouter une categories'),
                'required' => true,
                ])
            @component('components.button')
                @lang('Envoyer')
            @endcomponent
        </form>
    @endcomponent            
@endsection