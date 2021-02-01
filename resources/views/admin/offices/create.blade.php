@extends('admin.layouts.master')

@section('title', 'Add office')

@section('content')
    <form action="{{ route('admin.offices.store') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="site_position" value="{{ $sitePosition }}">
        @csrf

        @component('admin.components.name')
            <div class="form-group">
                <label for="address">Address*</label>
                <div class="input-group">
                    <input type="text" name="address" id="address"
                           class="form-control @error('address') is-invalid @enderror"
                           placeholder="English" value="{{ old('address') }}" required>

                    <input type="text" name="address_ar" class="form-control @error('address_ar') is-invalid @enderror"
                           placeholder="Arabic" value="{{ old('address_ar') }}" required>

                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @error('address_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="example@mail.com" value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="form-row form-group">
                <div class="col-6">
                    <label for="lat">Latitude</label>
                    <input type="text" name="lat" id="lat"
                           class="form-control"
                           placeholder="30.015654" value="{{ old('lat') }}">
                </div>
                <div class="col-6">
                    <label for="lng">Longitude</label>
                    <input type="text" name="lng" id="lng"
                           class="form-control"
                           placeholder="31.412349" value="{{ old('lng') }}">
                </div>
            </div>

            <div class="repeater">
                <table class="table table-borderless table-sm">
                    <thead class="text-black-50">
                        <tr>
                            <th class="p-0">Phone</th>
                            <th class="p-0">Phone owner</th>
                        </tr>
                    </thead>
                    <tbody data-repeater-list="phones">
                        <tr data-repeater-item>
                            <td class="pl-0">
                                <input type="text" name="phone" id="phone"
                                       class="form-control form-control-sm"
                                       placeholder="+1 (234) 56789">
                            </td>
                            <td class="">
                                <div class="form-row">
                                    <div class="input-group">
                                        <input type="text" name="phone_label" id="phone_label"
                                               class="col form-control form-control-sm"
                                               placeholder="English">

                                        <input type="text" name="phone_label_ar"
                                               class="col form-control form-control-sm rounded-right"
                                               placeholder="Arabic">

                                        <button data-repeater-delete
                                                type="button"
                                                class="bg-white border-0 text-danger"
                                                title="Delete phone">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button data-repeater-create type="button" class="btn btn-outline-light btn-block bg-white text-success border">
                    Add phone
                </button>
            </div>
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => URL::previous()
        ])
    </form>
@endsection

@push('scripts')
    <script>
        $('.repeater').repeater({
            isFirstItemUndeletable: true
        });
    </script>
@endpush
