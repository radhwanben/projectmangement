@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.update", [$project->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nom">{{ trans('cruds.project.fields.nom') }}</label>
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" type="text" name="nom" id="nom" value="{{ old('nom', $project->nom) }}" required>
                @if($errors->has('nom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nom') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.nom_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categorie">{{ trans('cruds.project.fields.categorie') }}</label>
                <input class="form-control {{ $errors->has('categorie') ? 'is-invalid' : '' }}" type="text" name="categorie" id="categorie" value="{{ old('categorie', $project->categorie) }}">
                @if($errors->has('categorie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categorie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.categorie_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="deadline">{{ trans('cruds.project.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline', $project->deadline) }}" required>
                @if($errors->has('deadline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deadline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.project.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $project->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection