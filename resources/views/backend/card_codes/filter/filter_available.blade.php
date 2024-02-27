<div class="card-body">
    <form action="{{ route('admin.card_codes.index') }}" method="get">
        <div class="row">
            {{-- keyword --}}
            <div class="col-8 col-sm-4 col-md-2">
                <div class="form-group">
                    <input type="text" name="keyword_available_codes"
                        value="{{ old('keyword_available_codes', request()->input('keyword_available_codes')) }}"
                        class="form-control" placeholder="{{ __('panel.keyword') }}">
                </div>
            </div>
            {{-- status --}}
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="status_available_codes" class="form-control">
                        <option value=""> {{ __('panel.show_all') }}</option>
                        <option value="1"
                            {{ old('status_available_codes', request()->input('status_available_codes')) == '1' ? 'selected' : '' }}>
                            {{ __('panel.status_active') }}
                        </option>
                        <option value="0"
                            {{ old('status_available_codes', request()->input('status_available_codes')) == '0' ? 'selected' : '' }}>
                            {{ __('panel.status_inactive') }}
                        </option>
                    </select>
                </div>
            </div>
            {{-- code type --}}
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="code_type_available_codes" class="form-control">
                        <option value=""> {{ __('panel.cc_code_type') }}</option>
                        <option value="1"
                            {{ old('code_type_available_codes', request()->input('code_type_available_codes')) == '1' ? 'selected' : '' }}>
                            {{ __('panel.cc_direct_code') }}
                        </option>
                        <option value="0"
                            {{ old('code_type_available_codes', request()->input('code_type_available_codes')) == '0' ? 'selected' : '' }}>
                            {{ __('panel.cc_Indirect_code') }}
                        </option>
                    </select>
                </div>
            </div>
            {{-- sort by  --}}
            <div class="d-none d-sm-block col-sm-4 col-md-2">
                <div class="form-group">
                    <select name="sort_by_available_codes" class="form-control">
                        {{-- <option value="">---</option> --}}
                        <option value="id"
                            {{ old('sort_by_available_codes', request()->input('sort_by_available_codes')) == 'id' ? 'selected' : '' }}>
                            {{ __('panel.id') }}
                        </option>
                        <option value="code"
                            {{ old('sort_by_available_codes', request()->input('sort_by_available_codes')) == 'code' ? 'selected' : '' }}>
                            {{ __('panel.cc_code') }}
                        </option>
                        <option value="created_at"
                            {{ old('sort_by_available_codes', request()->input('sort_by_available_codes')) == 'created_at' ? 'selected' : '' }}>
                            {{ __('panel.created_at') }}
                        </option>
                        <option value="published_on"
                            {{ old('sort_by_available_codes', request()->input('sort_by_available_codes')) == 'published_on' ? 'selected' : '' }}>
                            {{ __('panel.published_on') }}
                        </option>


                    </select>
                </div>
            </div>
            {{-- order by --}}
            <div class="col-md-2 d-none d-md-block">
                <div class="form-group">
                    <select name="order_by_available_codes" class="form-control">
                        {{-- <option value="">---</option> --}}
                        <option value="asc"
                            {{ old('order_by_available_codes', request()->input('order_by_available_codes')) == 'asc' ? 'selected' : '' }}>
                            {{ __('panel.asc') }}
                        </option>
                        <option value="desc"
                            {{ old('order_by_available_codes', request()->input('order_by_available_codes')) == 'desc' ? 'selected' : '' }}>
                            {{ __('panel.desc') }}
                        </option>
                    </select>
                </div>
            </div>
            {{-- limit by --}}
            <div class="col-md-1 d-none d-md-block">
                <div class="form-group">
                    <select name="limit_by_available_codes" class="form-control">
                        {{-- <option value="">---</option> --}}
                        <option value="10"
                            {{ old('limit_by_available_codes', request()->input('limit_by_available_codes')) == '10' ? 'selected' : '' }}>
                            10</option>
                        <option value="20"
                            {{ old('limit_by_available_codes', request()->input('limit_by_available_codes')) == '20' ? 'selected' : '' }}>
                            20</option>
                        <option value="50"
                            {{ old('limit_by_available_codes', request()->input('limit_by_available_codes')) == '50' ? 'selected' : '' }}>
                            50</option>
                        <option value="100"
                            {{ old('limit_by_available_codes', request()->input('limit_by_available_codes')) == '100' ? 'selected' : '' }}>
                            100</option>
                    </select>
                </div>
            </div>
            <div class="col-2 d-md-none col-sm-2 col-md-2 ">
            </div>
            <div class="col-2 col-sm-2 col-md-1">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-link">{{ __('panel.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
