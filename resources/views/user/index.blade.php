@extends('layouts.app')

@section('template_title')
    User
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ $title }}
                            </span>
                            @if(Auth::user()->role == 'ADMINISTRATOR')
                                <div class="float-end">
                                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
                                    {{ __('Create New') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'ADMINISTRATOR')
                    <div class="row mt-4 ms-1 me-1">
                        <div class="container overflow-hidden text-center">
                            <div class="row gy-5">
                                <div class="col-3">
                                    <a href="/users/filter/administrator">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h4>👨🏼‍💻 <b>{{$admins}}</b> Admins </h4></div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="/users/filter/teacher">
                                        <div class="p-3 text-start text-white rounded-3 bg-primary"><h4>👨‍🏫 <b>{{$teachers}}</b> Teachers</h4></div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="/users/filter/student">
                                        <div class="p-3 text-start text-white rounded-3 bg-secondary"><h4>👨🏼‍🎓 <b>{{$students}}</b> Students</h4></div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="/users">
                                        <div class="p-3 text-start text-white rounded-3 bg-danger"><h4>🙎🏼‍♂️ <b>{{$usersActive}}</b> All</h4></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>

										<th>Name</th>
										<th>Email</th>
                                        <th>Role</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>
                                                @if(Auth::user()->role != 'ADMINISTRATOR')
                                                    <a class="fw-bolder" href="courses/filter/student/{{$user->id}}" title="View this student's courses">
                                                        {{ $user->name }}
                                                    <a>
                                                @else
                                                    {{ $user->name }}
                                                @endif
                                                </td>
											<td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge @if($user->role == 'STUDENT') text-bg-secondary @elseif($user->role == 'TEACHER') text-bg-primary @else text-bg-success @endif">
                                                    {{ $user->role }}
                                                </span>
                                                </td>

                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                @if (Auth::user()->email != $user->email && Auth::user()->role == 'ADMINISTRATOR')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="remove({{$user->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('user/inc/scripts')

@endsection
