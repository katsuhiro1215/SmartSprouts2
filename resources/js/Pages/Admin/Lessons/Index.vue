<script setup>
import { Head } from "@inertiajs/vue3";
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';

import Breadcrumb from "@/Components/Breadcrumb.vue";
import Table from "@/Components/Table/Table.vue";
import Card from "@/Components/Cards/Card.vue";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
  allLessons: Array,
  lessons: Array,
  deletedLessons: Array,
});
</script>

<template>
  <Head title="Lesson" />

  <AdminDashboardLayout>
    <template #header>
      <h2>Lesson</h2>
      <div class="flex sm:flex-row items-center justify-between">
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Lesson', url: route('admin.lesson.index') },
      ]"
    />
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`学校を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="flex gap-5">
      <div class="w-1/4">
        <Card>
          <template #content>
            <nav>
              <ul class="flex flex-col space-y-4">
                <li>
                  <NavLink>
                    <span class="text-base">レッスン一覧</span>
                  </NavLink>
                </li>
                <li>
                  <NavLink>
                    <span class="text-base">レッスン一覧</span>
                  </NavLink>
                </li>
                <li>
                  <NavLink>
                    <span class="text-base">レッスン一覧</span>
                  </NavLink>
                </li>
              </ul>
            </nav>
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
