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
                    <td>{{ round($service['qty'] / $service['occup_hour'], 2) }}</td>
                    <td>{{ $service['occup_hour'] }}</td>
                    <td>{{ $service['price'] }}</td>
                    <td>{{ round($service['total'], 2) }}</td>
                    <td>{{ round(($service['total'] * $service['profit_margin_p_c']) / 100, 2) }}</td>
                    <td>{{ round($service['profit_margin_p_c'], 2) }}</td>
                    <td>{{ round($service['total_plus_margin'], 2) }}</td>
                </tr>
            @endforeach
            <tfoot>
                @if (isset($category['qty']) && $category['qty'] != 0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $category['qty'] }}</td>
                        <td></td>
                        <td>{{ $category['occup_hour'] }}</td>
                        <td>{{ round($category['price'], 2) }}</td>
                        <td>{{ round($category['total'], 2) }}</td>
                        <td>{{ round(($category['total'] * $category['profit_margin_p_c']) / 100, 2) }}</td>
                        <td>{{ round($category['profit_margin_p_c'], 2) }}</td>
                        <td>{{ round($category['total_plus_margin'], 2) }}</td>
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
                background-color: #cfdfef;
                color: #000000;
            }

            .epp {
                background-color: #cccaf0;
                color: #000000;
            }

            .epps {
                background-color: #f7cee2;
                color: #000000;
            }

            .em {
                background-color: #f7e3cc;
                color: #000000;
            }

            .pv {
                background-color: #cccaf0;
                color: #000000;
            }

        </style>


        @php
            
            $percent = 0.4;
            $epo_gain_marge = $project['epo'] * $percent;
            $epp_gain_marge = $project['epp'] * $percent;
            $epps_gain_marge = $project['epps'] * $percent;
            $em_gain_marge = $project['em'] * $percent;
            
        @endphp

        <table class="blueTable">
            <thead>
                <tr>
                    <td></td>
                    <td>%</td>
                    <td>Total</td>
                    <td>Marge</td>
                </tr>
            </thead>
            <tr>
                <td class="epo">Estimation le plus optimiste</td>
                <td rowspan="5">40%</td>
                <td class="em">{{ round($project['epo'], 2) }} Dhs</td>
                <td>{{ round($epo_gain_marge, 2) }} Dhs</td>
            </tr>
            <tr>
                <td class="epp">Estimation le plus probable</td>
                <td class="em">{{ round($project['epp'], 2) }} Dhs</td>
                <td>{{ round($epp_gain_marge, 2) }} Dhs</td>
            </tr>
            <tr>
                <td class="epps">Estimation le plus pessimiste</td>
                <td class="em">{{ round($project['epps'], 2) }} Dhs</td>
                <td>{{ round($epps_gain_marge, 2) }} Dhs</td>
            </tr>
            <tr>
                <td class="em">Estimation Moyen</td>
                <td class="em">{{ round($project['em'], 2) }} Dhs</td>
                <td>{{ round($em_gain_marge, 2) }} Dhs</td>
            </tr>
            <tr>
                <td class="pv">Prix de vente H.T</td>
                <td class="em">{{ round($project['em'], 2) }} Dhs</td>
                <td>{{ round($em_gain_marge, 2) }} Dhs</td>
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
                <td>{{ $project['smph_custommer_demand'] }}</td>
                <td rowspan="2" class="epo">{{ round($project['smph'], 2) }} Dhs/m</td>


                <td>Custommer Demand</td>
                <td>{{ $project['lmph_custommer_demand'] }}</td>
                <td rowspan="2" class="epo">{{ round($project['lmph'], 2) }} Dhs/m</td>

            </tr>

            <tr>
                <td>Production Available Time</td>
                <td>{{ $project['smph_production_available_time'] }}</td>

                <td>Production Available Time</td>
                <td>{{ $project['lmph_production_available_time'] }}</td>

            </tr>

        </table>

        <br>

        @php
            
            $smph_cd = $project['smph_custommer_demand'] == 0 ? 1 : $project['smph_custommer_demand'];
            $smph_pat = $project['smph_production_available_time'] == 0 ? 1 : $project['smph_production_available_time'];
            $lmph_cd = $project['lmph_custommer_demand'] == 0 ? 1 : $project['lmph_custommer_demand'];
            $lmph_pat = $project['lmph_production_available_time'] == 0 ? 1 : $project['lmph_production_available_time'];
            
            $smph_epo = ($project['epo'] * $smph_pat) / $smph_cd;
            $lmph_epo = ($project['epo'] * $lmph_pat) / $lmph_cd;
            
            $smph_epp = ($project['epp'] * $smph_pat) / $smph_cd;
            $lmph_epp = ($project['epp'] * $lmph_pat) / $lmph_cd;
            
            $smph_epps = ($project['epps'] * $smph_pat) / $smph_cd;
            $lmph_epps = ($project['epps'] * $lmph_pat) / $lmph_cd;
            
        @endphp


        <table class="blueTable">
            <tr>
                <td colspan="2" class="pv">Coût SMPH</td>
                <td colspan="2" class="pv"> Coût LMPH</td>
            </tr>

            <tr>
                <td>SMPH from Estimation le plus optimiste</td>
                <td class="epo">{{ round($smph_epo, 2) }} Dhs/m </td>

                <td>LMPH from Estimation le plus optimiste</td>
                <td class="epo">{{ round($lmph_epo, 2) }} Dhs/m </td>
            </tr>

            <tr>
                <td>SMPH from Estimation le plus probable</td>
                <td class="epo">{{ round($smph_epp, 2) }} Dhs/m </td>

                <td>LMPH from Estimation le plus probable</td>
                <td class="epo">{{ round($lmph_epp, 2) }} Dhs/m </td>
            </tr>

            <tr>
                <td>SMPH from Estimation le plus pessimiste</td>
                <td class="epo">{{ round($smph_epps, 2) }} Dhs/m </td>

                <td>LMPH from Estimation le plus pessimiste</td>
                <td class="epo">{{ round($lmph_epps, 2) }} Dhs/m </td>
            </tr>

        </table>
    </div>

    @env('local')
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endenv
</body>

</html>
