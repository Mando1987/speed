<strong>[ @lang('site.telegram_add_order') ]</strong>✅
<strong>[ @lang('site.telegram_date') ] </strong> {{now()}}
<strong>[ @lang('site.telegram_details') ] </strong> @lang('site.telegram_do') <u>{{ $order->customer->fullname }}</u> @lang('site.telegram_do_new_order')
  @lang('site.telegram_order_info') <strong>{{ $order->info }}</strong>
<strong>[ @lang('site.telegram_review_order') ] </strong> <a href="{{ route('order.index') }}">@lang('site.telegram_click_here')</a>
.

