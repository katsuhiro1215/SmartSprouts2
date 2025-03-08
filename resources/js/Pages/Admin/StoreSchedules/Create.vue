<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps, ref, computed, watch } from 'vue';
import axios from 'axios';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import InputError from '@/Components/Forms/InputError.vue';
import LoadingIndicator from '@/Components/Loading/LoadingIndicator.vue';
//Constants
import messages from '@/Constants/messages';
import validationMessages from '@/Constants/validationMessages';
// Icons
import Plus from 'vue-material-design-icons/Plus.vue';
import Close from 'vue-material-design-icons/Close.vue';
import SelectInput from '@/Components/Forms/SelectInput.vue';

defineProps({
  stores: Array,
});

const form = useForm({
  store_id: '',
  schedules: [
    {
      date: '',
      dayOfWeek: '',
      openTime: '',
      closeTime: '',
    },
  ],
  file: null,
  errors: {},
});

const isLoading = ref(false);
const loadingText = ref('');

const currentSchedules = ref([]);

const getCurrentMonthYear = () => {
  const date = new Date();
  return date.toISOString().slice(0, 7); // 'YYYY-MM' 形式で取得
};
const currentMonthYear = ref(getCurrentMonthYear()); /// 現在の月と年を追跡

// const MAX_SCHEDULES = 20;
const MAX_SCHEDULES = 5; // 検証用に5件に制限

const addSchedule = () => {
  if (form.schedules.length < MAX_SCHEDULES) {
    form.schedules.push({
      date: '',
      dayOfWeek: '',
      openTime: '',
      closeTime: '',
    });
  }
};

const removeSchedule = (index) => {
  form.schedules.splice(index, 1);
};

const updateDayOfWeek = (index) => {
  const date = new Date(form.schedules[index].date);
  const dayOfWeek = ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'][
    date.getDay()
  ];
  form.schedules[index].dayOfWeek = dayOfWeek;
};

// 時間のバリデーション
const validateTimes = (index) => {
  const schedule = form.schedules[index];
  if (schedule.openTime && schedule.closeTime) {
    const openTime = new Date(`1970-01-01T${schedule.openTime}:00`);
    const closeTime = new Date(`1970-01-01T${schedule.closeTime}:00`);
    if (closeTime <= openTime) {
      form.errors[`schedules.${index}.closeTime`] = validationMessages.storeSchedules.closeTime;
      schedule.closeTime = '';
    } else {
      delete form.errors[`schedules.${index}.closeTime`];
    }
  }
};

// 重複チェック
const checkForConflicts = async (index) => {
  const schedule = form.schedules[index];
  if (form.store_id && schedule.date && schedule.openTime && schedule.closeTime) {
    try {
      const url = route('admin.storeSchedule.checkConflicts', {
        store_id: form.store_id,
        date: schedule.date,
        openTime: schedule.openTime,
        closeTime: schedule.closeTime,
      });
      console.log('Checking for conflicts at URL:', url);
      const response = await axios.get(url);
      console.log('Conflict Response:', response.data);
      if (response.data.conflict) {
        form.errors[`schedules.${index}.conflict`] =
          validationMessages.storeSchedules.conflictSchedule;
      } else {
        delete form.errors[`schedules.${index}.conflict`];
      }
    } catch (error) {
      console.error('Error checking for conflicts:', error);
    }
  }
};

// 必須フィールドのバリデーション
const validateRequiredFields = (index) => {
  const schedule = form.schedules[index];
  if (!schedule.date) {
    form.errors[`schedules.${index}.date`] = validationMessages.storeSchedules.required;
  } else {
    delete form.errors[`schedules.${index}.date`];
  }
  if (!schedule.openTime) {
    form.errors[`schedules.${index}.openTime`] = validationMessages.storeSchedules.required;
  } else {
    delete form.errors[`schedules.${index}.openTime`];
  }
  if (!schedule.closeTime) {
    form.errors[`schedules.${index}.closeTime`] = validationMessages.storeSchedules.required;
  } else {
    delete form.errors[`schedules.${index}.closeTime`];
  }
};

