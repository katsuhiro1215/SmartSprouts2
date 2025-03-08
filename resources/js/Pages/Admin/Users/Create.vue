<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import LoadingIndicator from '@/Components/Loading/LoadingIndicator.vue';
// Components - Forms
import TextInput from '@/Components/Forms/TextInput.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import SelectInput from '@/Components/Forms/SelectInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
// Constants
import validationMessages from '@/Constants/validationMessages';
//icon
import EyeOutline from 'vue-material-design-icons/EyeOutline.vue';
import Back from 'vue-material-design-icons/ArrowLeft.vue';
// User - components
import UserSidebarLink from './_components/UserSidebarLink.vue';
import Wizard from './_components/Wizard.vue';
// Validation
import {
  validateStoreId,
  validateUsername,
  validateEmail,
  validatePassword,
  validatePasswordConfirmation,
  validateAllFields,
} from './_components/Validation';

const props = defineProps({
  stores: Array,
});

const form = useForm({
  store_id: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const isLoading = ref(false);
const loadingText = ref('');

// メールアドレスのユニーク性チェック
const checkEmailUniqueness = async () => {
  if (form.email) {
    try {
      const response = await axios.get(route('admin.user.checkEmail'), {
        params: { email: form.email },
      });
      if (response.data.exists) {
        form.errors.email = validationMessages.user.emailUnique;
      } else {
        delete form.errors.email;
      }
    } catch (error) {
      console.error('Error checking email uniqueness:', error);
    }
  }
};

// ボタンの状態
const submitButtonType = computed(() => {
  return form.store_id && form.username && form.email && form.password && form.password_confirmation
    ? 'primary'
    : 'secondary';
});

const isSubmitDisabled = computed(() => {
  return !(
    form.store_id &&
    form.username &&
    form.email &&
    form.password &&
    form.password_confirmation
  );
});

// フォームの送信 (Userの登録)
const store = async () => {
  validateAllFields(form);
  await checkEmailUniqueness();

  isLoading.value = true;
  loadingText.value = '登録中';
  form.post(route('admin.user.store'), {
    onFinish: () => {
      isLoading.value = false;
      loadingText.value = '';
    },
  });
};
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
            { name: 'Create', url: route('admin.user.create') },
          ]"
        />
      </div>
    </template>
    <FlashMessage />
    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <div class="w-full flex gap-5">
      <UserSidebarLink />
      <div class="w-[calc(100%-64px)] sm:w-[calc(100%-80px)] lg:w-[calc(100%-96px)]">
        <Card>
          <template #header>
            <div class="flex justify-between">
              <div class="flex flex-col gap-2">
                <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300 leading-tight">
                  ユーザー新規作成
                </h2>
                <p>ユーザーを新規作成</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button
                  :href="route('admin.user.index')"
                  buttonActionType="button"
                  buttonType="secondary"
                  ><Back />戻る</Button
                >
              </div>
            </div>
          </template>
          <template #content>
            <div class="space-y-6">
              <Wizard />
              <!-- Form -->
              <form @submit.prevent="store" class="space-y-8">
                <div class="w-full space-y-6">
                  <div class="w-1/2 lg:w-1/3 space-y-3">
                    <InputLabel for="store_id" value="店舗名" required />
                    <SelectInput
                      id="store_id"
                      name="store_id"
                      v-model="form.store_id"
                      :options="stores"
                      @blur="validateStoreId(form)"
                      required
                    />
                    <InputError class="mt-2" :message="form.errors.store_id" />
                  </div>
                  <div class="w-1/2 lg:w-1/3 space-y-3">
                    <InputLabel for="username" value="ユーザー名" required />
                    <TextInput
                      id="username"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.username"
                      @blur="validateUsername(form)"
                      required
                      placeholder="ユーザー名を入力してください。"
                      autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.username" />
                  </div>
                  <div class="w-1/2 lg:w-1/3 space-y-3">
                    <InputLabel for="email" value="メールアドレス" required />
                    <TextInput
                      id="email"
                      type="email"
                      class="mt-1 block w-full"
                      v-model="form.email"
                      @blur="validateEmail(form); checkEmailUniqueness()"
                      required
                      placeholder="メールアドレスを入力してください。"
                      autocomplete="email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                  </div>
                  <div class="w-1/2 lg:w-1/3 space-y-3">
                    <InputLabel for="password" value="パスワード" required />
                    <TextInput
                      id="password"
                      type="password"
                      class="mt-1 block w-full"
                      v-model="form.password"
                      @blur="validatePassword(form)"
                      required
                      placeholder="パスワードを入力してください。"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                  </div>
                  <div class="w-1/2 lg:w-1/3 space-y-3">
                    <InputLabel for="password_confirmation" value="パスワード確認" required />
                    <div class="relative">
                      <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        @blur="validatePasswordConfirmation(form)"
                        required
                        placeholder="再度パスワードを入力してください。"
                      />
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <EyeOutline class="h-6 w-6 text-gray-400" />
                      </div> 
                    </div>
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                  </div>
                </div>
                <Button :buttonType="submitButtonType" type="submit" :disabled="isSubmitDisabled"
                  >登録</Button
                >
              </form>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
