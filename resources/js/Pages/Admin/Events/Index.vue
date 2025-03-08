<script setup>
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import EventSidebarLink from './_components/EventSidebarLink.vue';
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
        <EventSidebarLink />
      </div>
      <!-- Main Contents -->
      <div class="w-[calc(100%-80px)] sm:w-[calc(100%-160px)] lg:w-[calc(100%-240px)]">
        <Card>
          <template #header>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">イベント一覧</h2>
          </template>
          <template #content>

          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>