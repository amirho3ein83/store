@component('mail::message')
 ممنون از خرید شما

<x-mail::button :url="$url">
    لیست خرید شما
</x-mail::button>

@component('mail::subcopy')
با خرید بیشتر از فروشگاه ما میتونی امتیاز بیشتری جمع کنی 
و از تخفیف های شگفت انگیز استفاده کنی
@endcomponent