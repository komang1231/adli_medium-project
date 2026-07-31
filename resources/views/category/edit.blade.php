{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Category
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Category</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('categories.update', $category->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('category.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}

<div class="row">

    <div class="col-md-12">

        <div class="form-group mb-4">

            <label class="form-label">
                Nama Category
            </label>

            <input
                id="edit_nama_category"
                name="nama_category"
                class="form-control">

        </div>

    </div>

    <div class="col-md-12">

        <button type="submit" class="btn btn-submit">

            Submit

        </button>

    </div>

</div>
