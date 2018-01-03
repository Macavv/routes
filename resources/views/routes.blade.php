<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--End Styles -->
</head>
<body>
<div class="container">
    <h4>List off routes: Total: {{ count($routes) }}</h4>
</div>
<div class="container">
    <form method="get" action="{{ url('routes') }}">
        <div class="form-group row">
            <div class="col-md-4">
                <select class="form-control" title="method" name="method">
                    <option value="" {{ $request['method'] === '' ? 'selected' : '' }}>All</option>
                    <option value="GET" {{ strtoupper($request['method']) === 'GET' ? 'selected' : '' }}>GET</option>
                    <option value="POST" {{ strtoupper($request['method']) === 'POST' ? 'selected' : '' }}>POST</option>
                    <option value="PUT" {{ strtoupper($request['method']) === 'PUT' ? 'selected' : '' }}>PUT</option>
                    <option value="DELETE" {{ strtoupper($request['method']) === 'DELETE' ? 'selected' : '' }}>DELETE
                    </option>
                </select>
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" name="keyword" value="{{ $request['keyword'] }}"
                       placeholder="Keyword...">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-default btn-block">Search</button>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Methods</td>
                <td>Uri</td>
                <td>Middleware</td>
                <td>Name</td>
                <td>Controller</td>
            </tr>
            </thead>
            <tbody>
            @if(count($routes))
                @foreach ($routes as $route)
                    <tr>
                        <td>
                            @if(key_exists('methods', $route))
                                {{ implode('|', $route->methods) }}
                            @endif
                        </td>
                        <td>{{ $route->uri }}</td>
                        <td>
                            @if(key_exists('middleware', $route->action))
                                {{ implode('|', $route->action['middleware']) }}
                            @endif
                        </td>
                        <td>
                            @if(key_exists('as', $route->action))
                                {{ $route->action['as'] }}
                            @endif
                        </td>
                        <td>
                            @if(key_exists('uses', $route->action))
                                {{ ($route->action['uses'] instanceof \Closure) ? 'Closure' : $route->action['uses'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">No matching routes found!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>