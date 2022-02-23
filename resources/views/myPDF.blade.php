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
            background: #FFEB9C !important;
            background: -moz-linear-gradient(top, #fff0b5 0%, #ffeda6 66%, #FFEB9C 100%);
            background: -webkit-linear-gradient(top, #fff0b5 0%, #ffeda6 66%, #FFEB9C 100%);
            background: linear-gradient(to bottom, #fff0b5 0%, #ffeda6 66%, #FFEB9C 100%);
        }

        table.blueTable th {
            font-size: 13px;
            font-weight: normal;
            color: #9C5700;
            text-align: center;
        }

        table.blueTable tfoot {
            font-size: 12px;
            font-weight: normal;
            background: #add0ee;
            background: -moz-linear-gradient(top, #add0ee 0%, #add0ee 66%, #add0ee 100%);
            background: -webkit-linear-gradient(top, #add0ee 0%, #add0ee 66%, #add0ee 100%);
            background: linear-gradient(to bottom, #add0ee 0%, #add0ee 66%, #add0ee 100%);
        }

        table.blueTable tfoot td {
            font-size: 12px;
        }

        table.blueTable tfoot tr {
            background-color: rgb(198, 239, 206);
            color: rgb(0, 97, 0);
        }

        table.blueTable td.cat_parent {
            color: #ffffff !important;
            background: #5b9bd5 !important;
        }

        table.blueTable td.cat {
            background-color: rgb(198, 239, 206);
            color: rgb(0, 97, 0);
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
            <tr bgcolor='#FFEB9C'>
                <th colspan="2">Catégorie</th>
                <th>Libelé</th>
                <th>Unité de mesure</th>
                <th>Quantité</th>
                <th>Ratio Méthe/heure</th>
                <th>Occupation. /Heure</th>
                <th>Coût Horaire</th>
                <th>Total</th>
                <th>Marge</th>
                <th>%</th>
                <th>Coût + Marge</th>
            </tr>
        </thead>

        {{-- {{ dd($categories) }} --}}

        @foreach ($categories ?? '' as $category)

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
                    <td>{{ $service['unit_measure'] }}</td>
                    <td>{{ $service['qty'] }}</td>
                    <td>{{ $service['qty'] / $service['occup_hour'] }}</td>
                    <td>{{ $service['occup_hour'] }}</td>
                    <td>{{ $service['price'] }}</td>
                    <td>{{ $service['total'] }}</td>
                    <td>{{ ($service['total'] * $service['profit_margin_p_c']) / 100 }}</td>
                    <td>{{ $service['profit_margin_p_c'] }}</td>
                    <td>{{ $service['total_plus_margin'] }}</td>
                </tr>
            @endforeach
            <tfoot>
                @if (isset($category['qty']) && $category['qty'] != 0)
                    <tr>
                        <td>{{ $category['id'] }}</td>
                        <td></td>
                        <td>{{ $category['qty'] }}</td>
                        <td></td>
                        <td>{{ $category['occup_hour'] }}</td>
                        <td>{{ $category['price'] }}</td>
                        <td>{{ $category['total'] }}</td>
                        <td>{{ ($category['total'] * $category['profit_margin_p_c']) / 100 }}</td>
                        <td>{{ $category['profit_margin_p_c'] }}</td>
                        <td>{{ $category['total_plus_margin'] }}</td>
                    </tr>
                @endif
            </tfoot>

        @endforeach

        @if (!$factors->isEmpty())

            @php
                $valueTotal = 0;
            @endphp
            @foreach ($factors ?? '' as $key => $factor)

                @php
                    $valueTotal += $factor['value'];
                @endphp

                <tr>
                    @if ($key == 0)
                        <td rowspan="{{ count($factors) + 1 }}" class="cat_parent">
                            Les charges proportionnelles
                        </td>
                        <td rowspan="{{ count($factors) + 1 }}" class="cat">
                            Facteurs HASSPVR
                        </td>
                    @endif
                    <td colspan="4">{{ $factor['name'] }}</td>
                    <td colspan="6">{{ $factor['value'] }}%</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Total Risques HASSPVR</td>
                <td colspan="6">{{ round($valueTotal / count($factors), 2) }}%</td>
            </tr>
        @endif

    </table>
    </div>

    <br>
    <br>
    <div>
        <style>
            .epo {
                background-color: rgb(198, 239, 206);
                color: rgb(0, 97, 0);
            }

            .epp {
                background-color: rgb(255, 235, 156);
                color: rgb(156, 87, 0);
            }

            .epps {
                background-color: rgb(255, 199, 206);
                color: rgb(156, 0, 6);
            }

            .em {
                background-color: rgb(217, 224, 242);
                color: rgb(0, 0, 0);
            }

            .pv {
                background-color: rgb(68, 114, 196);
                color: rgb(255, 255, 255);
            }

        </style>

        <table class="blueTable">
            <tr>
                <td class="epo">Estimation le plus optimiste</td>
                <td>{{ $project['epo'] }}</td>
            </tr>
            <tr>
                <td class="epp">Estimation le plus probable</td>
                <td>{{ $project['epp'] }}</td>
            </tr>
            <tr>
                <td class="epps">Estimation le plus pessimiste</td>
                <td>{{ $project['epps'] }}</td>
            </tr>
            <tr>
                <td class="em">Estimation Moyen</td>
                <td>{{ $project['em'] }}</td>
            </tr>
            <tr>
                <td class="pv">Prix de vente H.T</td>
                <td>{{ $project['em'] }}</td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <div>
        <table class="blueTable">
            <tr>
                <td colspan="6" class="pv">SMPH = square meter per hour or LMPH = linear meter per hour</td>
            </tr>
            <tr>
                <td colspan="3" class="pv">Coût SMPH</td>
                <td colspan="3" class="pv"> Coût LMPH</td>
            </tr>
            <tr>
                <td>Custommer Demand</td>
                <td>1</td>
                <td rowspan="2" class="epo">{{ $project['smph'] }}</td>


                <td>Custommer Demand</td>
                <td>1</td>
                <td rowspan="2" class="epo">{{ $project['lmph'] }}</td>

            </tr>

            <tr>
                <td>Production Available Time</td>
                <td>4</td>

                <td>Production Available Time</td>
                <td>4</td>

            </tr>

        </table>
    </div>

    @env('local')
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endenv
</body>

</html>
