@extends('layouts.admin')
@section('content')
@can('tache_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.taches.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tache.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tache.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Tache">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tache.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tache.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.tache.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.tache.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.tache.fields.project') }}
                        </th>
                        <th>
                            {{ trans('cruds.tache.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taches as $key => $tache)
                        <tr data-entry-id="{{ $tache->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tache->id ?? '' }}
                            </td>
                            <td>
                                {{ $tache->description ?? '' }}
                            </td>
                            <td>
                                {{ $tache->date ?? '' }}
                            </td>
                            <td>
                                @foreach($tache->users as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($tache->projects as $key => $item)
                                    <span class="badge badge-info">{{ $item->nom }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $tache->status ?? '' }}
                            </td>
                            <td>
                                @can('tache_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taches.show', $tache->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tache_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taches.edit', $tache->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tache_delete')
                                    <form action="{{ route('admin.taches.destroy', $tache->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tache_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.taches.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Tache:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection