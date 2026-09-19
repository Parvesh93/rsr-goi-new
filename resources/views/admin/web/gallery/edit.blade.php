<!-- Edit modal content -->
<div id="editModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="needs-validation" novalidate action="{{ route($route . '.update', $row->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ __('modal_edit') }} {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- Form Start -->
                    <div class="form-group">
                        <label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ $row->title }}" required>

                        <div class="invalid-feedback">
                            {{ __('required_field') }} {{ __('field_title') }}
                        </div>
                    </div>

                    {{-- <div class="form-group">
                    <label for="college_status">{{ __('field_college_status') }}
                        <span>*</span></label>
                    <select class="form-control" name="college_status" required>
                        <option value="">{{ __('select') }}</option>

                        <option value="1" @if ($row->college == 1) selected @endif>
                            {{ __('college_first') }}</option>
                        <option value="2" @if ($row->college == 2) selected @endif>
                            {{ __('college_second') }}</option>

                    </select>

                    <div class="invalid-feedback">
                        {{ __('required_field') }} {{ __('field_college_status') }}
                    </div>
                </div> --}}
                    <div class="form-group">
                        <label for="section" class="form-label">{{ __('field_slugType') }} <span>*</span></label>
                        <input type="text" class="form-control" name="section" id="section"
                            value="{{ $row->section }}" required>

                        <div class="invalid-feedback">
                            {{ __('required_field') }} {{ __('field_slugType') }}
                        </div>
                    </div>
                    
                     <div class="form-group col-md-12">
                                        <label for="button_link">{{ __('field_button_link') }}</label>
                                        <input type="url" class="form-control" name="button_link" id="button_link"
                                            value="{{ $row->button_link }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_button_link') }}
                                        </div>
                         </div>



                    <div class="form-group ">
                        <label for="attach">{{ __('field_photo') }}
                            <span>{{ __('image_size', ['height' => 'auto', 'width' => 800]) }}</span></label>
                        <input type="file" class="form-control" name="attach" id="attach"
                            value="{{ old('attach') }}">

                        <div class="invalid-feedback">
                            {{ __('required_field') }} {{ __('field_photo') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('field_description') }} </label>
                        <input type="text" class="form-control" name="description" id="description"
                            value="{{ $row->description }}">

                        <div class="invalid-feedback">
                            {{ __('required_field') }} {{ __('field_description') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">{{ __('select_status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" @if ($row->status == 1) selected @endif>
                                {{ __('status_active') }}</option>
                            <option value="0" @if ($row->status == 0) selected @endif>
                                {{ __('status_inactive') }}</option>
                        </select>
                    </div>
                    <!-- Form End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-times"></i> {{ __('btn_close') }}</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                        {{ __('btn_update') }}</button>
                </div>

            </form>
        </div>
    </div>
</div>
