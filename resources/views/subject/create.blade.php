@extends('layouts.app')

@section('template_title')
    Create Subject
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Subject</span>
                    </div>
                    <div class="card-body">
                        <form id="form" method="POST" action="{{ route('subjects.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('subject.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
