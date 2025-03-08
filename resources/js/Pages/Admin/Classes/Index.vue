<script setup>
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import ClassSidebarLink from './_components/ClassSidebarLink.vue';
import Card from '@/Components/Cards/Card.vue';
</script>

<template>
  <Head title="Class" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Class</h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Class', url: route('admin.class.index') },
          ]"
        />
      </div>
    </template>
    <div class="flex gap-5">
      <!-- Sidebar -->
      <div class="w-60">
        <ClassSidebarLink />
      </div>
      <!-- Main Contents -->
      <div class="w-[calc(100%-80px)] sm:w-[calc(100%-160px)] lg:w-[calc(100%-240px)]">
        <Card>
          <template #header>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">クラス管理</h2>
            <p class="text-sm text-gray-500 dark:text-gray-300">レッスン、コースカテゴリー、コース、ルームの一覧画面表示、新規作成&保存、詳細画面表示、編集&更新、削除ができます。</p>
          </template>
          <template #content>
            <!-- レッスン一覧 -->
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>