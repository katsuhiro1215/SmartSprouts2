<script setup>
import { Head } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";

import Card from "@/Components/Cards/Card.vue";
import Button from "@/Components/Buttons/Button.vue";
</script>

<template>
  <Head title="Admin" />

  <AuthenticatedLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        詳細画面
      </h1>
      <div class="flex sm:flex-row items-center justify-between">
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Admin', url: route('admin.admin.index') },
            { name: 'Show', url: route('admin.admin.show') },
          ]"
        />
      </div>
    </template>
    <Button type="button" class="">新規作成</Button>
    <div class="w-full grid grid-cols-3 gap-5">
      <Card>

      </Card>
    </div>
  </AuthenticatedLayout>
</template>
