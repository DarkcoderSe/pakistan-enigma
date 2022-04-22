@extends('layouts.master')

@section('title', 'Crawl Candidates from Rozee.pk')


@section('content')
<div class="container" style="margin-top: 150px;">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <h3>
                Get Aawam Detail
            </h3>
        </div>
    </div>
    <div class="row justify-content-center mt-4 pt-3">
        <div class="col-md-6">
            <form action="{{ URL::to('submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Phone Number / CNIC</label>
                        <input type="text" name="number" class="form-control" placeholder="3XXX... OR CNIC" required>

                        @if ($errors->any('files'))
                        @foreach ($errors->all() as $error)
                        <span class="small text-danger">
                            {{ $error }}
                        </span>
                        @endforeach
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Get Detail
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
