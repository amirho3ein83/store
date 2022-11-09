<script setup>
</script>

<template>



  <section class="text-gray-600 body-font lg:px-14">
    <div class="container mx-auto flex px-5 py-4 lg:flex-row flex-col items-center justify-center">
      <div class="lg:max-w-lg lg:w-full  mb-10 md:mb-0">
        <img
          src="https://thumbs.dreamstime.com/b/happy-asian-businessman-empty-shopping-cart-cartoon-illustration-151640371.jpg"
          alt="">
      </div>
      <div
        class="lg:flex-grow  lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center py-4">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-purple-900">Your Cart is empty!</h1>
        <div class="flex w-full md:justify-start justify-center items-end">

          <Link :href="'/category'"
            class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Let's
            go shopping</Link>
        </div>

      </div>
    </div>
  </section>
</template>
