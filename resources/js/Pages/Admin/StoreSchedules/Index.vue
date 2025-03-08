<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import Yearly from '@/Components/Calendar/Yearly.vue';
import Monthly from '@/Components/Calendar/Monthly.vue';
// Store Components
import Sidebar from './_components/Sidebar.vue';
import ScheduleTab from './_components/ScheduleTab.vue';
import Daily from './_components/Daily.vue';
import Weekly from './_components/Weekly.vue';

const props = defineProps({
  storeSchedules: Array,
  stores: Array,
});

const currentTab = ref('all');
const currentView = ref('monthly');
const currentDate = ref(new Date());

const changeTab = (tab) => {
  currentTab.value = tab;
};

const changeView = (view) => {
  currentView.value = view;
};

const filteredSchedules = computed(() => {
  if (currentTab.value === 'all') {
    return props.storeSchedules;
  }
  return props.storeSchedules.filter((schedule) => schedule.store_id === currentTab.value);
});
</script>

<template>
  <Head title="店舗スケジュール" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
          Store Schedule
        </h1>
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Store', url: route('admin.store.index') },
        { name: 'Store Schedule', url: route('admin.storeSchedule.index') },
      ]"
    />
    <FlashMessage />

    <div class="flex gap-5">
      <div class="w-1/5">
        <Sidebar />
      </div>
      <div class="w-4/5">
        <Card>
          <template #header>
            <div class="flex items-center justify-between">
              <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300">
                店舗スケジュール
              </h2>
              <ScheduleTab
                :stores="[{ id: 'all', name: '全体' }, ...props.stores]"
                :currentTab="currentTab"
                :changeTab="changeTab"
              />
            </div>
          </template>
          <template #content>
            <div class="flex items-center justify-between">
              <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-300">
                A店舗
              </h3>
              <span>2025年2月</span>
              <div class="flex flex-col space-y-4">
                <Button
                  @click="changeView('list')"
                  buttonActionType="button"
                  :buttonType="currentView === 'list' ? 'primary' : 'secondary'"
                  :class="{ 'font-bold': currentView === 'list' }"
                  >リスト表示</Button
                >
                <div class="flex gap-2">
                  <Button
                    @click="changeView('daily')"
                    buttonActionType="button"
                    :buttonType="currentView === 'daily' ? 'primary' : 'secondary'"
                    :class="{ 'font-bold': currentView === 'daily' }"
                    >日</Button
                  >
                  <Button
                    @click="changeView('weekly')"
                    buttonActionType="button"
                    :buttonType="currentView === 'weekly' ? 'primary' : 'secondary'"
                    :class="{ 'font-bold': currentView === 'weekly' }"
                    >週</Button
                  >
                  <Button
                    @click="changeView('monthly')"
                    buttonActionType="button"
                    :buttonType="currentView === 'monthly' ? 'primary' : 'secondary'"
                    :class="{ 'font-bold': currentView === 'monthly' }"
                    >月</Button
                  >
                  <Button
                    @click="changeView('yearly')"
                    buttonActionType="button"
                    :buttonType="currentView === 'yearly' ? 'primary' : 'secondary'"
                    :class="{ 'font-bold': currentView === 'yearly' }"
                    >年</Button
                  >
                </div>
              </div>
            </div>
            <div class="flex flex-col mt-4">
              <div v-if="currentView === 'daily'">
                <Daily :date="currentDate" :storeSchedules="filteredSchedules" />
              </div>              
              <div v-if="currentView === 'weekly'">
                <Weekly :weekStartDate="currentDate" :storeSchedules="props.storeSchedules" />
              </div>
              <div v-if="currentView === 'monthly'">
                <Monthly :monthStartDate="currentDate" />
              </div>
              <div v-if="currentView === 'yearly'">
                <Yearly :year="currentDate.getFullYear()" />
              </div>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
