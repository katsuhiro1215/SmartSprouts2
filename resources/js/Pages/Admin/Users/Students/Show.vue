<script setup>
import Alert from '@/Components/Alert.vue';
import Avatar from '@/Components/Avatar.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Button from '@/Components/Buttons/Button.vue';
import Card from '@/Components/Cards/Card.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';

const props = defineProps({
  student: Object,
});

</script>

<template>
  <Head title="生徒管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Student | Show</h1>
        <div class="flex justify-end items-center gap-2">
          <Button buttonActionType="button" buttonType="success">Export</Button>
          <Button buttonActionType="button" buttonType="success">Import</Button>
          <Button buttonType="success"><Plus />新規作成</Button>
        </div>
      </div>
    </template>
    <div class="w-full p-2">
      <Breadcrumb
        :items="[
          { name: 'Home', url: route('admin.dashboard') },
          { name: 'Student', url: route('admin.student.index') },
          { name: 'Show', url: route('admin.student.show', ['student']) },
        ]"
      />
    </div>

    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`生徒を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="w-full flex flex-col lg:flex-row gap-5 p-6 bg-slate-300">
      <div class="w-1/4">
        <Card>
          <template #content>
            <div class="flex flex-col gap-4 text-center">
              <Avatar class="mx-auto" />
              <h3>{{ student.lastname }} {{ student.firstname }}</h3>
              <h3>{{ student.lastname_kana }} {{ student.firstname_kana }}</h3>
            </div>
  
          </template>
        </Card>
      </div>
      <div class="w-3/4">
        <Card>
          <template #content>
  
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>