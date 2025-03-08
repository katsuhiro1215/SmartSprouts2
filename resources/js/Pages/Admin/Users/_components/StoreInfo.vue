<script setup>
import { defineProps } from 'vue';
// Components
import SimpleTable from '@/Components/Table/SimpleTable.vue';
import Button from '@/Components/Buttons/Button.vue';
// Icons
import Plus from 'vue-material-design-icons/Plus.vue';
import NoteEdit from 'vue-material-design-icons/NoteEdit.vue';

const props = defineProps({
  user: Object,
});

const headers = ['SL', '店舗名', 'メールアドレス', '連絡先', 'Action'];
</script>

<template>
  <div class="flex justify-between items-center">
    <h3>店舗情報</h3>
    <div class="flex gap-4">
      <Button :href="route('admin.store.create')" buttonActionType="button" buttonType="success"
        ><Plus class="mr-2" />新規作成</Button
      >
    </div>
  </div>
  <SimpleTable v-if="user.stores.length" :headers="headers" :items="user.stores">
    <template #renderItem="{ item: store, index, tdClass }">
      <td :class="tdClass">
        {{ index + 1 }}
      </td>
      <td :class="tdClass">
        <Avatar :src="store.store_photo_path" size="xl" />
        {{ store.name }}
      </td>
      <td :class="tdClass">
        {{ store.email }}
      </td>
      <td :class="tdClass">
        {{ store.phone_number }}
      </td>
      <td :class="tdClass">
        <Button
          :href="route('admin.store.show', store.id)"
          buttonActionType="button"
          buttonType="info"
          >詳細</Button
        >
      </td>
    </template>
  </SimpleTable>
  <div v-if="!user.stores.length">
    <p>店舗情報を登録してください。</p>
    <Button buttonActionType="button" buttonType="primary">店舗情報を登録</Button>
  </div>
</template>