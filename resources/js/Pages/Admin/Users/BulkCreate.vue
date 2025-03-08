<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';
// Layout
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import PageSizeSelector from '@/Components/PageSizeSelector.vue';
import SortSelector from '@/Components/SortSelector.vue';
import ListView from '@/Components/ListView.vue';
import GridView from '@/Components/GridView.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import Pagination from '@/Components/Pagination.vue';
//icon
import Plus from 'vue-material-design-icons/Plus.vue';
import Magnify from 'vue-material-design-icons/Magnify.vue';
import ViewList from 'vue-material-design-icons/ViewList.vue';
import DotsGrid from 'vue-material-design-icons/DotsGrid.vue';
import EyeOutline from 'vue-material-design-icons/EyeOutline.vue';
import NoteEdit from 'vue-material-design-icons/NoteEdit.vue';
import TrashCanOutline from 'vue-material-design-icons/TrashCanOutline.vue';

const form = useForm({
  // User
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
  // Student
  student_lastname: null,
  student_firstname: null,
  student_lastname_kana: null,
  student_firstname_kana: null,
  student_photo_path: null,
  student_birth: null,
  student_gender: null,
  student_blod: null,
  student_mobile_number: null,
  student_mobile_number_relationship: null,
  student_personal_history: null,
  member_no: null,
  membership_status: null,
  serial_no: null,
  permission_photo: null,
  permission_dm: null,
  school_year: null,
  student_remarks: null,
  // Guardian
  guardian_lastname: null,
  guardian_firstname: null,
  guardian_lastname_kana: null,
  guardian_firstname_kana: null,
  relationship: null,
  guardian_photo_path: null,
  guardian_birth: null,
  guardian_gender: null,
  guardian_mobile_number: null,
  company_name: null,
  company_phone_number: null,
  // Address
  zipcode: null,
  address1: null,
  address2: null,
  address3: null,
  address4: null,
  phone_number: null,
});
</script>

<template>
  <Head title="ユーザー管理" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">User</h1>
        <div class="flex justify-end items-center gap-2">
          <Button buttonActionType="button" buttonType="success">Export</Button>
          <Button buttonActionType="button" buttonType="success">Import</Button>
          <Button @click="isSidebarVisible = true" buttonActionType="button" buttonType="success"
            ><Plus />新規作成</Button
          >
        </div>
      </div>
    </template>
    <div class="w-full p-2">
      <Breadcrumb
        :items="[
          { name: 'Home', url: route('admin.dashboard') },
          { name: 'School', url: route('admin.user.index') },
        ]"
      />
    </div>

    <FlashMessage />

    <div class="w-full p-6 bg-slate-100 space-y-4">
      <h2 class="text-xl font-semibold mb-4">{{ '新規作成' }}</h2>
      <form action="">
        <Card>
          <template #content>
            <div class="grid grid-cols-4 gap-2">
              <!-- progressbar -->
              <div class="flex items h-4 bg-fuchsia-600"></div>
              <div class="flex items h-4 bg-fuchsia-600"></div>
              <div class="flex items h-4 bg-fuchsia-600"></div>
              <div class="flex items h-4 bg-fuchsia-600"></div>
            </div>
          </template>
        </Card>
        <Card>
          <template #content>
            <div class="grid grid-cols-4 gap-2">
              <div class="col-span-4">
                <TextInput
                  type="text"
                  class="mt-1 block w-full"
                  id="name"
                  v-model="form.name"
                  required
                  autofocus
                  placeholder="名前"
                  autocomplete="name"
                />
              </div>
              <div class="col-span-4">
                <TextInput
                  type="email"
                  class="mt-1 block w-full"
                  id="email"
                  v-model="form.email"
                  required
                  placeholder="メールアドレス"
                  autocomplete="email"
                />
              </div>
              <div class="col-span-4">
                <TextInput
                  type="password"
                  class="mt-1 block w-full"
                  id="password"
                  v-model="form.password"
                  required
                  placeholder="パスワード"
                  autocomplete="password"
                />
              </div>
              <div class="col-span-4">
                <TextInput
                  type="password"
                  class="mt-1 block w-full"
                  id="password_confirmation"
                  v-model="form.password_confirmation"
                  required
                  placeholder="パスワード確認"
                  autocomplete="password"
                />
              </div>
            </div>
          </template>
        </Card>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
