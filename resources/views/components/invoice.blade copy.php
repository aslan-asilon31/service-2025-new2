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


    <table width="100%" style="font-weight:100;">
      <tr>
        <td width="50%" valign="top">
          <table>
            <tr>
              <td>TGL</td>
            </tr>
            <tr>
              <td>KEPADA YTH</td>
            </tr>
            <tr>
              <td>{{ $sales_order['customer']['first_name'] }} 03259</td>
            </tr>
          </table>
        </td>
        <td width="50%" align="right" valign="top">
          <table style="width: 100%;">
            <tr>
              <td align="right">PAGE : 1</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <br />

    <table width="" class="table-desc">
      <thead style="background-color: light;">
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
          <td colspan="3" class="text-center" style="border: none;">
            Marketplace : HD
          </td>
          <td align="right">NILAI BRUTO</td>
          <td align="right"
            style="border-left:1px solid black;border-top:1px solid black;border-bottom: 1px solid black;border-right:1px solid black;">
            Rp
            {{ number_format($brutoTotal, 2, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-center" style="border: none;">
            NO REFERENSI : 123
          </td>
          <td align="right">DISCOUNT</td>
          <td align="right">435654</td>
          {{-- <td align="right" class=""
            style="border-left:1px solid black;border-top:1px solid black;border-bottom: 1px solid black;border-right:1px solid black;">
            Rp 45.000</td> --}}
        </tr>
        <tr>
          <td colspan="3" class="text-center" style="border: none;">
            PENGIRIMAN VIA : SICEPAT
          </td>
          <td align="right">GRAND TOTAL</td>
          <td align="right" class=" font-bold"
            style="border-left:1px solid black;border-top:1px solid black;border-bottom: 1px solid black;border-right:1px solid black;">
            Rp
            {{ number_format($grandTotal, 2, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="5" class="text-center" style="border: none;">
            KETERANGAN : LOREM IPSUM DOLOR SIT AMET
          </td>
        </tr>
        <tr>
          <td colspan="3" class="text-center" style="border: none;">
          </td>
          <td align="right" style="border: none;">HORMAT KAMI</td>
          <td align="right" class="" style="border: none;"></td>
        </tr>




        <tr>
          <td colspan="2" class="text-center"
            style="border-left:1px solid black;border-top:1px solid black;border-bottom: none;border-right:1px solid black;">
            PEMBAYARAN DAPAT DI TRANSFER MELALUI :
          </td>
          <td align="right" style="border: none;"></td>
          <td align="right" style="border: none;"></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center"
            style="border-left:1px solid black;border-top: none;border-bottom: none;border-right:1px solid black;">
            BANK : BCA
          </td>
          <td align="right" style="border: none;"></td>
          <td align="right" style="border: none;"></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center"
            style="border-left:1px solid black;border-top: none;border-bottom: none;">NO
            REKENING : 0349543</td>
          <td align="right" colspan="3"
            style="border-left:1px solid black;border-bottom: none;border-top: none;border-right: none;text-align:center;">
            ADMIN</td>
          <td align="right" style="border: none;"></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center"
            style="border-left:1px solid black;border-top: none;border-bottom: 1px solid black;border-right:1px solid black;">
            ATAS NAMA : PERUSAHAAN
          </td>
          <td align="right" style="border: none;"></td>
          <td align="right" style="border: none;"></td>

        </tr>

      </tfoot>
    </table>
  </div>

</body>

</html>