// 重複チェック
const checkInternalConflicts = (index) => {
  const schedule = form.schedules[index];
  for (let i = 0; i < form.schedules.length; i++) {
    if (i !== index && form.schedules[i].date === schedule.date) {
      const openTime1 = new Date(`1970-01-01T${form.schedules[i].openTime}:00`);
      const closeTime1 = new Date(`1970-01-01T${form.schedules[i].closeTime}:00`);
      const openTime2 = new Date(`1970-01-01T${schedule.openTime}:00`);
      const closeTime2 = new Date(`1970-01-01T${schedule.closeTime}:00`);
      if (
        (openTime2 >= openTime1 && openTime2 < closeTime1) ||
        (closeTime2 > openTime1 && closeTime2 <= closeTime1) ||
        (openTime2 <= openTime1 && closeTime2 >= closeTime1)
      ) {
        form.errors[`schedules.${index}.conflict`] = validationMessages.storeSchedules.conflictSchedule;
        return;
      }
    }
  }
  delete form.errors[`schedules.${index}.conflict`];
};

// 現在のスケジュールを取得
const fetchCurrentSchedules = async (direction = null) => {
  if (form.store_id) {
    if (direction) {
      updateCurrentMonthYear(direction);
    }
    try {
      const url = route('admin.storeSchedule.current', {
        store_id: form.store_id,
        date: currentMonthYear.value,
      });
      console.log('Fetching current schedules from URL:', url);
      const response = await axios.get(url);
      console.log('Current Schedules Response:', response.data);
      currentSchedules.value = response.data;
    } catch (error) {
      console.error('Error fetching current schedules:', error);
    }
  }
};

// 現在の月と年を更新
const updateCurrentMonthYear = (direction) => {
  const date = new Date(currentMonthYear.value + '-01');
  if (direction === 'prev') {
    date.setMonth(date.getMonth() - 1);
  } else if (direction === 'next') {
    date.setMonth(date.getMonth() + 1);
  }
  currentMonthYear.value = date.toISOString().slice(0, 7); // 'YYYY-MM' 形式で更新
};

watch(
  () => form.store_id,
  (newStoreId) => {
    if (newStoreId) {
      fetchCurrentSchedules(currentMonthYear.value);
    }
  }
);

// ボタンの状態
const submitButtonType = computed(() => {
  return form.store_id &&
    form.schedules.every((schedule) => schedule.date && schedule.openTime && schedule.closeTime)
    ? 'primary'
    : 'secondary';
});

// ボタンの状態
const isSubmitDisabled = computed(() => {
  return !(
    form.store_id &&
    form.schedules.every((schedule) => schedule.date && schedule.openTime && schedule.closeTime)
  );
});

// ボタンの状態
const isAddDisabled = computed(() => {
  return form.schedules.length >= MAX_SCHEDULES;
});

// フォームの送信
const store = () => {
  isLoading.value = true;
  loadingText.value = '登録中';
  form.post(
    route('admin.storeSchedule.store', {
      onFinish: () => {
        isLoading.value = false;
        loadingText.value = '';
      },
    })
  );
};
</script>

