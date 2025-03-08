<script setup>
import { defineProps } from 'vue';
// Components
import Button from '@/Components/Buttons/Button.vue';
import SimpleTable from '@/Components/Table/SimpleTable.vue';
// Icons

const props = defineProps({
  user: Object,
});

const headers = ['SL', '郵便番号', '住所', '電話番号', 'Action'];
</script>

<template>
  <div class="flex justify-between items-center">
    <h3>住所情報</h3>
    <div class="flex gap-4">
      <Button :href="route('admin.userAddress.create', { user: user.id })" buttonActionType="button" buttonType="success"
        ><Plus class="mr-2" />新規作成</Button
      >
    </div>
  </div>

  <SimpleTable v-if="user.user_addresses && user.user_addresses.length" :headers="headers" :items="user.user_addresses">
    <template #renderItem="{ item: userAddress, index, tdClass }">
      <td :class="tdClass">
        {{ index + 1 }}
      </td>
      <td :class="tdClass">
        {{ userAddress.zipcode }}
      </td>
      <td :class="tdClass">
        {{ userAddress.full_address }}
      </td>
      <td :class="tdClass">
        {{ userAddress.phone_number }}
      </td>
      <td :class="tdClass">
        <Button
          :href="route('admin.userAddress.edit', { user: user.id, userAddress: userAddress.id })"
          buttonActionType="button"
          buttonType="warning"
          >編集</Button
        >
      </td>
    </template>
  </SimpleTable>
  <div v-if="!user.user_addresses || !user.user_addresses.length">
    <p>店舗情報を登録してください。</p>
    <Button buttonActionType="button" buttonType="primary">店舗情報を登録</Button>
  </div>
</template>