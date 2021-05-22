@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center my-4">
        <div class="col-sm-6">

            <div class="card shadow mb-4" v-for="post in posts">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">@{{post.title}}</h6>
                    <p class="m-0">@{{post.created_at}}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11">@{{post.body}}</div>
                        {{--                        <div class="col-lg-1 d-flex justify-content-end">--}}
                        {{--                            {!! Form::open([--}}
                        {{--                            'route' => ['posts.destroy', @{{post}}],--}}
                        {{--                            'method' => 'DELETE',--}}
                        {{--                            ]) !!}--}}
                        {{--                            {!! Form::button('<i class="fas fa-trash" aria-hidden="true"></i>', [--}}
                        {{--                                'type' => 'submit',--}}
                        {{--                                'class' => 'btn btn-danger btn-circle btn-sm',--}}
                        {{--                                'title' => 'Usuń post',--}}
                        {{--                                'onclick'=>'return confirm("Czy usunac?")'--}}
                        {{--                        ]) !!}--}}
                        {{--                            {!! Form::close() !!}--}}
                        {{--                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-md-center my-4">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="title" class="control-label">Tekst</label>
                <input type="text" id="title" name="title" class="form-control" required="required" v-model="titleBox">
            </div>

            <div class="form-group">
                <label for="body" class="control-label">Tekst</label>
                <textarea name="body" id="body" class="form-control" v-model="commentBox" cols="50" rows="10"
                          required="required"></textarea>
            </div>
            <div class="form-group d-flex flex-column align-items-stretch">
                <button class="btn btn-success" @click.prevent="storePost">Dodaj</button>
            </div>
        </div>
    </div>




@endsection()

@section('modals')

    {{--    <!-- Add Post Modal -->--}}
    {{--    <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalTitle"--}}
    {{--         aria-hidden="true">--}}
    {{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="exampleModalLongTitle">Dodaj post</h5>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                        <span aria-hidden="true">&times;</span>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    {!! Form::open([--}}
    {{--                        'method' => 'POST',--}}
    {{--                        'url' => route('posts.store'),--}}
    {{--                        ]) !!}--}}
    {{--                    <div class="form-group--}}
    {{--                    {{ $errors->has('title') ? ' has-error' : ''}}">--}}
    {{--                        {!! Form::label('title', 'Tytuł' .': ', ['class' => 'control-label']) !!}--}}
    {{--                        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}--}}
    {{--                        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}--}}
    {{--                    </div>--}}
    {{--                    <div class="form-group--}}
    {{--                    {{ $errors->has('body') ? ' has-error' : ''}}">--}}
    {{--                        {!! Form::label('body', 'Tekst' .': ', ['class' => 'control-label']) !!}--}}
    {{--                        {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => 'required']) !!}--}}
    {{--                        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <div class="modal-footer">--}}
    {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>--}}
    {{--                    {!! Form::submit('Dodaj', ['class' => 'btn btn-success']) !!}--}}
    {{--                    {!! Form::close() !!}--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection


@section('scripts')
    <script>
        const app = new Vue({
            el: '#wrapper',
            data: {
                titleBox: '',
                commentBox: '',
                posts: {},
                user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
            },
            mounted() {
                this.getPosts();
                this.listen();
            },
            methods: {
                getPosts() {
                    axios.get('api/posts/3')
                        .then((response) => {
                            this.posts = response.data;
                        })
                        .catch((error) => {
                            console.warn(error.response.data);
                        })
                },
                storePost() {
                    axios.post('api/posts', {
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        title: this.titleBox,
                        body: this.commentBox,
                        user_id: this.user.id,
                    })
                        .then((response) => {
                            console.log(response.data);
                            this.posts.unshift(response.data);
                            this.posts.pop();
                            this.commentBox = '';
                            this.titleBox = '';
                        })
                        .catch((error) => {
                            console.warn(error.response.data);
                        })
                },
                listen(){
                  Echo.channel('posts')
                    .listen('NewPost', (post) => {
                        this.posts.unshift(post);
                        this.posts.pop();
                    })
                },
            }
        });
    </script>
@endsection()

