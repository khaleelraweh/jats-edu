@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_events') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                            <i class="fa fa-solid fa-chevron-left chevron"></i>
                        @else
                            <i class="fa fa-solid fa-chevron-right chevron"></i>
                        @endif
                    </li>
                    <li>
                        {{ __('panel.show_events') }}
                    </li>
                </ul>
            </div>

            <div class="ml-auto">
                @ability('admin', 'create_events')
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_event') }}</< /span>
                    </a>
                @endability
            </div>

        </div>

        <div class="card-body">
            {{-- filter form part  --}}
            @include('backend.events.filter.filter')

            {{-- table part --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('panel.image') }}</th>
                            <th>{{ __('panel.title') }}</th>
                            <th>{{ __('panel.price') }}</th>
                            <th class="d-none d-sm-table-cell">{{ __('panel.author') }}</th>
                            <th class="d-none d-sm-table-cell"> {{ __('panel.created_at') }} </th>

                            <th class="d-none d-sm-table-cell">{{ __('panel.status') }}</th>
                            <th class="text-center" style="width:30px;">{{ __('panel.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>

                                <td>
                                    @if ($event->firstMedia)
                                        {{-- <td><img src="{{asset('assets/cards/'.$event->photos()->first()->file_name)}}" width="60" alt="product Image"> </td> --}}
                                        <img src="{{ asset('assets/courses/' . $event->firstMedia->file_name) }}"
                                            width="60" height="60" alt="{{ $event->title }}">
                                    @else
                                        <img src="{{ asset('image/not_found/item_image_not_found.webp') }}" width="60"
                                            height="60" alt="khaleel">
                                    @endif

                                </td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->price }}</td>
                                <td class="d-none d-sm-table-cell">{{ $event->created_by }}</td>
                                <td class="d-none d-sm-table-cell">{{ $event->created_at }}</td>

                                <td class="d-none d-sm-table-cell">{{ $event->status() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            onclick=" if( confirm('Are you sure to delete this record?') ){document.getElementById('delete-product-{{ $event->id }}').submit();}else{return false;}"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="post"
                                        class="d-none" id="delete-product-{{ $event->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Product cards found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="float-right">
                                    {!! $events->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
@endsection
