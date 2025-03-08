<script setup>
// Components
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
</script>

<template>
  <Card>
    <template #content>
      <div class="flex flex-col space-y-4">
        <Button
          :href="route('admin.storeSchedule.create')"
          buttonActionType="button"
          buttonType="info"
          >店舗スケジュール新規作成</Button
        >
        <Button
          :href="route('admin.storeSchedule.import')"
          buttonActionType="button"
          buttonType="info"
          >店舗スケジュールImport</Button
        >
        <Button
          :href="route('admin.storeSchedule.export')"
          buttonActionType="button"
          buttonType="info"
          >店舗スケジュールExport</Button
        >
      </div>
    </template>
  </Card>
</template>