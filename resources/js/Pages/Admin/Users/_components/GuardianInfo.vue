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

const headers = ['SL', '保護者名', 'フリガナ', 'Action'];
</script>

<template>
  <div class="flex justify-between items-center">
    <h3>保護者情報</h3>
    <div class="flex gap-4">
      <Button
        :href="route('admin.guardian.create', { user: user.id })"
        buttonActionType="button"
        buttonType="success"
        ><Plus class="mr-2" />新規作成</Button
      >
    </div>
  </div>
  <SimpleTable :headers="headers" :items="user.guardians">
    <template #renderItem="{ item: guardian, index, tdClass }">
      <td :class="tdClass">
        {{ index + 1 }}
      </td>
      <td :class="tdClass">
        <Avatar :src="guardian.avatar" size="xl" />
        {{ guardian.full_name }}
      </td>
      <td :class="tdClass">
        {{ guardian.full_name_kana }}
      </td>
      <td :class="tdClass">
        <Button
          :href="route('admin.guardian.show', guardian.id)"
          buttonActionType="button"
          buttonType="info"
          >詳細</Button
        >
      </td>
    </template>
  </SimpleTable>
  <div v-if="!user.guardians.length">
    <p>保護者情報を登録してください。</p>
    <Button
      :href="route('admin.guardian.index', { user: user.id })"
      buttonActionType="button"
      buttonType="primary"
      >保護者情報を登録</Button
    >
  </div>
</template>