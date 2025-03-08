<script setup>
import { ref, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import NavLink from '@/Components/NavLink.vue';
import Table from '@/Components/Table/Table.vue';
import Button from '@/Components/Buttons/Button.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import PageSizeSelector from '@/Components/PageSizeSelector.vue';
import SortSelector from '@/Components/SortSelector.vue';
import ListView from '@/Components/ListView.vue';
import GridView from '@/Components/GridView.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import Pagination from '@/Components/Pagination.vue';
// Icons
import Plus from 'vue-material-design-icons/Plus.vue';
import Magnify from 'vue-material-design-icons/Magnify.vue';
import ViewList from 'vue-material-design-icons/ViewList.vue';
import DotsGrid from 'vue-material-design-icons/DotsGrid.vue';
import EyeOutline from 'vue-material-design-icons/EyeOutline.vue';
import NoteEdit from 'vue-material-design-icons/NoteEdit.vue';
import TrashCanOutline from 'vue-material-design-icons/TrashCanOutline.vue';
import ClassSidebarLink from '../Classes/_components/ClassSidebarLink.vue';

const props = defineProps({
  courses: Object,
  generalCourses: Object,
  shortCourses: Object,
  trailCourses: Object,
  deletedCourses: Object,
});

// Form
const form = useForm({});
const isSidebarVisible = ref(false);

// Tabs
const tabs = [
  { name: 'courses', label: 'コース一覧' },
  { name: 'generalCourses', label: '一般教室' },
  { name: 'shortCourses', label: '短期教室' },
  { name: 'trailCourses', label: '体験教室' },
  { name: 'deletedCourses', label: '削除済一覧' },
];
const activeTab = ref('generalCourses');
const viewMode = ref('list');
const switchTab = (tabName) => {
  activeTab.value = tabName;
};

// Schools
const currentCourses = computed(() => {
  return props[activeTab.value];
});

// ソート
const sortOptions = [
  { value: 'name_asc', label: '学校名 (昇順)' },
  { value: 'name_desc', label: '学校名 (降順)' },
];
</script>

<template>
  <Head title="Course" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Course</h1>
        <div class="flex justify-end items-center gap-2">
          <Button buttonActionType="button" buttonType="success">Export</Button>
          <Button buttonActionType="button" buttonType="success">Import</Button>
          <Button @click="isSidebarVisible = true" buttonActionType="button" buttonType="success"
            ><Plus />新規作成</Button
          >
        </div>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Course', url: route('admin.course.index') },
          ]"
        />
      </div>
    </template>
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`学校を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="flex gap-5">
      <!-- Sidebar -->
       <div class="w-60">
        <ClassSidebarLink />
       </div>
      <Card>
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
          <div class="flex justify-between items-center mb-4">
            <div class="relative flex justify-start items-center md:w-2/3 lg:w-1/3">
              <TextInput
                id="search"
                type="text"
                name="search"
                class="block w-full"
                placeholder="検索してください。"
                v-model="search"
              />
              <Button
                @click="searchSchools"
                buttonActionType="button"
                buttonType="primary"
                class="absolute right-0 bg-transparent text-black"
              >
                <Magnify />
              </Button>
            </div>
            <div class="flex justify-end gap-4">
              <!-- 表示順変更 -->
              <SortSelector :sortOptions="sortOptions" />
              <!-- 表示件数変更 -->
              <PageSizeSelector />
              <Button
                @click="viewMode = 'list'"
                :class="{ 'bg-indigo-300': viewMode === 'list' }"
                buttonType="pink"
              >
                <ViewList />
              </Button>
              <Button
                @click="viewMode = 'grid'"
                :class="{ 'bg-indigo-300': viewMode === 'grid' }"
                buttonType="info"
                iconSrc="/upload/grid-icon.svg"
                :iconOnly="true"
              >
                <DotsGrid />
              </Button>
            </div>
          </div>
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 w-full items-center">
              <div class="tab-content pt-0">
                <div
                  v-for="tab in tabs"
                  :key="tab.name"
                  class="tab-pane space-y-4"
                  role="tabpanel"
                  v-show="activeTab === tab.name"
                >
                  <!-- リスト表示 -->
                  <div v-if="viewMode === 'list'">
                    <ListView
                      :items="currentCourses"
                      :headers="['SL', 'タイプ', '学校名', '住所', '電話番号', 'Action']"
                    >
                      <template #renderItem="{ item, index }">
                        <td
                          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                          {{ index + 1 }}
                        </td>
                        <td
                          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                          {{ item.type }}
                        </td>
                        <td
                          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                          {{ item.name }}
                        </td>
                        <td
                          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                          {{ item.address1 }}{{ item.address2 }}
                        </td>
                        <td
                          class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                          {{ item.phone_number }}
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
                      </template>
                    </ListView>
                  </div>
                  <!-- グリッド表示 -->
                  <div v-else>
                    <GridView :items="currentourses.data">
                      <template #renderItem="{ item }">
                        <div class="flex justify-center mb-4">
                          <figure>
                            <img src="/upload/school-icon.svg" alt="school image" width="56" />
                          </figure>
                        </div>
                        <h3 class="text-base font-medium text-gray-900 dark:text-white text-center">
                          {{ item.name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                          {{ item.type }}
                        </p>
                        <div class="flex justify-center gap-3 mt-4">
                          <Button
                            :href="route('admin.school.show', item.id)"
                            buttonActionType="button"
                            buttonType="info"
                          >
                            <EyeOutline />
                          </Button>
                          <Button @click="editSchool(item)" buttonType="warning">
                            <NoteEdit />
                          </Button>
                          <Button @click="requestDeletion(item, 'delete')" buttonType="danger">
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
                        </div>
                      </template>
                    </GridView>
                  </div>
                  <div class="flex justify-between items-center">
                    <div class="flex items-center dark:text-white">
                      <div class="mr-2">
                        <span>{{ props.courses.current_page }}</span
                        >ページ / <span>{{ props.courses.last_page }}</span
                        >ページ中
                      </div>
                    </div>
                    <Pagination :links="courses.links"></Pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </Card>
    </div>
  </AdminDashboardLayout>
</template>
