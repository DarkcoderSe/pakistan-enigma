@extends('layouts.master')

@section('title', 'Crawled Candidates')

@push('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
<div class="container-fluid" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h5>
                                Crawled Candidates
                            </h5>
                        </div>
                        <div class="col-md-6 text-right">
                            {{-- <a href="{{ URL::to('export') }}" class="btn btn-success btn-sm">
                                Export Excel
                            </a> --}}
                            <a href="{{ URL::to('export') }}" class="btn btn-info btn-sm">
                                Send Mass Email
                            </a>
                        </div>
                    </div>
                    <form id="candidateForm" action="{{ URL::to('/export-to-excel') }}" method="post">
                        <table id="candidateTable" class="table table-default table-sm">
                            <thead>
                                <tr>
                                    <th class="pl-4">
                                        <input type="checkbox" id="select-all" >
                                    </th>
                                    @isset($headers)
                                        @foreach ($headers as $header)
                                        <th class="pl-4">
                                            {{ ucwords(str_replace('_', ' ', $header)) }}
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
                                            <input type="hidden" name="{{ $header }}[]" value="{{ $candidate[$header] ?? '' }}">
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')






<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#candidateTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('#select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>
@endpush
