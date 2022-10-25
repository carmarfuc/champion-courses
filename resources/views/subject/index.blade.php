@extends('layouts.app')

@section('template_title')
    Subject
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ $title }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="row mt-5 ms-1 me-1">
                        <div class="container overflow-hidden text-center">
                            <div class="row gy-5">
                                <div class="col-4">
                                    <a href="/subjects/filter/active">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h4>📖 <b>{{$subjectsActive}}</b> Active </h4></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/subjects/filter/inactive">
                                        <div class="p-3 text-start text-white rounded-3 bg-danger"><h4>📕 <b>{{$subjectsInactive}}</b> Inactive</h4></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/subjects">
                                        <div class="p-3 text-start text-white rounded-3 bg-secondary"><h4>📚 <b>{{$subjectsAll}}</b> All</h4></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>

										<th>Name</th>
										<th>Monthly Price</th>
										<th>Start Date</th>
										<th>Finish Date</th>
										<th>Status</th>
										<th>Teacher</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $subject->name }}</td>
											<td>$ {{ @money($subject->monthly_price) }}</td>
											<td>{{ $subject->start_date }}</td>
											<td>{{ $subject->finish_date }}</td>
											<td>
                                                <span class="badge {{($subject->status == 'INACTIVE') ? 'text-bg-danger' : 'text-bg-success'}}">
                                                    {{ $subject->status }}
                                                </span>
                                            </td>
											<td>{{ $subject->user->name }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('subjects.show',$subject->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('subjects.edit',$subject->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="remove({{$subject->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $subjects->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('subject/inc/scripts')

@endsection
