<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import Button from '@/Components/Buttons/Button.vue';
import Card from '@/Components/Cards/Card.vue';
import Table from '@/Components/Table/Table.vue';

const props = defineProps({
  store: Object,
  schedules: Array,
  lessons: Array,
  users: Array,
  students: Array,
  userRole: String,
});

const userRole = props.userRole;

// Image Path
const imgPath = ref('https://via.placeholder.com/150');

// Tabs
const tabs = [
  { name: 'store', label: '店舗基本情報' },
  { name: 'schedules', label: '店舗スケジュール' },
  { name: 'courseCategories', label: 'コース' },
  { name: 'users', label: '在籍ユーザー' },
  { name: 'students', label: '在籍生徒' },
];

const activeTab = ref('stores');

const switchTab = (tabName) => {
  activeTab.value = tabName;
};

</script>

<template>
  <Head title="店舗管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">Store</h1>
        <div class="flex justify-end items-center gap-4">
          <Button :href="route('admin.store.index')" buttonType="primary">店舗一覧</Button>
        </div>
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Store', url: route('admin.store.index') },
        { name: 'Show', url: route('admin.store.show', ['store']) },
      ]"
    />
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`店舗を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />
    <!-- Contents -->
    <div class="flex gap-5">
      <Card class="w-1/4">
        <template #content>
          <div class="flex flex-col justify-center space-y-4">
            <figure>
              <img :src="imgPath" alt="" />
            </figure>
            <h3>{{ store.name }}</h3>
            <Button buttonType="warning"> 編集 </Button>
            <Button
              v-if="['Owner', 'SuperAdmin', 'Manager'].includes(userRole)"
              buttonType="danger"
            >
              削除
            </Button>
          </div>
        </template>
      </Card>
      <Card class="w-3/4">
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
            <!-- 店舗情報 -->
             <div v-if="tab.name === 'store'">
              <h2>店舗基本情報</h2>
                <Table>
                  <template #body>
                    <tr>
                      <th>店舗名</th>
                      <td>{{ store.name }}</td>
                    </tr>
                  </template>
                </Table>
             </div>
            <!-- 店舗スケジュール -->
             <div v-else-if="tab.name === 'schedules'">
              <h2>店舗スケジュール</h2>
                <Table>
                  <template #head>
                    <tr>
                      <th>SL</th>
                      <th>営業日</th>
                      <th>営業時間</th>
                    </tr>
                  </template>
                  <template #body>
                    <tr v-for="schedule in schedules" :key="schedule">
                      <td>{{  }}</td>
                    </tr>
                  </template>
                </Table>

             </div>
            <!-- コース情報 -->

            <!-- 在籍ユーザー -->

            <!-- 在籍生徒 -->

          </div>

        </template>
      </Card>
    </div>
  </AdminDashboardLayout>
</template>