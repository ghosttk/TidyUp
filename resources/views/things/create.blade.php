@extends('layouts.app')

@section('content')
    <form name='create-things' action="/things" method="post">
        @csrf
        <input type='text' name='tdata'></input>
        <input type='submit'>
    </form>
@endsection
