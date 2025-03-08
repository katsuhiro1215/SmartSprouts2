<script setup>
import { Head } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Card from "@/Components/Cards/Card.vue";
</script>

<template>
  <Head title="Course Create" />

  <AuthenticatedLayout>
    <template #header>
      <h2>Course Create</h2>
      <div class="flex sm:flex-row items-center justify-between">
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Course', url: route('admin.course.index') },
            { name: 'Create', url: route('admin.course.create') },
          ]"
        />
      </div>
    </template>
    

  </AuthenticatedLayout>
</template>
