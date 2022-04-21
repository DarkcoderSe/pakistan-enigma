@extends('layouts.master')

@section('title', 'Crawl Candidates from Rozee.pk')


@section('content')
<div class="container" style="margin-top: 150px;">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <h3>
                Crawl Rozee.pk Candidates
            </h3>
        </div>
    </div>
    <div class="row justify-content-center mt-4 pt-3">
        <div class="col-md-6">
            <form action="{{ URL::to('submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Files ( <span class="small text-danger">*Html files only</span> )</label>
                        <input type="file" name="files[]" class="form-control" placeholder="Select HTML Files" multiple required>

                        @if ($errors->any('files'))
                        @foreach ($errors->all() as $error)
                        <span class="small text-danger">
                            {{ $error }}
                        </span>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            Please, select the attributes you want to crawl.
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" disabled checked>
                                Name
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="phone" checked>
                                Phone
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="email" checked>
                                Email
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="current_salary">
                                Current Salary
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="expected_salary">
                                Expected Salary
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="experience">
                                Experience
                            </label>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">
                    Crawl
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
