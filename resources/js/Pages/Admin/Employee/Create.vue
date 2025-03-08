<script setup>
import { Head } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";

import Card from "@/Components/Cards/Card.vue";
import Button from "@/Components/Buttons/Button.vue";
</script>

<template>
  <Head title="Employee" />

  <AuthenticatedLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Employee Create
      </h1>
      <div class="flex sm:flex-row items-center justify-between">
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Employee', url: route('admin.employee.index') },
            { name: 'Create', url: route('admin.employee.create') },
          ]"
        />
      </div>
    </template>
    <div class="w-full grid grid-cols-3 gap-5">
      <Card>
        新規作成
      </Card>
    </div>
  </AuthenticatedLayout>
</template>
