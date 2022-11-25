
<template>
  <div>
    <div class="bg-black brightness-75 "></div>
    <div class="fixed top-0 left-0 z-40 w-screen h-screen flex items-center justify-center"
      style="background: rgba(0, 0, 0, 0.3);">
      <div
        class="w-full items-center align-baseline max-w-[570px] rounded-[20px] bg-white py-2 px-4 text-center md:py-[40px] md:px-[30px]">
        <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl">
          Payment Done Successfully
          <i class="bi bi-check-circle-fill text-4xl text-[#2fde18]"></i>
        </h3>
        <h3 class="text-dark pb-2 text-lg font-bold sm:text-md my-5">
          see your order in your
          <Link class="underline text-blue-700" :href="`/user/orders-list`">purchase list</Link>
        </h3>

        <div class="w-1/2 px-3 mx-auto">
          <Link :href="`/home`"
            class="bg-[#9f18f2] border-primary block w-full rounded-lg border p-3 text-center text-base font-medium text-white transition hover:bg-opacity-90">
          Back to home
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>


