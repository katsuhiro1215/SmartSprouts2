<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';
// Layout
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
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
import Back from 'vue-material-design-icons/ArrowLeft.vue';
import Magnify from 'vue-material-design-icons/Magnify.vue';
import ViewList from 'vue-material-design-icons/ViewList.vue';
import DotsGrid from 'vue-material-design-icons/DotsGrid.vue';
import NoteEdit from 'vue-material-design-icons/NoteEdit.vue';
import TrashCanOutline from 'vue-material-design-icons/TrashCanOutline.vue';
import Avatar from '@/Components/Avatar.vue';
import Badge from '@/Components/Badge.vue';
import UserSidebarLink from './_components/UserSidebarLink.vue';
import AuthInfo from './_components/AuthInfo.vue';
import UserAddressInfo from './_components/UserAddressInfo.vue';
import StudentInfo from './_components/StudentInfo.vue';
import StoreInfo from './_components/StoreInfo.vue';
import GuardianInfo from './_components/GuardianInfo.vue';

const props = defineProps({
  user: Object,
});

const activeTab = ref('authInfo');

const tabs = [
  { name: '認証情報', key: 'authInfo' },
  { name: '住所情報', key: 'addressInfo' },
  { name: '店舗情報', key: 'storeInfo' },
  { name: '生徒情報', key: 'studentInfo' },
  { name: '保護者情報', key: 'guardianInfo' },
];

const setActiveTab = (tab) => {
  activeTab.value = tab;
};
</script>

<template>
  <Head title="ユーザー管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">ユーザー管理</h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Student', url: route('admin.student.index') },
          ]"
        />
      </div>
    </template>
    <FlashMessage />

    <div class="w-full flex gap-5">
      <UserSidebarLink />
      <div class="w-[calc(100%-64px)] sm:w-[calc(100%-80px)] lg:w-[calc(100%-96px)]">
        <Card>
          <template #header>
            <div class="flex justify-between">
              <div class="flex flex-col gap-2">
                <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300 leading-tight">
                  ユーザー詳細
                </h2>
                <p class="pl-2 text-slate-400">ユーザー情報</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button
                  :href="route('admin.user.index')"
                  buttonActionType="button"
                  buttonType="secondary"
                >
                  <Back />ユーザー一覧へ戻る
                </Button>
              </div>
            </div>
          </template>
          <template #content>
            <div class="w-full flex gap-5">
              <div class="w-60 border bg-slate-100 dark:bg-gray-900 space-y-6 p-5">
                <div class="flex justify-center">
                  <Avatar size="xxl" />
                </div>
                <h3 class="text-center">{{ user.username }}</h3>
                <div class="flex flex-col space-y-4">
                  <h4 class="text-sm border-b border-b-red-200 p-2">認証情報</h4>
                  <Button
                    :href="route('admin.user.edit', ['user'])"
                    buttonActionType="button"
                    buttonType="warning"
                    class="block"
                    ><NoteEdit class="mr-2" />編集</Button
                  >
                  <Button
                    :href="route('admin.user.index')"
                    buttonActionType="button"
                    buttonType="warning"
                    ><NoteEdit class="mr-2" />パスワード変更</Button
                  >
                  <Button
                    :href="route('admin.user.index')"
                    buttonActionType="button"
                    buttonType="danger"
                    ><TrashCanOutline class="mr-2" />アカウント削除</Button>
                </div>
              </div>
              <div class="w-[calc(100%-240px)] space-y-6">
                <!-- タブ -->
                <Card>
                  <template #header>
                    <div class="w-full">
                      <ul class="flex justify-around bg-slate-200 dark:bg-slate-600 p-4">
                        <li v-for="tab in tabs" :key="tab.key">
                          <a
                            href="#"
                            :class="{
                              'text-gray-500 dark:text-gray-400': activeTab !== tab.key,
                              'text-blue-500 dark:text-blue-400': activeTab === tab.key,
                            }"
                            @click.prevent="setActiveTab(tab.key)"
                          >
                            {{ tab.name }}
                          </a>
                        </li>
                      </ul>
                    </div>
                  </template>
                  <template #content>
                    <div class="w-full space-y-4" v-if="activeTab === 'authInfo'">
                      <AuthInfo :user="user" />
                    </div>
                    <div class="w-full space-y-4" v-if="activeTab === 'addressInfo'">
                      <UserAddressInfo :user="user" />
                    </div>
                    <div class="w-full space-y-4" v-if="activeTab === 'storeInfo'">
                      <StoreInfo :user="user" />
                    </div>
                    <div class="w-full space-y-4" v-if="activeTab === 'studentInfo'">
                      <StudentInfo :user="user" />
                    </div>
                    <div class="w-full space-y-4" v-if="activeTab === 'guardianInfo'">
                      <GuardianInfo :user="user" />
                    </div>
                  </template>
                </Card>
              </div>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
