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
// Store Components
import Stores from './_components/Stores.vue';
import StoreItem from './_components/StoreItem.vue';
import StoreSidebarLink from './_components/StoreSidebarLink.vue';

const props = defineProps({
  allStores: Array,
  stores: Array,
  deletedStores: Array,
  userRole: String,
});

const userRole = props.userRole;

// Tabs
const tabs = [
  { name: 'allStores', label: '全店舗一覧' },
  { name: 'stores', label: '営業中店舗' },
  { name: 'deletedStores', label: '休業中店舗' },
];

const activeTab = ref('allStores');

const switchTab = (tabName) => {
  activeTab.value = tabName;
};

const currentStores = computed(() => {
  return props[activeTab.value];
});
</script>

<template>
  <Head title="Store" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">Store</h1>
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Store', url: route('admin.store.index') },
      ]"
    />
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`店舗を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="flex gap-5">
      <!-- Sidebar -->
      <div class="w-60">
        <StoreSidebarLink />
      </div>
      <!-- Main Contents -->
      <div class="w-[calc(100%-80px)] sm:w-[calc(100%-160px)] lg:w-[calc(100%-240px)]">
        <Card>
          <template #header>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">店舗一覧</h2>
          </template>
          <template #content>
            <div class="w-full flex flex-wrap gap-2 mb-4">
              <Button
                v-for="tab in tabs"
                :key="tab.name"
                buttonType="primary"
                :class="{ 'bg-indigo-300': activeTab === tab.name }"
                @click="switchTab(tab.name)"
              >
                {{ tab.label }}
              </Button>
            </div>

            <div v-for="tab in tabs" :key="tab.name" v-show="activeTab === tab.name">
              <Stores :items="currentStores.data" :userRole="userRole">
                <template #renderItem="{ item }">
                  <StoreItem :item="item" :userRole="userRole" />
                </template>
                <template #empty>
                  <div class="text-center text-slate-600 dark:text-slate-300">
                    店舗はありません。
                  </div>
                </template>
              </Stores>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>