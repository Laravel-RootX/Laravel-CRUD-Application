@extends('layouts.backend')

@section('title', 'List of Groups')

@section('content_header', 'List of Groups')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    @include('groups.partial.addButton')
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <table id="list-table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(!empty($groups))
                                @foreach($groups as $groups)
                                    <tr>
                                        <td>{{ $groups->name }}</td>

                                        <td>
                                            <a href="{{url('/groups/'. $groups->id . '/edit')}}"
                                               class="btn btn-xs btn-primary mb-2">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i> Edit
                                            </a>

                                            <form action="{{url('/groups', ['id'=>$groups->id])}}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')"
                                                  style="display: inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-xs">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>

    <script type="text/javascript">
        jQuery(function ($) {

            let table = $('#list-table').DataTable({
                "responsive": true,
                "pageLength": 50
            });

            // Sort by datatable desc
            table.order([0, 'asc'])
                .draw();

        })
    </script>
@endsection
