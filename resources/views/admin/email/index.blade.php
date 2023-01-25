@extends('admin.templates.default')

@section('content')

    <div class="content flex-column-fluid" id="kt_content">
        <div class="card">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{$title}}</span>
                        <span class="text-muted mt-1 fw-bold fs-7">{{$subtitle ?? ''}}</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <form id="modal_form_form" class="form" action="{{ route('email.store') }}" method="post" >
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Kepada</span>
                            </label>
                            <input type="email" class="form-control form-control-solid" placeholder="isi email" name="email" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Isi Email</span>
                            </label>
                            <textarea type="text" class="form-control form-control-solid" rows="10" name="body"></textarea>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" id="modal_form_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')

    <script>
        var element = document.getElementById('menu-email');
            element.classList.add('active');
    </script>

    <script>
        // Define form element
        const form = document.getElementById('modal_form_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan isi email!'
                            }
                        }
                    },
                    'body': {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan isi email!'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('modal_form_submit');
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        form.submit();
                    }
                });
            }
        });
    </script>

@endpush
