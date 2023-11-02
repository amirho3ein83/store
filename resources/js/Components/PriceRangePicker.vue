<script >


export default {
    //...
    mounted() {
        const recaptchaScript = document.createElement("script");
        recaptchaScript.setAttribute(
            "src",
            "https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        );
        document.head.appendChild(recaptchaScript);
    },
    //...
};

function range() {
    return {
        minprice: 1000,
        maxprice: 7000,
        min: 100,
        max: 10000,
        minthumb: 0,
        maxthumb: 0,

        mintrigger() {
            this.minprice = Math.min(this.minprice, this.maxprice - 500);
            this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
        },

        maxtrigger() {
            this.maxprice = Math.max(this.maxprice, this.minprice + 500);
            this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100);
        },
    }
}
</script>

<template>
    <!-- component -->

    <div x-data="range()" x-init="mintrigger(); maxtrigger()" class="relative max-w-xl w-full">
        <div>
            <input type="range" step="100" x-bind:min="min" x-bind:max="max" x-on:input="mintrigger" x-model="minprice"
                class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

            <input type="range" step="100" x-bind:min="min" x-bind:max="max" x-on:input="maxtrigger" x-model="maxprice"
                class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

            <div class="relative z-10 h-2">

                <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200"></div>

                <div class="absolute z-20 top-0 bottom-0 rounded-md bg-gray-400"
                    x-bind:style="'right:'+maxthumb+'%; left:'+minthumb+'%'"></div>

                <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-gray-400 rounded-full -mt-2 -ml-1"
                    x-bind:style="'left: '+minthumb+'%'"></div>

                <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-gray-400 rounded-full -mt-2 -mr-3"
                    x-bind:style="'right: '+maxthumb+'%'"></div>


            </div>

            <div class="flex justify-between items-center py-4">
                <!-- <div>
                    <input type="text" maxlength="5" x-on:input="mintrigger" x-model="minprice"
                        class=" border border-gray-50 rounded w-24 text-center" value="1000">
                </div> -->
                <!-- <div>
                    <input type="text" maxlength="5" x-on:input="maxtrigger" x-model="maxprice"
                        class=" border border-gray-50 rounded w-24 text-center" value="10000">
                </div> -->
                <span
                    class="inline-block whitespace-nowrap rounded-[0.27rem] bg-secondary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-secondary-800">
                    100
                </span>
                <span
                    class="inline-block whitespace-nowrap rounded-[0.27rem] bg-secondary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-secondary-800">
                    10000
                </span>
            </div>

        </div>


    </div>
</template>

<style>
input[type=range]::-webkit-slider-thumb {
    pointer-events: all;
    width: 24px;
    height: 24px;
    -webkit-appearance: none;
    /* @apply w-6 h-6 appearance-none pointer-events-auto; */
}
</style>