<template>
  <Head title="店舗スケジュール" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
          Store Schedule | Create
        </h1>
        <div class="flex justify-end items-center gap-4">
          <Button
            :href="route('admin.storeSchedule.index')"
            buttonActionType="button"
            buttonType="secondary"
            >一覧</Button
          >
        </div>
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Store Schedule', url: route('admin.storeSchedule.index') },
        { name: 'Create', url: route('admin.storeSchedule.create') },
      ]"
    />
    <FlashMessage />
    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <div class="flex gap-5">
      <div class="w-3/4">
        <Card>
          <template #header>
            <div class="space-y-4">
              <h2 class="text-xl font-bold tracking-tight">
                {{ messages.storeSchedule.create.header }}
              </h2>
              <p class="text-slate-400" v-html="messages.storeSchedule.create.description"></p>
              <div class="shrink-0 bg-slate-300 h-[1px] w-full my-6"></div>
            </div>
          </template>
          <template #content>
            <form @submit.prevent="store" class="space-y-8">
              <div class="flex flex-col lg:flex-row">
                <div class="w-full space-y-6">
                  <div class="flex flex-col md:flex-row gap-5">
                    <div class="w-1/3">
                      <InputLabel for="name" value="店舗名" required />
                      <SelectInput
                        id="store_id"
                        name="store_id"
                        v-model="form.store_id"
                        :options="stores"
                        required
                      />
                      <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                  </div>
                  <div v-if="form.store_id" class="space-y-4">
                    <div
                      v-for="(schedule, index) in form.schedules"
                      :key="index"
                      class="flex items-center gap-4"
                    >
                      <div class="w-1/4">
                        <!-- 営業日 -->
                        <InputLabel value="営業日" required />
                        <TextInput
                          type="date"
                          class="block w-full"
                          v-model="schedule.date"
                          @change="updateDayOfWeek(index)"
                          required
                        />
                      </div>
                      <div class="w-1/4">
                        <!-- 曜日 -->
                        <InputLabel value="曜日" required />
                        <TextInput
                          type="text"
                          class="block w-full bg-slate-100"
                          v-model="schedule.dayOfWeek"
                          readonly
                        />
                      </div>
                      <div class="w-1/4">
                        <!-- 開店時間 -->
                        <InputLabel value="開店時間" required />
                        <TextInput
                          type="time"
                          class="block w-full"
                          v-model="schedule.openTime"
                          @blur="
                            validateTimes(index);
                            validateRequiredFields(index);
                            checkForConflicts(index);
                            checkInternalConflicts(index);
                          "
                          required
                        />
                        <InputError
                          class="mt-2"
                          :message="
                            form.errors[`schedules.${index}.openTime`] ||
                            form.errors[`schedules.${index}.conflict`]
                          "
                        />
                      </div>
                      <div class="w-1/4">
                        <!-- 閉店時間 -->
                        <InputLabel value="閉店時間" required />
                        <TextInput
                          type="time"
                          class="block w-full"
                          v-model="schedule.closeTime"
                          @blur="
                            validateTimes(index);
                            validateRequiredFields(index);
                            checkForConflicts(index);
                            checkInternalConflicts(index);
                          "
                          required
                        />
                        <InputError
                          class="mt-2"
                          :message="
                            form.errors[`schedules.${index}.closeTime`] ||
                            form.errors[`schedules.${index}.conflict`]
                          "
                        />
                      </div>
                      <div class="w-1/4">
                        <Button
                          class="mt-6"
                          buttonType="danger"
                          @click.prevent="removeSchedule(index)"
                        >
                          <Close />
                        </Button>
                      </div>
                    </div>
                    <div class="flex items-center gap-4">
                      <Button
                        buttonType="primary"
                        @click.prevent="addSchedule"
                        :disabled="isAddDisabled"
                      >
                        <Plus />追加
                      </Button>
                      <span v-if="isAddDisabled" class="text-red-500">上限は20件までです。</span>
                    </div>
                  </div>
                </div>
              </div>
              <Button :buttonType="submitButtonType" type="submit" :disabled="isSubmitDisabled"
                >登録</Button
              >
            </form>
          </template>
        </Card>
      </div>

      <div class="w-1/4">
        <Card>
          <template #header>
            <h2 class="text-lg font-bold">現在登録されているスケジュール</h2>
          </template>
          <template #content>
            <div class="flex justify-between items-center mb-4">
              <Button @click="fetchCurrentSchedules('prev')" buttonType="secondary">前月</Button>
              <span>{{ currentMonthYear }}</span>
              <Button @click="fetchCurrentSchedules('next')" buttonType="secondary">次月</Button>
            </div>
            <table class="min-w-full bg-white">
              <thead>
                <tr>
                  <th class="py-2">SL</th>
                  <th class="py-2">日付</th>
                  <th class="py-2">開店時間</th>
                  <th class="py-2">閉店時間</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="schedule in currentSchedules" :key="schedule.id">
                  <td class="border px-4 py-2">{{ schedule.id }}</td>
                  <td class="border px-4 py-2">{{ schedule.date }}</td>
                  <td class="border px-4 py-2">{{ schedule.openTime }}</td>
                  <td class="border px-4 py-2">{{ schedule.closeTime }}</td>
                </tr>
              </tbody>
            </table>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>