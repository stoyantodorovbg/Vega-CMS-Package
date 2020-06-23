<form method="POST"
      action="{{ isset($phrase) ? route('admin-phrases.update', $phrase->getSlug()) :  route('admin-phrases.store') }}"
>
    @csrf
    @if(isset($phrase))
        @method('PATCH')
    @endif
    <div class="row">
        <div class="form-group col-12">
            <label class="text-capitalize">{{ phrase('labels.system_name') }}</label>
            <input type="text"
                   name="system_name"
                   value="{{ isset($phrase) ? old('system_name', $phrase->system_name) : '' }}"
                   id="admin-form-phrase-system_name"
                   class="form-control"
            >
        </div>
    </div>
    @foreach($activeLocales as $locale)
        <div class="row mb-5">
            <div class="input-group flex-nowrap col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ $locale->code }}</span>
                </div>
                <input type="text"
                       name="{{ 'text[' . $locale->code . ']' }}"
                       value="{{ isset($phrase, $phraseTranslations[$locale->code]) ?  $phraseTranslations[$locale->code] : '' }}"
                       id="admin-form-phrase-text"
                       class="form-control"
                >
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary float-right text-uppercase pl-5 pr-5">
                {{ phrase('buttons.submit') }}
            </button>
        </div>

    </div>
</form>
