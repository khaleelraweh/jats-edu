<div class="card-body">
    <form action="{{ route('admin.orders.index') }}" method="get">
        <div class="row">

            <div class="col-8 col-sm-4 col-md-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}"
                        class="form-control" placeholder="{{ __('panel.keyword') }}">
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value=""> {{ __('panel.order_status') }}</option>
                        <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>
                            {{ __('panel.order_new_order') }}

                        </option>
                        <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>
                            {{ __('panel.order_paid') }}
                        </option>
                        <option value="2" {{ old('status', request()->input('status')) == '2' ? 'selected' : '' }}>
                            {{ __('panel.order_under_process') }}
                        </option>
                        <option value="3"
                            {{ old('status', request()->input('status')) == '3' ? 'selected' : '' }}>
                            {{ __('panel.order_finished') }}
                        </option>
                        <option value="4"
                            {{ old('status', request()->input('status')) == '4' ? 'selected' : '' }}>
                            {{ __('panel.order_rejected') }}
                        </option>
                        <option value="5"
                            {{ old('status', request()->input('status')) == '5' ? 'selected' : '' }}>
                            {{ __('panel.order_canceled') }}
                        </option>
                        <option value="6"
                            {{ old('status', request()->input('status')) == '6' ? 'selected' : '' }}>
                            {{ __('panel.order_refund_requested') }}
                        </option>
                        <option value="7"
                            {{ old('status', request()->input('status')) == '7' ? 'selected' : '' }}>
                            {{ __('panel.order_returned_order') }}
                        </option>
                        <option value="8"
                            {{ old('status', request()->input('status')) == '8' ? 'selected' : '' }}>
                            {{ __('panel.order_refunded') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="d-none d-sm-block col-sm-4 col-md-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">{{ __('panel.show_all') }}</option>
                        <option value="ref_id"
                            {{ old('sort_by', request()->input('sort_by')) == 'ref_id' ? 'selected' : '' }}>
                            {{ __('panel.ref_id') }}
                        </option>

                    </select>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        {{-- <option value="">ترتيب</option> --}}
                        <option value="asc"
                            {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>
                            {{ __('panel.asc') }}
                        </option>
                        <option value="desc"
                            {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>
                            {{ __('panel.desc') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        {{-- <option value="">عدد</option> --}}
                        <option value="10"
                            {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20"
                            {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50"
                            {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100"
                            {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            <div class="col-2 col-sm-2 col-md-2">
            </div>
            <div class="col-2 col-sm-2 col-md-1">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-link">{{ __('panel.search') }}</button>
                </div>
            </div>

        </div>
    </form>
</div>
