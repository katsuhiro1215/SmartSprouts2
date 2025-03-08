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
  allQuestionnaires: Object,
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
        ]"
      />
    </template>
    <FlashMessage />

    <div class="w-full bg-green-300">
      <Card>
        <template #content>
          <h2 class="text-xl font-bold mb-4">アンケート一覧</h2>
          <Table v-if="allQuestionnaires.length > 0">
            <template #head>
              <th>SL</th>
              <th>アンケート名</th>
              <th>ステータス</th>
              <th>Action</th>
            </template>
            <template #body>
              <tr v-for="questionnaire in allQuestionnaires" :key="questionnaire.id">
                <td>{{ questionnaire.name }}</td>
                <td>{{ questionnaire.status }}</td>
                <td
                  class="flex gap-3 p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                  <Button
                    buttonType="info"
                    class="size-10"
                  >
                    <EyeOutline />
                  </Button>
                </td>
              </tr>
            </template>
          </Table>
          <p>まだアンケートがありません。</p>

        </template>
      </Card>      
    </div>

    <div class="w-full">
      <Card>
        <template #content>
          <div class="w-full flex gap-5">
            <div class="w-1/2">
              <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
            </div>
            <div class="w-1/2">
              <p class="text-base text-gray-800 dark:text-gray-100">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
              </p>
            </div>
          </div>

          <div class="w-full h-80 bg-indigo-300 my-10">
            アンケート全体
             <div class="w-[95%] h-[95%] m-5 bg-red-300">
              質問
              <div class="w-[90%] h-[90%] m-5 bg-green-300">
                選択肢
              <div class="w-[85%] h-[85%] m-5 bg-yellow-300">

              </div>

              </div>
             </div>
          </div>


          <div class="space-y-4">
            <h3 class="text-xl font-bold mb-4">アンケート回答</h3>
            <div class="space-y-2">
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
            </div>
            <h3 class="text-xl font-bold mb-4">アンケート回答</h3>
            <div class="space-y-2">
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
              <div class="w-full flex items-center gap-5">
                <div class="w-2/5">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">アンケート質問名</h3>
                </div>
                <div class="w-2/5">
                  <p class="text-base text-gray-800 dark:text-gray-100">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.
                  </p>
                </div>
                <div class="w-1/5">
                  <div class="flex gap-5">
                    <Button buttonActionType="button" buttonType="warning">編集</Button>
                    <Button buttonActionType="button" buttonType="danger">削除</Button>
                  </div>
                </div>
              </div>
            </div>
          </div>



        </template>
      </Card>
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
              <tr v-for="questionnaire in allQuestionnaires" :key="questionnaire.id">
                <td>1</td>
                <td>{{ questionnaire.name }}</td>
                <td>{{ questionnaire.status }}</td>
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