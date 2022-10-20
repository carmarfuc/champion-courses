@extends('layouts.app')

@section('template_title')
    Setting
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Setting') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('settings.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									    <th>Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $setting)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ str_replace('_',' ',$setting->name) }}</td>
											<td>{{ $setting->value }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('settings.edit',$setting->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar({{$setting->id}})"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $settings->links() !!}
            </div>
        </div>
    </div>
@endsection


<!-- Scripts -->
<script>
    const _token = "{{csrf_token()}}";
</script>
<script src="{{ asset('js/settings_scripts.js') }}" defer></script>

