@extends('layouts.app')

@section('content')
<div class="w-full">
    <edit-user-component :user="{{$user}}"></edit-user-component>
</div>
@endsection
