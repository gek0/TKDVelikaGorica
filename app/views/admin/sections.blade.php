@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <div id="cover-image">
            {{ Form::open(['url' => route('admin-sectionsPOST'), 'role' => 'form', 'id' => 'admin-sections', 'class' => 'form-element']) }}
                @foreach($sections_data as $section)
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="{{ $section->section_name }}">Ime sekcije:</label>
                                <input class="form-input-control disabled not-allowed" placeholder="Ime sekcije" readonly="readonly" name="{{ $section->section_name }}" type="text" value="{{ $section->section_name }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="{{ $section->section_name.'_status' }}">Sekcija vidljiva:</label>
                                <div data-toggle="buttons">
                                    <label class="btn btn-default btn-circle btn-lg @if($section->enabled === 'yes') active @endif">
                                        <input type="radio" name="{{ $section->section_name.'_status' }}" value="yes" @if($section->enabled === 'yes') checked @endif>Da <i class="fa fas fa-check fa-fw"></i>
                                    </label>
                                    <label class="btn btn-default btn-circle btn-lg @if($section->enabled === 'no') active @endif">
                                        <input type="radio" name="{{ $section->section_name.'_status' }}" value="no" @if($section->enabled === 'no') checked @endif>Ne <i class="fa fas fa-times fa-fw"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="text-center">
                    <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@include('admin.layout.footer')