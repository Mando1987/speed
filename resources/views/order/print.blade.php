
<div class="text-center font-weight-bold" style="padding: 10px">
<div class="row">

  <div class="col bg-black p-2 border border-dark">
    <h5>
      @lang('site.order_print_num')
    </h5>
  </div>
  <div class="col p-2 border border-dark">
    <h5>
      4444444
    </h5>
  </div>
  <div class="col p-2 border border-dark border-left-0">
    <h5>
      <strong>
        @lang('site.order_print_siteName')
      </strong>
    </h5>
  </div>
  <div class="col p-2 border border-dark bg-dark border-left-0">
    <h5>
      <strong>
        @lang('site.order_print_city')
      </strong>
    </h5>
  </div>
  <div class="col p-2 border border-dark border-left-0">
    <h5>
        سيدى جابر
    </h5>
  </div>
  <div class="col p-2 border border-dark bg-dark border-left-0">
    <h5>
      <strong>
        @lang('site.order_print_governate')
      </strong>
    </h5>
  </div>
  <div class="col p-2 border border-dark border-left-0">
    <h5>
      القاهرة
    </h5>
  </div>
</div>

<div class="row mt-1">
  <div class="col-5 border border-dark">
    <div class="row">
      <div class="col p-2">
        <h5>
          @lang('site.order_print_date')
        </h5>
      </div>
      <div class="col p-2 border-left">
        <h5>
          29/12/2020
        </h5>
      </div>
      <div class="col p-2  border-left">
        <h5>
          @lang('site.order_print_employee')
        </h5>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>@lang('site.order_print_name')</td>
              <td >
                محمود محمد عبد الرحمن
              </td>
            </tr>
            <tr>
              <td>@lang('site.order_print_phone')</td>
              <td >
                01280142656
              </td>
            </tr>
            <tr>
              <td>@lang('site.order_print_address')</td>
              <td >
                مدينة الشروق بوابه اولى المتميز منطقة 6 مربع 21 عمارة 124 الدور التالت شقة 5 على اليمين
              </td>
            </tr>
            <tr>
              <td> @lang('site.order_print_price')</td>
              <td>555 جنية</td>
            </tr>
            <tr>
              <td> @lang('site.order_print_charge_price')</td>
              <td>555 جنية</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="col-7 border border-dark border-left-0">
    <div class="row">
      <div class="col p-2">
        <h5>
          @lang('site.order_print_reciver')
        </h5>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>@lang('site.order_print_name')</td>
              <td >
                محمود محمد عبد الرحمن
              </td>
            </tr>
            <tr>
              <td>@lang('site.order_print_phone')</td>
              <td >
                01280142656
              </td>
            </tr>
            <tr>
              <td>@lang('site.order_print_address')</td>
              <td >
                مدينة الشروق بوابه اولى المتميز منطقة 6 مربع 21 عمارة 124 الدور التالت شقة 5 على اليمين
              </td>
            </tr>
            <tr>
              <td>@lang('site.order_print_notes')</td>
              <td >
                السماح للعميل بفتح الشحنة الشحنة عبارة عن جلاليب قطيفة
                علامة مميزة امام كافيه لاتيه بالجبنة
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row border border-dark">
  <div class="col-7">
     <table class="table table-borderless m-1 p-1 table-sm">
       <tbody>
         <tr>
           <td>خالص</td>
           <td class="border border-dark">✔</td>

           <td>تحصيل</td>
           <td class="border border-dark">✔</td>
           <td>اخرى</td>
           <td class="border border-dark">❌</td>
         </tr>
       </tbody>
     </table>
  </div>
  <div class="col-5 border-left border-dark">
    <table class="table table-sm m-1 p-1 table-borderless">

        <tr>
          <td colspan="4">الشحن ذهاب وعودة على</td>
        </tr>
        <tr>
          <td>الراسل</td>
          <td class="border border-dark">
            <span>✔</span>
          </td>
          <td>المرسل اليه</td>
          <td class="border border-dark">❌</td>
        </tr>

    </table>
  </div>
</div>
<div class="row text-center">
  <div class="col-12">
    <span>
      @lang('site.order_print_danger_msg')
    </span>
  </div>
  <div class="col-12">
    <span>
      @lang('site.order_print_contact_msg')
    </span>
  </div>
</div>



</div>
<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>


