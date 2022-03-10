<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        table.blueTable {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            border: 1px solid #FFFFFF;
            background-color: #F4F4F4;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        table.blueTable td,
        table.blueTable th {
            border: 1px solid #AAAAAA;
            padding: 3px 2px;
        }

        table.blueTable tbody td {
            font-size: 11px;
        }

        table.blueTable tr:nth-child(even) {
            background: #FFFFFF;
        }

        table.blueTable thead tr {
            background: #f7cee2 !important;
            background: -moz-linear-gradient(top, #f7cee2 0%, #f7cee2 66%, #f7cee2 100%);
            background: -webkit-linear-gradient(top, #f7cee2 0%, #f7cee2 66%, #f7cee2 100%);
            background: linear-gradient(to bottom, #f7cee2 0%, #f7cee2 66%, #f7cee2 100%);
        }

        table.blueTable th {
            font-size: 13px;
            font-weight: normal;
            color: #d54c4c;
            text-align: center;
        }

        table.blueTable tfoot {
            font-size: 12px;
            font-weight: normal;
            background: #cccaf0;
            background: -moz-linear-gradient(top, #cccaf0 0%, #cccaf0 66%, #cccaf0 100%);
            background: -webkit-linear-gradient(top, #cccaf0 0%, #cccaf0 66%, #cccaf0 100%);
            background: linear-gradient(to bottom, #cccaf0 0%, #cccaf0 66%, #cccaf0 100%);
        }

        table.blueTable tfoot td {
            font-size: 12px;
        }

        table.blueTable tfoot tr {
            background-color: #cfdfef;
            color: #000000;
        }

        table.blueTable td.cat_parent {
            color: #ffffff !important;
            background: #5b9bd5 !important;
        }

        table.blueTable td.cat {
            background-color: #cfdfef;
            color: #000000;
        }

        .head {
            text-align: center;
            margin: 16px 0 36px;
        }

        .head .title {
            font-size: 36px;
            text-transform: uppercase;
        }

        .head .description {
            font-size: 18px;
            margin: 8px 0 16px;
        }

    </style>
</head>

<body>

    <header>
        <div class="entet">
            <img src="{{ public_path('entete_tawzer.png') }}" style="width: 100%;">
        </div>
    </header>


    <div class="head">
        <div class="title">
            {{ $project['name'] }}
        </div>

        <div class="description">
            {{ $project['description'] }}
        </div>
    </div>
    @php
        $parent_name = '';
        $cat_name = '';
    @endphp

    <table class="blueTable">

        <thead>
            <tr bgcolor='#f7cee2'>
                <th colspan="2">Catégorie</th>
                <th>Libelé</th>
                <th>Standard</th>
                <th>Actual</th>
                <th>Gap</th>
            </tr>
        </thead>

        {{-- {{ dd($categories) }} --}}

        @foreach ($sag ?? '' as $category)
            @foreach ($category['services'] as $service)
                <tr>

                    @if ($cat_name != $category['name'])
                        <td rowspan="{{ count($category['services']) + 1 }}" class="cat_parent">
                            {{ $category['parent_name'] }}
                        </td>
                    @endif

                    @if ($parent_name != $category['parent_name'])
                    @endif

                    @php
                        $parent_name = $category['parent_name'];
                    @endphp

                    @if ($cat_name != $category['name'])
                        <td rowspan="{{ count($category['services']) + 1 }}" class="cat">
                            {{ $category['name'] }}
                        </td>
                    @endif
                    
                    @php
                        $cat_name = $category['name'];
                    @endphp

                    <td>{{ $service['name'] }}</td>
                    <td>{{ $service['qty'] }}</td>
                    <td>{{ $service['actual'] }}</td>
                    <td>{{ $service['gap'] }}</td>

                </tr>
            @endforeach
            <tfoot>
                @if (isset($category['qty']) && $category['qty'] != 0)
                    <tr>
                        <td> </td>
                        <td>{{ $category['qty'] }}</td>
                        <td>{{ $category['actual'] }}</td>
                        <td>{{ $category['gap'] }}</td>

                    </tr>
                @endif
            </tfoot>
        @endforeach



    </table>

    @env('local')
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endenv
</body>

</html>
