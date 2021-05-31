<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Waiver</title>
    <style>
        @page {
            margin: 20px 20px;

        }
        table {
            border: 1px solid black;
        }
        tr, th, td {
            border: 1px solid black;
        }
        img {

            max-height: 25%;
        }
        body {
            margin: 0;
            text-indent: 0;
            font-family: sans-serif;
            line-height: 1.4;
        }
        p {
            margin: 0;
            padding: 0;
            text-indent: 0 !important;
            text-decoration: none;
        }
    </style>
</head>
@foreach ($bookings as $booking)

    <body class="text-black text-sm">

    <table class="border-2 border-black" cellspacing="0" cellpadding="6" width="100%">
        <tr class="border border-black h-8">
            <td class="border border-black"><b>Reference</b></td>
            <td class="border border-black"><b>Customer</b></td>
            <td class="border border-black"><b>Departure Date</b></td>
            <td class="border border-black"><b>Departure Time</b></td>
        </tr>
        <tr class="odd border border-black h-8">
            <td class="border border-black">{{$booking['ref']}}</td>
            <td class="border border-black">{{$booking['name']}}</td>
            <td class="border border-black">{{$booking['arrival']}}</td>
            <td class="border border-black">{{$booking['time']}}</td>
        </tr>
        <tr class="border border-black h-8">
            <td class="border border-black"><b>Terminal</b></td>
            <td class="border border-black"><b>Return Date</b></td>
            <td class="border border-black"><b>Return Time</b></td>
            <td class="border border-black"><b>Flight Number</b></td>
        </tr>
        <tr class="odd border border-black h-8">
            <td class="border border-black">{{$booking['terminal']}}</td>
            <td class="border border-black">{{$booking['return']}}</td>
            <td class="border border-black">{{$booking['return_time']}}</td>
            <td class="border border-black">{{$booking['flight_in']}}</td>
        </tr>
        <tr class="border border-black h-8">
            <td class="border border-black"><b>Vehicle</b></td>
            <td class="border border-black"><b>Vehicle Reg</b></td>
            <td class="border border-black"><b>Colour</b></td>
            <td class="border border-black"><b>Mobile Number</b></td>
        </tr>
        <tr class="odd border border-black h-8">
            <td class="border border-black">{{$booking['vehicle']}}</td>
            <td class="border border-black">{{$booking['vehicle_reg']}}</td>
            <td class="border border-black">{{$booking['vehicle_colour']}}</td>
            <td class="border border-black">{{$booking['mobile']}}</td>
        </tr>
    </table>
    <br>
    <p>All vehicles are parked at the owners risk and we do not accept liability for any loss or
        damage
        to any vehicle or its contents unless the loss or damage is a direct result of our negligence. Customers
        are
        advised to check their vehicle on arrival and on departure from the airport as no liability issues will
        be
        considered at a later date. The client authorizes {{ config('parkright.company.name') }} drivers to move the client’s vehicle to an
        alternative
        car park as required to avoid obstructions, in emergency and during busy periods. Please fill in any
        damage
        on the diagram e.g. S for scratch, D for dent, C for chip.</p>
    <br>
    <p class="font-semibold my-4"><b>Special Instructions:</b></p>
    <hr style="margin-bottom: 25px;" class="border border-black mt-2">
    <hr class="border border-black mt-6 mb-2">
    <table class="border-2 border-black my-2" cellspacing="0" cellpadding="2" width="180"
           align="right">
        <tr class="border border-black">
            <td class="border border-black">Fuel</td>
            <td class="border border-black"></td>
        </tr>
        <tr class="border border-black">
            <td class="border border-black" width="50">Mileage</td>
            <td class="border border-black"></td>
        </tr>
    </table>

    <br><img style="z-index: -999;" src="{{ public_path() .'/images/cars-min.png' }}"><br>
    <span class="font-semibold">Further comments / codes etc:</span>
    <hr class="border border-black">
    <p>
        I hereby agree to {{ config('parkright.company.name') }} terms and conditions
        <br>
        <br>
        <span style="font-size:18px" class="font-semibold text-xl">Customer Signature</span>..........................................................................................................................
        <br>
        <br>
        <span style="text-decoration: underline;" class="underline font-semibold"><b>Vehicle Return</b></span>
        <br>
        By signing this form I confirm that my vehicle has been checked and is in acceptable condition and that I relinquish
        {{ config('parkright.company.name') }} from all further responsibilities regarding my vehicle.
        <br>
        <br>
        <span style="font-size:18px" class="font-semibold text-xl">Customer Signature</span>..........................................................................................................................
    </p>
    </body>
@endforeach

</html>
