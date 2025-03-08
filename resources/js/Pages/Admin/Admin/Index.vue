<script setup>
import { Head } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";

import Card from "@/Components/Cards/Card.vue";
import Button from "@/Components/Buttons/Button.vue";
import Avatar from "@/Components/Avatar.vue";
import Alert from "@/Components/Alert.vue";
import FlashMessage from "@/Components/FlashMessage.vue";

defineProps({
  admins: Array,
  employees: Array,
  others: Array,
  expiredAdmins: Array,
});
</script>

<template>
  <Head title="Admin" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Admin</h1>
        <!-- Button -->
        <div class="flex items-center">
          <Button
            buttonActionType="button"
            buttonType="secondary"
            >削除済み一覧</Button
          >
        </div>
      </div>
    </template>
    <div class="w-full p-2">
      <Breadcrumb
        :items="[
          { name: 'Home', url: route('admin.dashboard') },
          { name: 'Admin', url: route('admin.admin.index') },
        ]"
      />
    </div>

    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`顧客を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="w-full p-6 bg-slate-100">
      <div class="mb-4">
        <h2 class="font-semibold mb-4">管理者</h2>
        <div class="w-full grid grid-cols-4 gap-5">
          <Card
            v-for="admin in admins"
            :key="admin.id"
            footer="Footer content here"
          >
            <template #content>
              <div class="flex flex-col justify-center items-center">
                <Avatar class="mb-2" />
                <h4 class="mb-1 text-base">{{ admin.username }}</h4>
                <p class="text-sm text-slate-500">{{ admin.role }}</p>
              </div>
            </template>
            <template #footer>
              <div class="flex justify-center gap-4">
                <Button
                  :href="route('admin.admin.show', { admin: admin.id })"
                  buttonActionType="button"
                  buttonType="info"
                  >詳細</Button
                >
              </div>
            </template>
          </Card>
        </div>
      </div>
      <div class="mb-4">
        <h2 class="font-semibold mb-4">従業員</h2>
        <div class="w-full grid grid-cols-4 gap-5">
          <Card
            v-for="employee in employees"
            :key="employee.id"
            footer="Footer content here"
          >
            <template #content>
              <div class="flex flex-col justify-center items-center">
                <Avatar class="mb-2" />
                <h4 class="mb-1 text-base">{{ employee.username }}</h4>
                <p class="text-sm text-slate-500">{{ employee.role }}</p>
              </div>
            </template>
            <template #footer>
              <div class="flex justify-center gap-4">
                <Button
                  :href="route('admin.employee.show', { employee: employee.id })"
                  buttonActionType="button"
                  buttonType="info"
                  >詳細</Button
                >
              </div>
            </template>
          </Card>
        </div>
      </div>
      <div class="mb-4">
        <h2 class="font-semibold mb-4">その他</h2>
        <div class="w-full grid grid-cols-4 gap-5">
          <Card
            v-for="other in others"
            :key="other.id"
            footer="Footer content here"
          >
            <template #content>
              <div class="flex flex-col justify-center items-center">
                <Avatar class="mb-2" />
                <h4 class="mb-1 text-base">{{ other.username }}</h4>
                <p class="text-sm text-slate-500">{{ other.role }}</p>
              </div>
            </template>
            <template #footer>
              <div class="flex justify-center gap-4">
                <Button
                  :href="route('admin.other.show', { other: other.id })"
                  buttonActionType="button"
                  buttonType="info"
                  >詳細</Button
                >
              </div>
            </template>
          </Card>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
