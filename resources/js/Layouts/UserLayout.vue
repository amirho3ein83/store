<script setup>
import Logout from "@/Modals/triggers/Logout.vue";
import Navbar from "@/Components/Navbar.vue";

</script>

<template>
    <Navbar />

    <main class="profile-page">
        <section class="relative sm:py-6 bg-[#ebe9e8]  min-h-screen">
            <div class="container mx-auto px-4">
                <div
                    class="relative flex flex-col min-w-0 min-h-[500px] h-full break-words bg-[#babbc2] w-full mb-6 shadow-xl rounded-lg"
                >
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div
                                class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center"
                            >
                                <div class="relative">
                                    <img
                                        alt="..."
                                        src="../Pages/Store/Products/pics/sh3.webp"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                                    />
                                </div>
                            </div>
                            <div
                                class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center"
                            >
                            <div class="py-6 px-3 ">
                                    <h1 class="text-2xl">
                                        {{ $page.props.user.name }}
                                    </h1>
                                </div>
                            </div>

                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div
                                    class="flex justify-center py-4 lg:pt-4 pt-8"
                                >
                                    <div
                                        class="mr-4 p-3 text-center hover:brightness-50 cursor-pointer"
                                    >
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
                                        >
                                            <Logout />
                                        </span>
                                    </div>
                                    <Link
                                        :href="'/user/profile/liked-products'"
                                        preserve-scroll
                                    >
                                        <div
                                            class="mr-4 p-3 text-center hover:brightness-50 cursor-pointer"
                                        >
                                            <span
                                                class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
                                                ><i
                                                    class="bi text-red-600 bi-heart-fill"
                                                ></i></span
                                            ><span
                                                class="text-sm text-blueGray-400"
                                                >علاقه مندی ها</span
                                            >
                                        </div>
                                    </Link>
                                    <Link
                                        :href="'/user/orders-list'"
                                        preserve-scroll
                                    >
                                        <div
                                            class="mr-4 p-3 text-center hover:brightness-50 cursor-pointer"
                                        >
                                            <span
                                                class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
                                                ><i
                                                    class="bi bi-bag-fill"
                                                ></i></span
                                            ><span
                                                class="text-sm text-blueGray-400"
                                                >خرید ها
                                            </span>
                                        </div>
                                    </Link>

                                    <Link
                                        :href="'/user/profile/wallet'"
                                        preserve-scroll
                                    >
                                        <div
                                            class="lg:mr-4 p-3 text-center hover:brightness-50 cursor-pointer"
                                        >
                                            <span
                                                class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"
                                                ><i
                                                    class="bi bi-wallet2"
                                                ></i></span
                                            ><span
                                                class="text-sm text-blueGray-400"
                                            >
                                                 کیف پول</span
                                            >
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-8">
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
            <!-- <footer class="relative bg-blueGray-200 pt-8 pb-6 mt-8">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-6/12 px-4 mx-auto text-center">
        <div class="text-sm text-blueGray-500 font-semibold py-1">
          Made with <a href="https://www.creative-tim.com/product/notus-js" class="text-blueGray-500 hover:text-gray-800" target="_blank">Notus JS</a> by <a href="https://www.creative-tim.com" class="text-blueGray-500 hover:text-blueGray-800" target="_blank"> Creative Tim</a>.
        </div>
      </div>
    </div>
  </div>
</footer> -->
        </section>
    </main>
</template>
