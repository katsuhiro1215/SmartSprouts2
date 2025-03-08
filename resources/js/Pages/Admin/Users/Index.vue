<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
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
// User - components
import UserSidebarLink from './_components/UserSidebarLink.vue';
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
  allUsers: Object,
  users: Object,
  deletedUsers: Object,
});

// Lifecycle
onMounted(() => {
  console.log('allUsers:', props);
});

// Form
const form = useForm({});
const isSidebarVisible = ref(false);

// Tabs
const tabs = [
  { name: 'allUsers', label: '全ユーザー一覧' },
  { name: 'users', label: 'ユーザー一覧' },
  { name: 'deletedSchools', label: '削除済一覧' },
];
const activeTab = ref('allUsers');
const viewMode = ref('list');
const switchTab = (tabName) => {
  activeTab.value = tabName;
};

// Users
const currentUsers = computed(() => {
  return props[activeTab.value];
});

// 復活処理
const restoreUser = (id) => {
  form.put(route('admin.user.restore', id));
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
    form.delete(route('admin.user.destroy', currentEntity.value.id));
  } else if (entityType.value === 'forceDelete') {
    form.delete(route('admin.user.forceDelete', currentEntity.value.id));
  }
  showAlert.value = false;
};
const cancelDeletion = () => {
  showAlert.value = false;
};

// 検索
const search = ref('');
const searchUsers = () => {
  form.get(route('admin.user.index', { search: search.value }));
};

// ソート
const sortOptions = [
  { value: 'username_asc', label: 'ユーザー名 (昇順)' },
  { value: 'username_desc', label: 'ユーザー名 (降順)' },
];
</script>

<template>
  <Head title="ユーザー管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">顧客管理</h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'User', url: route('admin.user.index') },
          ]"
        />
      </div>
    </template>
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`ユーザーを削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="w-full flex gap-5">
      <UserSidebarLink />
      <div class="w-[calc(100%-64px)] sm:w-[calc(100%-80px)] lg:w-[calc(100%-96px)]">
        <Card>
          <template #header>
            <div class="flex justify-between">
              <div class="flex flex-col gap-2">
                <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300 leading-tight">
                  ユーザー一覧
                </h2>
                <p>顧客一覧</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button buttonActionType="button" buttonType="success">Export</Button>
                <Button buttonActionType="button" buttonType="success">Import</Button>
                <Button
                  :href="route('admin.user.bulkCreate')"
                  buttonActionType="button"
                  buttonType="pink"
                  ><Plus />一括作成</Button
                >
                <Button
                  :href="route('admin.user.create')"
                  buttonActionType="button"
                  buttonType="orange"
                  ><Plus />新規作成</Button
                >
              </div>
            </div>
          </template>
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
                        :items="currentUsers"
                        :headers="['SL', 'ユーザー名', 'メールアドレス', 'Action']"
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
                            {{ item.username }}
                          </td>
                          <td
                            class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                          >
                            {{ item.email }}
                          </td>
                          <td
                            class="flex gap-3 p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                          >
                            <Button
                              :href="route('admin.user.show', item.id)"
                              buttonType="info"
                              class="size-10"
                            >
                              <EyeOutline />
                            </Button>
                            <Button
                              :href="route('admin.user.edit', item.id)"
                              buttonType="warning"
                              class="size-10"
                            >
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
                              v-if="activeTab === 'deletedUsers'"
                              @click="restoreUser(item.id)"
                              buttonType="success"
                            >
                              <RestoreIcon />
                            </Button>
                            <Button
                              v-if="activeTab === 'deletedUsers'"
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
                      <GridView :items="currentUsers.data">
                        <template #renderItem="{ item }">
                          <div class="flex justify-center mb-4">
                            <figure>
                              <img src="/upload/user.png" alt="user image" width="56" />
                            </figure>
                          </div>
                          <h3
                            class="text-base font-medium text-gray-900 dark:text-white text-center"
                          >
                            {{ item.username }}
                          </h3>
                          <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                            {{ item.email }}
                          </p>
                          <div class="flex justify-center gap-3 mt-4">
                            <Button buttonType="indo">
                              <EyeOutline />
                            </Button>
                            <Button buttonType="warning">
                              <NoteEdit />
                            </Button>
                            <Button @click="requestDeletion(item, 'delete')" buttonType="danger">
                              <TrashCanOutline />
                            </Button>
                            <Button
                              v-if="activeTab === 'deletedUsers'"
                              @click="restoreUser(item.id)"
                              buttonType="success"
                            >
                              <RestoreIcon />
                            </Button>
                            <Button
                              v-if="activeTab === 'deletedUsers'"
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
                          <span>{{ props.users.current_page }}</span
                          >ページ / <span>{{ props.users.last_page }}</span
                          >ページ中
                        </div>
                      </div>
                      <Pagination :links="users.links"></Pagination>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
