@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>{{ __('Study like a champion here!') }}</h3>
                    <div class="row mt-5">
                        <div class="container overflow-hidden text-center">
                            <div class="row gy-5">
                                <div class="col-4">
                                    <a href="/users/filter/teacher">
                                        <div class="p-3 text-start text-white rounded-3 bg-primary"><h3>👨‍🏫 <b>{{$teachers}}</b> Teachers</h3></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/users/filter/student">
                                        <div class="p-3 text-start text-white rounded-3 bg-secondary"><h3>👨🏼‍🎓 <b>{{$students}}</b> Students</h3></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/users">
                                        <div class="p-3 text-start text-white rounded-3 bg-danger"><h3>🙎🏼‍♂️ <b>{{$usersActive}}</b> Users Active</h3></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/courses">
                                        <div class="p-3 text-start text-black rounded-3 bg-warning"><h3>👨🏼‍💻 <b>{{$studentsInCourses}}</b> Students in Courses</h3></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/courses">
                                        <div class="p-3 text-start text-black rounded-3 bg-info"><h3>📚 <b>{{$subjectCourses}}</b> Subject Courses </h3></div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="/subjects/filter/active">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h3>📚 <b>{{$subjectsActive}}</b> Subjects Active </h3></div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="/payments">
                                        <div class="p-3 text-start text-white rounded-3 bg-primary"><h3>💸 <b>{{$pendingPayments}}</b> Pending Payments</h3></div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="/payments">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h3>💵 <b>{{$paymentsPaid}}</b> Payments Paid</h3></div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="/payments">
                                        <div class="p-3 text-start text-white rounded-3 bg-primary"><h3>💸 <b>{{$pendingRemunerations}}</b> Pending Remunerations</h3></div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="/payments">
                                        <div class="p-3 text-start text-white rounded-3 bg-success"><h3>💵 <b>{{$remunerationsPaid}}</b> Remunerations Paid</h3></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
