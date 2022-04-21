<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Crawl Rozee Candidates</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
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
                                @foreach ($errors as $error)
                                <span class="small text-danger">
                                    {{ $error }}
                                </span>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Crawl
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
