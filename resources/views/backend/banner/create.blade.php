@extends('backend.layouts.admin_layouts')
@section('admin_content')

<script src="{{ asset('backend/js/script.js') }}"></script>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <!-- Banner Add Section -->
                <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Banner Heading</h6>
                        <a href="{{ route('admin.banner.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right;"><i class="fas fa-arrow-left"></i>  Back</a>
                      </div>

                      <!-- Card Body -->
                      <div class="card-body">
                        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body pd-20 row">
                                <div class="form-group col-lg-12">
                                    <label for="title">Banner Title :</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="emailHelp" placeholder="Banner Title">
                                    <!--- Error Message -->
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="image">Banner image :</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" aria-describedby="emailHelp" onchange="showImage(this, 'profile_photo')" placeholder="Photo Here">
                                    <!--- Error Message -->
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <img src="{{ asset('backend/img/camera.png') }}" alt="banner_image" id="profile_photo" style="height: 100px;width: 200px;">
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="description">Banner Description :</label>
                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" aria-describedby="emailHelp" placeholder="Banner Description"></textarea>
                                    <!--- Error Message -->
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="condition">Banner Condition :</label>
                                    <select name="condition" id="condition" class="form-control @error('description') is-invalid @enderror" aria-label="Default select example">
                                        <option selected>Condition</option>
                                        <option value="banner" {{ old(('condition')=='banner' ? 'selected' : '') }}>Banner</option>
                                        <option value="promo" {{ old(('condition')=='promo' ? 'selected' : '') }}>Promo</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="status">Banner Status :</label>
                                    <select name="status" id="status" class="form-control @error('description') is-invalid @enderror" aria-label="Default select example">
                                        <option selected>Status</option>
                                        <option value="active" {{ old(('status')=='active' ? 'selected' : '') }}>Active</option>
                                        <option value="inactive" {{ old(('status')=='inactive' ? 'selected' : '') }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info btn-block pd-x-20">Submit</button>
                            </div>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>

@endsection



