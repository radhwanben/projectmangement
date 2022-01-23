<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTacheRequest;
use App\Http\Requests\StoreTacheRequest;
use App\Http\Requests\UpdateTacheRequest;
use App\Models\Project;
use App\Models\Tache;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TacheController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tache_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taches = Tache::with(['users', 'projects'])->get();

        return view('admin.taches.index', compact('taches'));
    }

    public function create()
    {
        abort_if(Gate::denies('tache_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id');

        $projects = Project::pluck('nom', 'id');

        return view('admin.taches.create', compact('projects', 'users'));
    }

    public function store(StoreTacheRequest $request)
    {
        $tache = Tache::create($request->all());
        $tache->users()->sync($request->input('users', []));
        $tache->projects()->sync($request->input('projects', []));

        return redirect()->route('admin.taches.index');
    }

    public function edit(Tache $tache)
    {
        abort_if(Gate::denies('tache_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id');

        $projects = Project::pluck('nom', 'id');

        $tache->load('users', 'projects');

        return view('admin.taches.edit', compact('projects', 'tache', 'users'));
    }

    public function update(UpdateTacheRequest $request, Tache $tache)
    {
        $tache->update($request->all());
        $tache->users()->sync($request->input('users', []));
        $tache->projects()->sync($request->input('projects', []));

        return redirect()->route('admin.taches.index');
    }

    public function show(Tache $tache)
    {
        abort_if(Gate::denies('tache_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tache->load('users', 'projects');

        return view('admin.taches.show', compact('tache'));
    }

    public function destroy(Tache $tache)
    {
        abort_if(Gate::denies('tache_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tache->delete();

        return back();
    }

    public function massDestroy(MassDestroyTacheRequest $request)
    {
        Tache::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}