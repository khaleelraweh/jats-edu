<div>
    <div class="row">
        <div class="col-sm-12 col-md-2 pt-3">
            <h2>صفحات النموذج</h2>
            <ul style="list-style: none;margin:0;padding:0;">
                @foreach ($pages as $index => $page)
                    <li class="w-100 mb-1 d-flex justify-content-between"
                        style="background-color: {{ $currentPageIndex == $index ? '#0162e8' : '#b9c2d8' }} ; border-width: 0;">
                        <a class="d-block" wire:click="setActivePage({{ $index }})" href="#"
                            style="padding: 9px 20px;line-height: 1.538;color:#fff;">
                            {{ $page['doc_page_name'] }} </a>

                        <a href="" wire:click.prevent="removePage({{ $currentPageIndex }})" class="d-block pt-2"
                            style="padding: 9px 20px;line-height: 1.538;color:#fff;">
                            <i
                                class="fas fa-trash-alt {{ $currentPageIndex == $index ? 'text-white' : 'text-danger' }}  me-3"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-between" style="">
                <!-- Button to add a new section -->
                <a wire:click.prevent="addPage()" class="d-block pt-2" style="cursor: pointer;">
                    <i class="fas fa-plus-square text-primary me-3"></i> {{ __('panel.add_page') }}
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-10 pt-3">
            @if (isset($pages[$currentPageIndex]))
                <div class="card">
                    <div class="card-header mb-0 pb-0">
                        <h2> <i class="far fa-edit" style="color: #0162e8"></i> {{ __('panel.page') }}
                            {{ $currentPageIndex + 1 }}</h2>
                    </div>
                    <div class="card-body mt-0 pt-0">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 pt-3">
                                <label
                                    for="{{ $pages[$currentPageIndex]['doc_page_name'] }}">{{ __('panel.page_title') }}</label>

                                <input type="text" class="form-control" id="pages.{{ $index }}.doc_page_name"
                                    wire:model.defer="pages.{{ $currentPageIndex }}.doc_page_name">

                                @error('pages.' . $currentPageIndex . '.doc_page_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-8 pt-3">
                                <label for="{{ $pages[$currentPageIndex]['doc_page_description'] }}">
                                    {{ __('panel.page_description') }}
                                </label>

                                <input type="text" class="form-control"
                                    id="{{ $pages[$currentPageIndex]['doc_page_description'] }}"
                                    wire:model.defer="pages.{{ $currentPageIndex }}.doc_page_description">

                                @error('pages.' . $currentPageIndex . '.doc_page_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 pt-5">
                                <div class="row align-items-end mb-4 mb-md-0">
                                    <div class="col-md mb-4 mb-md-0">
                                        <h4>{{ __('panel.groups') }}</h4>
                                    </div>
                                    <div class="col-md-auto aos-init aos-animate" data-aos="fade-start">
                                        <a href="" wire:click.prevent="addGroup({{ $currentPageIndex }})">
                                            <i class="fas fa-plus-circle me-2"></i>
                                            <span>
                                                {{ __('panel.add_group') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                @foreach ($pages[$currentPageIndex]['groups'] as $groupIndex => $group)
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="input-group p-2 "
                                                style="background: {{ $groupIndex == $activeGroupIndex ? '#0162e8' : '#DDE2EF' }}  !important;">
                                                <span
                                                    class="input-group-text {{ $groupIndex == $activeGroupIndex ? 'activeGroup' : '' }}"
                                                    style="border:none;">
                                                    <span>
                                                        {{ __('panel.group') }}
                                                        {{ $groupIndex + 1 }}
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control"
                                                    wire:model.defer="pages.{{ $currentPageIndex }}.groups.{{ $groupIndex }}.pg_name"
                                                    aria-label="{{ __('transf.Enter a Group Name') }}">

                                                <a class="input-group-text {{ $groupIndex == $activeGroupIndex ? 'activeGroup' : '' }}"
                                                    style="border:none; cursor: pointer;"
                                                    wire:click.prevent="removeGroup({{ $currentPageIndex }}, {{ $groupIndex }})">
                                                    <i
                                                        class="fas fa-trash-alt {{ $groupIndex == $activeGroupIndex ? 'text-white' : 'text-danger' }} "></i>
                                                </a>

                                                <a class="input-group-text p-1 {{ $groupIndex == $activeGroupIndex ? 'activeGroup' : '' }}"
                                                    style="border:none; cursor: pointer;"
                                                    wire:click="setActiveGroup({{ $currentPageIndex }}, {{ $groupIndex }})">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </div>

                                        </div>
                                        @error('pages.' . $currentPageIndex . '.groups.' . $groupIndex . '.pg_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-12 col-md-8 pt-5">
                                @foreach ($pages[$currentPageIndex]['groups'] as $groupIndex => $group)
                                    {{-- variables  --}}
                                    @if ($groupIndex == $activeGroupIndex)
                                        <div class="row align-items-end mb-4 mb-md-0">
                                            <div class="col-md mb-4 mb-md-0">
                                                <h4>{{ __('panel.variables') }}</h4>
                                            </div>
                                            <div class="col-md-auto aos-init aos-animate" data-aos="fade-start">
                                                <a href=""
                                                    wire:click.prevent="addVariable({{ $currentPageIndex }}, {{ $groupIndex }})">
                                                    <i class="fas fa-plus-circle me-2"></i>
                                                    <span>
                                                        {{ __('panel.add_variable') }}
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        {{-- @foreach ($group['variables'] as $variableIndex => $variable) --}}
                                        @foreach ($pages[$currentPageIndex]['groups'][$activeGroupIndex]['variables'] as $variableIndex => $variable)
                                            <div class="card">
                                                <div class="card-header mb-0">
                                                    <div class="input-group mb-0" style="background: transparent;">
                                                        <div class="d-flex align-items-center">
                                                            <h3 class="mb-0 "
                                                                style="border:none;background:transparent">
                                                                <span>{{ __('panel.variable') }}</span>
                                                                <span><small>{{ $variableIndex + 1 }}</small>
                                                                </span>
                                                            </h3>
                                                            <a class="d-block mx-2"
                                                                style="background: none;border:none;cursor: pointer;"
                                                                wire:click.prevent="removeVariable({{ $currentPageIndex }}, {{ $groupIndex }}, {{ $variableIndex }})">
                                                                <i class="fas fa-trash-alt text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body mt-0">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label for="pv_name">{{ __('panel.pv_name') }}</label>
                                                                <input type="text" class="form-control"
                                                                    wire:model.defer="pages.{{ $currentPageIndex }}.groups.{{ $groupIndex }}.variables.{{ $variableIndex }}.pv_name">
                                                                @error('pages.' . $currentPageIndex . '.groups.' .
                                                                    $groupIndex . '.variables.' . $variableIndex .
                                                                    '.pv_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="pv_question">{{ __('panel.pv_question') }}</label>
                                                                <input type="text" class="form-control"
                                                                    wire:model.defer="pages.{{ $currentPageIndex }}.groups.{{ $groupIndex }}.variables.{{ $variableIndex }}.pv_question">
                                                                @error('pages.' . $currentPageIndex . '.groups.' .
                                                                    $groupIndex . '.variables.' . $variableIndex .
                                                                    '.pv_question')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 pt-3">
                                                            <label for="pv_type">{{ __('panel.pv_type') }}</label>
                                                            <select name="pv_type" class="form-control"
                                                                wire:model.defer="pages.{{ $currentPageIndex }}.groups.{{ $groupIndex }}.variables.{{ $variableIndex }}.pv_type">
                                                                <option value="1"
                                                                    {{ old('pv_type') == '1' ? 'selected' : null }}>
                                                                    {{ __('panel.pv_type_text') }}
                                                                </option>
                                                                <option value="2"
                                                                    {{ old('pv_type') == '2' ? 'selected' : null }}>
                                                                    {{ __('panel.pv_type_number') }}
                                                                </option>
                                                            </select>
                                                            @error('pages.' . $currentPageIndex . '.groups.' .
                                                                $groupIndex . '.variables.' . $variableIndex . '.pv_type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="col-sm-12 col-md-6 pt-3">
                                                            <label
                                                                for="pv_required">{{ __('panel.pv_required') }}</label>
                                                            <select name="pv_required" class="form-control"
                                                                wire:model.defer="pages.{{ $currentPageIndex }}.groups.{{ $groupIndex }}.variables.{{ $variableIndex }}.pv_required">
                                                                <option value="1"
                                                                    {{ old('pv_required') == '1' ? 'selected' : null }}>
                                                                    {{ __('panel.yes') }}
                                                                </option>
                                                                <option value="0"
                                                                    {{ old('pv_required') == '0' ? 'selected' : null }}>
                                                                    {{ __('panel.no') }}
                                                                </option>
                                                            </select>
                                                            @error('pages.' . $currentPageIndex . '.groups.' .
                                                                $groupIndex . '.variables.' . $variableIndex .
                                                                '.pv_required')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--  pv_details field --}}
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 pt-3">
                                                            <label for="pv_details">
                                                                {{ __('panel.pv_details') }}
                                                            </label>
                                                            <textarea name="pv_details" rows="10" class="form-control summernote"
                                                                wire:model.defer="pages.{{ $currentPageIndex }}.groups.{{ $groupIndex }}.variables.{{ $variableIndex }}.pv_details">
                                                                {!! old('pv_details') !!}
                                                            </textarea>
                                                            @error('pages.' . $currentPageIndex . '.groups.' .
                                                                $groupIndex . '.variables.' . $variableIndex .
                                                                '.pv_details')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
