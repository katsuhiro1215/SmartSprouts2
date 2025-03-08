<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import LoadingIndicator from '@/Components/Loading/LoadingIndicator.vue';

const form = useForm({
  file: null,
});

const isLoading = ref(false);
const loadingText = ref('');

const handleFileChange = (e) => {
  form.file = e.target.files[0];
  console.log(form.file);
};

const submit = () => {
  console.log(form.file);
  isLoading.value = true;
  loadingText.value = '登録中';
  form.post(route('admin.storeSchedule.import'), {
    onFinish: () => {
      isLoading.value = false;
      loadingText.value = '';
    },
  });
};

const exportData = () => {
  // エクスポート処理をここに追加
};
</script>

<template>
  <Head title="店舗スケジュール インポート/エクスポート" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
          Store Schedule | Import/Export
        </h1>
        <div class="flex justify-end items-center gap-4">
          <Button
            :href="route('admin.storeSchedule.index')"
            buttonActionType="button"
            buttonType="secondary"
            >一覧</Button
          >
        </div>
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Store Schedule', url: route('admin.storeSchedule.index') },
        { name: 'Import/Export', url: route('admin.storeSchedule.importExport') },
      ]"
    />
    <FlashMessage />
    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <div class="flex gap-5">
      <div class="w-full">
        <Card>
          <template #header>
            <div class="flex items-center justify-between">
              <div class="space-y">
                <h2 class="text-xl font-bold tracking-tight">インポート/エクスポート</h2>
                <p class="text-slate-400">店舗スケジュールのインポートとエクスポートを行います。</p>
              </div>
            </div>
            <div class="shrink-0 bg-slate-300 h-[1px] w-full my-6"></div>
          </template>
          <template #content>
            <!-- Import -->
            <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-8">
              <div class="flex items-center">
                <input type="file" @change="handleFileChange" />
                <Button buttonType="primary" type="submit">インポート</Button>
              </div>
            </form>

            <!-- Export -->
            <!-- すべてExport -->
            <form action="">
              <Button buttonType="secondary" @click="exportData">エクスポート</Button>
            </form>
            <!-- 範囲を指定してExport -->
            <form action="">
              <Button buttonType="secondary" @click="exportData">エクスポート</Button>
            </form>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>