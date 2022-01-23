@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tache.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tache.fields.id') }}
                        </th>
                        <td>
                            {{ $tache->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tache.fields.description') }}
                        </th>
                        <td>
                            {{ $tache->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tache.fields.date') }}
                        </th>
                        <td>
                            {{ $tache->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tache.fields.user') }}
                        </th>
                        <td>
                            @foreach($tache->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tache.fields.project') }}
                        </th>
                        <td>
                            @foreach($tache->projects as $key => $project)
                                <span class="label label-info">{{ $project->nom }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tache.fields.status') }}
                        </th>
                        <td>
                            {{ $tache->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection