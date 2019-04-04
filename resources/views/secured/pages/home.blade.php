@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <form action="{{ route('updateHomePageItemAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pageId" value="{{ $pageData->hp_id }}">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="block1">Section 1</label>
                            <input type="text" class="form-control" name="block1" id="block1" required value="{{ $pageData->block_1 }}">
                        </div>
                        <div class="col-6">
                            <label for="block1Ar">Section 1 Ar.</label>
                            <input type="text" class="form-control" name="block1Ar" id="block1Ar" required value="{{ $pageData->block_1_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="block2">Section 2</label>
                            <input type="text" class="form-control" name="block2" id="block2" required value="{{ $pageData->block_2 }}">
                        </div>
                        <div class="col-6">
                            <label for="block2Ar">Section 2 Ar.</label>
                            <input type="text" class="form-control" name="block2Ar" id="block2Ar" required value="{{ $pageData->block_2_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="block3">Section 3</label>
                            <textarea name="block3" id="block3" class="summernote">{{ $pageData->block_3 }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="block3Ar">Section 3 Ar.</label>
                            <textarea name="block3Ar" id="block3Ar" class="summernote">{{ $pageData->block_3_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="block4">Section 4</label>
                            <input type="text" class="form-control" name="block4" id="block4" required value="{{ $pageData->block_4 }}">
                        </div>
                        <div class="col-6">
                            <label for="block4Ar">Section 4 Ar.</label>
                            <input type="text" class="form-control" name="block4Ar" id="block4Ar" required value="{{ $pageData->block_4_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="block5">Section 5</label>
                            <textarea name="block5" id="block5" class="summernote">{{ $pageData->block_5 }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="block5Ar">Section 5 Ar.</label>
                            <textarea name="block5Ar" id="block5Ar" class="summernote">{{ $pageData->block_5_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection