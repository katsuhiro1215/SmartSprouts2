<script setup>
import AdminDashboardLayout from "@/Layouts/AdminDashboardLayout.vue";
</script>

<template>
  <AdminDashboardLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h1>
    </template>
    <div class="w-full grid grid-cols-3 gap-5">
      <div class="w-full block bg-white p-5 shadow rounded-lg">
        <!-- コンテンツを自由にレイアウトできるようにしたいです。 -->
         <!-- User　一覧 5件 -->

         <!-- User index.vue -->
        <a href="">Read More</a>
      </div>







      <div class="w-full block bg-white p-5 shadow rounded-lg">
        <h2 class="border-2 border-dashed p-5">
          <a href="" class="flex justify-center items-center gap-4">
            <img src="/upload/logo.svg" alt="Logo image" width="40">
            <span class="text-lg">Shuplay体操教室</span>
          </a>
        </h2>
      </div>
      <div class="bg-white p-5 shadow rounded-lg">
        <h2 class="flex items-center gap-2 font-semibold text-lg rounded-sm bg-orange-300 text-gray-800 leading-tight px-4 py-2">
          <img src="/upload/information.png" alt="" width="32">
          インフォメーション
        </h2>
        <p class="text-gray-600">You're logged in!</p>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
