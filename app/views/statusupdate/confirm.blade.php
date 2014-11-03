<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/custom.css') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/favicon.ico') }}" />
        <title>Confirm Status Update</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/favicon.ico') }}" />
    </head>
    
    <body>
        <div class="well">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Are You Sure to Update this status?
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{url('update')}}" method="post">
                        <div class="form-group">
                            <textarea name="status" class="form-control">{{ $status }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Confirm!</button>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>