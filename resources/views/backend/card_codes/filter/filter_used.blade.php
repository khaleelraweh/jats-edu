<div class="card-body">
    <form action="{{ route('admin.card_codes.index') }}" method="get">
        <div class="row">
            <div class="col-8 col-sm-4 col-md-2">
                <div class="form-group">
                    <input type="text" name="keyword_used_code"
                        value="{{ old('keyword_used_code', request()->input('keyword_used_code')) }}" class="form-control"
                        placeholder="{{ __('panel.keyword') }}">
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status_used_code" class="form-control">
                        <option value=""> {{ __('panel.show_all') }}</option>
                        <option value="1"
                            {{ old('status_used_code', request()->input('status_used_code')) == '1' ? 'selected' : '' }}>
                            {{ __('panel.status_active') }}
                        </option>
                        <option value="0"
                            {{ old('status_used_code', request()->input('status_used_code')) == '0' ? 'selected' : '' }}>
                            {{ __('panel.status_inactive') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="d-none d-sm-block col-sm-4 col-md-2">
                <div class="form-group">
                    <select name="sort_by_used_code" class="form-control">
                        {{-- <option value="">---</option> --}}
                        <option value="id"
                            {{ old('sort_by_used_code', request()->input('sort_by_used_code')) == 'id' ? 'selected' : '' }}>
                            {{ __('panel.id') }}
                        </option>
                        <option value="code"
                            {{ old('sort_by_used_code', request()->input('sort_by_used_code')) == 'code' ? 'selected' : '' }}>
                            {{ __('panel.cc_code') }}
                        </option>
                        <option value="created_at"
                            {{ old('sort_by_used_code', request()->input('sort_by_used_code')) == 'created_at' ? 'selected' : '' }}>
                            {{ __('panel.created_at') }}
                        </option>
                        <option value="published_on"
                            {{ old('sort_by_used_code', request()->input('sort_by_used_code')) == 'published_on' ? 'selected' : '' }}>
                            {{ __('panel.published_on') }}
                        </option>

                    </select>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by_used_code" class="form-control">
                        {{-- <option value="">---</option> --}}
                        <option value="asc"
                            {{ old('order_by_used_code', request()->input('order_by_used_code')) == 'asc' ? 'selected' : '' }}>
                            {{ __('panel.asc') }}
                        </option>
                        <option value="desc"
                            {{ old('order_by_used_code', request()->input('order_by_used_code')) == 'desc' ? 'selected' : '' }}>
                            {{ __('panel.desc') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block">
                <div class="form-group">
                    <select name="limit_by_used_code" class="form-control">
                        {{-- <option value="">---</option> --}}
                        <option value="10"
                            {{ old('limit_by_used_code', request()->input('limit_by_used_code')) == '10' ? 'selected' : '' }}>
                            10</option>
                        <option value="20"
                            {{ old('limit_by_used_code', request()->input('limit_by_used_code')) == '20' ? 'selected' : '' }}>
                            20</option>
                        <option value="50"
                            {{ old('limit_by_used_code', request()->input('limit_by_used_code')) == '50' ? 'selected' : '' }}>
                            50</option>
                        <option value="100"
                            {{ old('limit_by_used_code', request()->input('limit_by_used_code')) == '100' ? 'selected' : '' }}>
                            100</option>
                    </select>
                </div>
            </div>
            <div class="col-2 col-sm-2 col-md-2 ">
            </div>
            <div class="col-2 col-sm-2 col-md-1">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-link">{{ __('panel.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
