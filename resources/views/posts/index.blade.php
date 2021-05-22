@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center my-4">
        <div class="col-sm-6">
            @forelse($posts as $post)
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">{{$post->title}}</h6>
                        <p class="m-0">{{$post->user->name}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @can('delete', $post)

                            <div class="col-lg-11">{{$post->body}}</div>
                            <div class="col-lg-1 d-flex justify-content-end">
                                {!! Form::open([
                                'route' => ['posts.destroy', $post],
                                'method' => 'DELETE',
                                ]) !!}
                                {!! Form::button('<i class="fas fa-trash" aria-hidden="true"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-circle btn-sm',
                                    'title' => 'Usuń post',
                                    'onclick'=>'return confirm("Czy usunac?")'
                            ]) !!}
                                {!! Form::close() !!}
                            </div>
                            @else
                                <div class="col-lg-12">{{$post->body}}</div>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <div class="d-flex justify-content-center">
                    <h1>There is no posts!</h1>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Add Post Modal -->
    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dodaj post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([
                        'method' => 'POST',
                        'url' => route('posts.store'),
                        ]) !!}
                    <div class="form-group
                    {{ $errors->has('title') ? ' has-error' : ''}}">
                        {!! Form::label('title', 'Tytuł' .': ', ['class' => 'control-label']) !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group
                    {{ $errors->has('body') ? ' has-error' : ''}}">
                        {!! Form::label('body', 'Tekst' .': ', ['class' => 'control-label']) !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    {!! Form::submit('Dodaj', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection()
