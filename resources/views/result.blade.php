@extends('layouts.master')

@section('title', 'Crawled Candidates')


@section('content')
<div class="container-fluid" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-4">
            <div class="card mb-4">
                <div class="card-body p-0">
                    <div class="row m-2">
                        <div class="col-md-6">
                            <h5>
                                Crawled Candidates
                            </h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ URL::to('export') }}" class="btn btn-primary btn-sm">
                                Export Excel
                            </a>
                            <a href="{{ URL::to('export') }}" class="btn btn-info btn-sm">
                                Send Mass Email
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-sm m-0">
                        <thead>
                            <tr>
                                <th class="pl-4">
                                    <input type="checkbox" id="checkall" >
                                </th>
                                @isset($headers)
                                    @foreach ($headers as $header)
                                    <th class="pl-4">
                                        {{ $header }}
                                    </th>
                                    @endforeach
                                @endisset
                            </tr>
                        </thead>
                        <tbody>
                            @isset($candidates)
                                @foreach ($candidates as $key => $candidate)
                                <tr>
                                    <td class="pl-4">
                                        <input class="candidate" type="checkbox" name="candidate[]" >
                                    </td>
                                    @foreach ($headers as $header)
                                    <td class="pl-4">
                                        {{ $candidate[$header] ?? '' }}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script>

</script>
@endpush
