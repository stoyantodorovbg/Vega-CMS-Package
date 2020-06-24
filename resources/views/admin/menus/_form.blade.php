<form method="POST"
      action="{{ isset($menu) ? route('admin-menus.update', $menu->getSlug()) : route('admin-menus.store') }}"
>
    @csrf
    @if(isset($menu)) @method('PATCH') @endif
    <div class="row">
        <div class="form-group col-6">
            <label class="text-uppercase">{{ phrase('labels.status') }}</label>
            <select class="form-control text-capitalize" name="status" id="admin-form-locale-status">
                <option>{{ phrase('labels.choose_status') }}</option>
                <option {{ isset($menu) && $menu->status === 1 ? 'selected' : '' }} value="1">
                    {{ phrase('labels.active') }}
                </option>
                <option {{ isset($menu) && $menu->status === 0 ? 'selected' : '' }} value="0">
                    {{ phrase('labels.inactive') }}
                </option>
            </select>
        </div>
        <div class="form-group col-6">
            <label class="text-uppercase">{{ phrase('labels.classes') }}</label>
            <input type="text"
                   name="classes"
                   value="{{ isset($menu) ? old('name', $menu->classes) : '' }}"
                   id="admin-form-menu-classes"
                   class="form-control"
            >
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="text-uppercase">{{ phrase('labels.title') }}</label>
            <json-input json_data="{{ isset($menu) ? $menu->title : $defaultJsonFieldsData['title'] }}"
                        input_name="title"
                        :level="1"
            ></json-input>
        </div>
        <div class="form-group col-6">
            <label class="text-uppercase">{{ phrase('labels.description') }}</label>
            <json-input json_data="{{ isset($menu) ? $menu->description : $defaultJsonFieldsData['description'] }}"
                        input_name="description"
                        :level="1"
            ></json-input>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="text-uppercase">{{ phrase('labels.styles') }}</label>
            <json-input json_data="{{ isset($menu) ? $menu->styles : $defaultJsonFieldsData['styles'] }}"
                        input_name="styles"
                        :level="1"
            ></json-input>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary float-right text-uppercase pl-5 pr-5">
                {{ phrase('buttons.submit') }}
            </button>
        </div>

    </div>
</form>


