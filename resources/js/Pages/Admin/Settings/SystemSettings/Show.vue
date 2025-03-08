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

import SettingSidebarLink from '@/Components/Sidebar/SettingSidebarLink.vue';

const props = defineProps({
  systemSetting: Object,
});
</script>

<template>
  <Head title="システム設定管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
          System Setting
        </h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Show', url: route('admin.systemSetting.index') },
          ]"
        />
      </div>
    </template>
    <FlashMessage />

    <div class="w-full flex gap-5">
      <SettingSidebarLink />
      <div class="w-[calc(100%-64px)] sm:w-[calc(100%-80px)] lg:w-[calc(100%-96px)]">
        <Card>
          <template #header>
            <div class="flex justify-between">
              <div class="flex flex-col gap-2">
                <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300 leading-tight">
                  システム設定
                </h2>
                <p class="pl-2 text-slate-400">システム全体の詳細情報を掲載しています。</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button
                  :href="route('admin.systemSetting.edit', systemSetting.id)"
                  buttonType="warning"
                >
                  編集
                </Button>
              </div>
            </div>
          </template>
          <template #content>
            <div class="w-full flex gap-5">
              <div class="flex flex-col gap-5">
                <Table>
                  <template #body>
                    <tr>
                      <th
                        class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
                      >
                        システム名
                      </th>
                      <td
                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        {{ systemSetting.name }}
                      </td>
                    </tr>
                    <tr>
                      <th
                        class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
                      >
                        システム概要
                      </th>
                      <td
                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        {{ systemSetting.description }}
                      </td>
                    </tr>
                    <tr>
                      <th
                        class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
                      >
                        システムバージョン
                      </th>
                      <td
                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        {{ systemSetting.version }}
                      </td>
                    </tr>
                    <tr>
                      <th
                        class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
                      >
                        フロントエンド
                      </th>
                      <td
                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        {{ systemSetting.frontend }}
                      </td>
                    </tr>
                    <tr>
                      <th
                        class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
                      >
                        バックエンド
                      </th>
                      <td
                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        {{ systemSetting.backend }}
                      </td>
                    </tr>
                    <tr>
                      <th
                        class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
                      >
                        開設日
                      </th>
                      <td
                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                      >
                        {{ systemSetting.opening_date }}
                      </td>
                    </tr>
                  </template>
                </Table>
                <dl class="flex items-center gap-5">
                  <dt class="w-32">Web Site URL</dt>
                  <dd>
                    <ul>
                      <li>{{ systemSetting.website }}</li>
                    </ul>
                  </dd>
                </dl>
                <dl class="flex items-center gap-5">
                  <dt class="w-32">SNS</dt>
                  <dd>
                    <ul>
                      <li>Facebook: {{ systemSetting.facebook }}</li>
                      <li>Twitter: {{ systemSetting.twitter }}</li>
                      <li>Instagram: {{ systemSetting.instagram }}</li>
                    </ul>
                  </dd>
                </dl>
              </div>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
