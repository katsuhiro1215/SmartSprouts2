<script setup>
import { Head, useForm } from '@inertiajs/vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Alert from '@/Components/Alert.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Button from '@/Components/Buttons/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
// Icons
import Plus from 'vue-material-design-icons/Plus.vue';
import Card from '@/Components/Cards/Card.vue';
import Table from '@/Components/Table/Table.vue';
import TrashCanOutline from 'vue-material-design-icons/TrashCanOutline.vue';
import NoteEdit from 'vue-material-design-icons/NoteEdit.vue';
import EyeOutline from 'vue-material-design-icons/EyeOutline.vue';

// Props
const props = defineProps({
  questionnaire: Object,
});
</script>

<template>
  <Head title="Questionnaire" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Questionnaire</h1>
        <div class="flex justify-end items-center gap-2">
          <Button buttonActionType="button" buttonType="success">Export</Button>
          <Button buttonActionType="button" buttonType="success">Import</Button>
          <Button buttonActionType="button" buttonType="success"><Plus />新規作成</Button>
        </div>
      </div>
      <Breadcrumb
        :items="[
          { name: 'Home', url: route('admin.dashboard') },
          { name: 'Questionnaire', url: route('admin.questionnaire.index') },
          { name: 'Show', url: route('admin.questionnaire.show') },
        ]"
      />
    </template>
    <FlashMessage />
    <!-- Contents -->
    <div class="w-full h-60 flex bg-green-300">
      <Card>
        <template #content>
          <div class="flex flex-col items-center justify-center h-full">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">アンケートタイトル</h2>
            <p class="text-base text-gray-800 dark:text-gray-100">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
            </p>
          </div>
        </template>
      </Card>
    </div>

    <h2>アンケート結果</h2>
    <div class="w-full flex flex-col lg:flex-row gap-5">
      <div class="w-1/2">
        <Card>
          <template #content></template>
        </Card>
      </div>
      <div class="w-1/2">
        <Card>
          <template #content></template>
        </Card>
      </div>
    </div>

    <div class="w-full">
      <Card>
        <template #content>
          <Table>
            <thead>
              <tr>
                <th>SL</th>
                <th>name</th>
                <th>回答</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="questionnaire">
                <td>1</td>
                <td>山田 太郎</td>
                <td>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam, nihil quia.
                  Iure voluptas, omnis quam tempora recusandae dolor cupiditate possimus.
                </td>
                <td
                  class="flex gap-3 p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                  <Button
                    :href="route('admin.school.show', item.id)"
                    buttonType="info"
                    class="size-10"
                  >
                    <EyeOutline />
                  </Button>
                  <Button @click="editSchool(item)" buttonType="warning" class="size-10">
                    <NoteEdit />
                  </Button>
                  <Button
                    @click="requestDeletion(item, 'delete')"
                    buttonType="danger"
                    class="size-10"
                  >
                    <TrashCanOutline />
                  </Button>
                  <Button
                    v-if="activeTab === 'deletedSchools'"
                    @click="restoreSchool(item.id)"
                    buttonType="success"
                  >
                    <RestoreIcon />
                  </Button>
                  <Button
                    v-if="activeTab === 'deletedSchools'"
                    @click="requestDeletion(item, 'forceDelete')"
                    buttonType="danger"
                  >
                    <TrashCanOutline />
                  </Button>
                </td>
              </tr>
            </tbody>
          </Table>
        </template>
      </Card>
    </div>
  </AdminDashboardLayout>
</template>