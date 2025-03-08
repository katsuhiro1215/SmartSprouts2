<script setup>
import { defineProps } from 'vue';
// Components
import Table from '@/Components/Table/Table.vue';
import Button from '@/Components/Buttons/Button.vue';

const props = defineProps({
  user: Object,
});
</script>

<template>
  <div class="flex justify-between items-center">
    <h3>認証情報</h3>
  </div>
  <Table>
    <template #body>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          ユーザーID
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ user.username }}
        </td>
      </tr>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          メールアドレス
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ user.email }}
        </td>
      </tr>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          パスワード
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          パスワードは表示できません。
        </td>
      </tr>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          Google ID
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ user.google_id ? user.google_id : '未登録' }}
        </td>
      </tr>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          OAuth Provider
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ user.provider ? user.provider : '未登録' }}
        </td>
      </tr>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          最終ログイン日時
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ user.login_at ? user.login_at : '未登録' }}
        </td>
      </tr>
      <tr>
        <th
          class="p-4 text-base font-medium text-start bg-slate-200 text-slate-700 dark:bg-slate-100"
        >
          最終ログアウト日時
        </th>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ user.logout_at ? user.logout_at : '未登録' }}
        </td>
      </tr>
    </template>
  </Table>
</template>