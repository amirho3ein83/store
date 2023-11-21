<script setup>
import Logout from "@/Modals/triggers/Logout.vue";
import { OrbitSpinner } from "epic-spinners";
import { Link } from "@inertiajs/inertia-vue3";

</script>

<template>
	<!-- <div class="px-8 bg-gray-800 w-[250px] h-screen sticky top-0">
        <h2 class="text-yellow-600 text-center py-3 text-2xl">پنل ادمین</h2>
        <ul class="mt-12">
            <Link
                :href="'/'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-house"></i>
                <span class="text-md ml-2">خانه</span>
            </Link>
            <Link
                :href="route('admin.dashboard')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-kanban"></i>
                <span class="text-md ml-2">داشبورد</span>
            </Link>
            <Link
                :href="route('admin.products.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-kanban"></i>
                <span class="text-md ml-2">محصولات</span>
            </Link>
            <Link
                :href="route('admin.orders.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-kanban"></i>
                <span class="text-md ml-2">سفارشات</span>
            </Link>
            <Link
                :href="route('admin.clients.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-person"></i>
                <span class="text-md ml-2">مشتریان</span>
            </Link>
            <Link
                :href="route('admin.criticisms.list')"
									                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
									            >
									                <i class="bi bi-person"></i>
									                <span class="text-md ml-2">انتقادات</span>
									            </Link>
									        </ul>
									    </div> -->




	<!-- component -->
	<div class="px-8 bg-gray-800 w-[250px] h-screen sticky top-0">
		<ul class=" py-4 flex flex-col justify-between h-full">
			<li class="py-2">
				<Link href="/home" preserve-scroll>
				<div class="flex items-center space-x-4 pb-6">
					<OrbitSpinner :animation-duration="3000" :size="50" />

					<div class="font-medium ">
						<p class="text-slate-300 text-xl">Space Store</p>

					</div>
				</div>
				</Link>
			</li>
			<ol>
				<li class="my-px">
					<Link :href="route('admin.dashboard')"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">

					<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
						<i class="bi bi-motherboard"></i>
					</span>
					<span class="ml-3">Manage</span>
					</Link>

				</li>

				<li class="my-px">
					<Link :href="route('admin.todolist')"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">
					<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
						<i class="bi bi-journal-text"></i>
					</span>
					<span class="ml-3">Tasks</span>
					</Link>
				</li>
				<li class="my-px">
					<Link :href="route('admin.products.list')"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">
					<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
						<i class="bi bi-inboxes"></i> </span>
					<span class="ml-3">Products</span>
					</Link>
				</li>
				<li class="my-px">
					<Link :href="route('admin.clients.list')"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">


					<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
						<i class="bi bi-people"></i>
					</span>
					<span class="ml-3">Clients</span>
					</Link>
				</li>
			</ol>

			<ol>
				<li class="my-px">
					<Link :href="route('user.profile')"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">


					<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
						<i class="bi bi-person"></i>
					</span>
					<span class="ml-3">Profile</span>
					</Link>
				</li>
				<li class="my-px">
					<a href="#"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">
						<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
							<i class="bi bi-bell"></i>
						</span>
						<span class="ml-3">Notifications</span>
					</a>
				</li>
				<li class="my-px">
					<a href="#"
						class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:bg-gray-700 hover:text-gray-200 group px-2">
						<span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
							<i class="bi bi-gear"></i>
						</span>
						<span class="ml-3">Settings</span>
					</a>
				</li>
				<li class="my-px">
					<span
						class="flex flex-row items-center h-12  rounded-lg text-gray-500  hover:text-gray-200 group px-3">
							<Logout />
					</span>
				</li>
			</ol>


		</ul>

	</div>
</template>
<style scope>
i {
	font-size: 20px
}
</style>