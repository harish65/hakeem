<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @font-face {

            font-family: 'Mayeka Regular Demo', sans-serif;
            src: url('../ecom-template-seven/fonts/Mayeka Bold Demo.otf') format('otf'),
                url('../ecom-template-seven/fonts/Mayeka Regular Demo.otf') format('otf');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'ZonaPro-Thin';
            src: url('../ecom-template-seven/fonts/ZonaPro-Bold.otf') format('otf'),
                url('../ecom-template-seven/fonts/ZonaPro-Thin.otf') format('otf');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Zona Pro Bold';
            font-style: normal;
            font-weight: normal;
            src: local('Zona Pro Bold'), url('ZonaPro-Bold.woff') format('woff');
        }


        @import url('http://fonts.cdnfonts.com/css/mayeka-demo');

        .outter-box {
            margin: 0;
            border-radius: 5px;
            padding: 5px;
            width: 500px;
        }

        .outter-box table tr td {
            border: 1px solid#000;
        }

        /*  .outter-box table tr td p{
                border-bottom: 1px solid#000;
                padding-left: 20px;
                line-height: 50px;
                margin: 0;
            }*/
        body {
            margin: 0;
            padding: 0;
            top: 0 !important;
            font-family: 'Mayeka Regular Demo', sans-serif !important;
        }
    </style>
</head>

<body style="font-family: Segoe UI, Roboto, Helvetica Neue,Helvetica, Arial,sans-serif; background: #fff;  max-width: 700px; padding: 0px; border-radius: 15px; display:table; margin: 0px auto;">

    <table cellspacing="0" cellpanding="0" style="max-width:700px;  border-collapse: collapse;">


        <tr>
            <td style="padding: 0px;">
                <div class="outter-box">
                    <table style="width:100%;border:1px solid#ccc;border-collapse: collapse;">
                        <tbody>
                            <thead style="background-color: #000;color: #fff;">
                                <th style="padding: 10px 20px;font-size: 18px;text-align: left;font-weight: normal;width:33%;;">Day</th>
                                <th style="padding: 10px 20px;font-size: 18px;text-align: left;font-weight: normal;width:33%;">{{ ($_GET['type'] == 'physio') ? 'Time' : 'Meal Hour' }}</th>
                                <th style="padding: 10px 20px;font-size: 18px;text-align: left;font-weight: normal;width:33%;">{{ ($_GET['type'] == 'physio' ) ? 'Exercises' : 'Meal Option' }}</th>
                            </thead>
                            @if($_GET['type'] == 'physio')
                            @forelse($requesttable->medicines as $key=>$medicine)

                            <tr>
                                <td style="padding:10px 20px;font-size:15px;text-align:left;width:30%">{{ $medicine->days }}</td>
                                <td style="padding:0px 0px;font-size:15px;text-align:left;width:30%">
                                    @foreach(json_decode($medicine->dosage_timing) as $dosage_timing)

                                    @if($loop->last)
                                    <p style="padding-left: 20px;line-height: 50px;margin: 0;">{{$dosage_timing->type}}</p>
                                    @else
                                    <p style="border-bottom: 1px solid#000;padding-left: 20px;line-height: 50px;margin: 0;">{{$dosage_timing->type}}</p>
                                    @endif
                                    @endforeach
                                </td>
                                <td style="padding:0px 0px;font-size:15px;text-align:left;width:40%">
                                    @foreach(json_decode($medicine->dosage_timing) as $dosage_timing)
                                    @if($loop->last)
                                    <p style="padding-left: 20px;line-height: 50px;margin: 0;">

                                        {{ (isset($dosage_timing->description))?$dosage_timing->description:'' }}<br>

                                    </p>
                                    @else

                                    <p style="border-bottom: 1px solid#000;padding-left: 20px;line-height: 50px;margin: 0;">

                                        {{ (isset($dosage_timing->description))?$dosage_timing->description:'' }}<br>

                                    </p>
                                    @endif

                                    @endforeach
                                </td>
                            </tr>
                            @empty
                            @endforelse
                            @else

                            @forelse($requesttable->medicines as $key=>$medicine)
                            <tr>
                                <td style="padding:10px 20px;font-size:15px;text-align:left;width:30%">{{ $medicine->days }}</td>
                                <td style="padding:0px 0px;font-size:15px;text-align:left;width:30%">
                                    @foreach(json_decode($medicine->dosage_timing) as $dosage_timing)

                                    @if($loop->last)
                                    <p style="padding-left: 20px;line-height: 50px;margin: 0;">{{$dosage_timing->type}}</p>
                                    @else
                                    <p style="border-bottom: 1px solid#000;padding-left: 20px;line-height: 50px;margin: 0;">{{$dosage_timing->type}}</p>
                                    @endif
                                    @endforeach
                                </td>
                                <td style="padding:0px 0px;font-size:15px;text-align:left;width:40%">
                                    @foreach(json_decode($medicine->dosage_timing) as $dosage_timing)
                                    @if($loop->last)
                                    <p style="padding-left: 20px;line-height: 50px;margin: 0;">

                                        {{ (isset($dosage_timing->description))?$dosage_timing->description:'' }}<br>

                                    </p>
                                    @else

                                    <p style="border-bottom: 1px solid#000;padding-left: 20px;line-height: 50px;margin: 0;">

                                        {{ (isset($dosage_timing->description))?$dosage_timing->description:'' }}<br>

                                    </p>
                                    @endif

                                    @endforeach
                                </td>
                            </tr>
                            @empty
                            @endforelse

                            @endif

                        </tbody>
                    </table>

                </div>
            </td>
        </tr>
    </table>

</body>

</html>
