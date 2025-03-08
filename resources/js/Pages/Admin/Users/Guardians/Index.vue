<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';
// Layout
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import RightSidebar from './components/RightSidebar.vue';
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
import Magnify from 'vue-material-design-icons/Magnify.vue';
import ViewList from 'vue-material-design-icons/ViewList.vue';
import DotsGrid from 'vue-material-design-icons/DotsGrid.vue';
import EyeOutline from 'vue-material-design-icons/EyeOutline.vue';
import NoteEdit from 'vue-material-design-icons/NoteEdit.vue';
import TrashCanOutline from 'vue-material-design-icons/TrashCanOutline.vue';

// Props
const props = defineProps({
  allSchools: Object,
  schools: Object,
  deletedSchools: Object,
  nurserySchools: Object,
  kindergartens: Object,
  elementarySchools: Object,
  juniorHighSchools: Object,
  highSchools: Object,
  universities: Object,
  others: Object,
});

// Lifecycle
onMounted(() => {
  console.log('elementarySchools:', props);
});

// Form
const form = useForm({});
const isSidebarVisible = ref(false);
const editData = ref(null);

// Tabs
const tabs = [
  { name: 'allSchools', label: '全学校一覧' },
  { name: 'schools', label: '学校一覧' },
  { name: 'nurserySchools', label: '保育園一覧' },
  { name: 'kindergartens', label: '幼稚園一覧' },
  { name: 'elementarySchools', label: '小学校一覧' },
  { name: 'juniorHighSchools', label: '中学校一覧' },
  { name: 'highSchools', label: '高校一覧' },
  { name: 'universities', label: '大学一覧' },
  { name: 'others', label: 'その他一覧' },
  { name: 'deletedSchools', label: '削除済一覧' },
];
const activeTab = ref('allSchools');
const viewMode = ref('list');
const switchTab = (tabName) => {
  activeTab.value = tabName;
};

// Schools
const currentSchools = computed(() => {
  return props[activeTab.value];
});

// 編集
const editSchool = (school) => {
  editData.value = school;
  isSidebarVisible.value = true;
};

// 復活処理
const restoreSchool = (id) => {
  form.put(route('admin.school.restore', id));
};

// 削除処理 (削除、完全削除) --- アラート表示
const showAlert = ref(false);
const currentEntity = ref(null);
const entityType = ref('');
const requestDeletion = (entity, type) => {
  currentEntity.value = entity;
  entityType.value = type;
  showAlert.value = true;
};
const confirmDeletion = () => {
  if (entityType.value === 'delete') {
    form.delete(route('admin.school.destroy', currentEntity.value.id));
  } else if (entityType.value === 'forceDelete') {
    form.delete(route('admin.school.forceDelete', currentEntity.value.id));
  }
  showAlert.value = false;
};
const cancelDeletion = () => {
  showAlert.value = false;
};

// 検索
const search = ref('');
const searchSchools = () => {
  form.get(route('admin.school.index', { search: search.value }));
};

// ソート
const sortOptions = [
  { value: 'name_asc', label: '学校名 (昇順)' },
  { value: 'name_desc', label: '学校名 (降順)' },
];

</script>

<template>
  <Head title="学校管理" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">School</h1>
        <div class="flex justify-end items-center gap-2">
          <Button buttonActionType="button" buttonType="success">Export</Button>
          <Button buttonActionType="button" buttonType="success">Import</Button>
          <Button @click="isSidebarVisible = true" buttonActionType="button" buttonType="success"
            ><Plus />新規作成</Button
          >
        </div>
      </div>
    </template>
    <div class="w-full p-2">
      <Breadcrumb
        :items="[
          { name: 'Home', url: route('admin.dashboard') },
          { name: 'School', url: route('admin.school.index') },
        ]"
      />
    </div>

    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`学校を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="w-full p-6 bg-slate-100 space-y-4">
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
                      :items="currentSchools"
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
                    <GridView :items="currentSchools.data">
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
                        <span>{{ props.schools.current_page }}</span
                        >ページ / <span>{{ props.schools.last_page }}</span
                        >ページ中
                      </div>
                    </div>
                    <Pagination :links="schools.links"></Pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </Card>
    </div>

    <RightSidebar
      :isVisible="isSidebarVisible"
      :editData="editData"
      :schools="schools"
      @close="isSidebarVisible = false"
    />
  </AuthenticatedLayout>
</template>
