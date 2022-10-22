@extends('layouts.app')

@section('template_title')
    Subject
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Subject') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>

										<th>Name</th>
										<th>Description</th>
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
											<td>{{ $subject->description }}</td>
											<td>$ {{ @money($subject->monthly_price) }}</td>
											<td>{{ $subject->start_date }}</td>
											<td>{{ $subject->finish_date }}</td>
											<td>
                                                <span class="badge {{($subject->status == 'inactive') ? 'text-bg-danger' : 'text-bg-success'}}">
                                                    {{ strtoupper($subject->status) }}
                                                </span>
                                            </td>
											<td>{{ $subject->user->name }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('subjects.show',$subject->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('subjects.edit',$subject->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="remove({{$subject->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
