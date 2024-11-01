@extends('user.layouts.user')

@section('title')
    index products
@endsection

@section('content')
    @if (Session::has('storyStore'))
        <div class="alert alert-success">
            {{ Session::get('storyStore') }}
        </div>
    @endif




@endsection




<script>
  
</script>
