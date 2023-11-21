<script setup>
import { now } from 'lodash';






</script>

<template>
    <Transition>
        <div
          
            class="p-2 flex justify-center items-center"
        >
            <div
                class="flex flex-col justify-between w-56 sm:w-72 h-72 bg-center bg-cover text-gray-800 shadow-md overflow-hidden cursor-pointer"
            >
                <div class="flex justify-between items-center ml-4 pr-8">
                    <div
                        class="bg-red-600 w-12 h-12 shadow flex flex-col-reverse p-2 text-center font-bold text-white rounded-b-full"
                    >
                        50%
                    </div>
                </div>
                <div
                    class="bg-gray-700 bg-opacity-95 shadow-md rounded-r-xl p-2 flex flex-col mr-4 mb-4"
                >
                    <div class="flex justify-between">
                        <h3 class="text-xl text-slate-200 font-bold truncate">
                            glaxy
                        </h3>

                        <div class="flex align-baseline gap-x-1">
                            <h3 class="text-xl font-bold pb-1 text-yellow-400">
                                $122
                            </h3>
                        </div>
                    </div>
                    <h4 class="text-slate-400 font-extralight truncate">
                       asdfadsfsadf
                    </h4>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-xs">
                            <VueCountdown
                                :time="date() * 1000"
                                v-slot="{ days, hours, minutes, seconds }"
                            >
                                <span class="text-red-300">
                                    {{ days }}:{{ hours }}:{{ minutes }}:{{
                                        seconds
                                    }}
                                </span>
                            </VueCountdown>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
