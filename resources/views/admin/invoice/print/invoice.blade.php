
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Invoice</title>
  <link rel="stylesheet" href="{{asset('assets_surat/css/style.css')}}">
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="{{asset('img/logo.png')}}" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Invoice</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25" style="margin-bottom: 10px">
            <div class="tm_card_note tm_mobile_hide"></div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Invoice No: <b>{{$invoice->invoice_number}}</b></p>
              <p class="tm_invoice_date tm_m0">Date: <b>{{ date('d.m.Y', strtotime($invoice->created_at)) }}</b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
          <div class="tm_invoice_right tm_text_right" style="width:75%;margin-bottom:20px">
            <p class="tm_invoice_date tm_m0">E.INVOICE: <b>{{ $invoice->invoice_external }}</b></p>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left" style="width: 55% !important;">
              <p class="tm_mb2"><b class="tm_primary_color">Invoice To:</b></p>
              <p>
                {{$invoice->customer->nama_customer}}<br>
                @foreach ($alamat as $key => $list)
                    {{$list}}
                    @if ($key !== array_key_last($alamat))
                    -
                    @endif
                @endforeach
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right" style="width: 50% !important;">
              <p class="tm_mb2"><b class="tm_primary_color">Project Name:</b></p>
              <p>
               {{$project_name}}
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1">
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_accent_bg">
                      <th class="tm_width_3 tm_semi_bold tm_white_color">L/No.</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color">No. Shipment</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color">Description</th>
                      <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color">Unit Price(IDR)</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Jumlah (IDR)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($shipment as $list)
                        <tr>
                        <td class="tm_width_2">{{date_format(date_create($list->created_at),'d-M-Y')}}</td>
                        <td class="tm_width_2">{{$list->shipment_number}}</td>
                        <td class="tm_width_4">{{$list->dataorigin->name}} - {{$list->datadestination->name}} </td>
                        <td class="tm_width_2">{{number_format($list->total_qty)}} CS</td>
                        <td class="tm_width_2">{{number_format($list->total_biaya_customer)}}</td>
                        <td class="tm_width_2 tm_text_right">{{number_format($list->total_biaya_customer)}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer" style="padding-top: 50px">
                <p class="tm_mb2"><b class="tm_primary_color">Payment To:</b></p>
                <p>
                  {{ $setting->name }}<br>
                  {{ $setting->norek }} <br>
                  {{ $setting->bank_name }} <br>
                  {{ $setting->address }}
                </p>
              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Subtoal</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">{{number_format($invoice->basic_customer_price)}}</td>
                    </tr>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">Tax <span class="tm_ternary_color">({{$invoice->tax}}%)</span></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right">+{{number_format($invoice->value_added_tax_customer)}}</td>
                    </tr>
                    <tr class="tm_accent_bg">
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">{{number_format($invoice->total_customer_price)}}</td>
                    </tr>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">Terbilang</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right">{{ucwords($terbilang)}} Rupiah</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_type1">
              <div class="tm_left_footer">
                <p class="tm_m0 tm_f16 tm_primary_color">Code Vendor:<b>{{ $setting->code_vendor }}</b></p>
              </div>
              <div class="tm_right_footer">
                <div class="tm_sign tm_text_center" style="">
                  <p class="tm_m0 tm_f16 tm_primary_color"  style="margin-bottom: 100px;">{{$setting->name}}</p>
                  <p class="tm_m0 tm_f16 tm_primary_color">{{$setting->direktur}}</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="{{asset('assets_surat/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets_surat/js/jspdf.min.js')}}"></script>
  <script src="{{asset('assets_surat/js/html2canvas.min.js')}}"></script>
  <script src="{{asset('assets_surat/js/main.js')}}"></script>
</body>
</html>
