<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// Components
import Table from '@/Components/Table/Table.vue';

const props = defineProps({
  allContacts: Object,
  contacts: Object,
  deletedContacts: Object,
});
</script>

<template>
  <Head />

  <AuthenticatedLayout>
    <template #header>
      <h2>Contact</h2>
      <div class="flex sm:flex-row items-center justify-between">
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Contact', url: route('admin.contact.index') },
          ]"
        />
      </div>
    </template>
    <div class="w-full pb-4">
      <Table>
        <template>

        </template>
      </Table>
    </div>
  </AuthenticatedLayout>
</template>