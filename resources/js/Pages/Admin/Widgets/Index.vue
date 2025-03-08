<script setup>
import { Head } from '@inertiajs/vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import SortSelector from '@/Components/SortSelector.vue';
import ListView from '@/Components/ListView.vue';
import GridView from '@/Components/GridView.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import Pagination from '@/Components/Pagination.vue';
// icons
import Plus from 'vue-material-design-icons/Plus.vue';

// Props
const props = defineProps({
  widgets: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <Head title="Widgets" />

  <AdminDashboardLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">Widget</h1>

      <Button type="button">新規作成</Button>
    </template>
    <div class="w-full p-2">
      <Breadcrumb
        :items="[
          { name: 'Home', url: route('admin.dashboard') },
          { name: 'Widget', url: route('admin.widget.index') },
        ]"
      />
    </div>
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`ウィジェットを削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />
    <div class="w-full grid grid-cols-4 gap-5">
      <Card>
        <template #header>
          <h3 class="text-2xl font-semibold leading-none tracking-tight">
            {{ __dirname('ユーザー') }}
          </h3>
          <p class="text-sm text-gray-600">一覧 5件</p>
        </template>
        <template #content> test </template>
      </Card>
      <Card>
        <template #header>
          <h3 class="text-2xl font-semibold leading-none tracking-tight">Student</h3>
          <p class="text-sm text-gray-600">一覧 5件</p>
        </template>
        <template #content> test </template>
      </Card>
      <Card>
        <template #header>
          <h3 class="text-2xl font-semibold leading-none tracking-tight">Guardian</h3>
          <p class="text-sm text-gray-600">一覧 5件</p>
        </template>
      </Card>
      <Card>
        <template #header>
          <h3 class="text-2xl font-semibold leading-none tracking-tight">User</h3>
          <p class="text-sm text-gray-600">一覧 5件</p>
        </template>
      </Card>
    </div>
  </AdminDashboardLayout>
</template>