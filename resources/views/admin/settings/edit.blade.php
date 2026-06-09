@extends('admin.masterAdmin')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card card-fullheight">
            <div class="card-header">
                <h5 class="box-title">Update Website Settings</h5>
            </div>

            <div class="card-body">

                @include('components.alert')

                {!! Form::open(['route' => 'settings.update', 'method' => 'post', 'files' => true]) !!}

                <div class="row">

                    {{-- Logo --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Logo</label>
                            <input class="form-control" type="file" name="logo">
                            @if($setting->logo)
                            <img src="{{ asset('settings/'.$setting->logo) }}" width="100" class="mt-2 img-thumbnail">
                            @endif
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Favicon</label>
                            <input class="form-control" type="file" name="favicon">
                            @if($setting->favicon)
                            <img src="{{ asset('settings/'.$setting->favicon) }}" width="40" class="mt-2 img-thumbnail">
                            @endif
                        </div>
                    </div>

                    {{-- Site Title --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Site Title <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="site_title"
                                value="{{ old('site_title', $setting->site_title) }}" required>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Site Description</label>
                            <textarea class="form-control" name="desc">{{ old('desc', $setting->desc) }}</textarea>
                        </div>
                    </div>

                    {{-- Hotline --}}
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label>Hotline</label>
                            <input class="form-control" type="text" name="hotline"
                                value="{{ old('hotline', $setting->hotline) }}">
                        </div>
                    </div>

                    {{-- Time --}}
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label>Time</label>
                            <input class="form-control" type="text" name="time"
                                value="{{ old('time', $setting->time) }}">
                        </div>
                    </div>

                    {{-- Mail --}}
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input class="form-control" type="text" name="mail"
                                value="{{ old('mail', $setting->mail) }}">
                        </div>
                    </div>

                    {{-- Copyright --}}
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Copyright</label>
                            <input class="form-control" type="text" name="copyright"
                                value="{{ old('copyright', $setting->copyright) }}">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <span class="badge badge-success mb-4 d-block">SEO Section Start</span>
                    </div>
                    {{-- SEO Fields --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Meta Title</label>
                            <input class="form-control" type="text" name="meta_title"
                                value="{{ old('meta_title', $setting->meta_title) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Meta Keywords</label>
                            <textarea class="form-control"
                                name="meta_keywords">{{ old('meta_keywords', $setting->meta_keywords) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Meta Description</label>
                            <textarea class="form-control"
                                name="meta_description">{{ old('meta_description', $setting->meta_description) }}</textarea>
                        </div>
                    </div>

                    {{-- Analytics --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Facebook Pixel Code</label>
                            <textarea class="form-control"
                                name="facebook_pixel">{{ old('facebook_pixel', $setting->facebook_pixel) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Google Analytics Script</label>
                            <textarea class="form-control"
                                name="google_analytics">{{ old('google_analytics', $setting->google_analytics) }}</textarea>
                        </div>
                    </div>

                    {{-- Allow Indexing --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Allow Search Engine Indexing</label>
                            <select class="form-control" name="allow_indexing">
                                <option value="1" {{ $setting->allow_indexing ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$setting->allow_indexing ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>

                    {{-- Header Scripts --}}
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Custom Header Scripts</label>
                            <textarea class="form-control"
                                name="custom_header_scripts">{{ old('custom_header_scripts', $setting->custom_header_scripts) }}</textarea>
                        </div>
                    </div>

                    {{-- Footer Scripts --}}
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Custom Footer Scripts</label>
                            <textarea class="form-control"
                                name="custom_footer_scripts">{{ old('custom_footer_scripts', $setting->custom_footer_scripts) }}</textarea>
                        </div>
                    </div>

                </div>

                <button class="btn btn-primary" type="submit">Update Settings</button>

                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>

@endsection