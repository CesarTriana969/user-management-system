@extends('layouts.app')

@section('content')
<div class="container ml-8 max-[768px]:ml-0">
    <dashboard-component :users="{{$users}}"></dashboard-component>
</div>
@endsection
