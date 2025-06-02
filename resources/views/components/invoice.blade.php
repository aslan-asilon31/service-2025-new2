<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Aloha!</title>

  <style type="text/css">
    @page {
      size: 595.276pt 841.89pt; //A4
      /* size: 686.07pt 391.23pt; */
      /* Ukuran kertas dalam points
        width = 24cm 2mm
        height = 13cm 8mm
      */
    }

    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
    }


    /* Pastikan table dan elemen lain juga tidak memiliki margin atau padding */
    table,
    th,
    td {
      margin: 0;
      padding: 0;
    }

    * {
      font-family: Verdana, Arial, sans-serif;
      font-size: 10px;
    }

    table {
      font-size: x-small;
    }

    .table-desc {
      border-collapse: collapse;
    }

    .table-desc th,
    .table-desc td {
      border: 1px solid black;
      padding: 4px;
    }

    .table-desc td:empty {
      border: none;
    }


    tfoot tr td {
      font-weight: bold;
      font-size: x-small;
    }
  </style>


  <style>
    .header-bar {
      width: 100%;
      white-space: nowrap;
    }

    .header-bar p {
      display: inline-block;
      margin: 0;
      vertical-align: top;
    }

    .left {
      width: 33%;
      text-align: left;
    }

    .center {
      width: 34%;
      text-align: center;
    }
  </style>
</head>

<body>

  <div style="padding-left: 18.9px; padding-right: 18.9px;padding-top: 15.12px; padding-bottom: 37.8px;">

    @php
      $brutoTotal = 0;
      $discount = 45000;
      $grandTotal = 0;
    @endphp

    <div class="header-bar">
      <p class="left">COMPANY NAME</p>
      <p class="center">FAKTUR PENJUALAN</p>
    </div>


    <table width="100%" style="font-weight:100; border: none">
      <tr>
        <td width="50%" valign="top" style="padding: 0; border: none;">
          Tanggal : 2025/05/05 <br />
          Kepada Yth. : {{ $sales_order['customer']['first_name'] }} <br />
        </td>
        <td width="50%" valign="top" style="padding: 0; border: none;text-align:right;">
          Page : 1
        </td>

      </tr>
    </table>

    <br />
    <style>
      table {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
      }

      th,
      td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }
    </style>

    <table>
      <thead style="">
        <tr>
          <th>#</th>
          <th>Description</th>
          <th>Quantity</th>
          <th>Unit Price Rp</th>
          <th>Total Rp</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($sales_order['sales_order_details'] as $index => $item)
          @php
            $total = $item['qty'] * $item['selling_price'];
            $brutoTotal += $total;
            $grandTotal = $brutoTotal - $discount;
          @endphp

          <tr>
            <th scope="">{{ $index + 1 }}</th>
            <td>{{ $item['product']['name'] }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>{{ number_format($item['selling_price'], 2, ',', '.') }}</td>
            <td>{{ number_format($total, 2, ',', '.') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text--500">No order details found.</td>
          </tr>
        @endforelse

      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-center" style="border: none; font-size:10px;">
            Marketplace : HD
          </td>
          <td align="right" style="font-size:10px;">NILAI BRUTO</td>
          <td align="right" style="font-size:10px;">
            Rp
            {{ number_format($brutoTotal, 2, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-center" style="border: none;font-size:10px;">
            NO REFERENSI : 123
          </td>
          <td align="right" style="font-size:10px;">DISCOUNT</td>
          <td align="right" style="font-size:10px;">Rp 45.000</td>
        </tr>
        <tr>
          <td colspan="3" class="text-center" style="border: none;font-size:10px;">
            PENGIRIMAN VIA : SICEPAT
          </td>
          <td align="right" style="font-size:10px;">GRAND TOTAL</td>
          <td align="right" style="font-size:10px;" class="font-bold">
            Rp
            {{ number_format($grandTotal, 2, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>

    <div class="margin-top:16px; margin-bottom:12px;">
      Keterangan : Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, incidunt, quod neque corporis
      sed quia id suscipit quaerat laudantium sapiente voluptatum modi nisi nesciunt nostrum deserunt quo, quisquam nam!
      Libero.
    </div>

    <table>
      <tbody>
        <tr>
          <td>
            PEMBAYARAN DAPAT DI TRANSFER MELALUI : <br />
            BANK : BCA <br />
            REKENING : 0349543 <br />
            ATAS NAMA : PERUSAHAAN
          </td>
          <td>
            HORMAT KAMI
            <br /> <br /> <br />
            ADMIN
          </td>
        </tr>
      </tbody>
    </table>

  </div>

</body>

</html>
