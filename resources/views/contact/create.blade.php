@extends('layout.main')

@section('title', 'Add Contact')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-6">
                <h1 class="h3 mb-3">Add Contact</h1>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('contacts') }}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('partials.alerts')
                        <form action="{{ route('contact.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" id="first_name" name="first_name" placeholder="First Name!"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }}">

                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name!"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }}">

                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror"
                                            id="category_id" name="category_id">
                                            <option value="">Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" id="email" name="email" placeholder="Email!"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">

                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input type="text" id="mobile" name="mobile" placeholder="Mobile!"
                                            class="form-control @error('mobile') is-invalid @enderror"
                                            value="{{ old('mobile') }}">

                                        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">DoB</label>
                                        <input type="date" id="dob" name="dob"
                                            class="form-control
                                            @error('dob') is-invalid @enderror"
                                            value="{{ old('dob') }}">

                                        @error('dob')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" id="facebook" name="facebook" placeholder="Facebook!"
                                            class="form-control @error('facebook') is-invalid @enderror"
                                            value="{{ old('facebook') }}">

                                        @error('facebook')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Insatgram</label>
                                        <input type="text" id="instagram" name="instagram" placeholder="Insatgram!"
                                            class="form-control @error('instagram') is-invalid @enderror"
                                            value="{{ old('instagram') }}">

                                        @error('instagram')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">YouTube</label>
                                        <input type="text" id="youtube" name="youtube" placeholder="YouTube!"
                                            class="form-control @error('youtube') is-invalid @enderror"
                                            value="{{ old('youtube') }}">

                                        @error('youtube')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="picture" class="form-label">Picture</label>
                                        <input type="file" name="picture" id="picture"
                                            class="form-control @error('picture') is-invalid @enderror">
                                        @error('picture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="2"
                                            placeholder="Address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <input type="submit" value="Add" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
